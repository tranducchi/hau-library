<header id="header">
    <h1 class="text-center p-3">
        Brand Logo
    </h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/"><i class="fa fa-home pr-1"></i>Trang Chủ <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars pr-1"></i>Chuyên Mục
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            @foreach($cat_h as $c)
                                <a class="dropdown-item" href="/category/{{$c->slug}}">{{$c->name}}</a>
                                <div class="dropdown-divider"></div>
                            @endforeach


                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-pencil pr-1"></i>Liên Hệ</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a href="/history/{{Auth::user()->id}}" class="nav-link">Lịch sử mượn sách</a>
                    </li>
                    @endauth
                </ul>
                <form class="form-inline my-2 my-lg-0 mr-5" action="/search" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="key" placeholder="Nhập tên sách" aria-label="Search">
                    <button class=" my-2 my-sm-0" type="submit" ><i class="fa fa-search pr-1"></i></button>
                </form>
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-info text-white btn-sm" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                        </li>
                         <span class="nav-link">or</span>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-warning btn-sm" href="{{ route('register') }}">{{ __('Đăng kí') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/user/{{Auth()->user()->id}}">
                                    <i class="fa fa-user-circle pr-2"></i>Thông tin User
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out pr-2" aria-hidden="true"></i>{{ __('Đăng xuất') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <div class="cart nav-item">
                    <a href="#" class="nav-link text-secondary"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i></a>
                    <div class="cart-count">
                        {{Cart::content()->count()}}
                    </div>
                    <div class="show-cart-book">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <div class="order-book">
                                    @foreach(Cart::content() as $c)
                                    <li class="list-group-item d-flex justify-content-between">
                                      <div class="thumb-cart">
                                              <img src="/storage/covers/{{$c->options->img}}" alt="">
                                           </div>
                                        <a href="/book/{{$c->options->slug}}"> {{$c->name}}</a>
                                        <a href="{{$c->id}}" class="fa fa-times-circle text-danger" onclick="unBook(this,{{$c->id}});return false;" style="font-size: 21px;text-decoration: none"></a>
                                    </li>
                                    @endforeach
                                </div>
                                <hr style="margin:0">
                                <li class="more-cart" style="list-style: none">
                                    <a href="/show-cart" class="text-center">Xem giỏ sách</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </nav>
</header>
