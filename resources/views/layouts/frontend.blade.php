<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drughouse</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('pharmative/fonts/icomoon/style.css') }}">

  <link rel="stylesheet" href="{{ asset('pharmative/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('pharmative/fonts/flaticon/font/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('pharmative/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('pharmative/css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('pharmative/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('pharmative/css/owl.theme.default.min.css') }}">


  <link rel="stylesheet" href="{{ asset('pharmative/css/aos.css') }}">

  <link rel="stylesheet" href="{{ asset('pharmative/css/style.css') }}">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

</head>

<body>
  @if(session('success'))
  <div class="alert alert-success text-center">
      {{ session('success') }}
  </div>
  @endif
  <div class="site-wrap">


    <!--<div class="site-navbar py-2">

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
              <a href="index.html" class="js-logo-clone"><strong class="text-primary">Pharma</strong>tive</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="shop.html">Store</a></li>
                <li class="has-children">
                  <a href="#">Products</a>
                  <ul class="dropdown">
                    <li><a href="#">Supplements</a></li>
                    <li class="has-children">
                      <a href="#">Vitamins</a>
                      <ul class="dropdown">
                        <li><a href="#">Supplements</a></li>
                        <li><a href="#">Vitamins</a></li>
                        <li><a href="#">Diet &amp; Nutrition</a></li>
                        <li><a href="#">Tea &amp; Coffee</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Diet &amp; Nutrition</a></li>
                    <li><a href="#">Tea &amp; Coffee</a></li>
                    
                  </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="cart.html" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">2</span>
            </a>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>-->
    <!-- Navbar Start -->
    @include('frontend.partials.navbar')
    <!-- Navbar End -->

    @yield('content')

    <!--<footer class="site-footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4">About <strong class="text-primary">Pharmative</strong></h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio voluptates
                sed dolorum excepturi iure eaque, aut unde.</p>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Navigation</h3>
            <ul class="list-unstyled">
              <li><a href="#">Supplements</a></li>
              <li><a href="#">Vitamins</a></li>
              <li><a href="#">Diet &amp; Nutrition</a></li>
              <li><a href="#">Tea &amp; Coffee</a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
             
              Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made
              with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank"
                class="text-primary">Colorlib</a>
             
            </p>
          </div>

        </div>
      </div>
    </footer>-->
    <!-- Footer Start -->
    @include('frontend.partials.footer')
    <!-- Footer End -->

    


  </div>

  <script src="{{ asset('pharmative/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('pharmative/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('pharmative/js/popper.min.js') }}"></script>
  <script src="{{ asset('pharmative/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('pharmative/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('pharmative/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('pharmative/js/aos.js') }}"></script>

  <script src="{{ asset('pharmative/js/main.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
  $(function() {
      let minPrice = {{ request('min_price', 0) }};
      let maxPrice = {{ request('max_price', 500) }};

      $("#slider-range").slider({
          range: true,
          min: 0,
          max: 500, // You can set dynamically from DB later
          values: [minPrice, maxPrice],
          slide: function(event, ui) {
              $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
              $("#min_price").val(ui.values[0]);
              $("#max_price").val(ui.values[1]);
          }
      });

      // Initial display
      $("#amount").val("$" + $("#slider-range").slider("values", 0) +
          " - $" + $("#slider-range").slider("values", 1));
  });
  </script>

</body>

</html>