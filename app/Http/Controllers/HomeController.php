<?php

namespace App\Http\Controllers;

use App\Books;
use App\Categories;
use App\GetBooks;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use Cart;
use Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Books::select('id', 'slug', 'name', 'description', 'views', 'cover')->orderBy('created_at', 'desc')->paginate(12);
        return view('front-end.home', compact('books'));
    }
    public function viewByCat($slug){
        $books = Categories::where('slug', $slug)->orderBy('created_at', 'desc')->first()->books()->paginate(12);
        $cat_name = Categories::select('name')->where('slug', $slug)->first();
        return view('front-end.cat-view', compact('books', 'cat_name'));
    }
    public function viewDetailBook($slug){
        $sessionKey = 'book' . $slug;
        $sessionView = Session::get($sessionKey);
        $post = Books::where('slug', $slug)->first();
        //count view
        if (!$sessionView) { //nếu chưa có session
            Session::put($sessionKey, 1); //set giá trị cho session
            $post->increment('views');
        }
        $book = Books::select('id','name', 'slug', 'description', 'composer', 'cat_id', 'quantity', 'views', 'cover')->where('slug', $slug)->get();
        $book_relation = Books::select('name', 'slug', 'description', 'composer','cat_id', 'quantity', 'views', 'cover')->where('slug','<>', $slug)->limit(3)->get();
        return view('front-end.detail-book', compact('book', 'book_relation'));
    }

    //search function
    public function search(Request $request){
        $key = $request->key;
        $books = Books::where( 'name', 'LIKE', '%' . $key . '%' )->orWhere ( 'description', 'LIKE', '%' . $key . '%' )->paginate();
        return view('front-end.search', compact('key', 'books'));

    }
    // show infor user
    public function showInfo($id){
        $user = User::select('id','student_id', 'name', 'class', 'department', 'date_of_birth')->where('id', $id)->get();
        return view('front-end.show-info', compact('user'));

    }
    //edit user
    public function userEdit($id){
        $user = User::select('id','student_id', 'name', 'class', 'department', 'date_of_birth')->where('id', $id)->get();
     return view('front-end.user-edit', compact('user'));
    }
    //update user
    public function userUpdate(Request $request, $id){
        if($request->password){
            $this->validate($request, [
                'password' => 'required|confirmed|min:8',
            ],[
                'password.required'=>'Không được để trống password',
                'password.confirmed'=>'Mật không không trùng khớp',
                'password.min'=>'Mật khẩu quá ngắn'
            ]);
        }
        $user = User::find($id);
        $user->student_id = $request->student_id;
        $user->name = $request->name;
        $user->department = $request->department;
        $user->date_of_birth = $request->birth;
        if($request->password){
           $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/user/'.$user->id)->with('success', 'Thành công ! ');
    }
    //get book
    public function getBooks($id){
        $book = Books::find($id);
        if($book->quantity < 1){
            return abort(404);
        }
        $student_id = Auth()->user()->id;
        $name = $book->name;
        $img = $book->cover;
        $id = $book->id;
        $slug = $book->slug;
        Cart::add(['id' => $id, 'name' => $name, 'qty' => 1, 'price' => 1.0, 'weight'=>2, 'options' => ['img' => $img, 'slug'=>$slug, 'student_id'=>$student_id]]);
        return $book;
    }
    //un book
    public function unBook($id){
        $book = Books::find($id);
        $book_id = $book->id;
        $rowId = Cart::search(function($cartItem, $rowId) use($book_id) {
            return $cartItem->id == $book_id;
        });
        $final_id =0;
        foreach ($rowId as $r){
            $final_id = $r->rowId;
        }
        return Cart::remove($final_id);
    }
    public function showCart(){
        return view('front-end.show-cart');
    }
    public function requestBook(Request $request){
        $validatedData = $request->validate([
            'book_id' => 'unique:get_books',
        ],[
            'book_id.unique'=>'Sách đã mượn'
        ]);
        foreach (Cart::content() as $s)
        {
            $getbook = new GetBooks();
            $getbook->book_id = $s->id;
            $getbook->student_id = $s->options->student_id;
            $getbook->status = 1;

            $getbook->save();
        }
        Cart::destroy();

        return redirect('/')->with('message', 'IT WORKS!');
    }
    public function historyBook($id){
        $history = User::find($id);
        return view('front-end.history', compact('history'));
    }
    public function refundBook($id){
        $get_book = GetBooks::find($id);
        $get_book->status =3;
        $get_book->save();
        return redirect()->back();
    }
    public function handleRefund($id){
        return $id;
    }
    public function filterBook($con){
        if($con ==0){
            $history = GetBooks::select('id', 'book_id', 'student_id', 'status', 'updated_at')->get();
            $data = '';
            $i =1;
            $CSRFToken = csrf_token();

            foreach ($history as $h){
                if($h->status ==0 ||$h->status ==1 ||$h->status ==2 || $h->status==4){
                    $data .='<tr>
                        <th scope="row">'.$i.'</th>
                        <td>'.$h->aboutBook->name.'</td>
                        <td><img height="100" src="/storage/covers/'.$h->aboutBook->cover.'" alt=""></td>
                        <td>
                           '.
                        ($h->status ==2 || $h->status ==4 ? date('d-m-Y', strtotime($h->updated_at)) : "" )
                      .
                        '
                        </td>
                        <td>
                        '.
                        ($h->status ==2 ? " <span class=\"badge badge-success\">Đang mượn</span>":"" )
                        .
                        ($h->status ==1 ? " <span class=\"badge badge-warning\">Đang xử lý</span>":"" )
                        .
                        ($h->status ==4? " <span class=\"badge badge-info\">Đã Trả</span>":"" )
                        .'
                        </td>

                        <td>
                        '.

                        ($h->status ==2 ? "
                                     <form action=\"/refund/$h->id\" method=\"post\">
                                    <button type=\"submit\" class=\"btn btn-info btn-sm\" onclick=\"return confirm('Xác nhận trả sách !');\"><i class=\"fa fa-send\"></i></button>
                                     <input type=\"hidden\" name=\"_method\" value=\"PUT\">
                                      <input type=\"hidden\" name=\"_token\" value=\"$CSRFToken\">



                                </form>
                        " : "")
                        .'

                        </td>
                    </tr>' ;
                }
                $i++;
            }
        }else{
            $history = GetBooks::select('id', 'book_id', 'student_id', 'status')->where('status', $con)->get();
            $data = '';
            $i =0;
            $CSRFToken = csrf_token();

            foreach ($history as $h){

                if($h->status ==0 ||$h->status ==1 ||$h->status ==2 || $h->status==4){
                    $i++;
                    $data .='<tr>
                        <th scope="row">'.$i.'</th>
                        <td>'.$h->aboutBook->name.'</td>
                        <td><img height="100" src="/storage/covers/'.$h->aboutBook->cover.'" alt=""></td>
                        <td>
                           '.
                        ($h->status ==2 || $h->status ==4 ? date('d-m-Y', strtotime($h->updated_at)) : "" )
                        .
                        '
                        </td>
                        <td>
                        '.
                        ($h->status ==2 ? " <span class=\"badge badge-success\">Đang mượn</span>":"" )
                        .
                        ($h->status ==1 ? " <span class=\"badge badge-warning\">Đang xử lý</span>":"" )
                        .
                        ($h->status ==4? " <span class=\"badge badge-info\">Đã Trả</span>":"" )
                        .'
                        </td>

                        <td>
                        '.

                        ($h->status ==2 ? "
                                     <form action=\"/refund/$h->id\" method=\"post\">
                                    <button type=\"submit\" class=\"btn btn-info btn-sm\" onclick=\"return confirm('Xác nhận trả sách !');\"><i class=\"fa fa-send\"></i></button>
                                     <input type=\"hidden\" name=\"_method\" value=\"PUT\">
                                      <input type=\"hidden\" name=\"_token\" value=\"$CSRFToken\">



                                </form>
                        " : "")
                        .'

                        </td>
                    </tr>' ;

                }

            }
        }
        return $data;
    }
}
