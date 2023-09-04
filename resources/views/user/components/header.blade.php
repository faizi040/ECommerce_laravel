<!-- header section strats -->
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="Assets/images/logo.png"
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="nav-label">Pages <span
                                class="caret"></span></a>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="about.html">About</a></li>
                            <li class="dropdown-item"><a href="testimonial.html">Testimonial</a></li> 
                            
                        
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="product.html">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog_list.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/show_cart')}}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/show_order')}}">Order</a>
                    </li>
                    <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>

                    @if (Route::has('login'))
                        @auth
                            <li class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a href="{{ route('profile.show') }}">
                                            {{ __('Profile') }}
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="">
                                                <a class="" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                            this.closest('form').submit(); "
                                                    role="button">
                                                    <i class="fas fa-sign-out-alt"></i>

                                                    {{ __('Log Out') }}
                                                </a>
                                            </div>
                                        </form>


                                    </li>

                                </ul>
                            </li>
                        @else
                            <li class="nav-item ms-3">
                                <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item ">
                                <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                            </li>

                        @endauth
                    @endif


                </ul>
            </div>
        </nav>
    </div>
</header>

<!-- end header section -->
