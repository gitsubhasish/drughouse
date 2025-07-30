<div class="site-navbar py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.html" class="js-logo-clone"><strong class="text-primary">Drug</strong>house</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="{{ route('shop') }}">Store</a></li>
                <li class="has-children">
                  <a href="#">Category</a>
                  <ul class="dropdown">
                    @foreach($categories as $category)
                        <li><a href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                  </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="{{ route('cart.index') }}" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">{{ count(session('cart', [])) }}</span>
            </a>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a>
          </div>
          @if(Auth::check())
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->avatar_url ?? asset('default-avatar.png') }}" alt="Avatar" class="rounded-circle" width="32" height="32">
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('frontend.my-account') }}">My Account</a></li>
                    <li>
                        <form action="{{ route('frontend.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('frontend-login') }}">Login</a>
        @endif
        </div>
      </div>
    </div>