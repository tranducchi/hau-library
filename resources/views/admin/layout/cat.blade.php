<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Library HAU</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Sách
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/book/create" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/book" class="nav-link">
                                <i class="fa fa-list-ul nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-th-large"></i>
                        <p>
                            Môn học
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/category/create" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/category" class="nav-link">
                                <i class="fa fa-list-ul nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa fa-clipboard"></i>
                        @if($rq || $rf !==null)
                        <span class="badge badge-info right">
                                                                 {{$rq+$rf}}
                          
                        </span>
                        @endif
                        <p>
                            Mượn sách

                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/order" class="nav-link">
                                <i class="fa fa-deaf nav-icon"></i>
                                <p>Yêu cầu</p>
                                @if($rq ?? '')
                                <span class="badge badge-warning right">
                                 
                                        {{$rq ?? ''}}
                                       
                                </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/refund/list" class="nav-link">
                                <i class="fa fa-paper-plane nav-icon"></i>
                                <p>Trả sách</p>
                                    @if($rf ?? '')
                                <span class="badge badge-warning right"> 
                                        {{$rf ?? ''}}
                                    </span>
                                    @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin/" class="nav-link">
                                <i class="fa fa-list-ul nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/admin/user" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Sinh viên

                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-sliders-h nav-icon"></i>
                        <p>
                            Slide
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/slide/create" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon"></i>
                                <p>Thêm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/slide" class="nav-link">
                                <i class="fa fa-list-ul nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
