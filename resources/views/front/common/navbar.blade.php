<header id="header">
    <!--header-->
    {{-- <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--/header_top-->

    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('front.home') }}"><img width="139" height="39"
                                src="{{ asset('images/home/logo.png') }}" alt=""></a>
                    </div>
                    {{-- <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if (Auth::check())
                                <li><a href="#"><i class="fa fa-user"></i> Account</a>
                                </li>
                                <li><a href="{{ route('front.order.show') }}">Order</a>
                                <li><a href="">Checkout</a>
                                </li>
                                <li><a href="{{ route('front.cart.show') }}">Cart <span
                                            class="badge badge-pill">{{ auth()->user()->cart->count() }}</span></a></li>
                                <li>

                                    <a href="#" onclick="$('#logout').submit()"><span
                                            class="fas fa-sign-out-alt spa"></span>Logout</a>
                                    <form action="{{ route('logout') }}" method="POST" id="logout">@csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('front.home') }}" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">

                                    {{-- <li><a href="{{ route('productDetail') }}">Product Details</a></li> --}}
                                    @auth
                                        <li><a href="{{ route('front.order.show') }}">Order</a>
                                        </li>
                                        <li><a href="{{ route('front.cart.show') }}">Cart</a></li>
                                    @endauth
                                    <li><a href="{{ route('front.product.show') }}">Products</a></li>
                                    @if (!Auth::check())
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                    @endif
                                </ul>
                            </li>
                            {{-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> --}}
                            {{-- <li><a href="404.html">404</a></li> --}}
                            <li><a href="{{ route('front.contactUs') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
<!--/header-->
{{--
<div class="mainmenu-area d-flex">
    @if (Auth::check())
        <div class="round hollow text-center " id="chat-button" style="position:absolute; top: 600px; right: 33px">
            <a href="#" id="addClass"><span class="glyphicon glyphicon-comment"></span> </a>
        </div>
        <div id="app"><chat-app :user="{{ auth()->user() }}" /></div>
    @endif
    <div class="container">

        <div class="row"> --}}

{{-- <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div> --}}
{{-- <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav d-block">
                    @if (Auth::check())
                    @endif
                    <li class="active"><a href="{{ route('front.home') }}">Home</a></li> --}}
{{-- <li><a href="single-product.html">Single product</a></li> --}}
{{-- <li><a href="{{ route('front.product.show') }}">Products</a></li>
                    <li><a href="{{ route('front.calculate.index') }}">Calculate</a></li>
                    @if (Auth::check())
                        <li><a href="{{ route('front.cart.show') }}">Cart</a></li>
                        <li><a href="{{ route('front.order.show') }}">Order</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login && Register</a></li>
                    @endif --}}
{{-- <li><a href="#">Category</a></li> --}}
{{-- <li><a href="#">Others</a></li> --}}
{{-- <li><a href="#">Contact</a></li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endif
                </ul>
                @if (Auth::check())
                    <ul class="nav navbar-nav d-block float-left" style="margin-left: 500px">
                        <li><a href="{{ route('home') }}">{{ auth()->user()->name }}</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area --> --}}
