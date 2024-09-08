
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
  </head>
  <body onload="startTime()">
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div class="notification-slider">
              <div class="d-flex h-100"> <img src="../assets/images/giftools.gif" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light">Out new update has been release.</span></h6><i class="icon-arrow-top-right f-light"></i>
              </div>
              <div class="d-flex h-100"><img src="../assets/images/giftools.gif" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="f-light">Something you love is now on sale! </span></h6><a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
              </div>
            </div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              <li class="language-nav">
                <div class="translate_wrapper">
                  <div class="current_lang">
                    <div class="lang"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">EN                               </span></div>
                  </div>
                  <div class="more_lang">
                    <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span></div>
                    <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                    <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
                    <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                    <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                    <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                    <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                  </div>
                </div>
              </li>
              <li>                         <span class="header-search">
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#search"></use>
                  </svg></span></li>
              <li class="onhover-dropdown">
                <svg>
                  <use href="../assets/svg/icon-sprite.svg#star"></use>
                </svg>
                <div class="onhover-show-div bookmark-flip">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="front">
                        <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                        <ul class="bookmark-dropdown">
                          <li>
                            <div class="row">
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="file-text"></i></div><span>Forms</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="user"></i></div><span>Profile</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="server"></i></div><span>Tables</span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="text-center"><a class="flip-btn f-w-700" id="flip-btn" href="javascript:void(0)">Add New Bookmark</a></li>
                        </ul>
                      </div>
                      <div class="back">
                        <ul>
                          <li>
                            <div class="bookmark-dropdown flip-back-content">
                              <input type="text" placeholder="search...">
                            </div>
                          </li>
                          <li><a class="f-w-700 d-block flip-back" id="flip-back" href="javascript:void(0)">Back</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="mode">
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#moon"></use>
                  </svg>
                </div>
              </li>
              <li class="cart-nav onhover-dropdown">
                <div class="cart-box">
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#stroke-ecommerce"></use>
                  </svg><span class="badge rounded-pill badge-success">2</span>
                </div>
                <div class="cart-dropdown onhover-show-div">
                  <h6 class="f-18 mb-0 dropdown-title">Cart</h6>
                  <ul>
                    <li>
                      <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="../assets/images/other-images/cart-img.jpg" alt="">
                        <div class="media-body"><span>Furniture Chair for Home</span>
                          <div class="qty-box">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                              <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                            </div>
                          </div>
                          <h6 class="font-primary">$500</h6>
                        </div>
                        <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li>
                      <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="../assets/images/other-images/cart-img.jpg" alt="">
                        <div class="media-body"><span>Furniture Chair for Home</span>
                          <div class="qty-box">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                              <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                            </div>
                          </div>
                          <h6 class="font-primary">$500.00</h6>
                        </div>
                        <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li class="total">
                      <h6 class="mb-0">Order Total : <span class="f-right">$1000.00</span></h6>
                    </li>
                    <li class="text-center"><a class="d-block mb-3 view-cart f-w-700" href="cart.html">Go to your cart</a><a class="btn btn-primary view-checkout" href="checkout.html">Checkout</a></li>
                  </ul>
                </div>
              </li>
              <li class="onhover-dropdown">
                <div class="notification-box">
                  <svg>
                    <use href="../assets/svg/icon-sprite.svg#notification"></use>
                  </svg><span class="badge rounded-pill badge-secondary">4 </span>
                </div>
                <div class="onhover-show-div notification-dropdown">
                  <h6 class="f-18 mb-0 dropdown-title">Notitications                               </h6>
                  <ul>
                    <li class="b-l-primary border-4">
                      <p>Delivery processing <span class="font-danger">10 min.</span></p>
                    </li>
                    <li class="b-l-success border-4">
                      <p>Order Complete<span class="font-success">1 hr</span></p>
                    </li>
                    <li class="b-l-secondary border-4">
                      <p>Tickets Generated<span class="font-secondary">3 hr</span></p>
                    </li>
                    <li class="b-l-warning border-4">
                      <p>Delivery Complete<span class="font-warning">6 hr</span></p>
                    </li>
                    <li><a class="f-w-700" href="#">Check all</a></li>
                  </ul>
                </div>
              </li>
              <li class="profile-nav onhover-dropdown pe-0 py-0">
                <div class="media profile-media"><img class="b-r-10" src="../assets/images/dashboard/profile.png" alt="">
                  <div class="media-body"><span>Emay Walter</span>
                    <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                  <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a href="#"><i data-feather="log-in"> </i><span>Log in</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" sidebar-layout="stroke-svg">
          <div>
              <div class="logo-wrapper"><a href="{{ route('index') }}"><img class="img-fluid for-light"
                          src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                          src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
                  <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                  <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
              </div>
              <div class="logo-icon-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
                          src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
              <nav class="sidebar-main">
                  <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                  <div id="sidebar-menu">
                      <ul class="sidebar-links" id="simple-bar">
                          <li class="back-btn"><a href="{{ route('index') }}"><img class="img-fluid"
                                      src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                      aria-hidden="true"></i></div>
                          </li>
                          <li class="sidebar-main-title">
                              <div>
                                  <h6 class="lan-1">General</h6>
                              </div>
                          </li>
                          <li class="sidebar-list">
                              <label class="badge badge-light-primary">5</label><a class="sidebar-link sidebar-title"
                                  href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                  </svg><span class="lan-3">Dashboard</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a class="lan-4" href="{{ route('index') }}">Default</a></li>
                                  <li><a class="lan-5" href="{{ route('dashboard-02') }}">Ecommerce</a></li>
                                  <li><a href="{{ route('dashboard-03') }}">Online course</a></li>
                                  <li><a href="{{ route('dashboard-04') }}">Crypto</a></li>
                                  <li><a href="{{ route('dashboard-05') }}">Social</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-widget') }}"></use>
                                  </svg><span class="lan-6">Widgets</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('general-widget') }}">General</a></li>
                                  <li><a href="{{ route('chart-widget') }}">Chart</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-layout') }}"></use>
                                  </svg><span class="lan-7">Page layout</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('box-layout') }}">Boxed</a></li>
                                  <li><a href="{{ route('layout-rtl') }}">RTL</a></li>
                                  <li><a href="{{ route('layout-dark') }}">Dark Layout</a></li>
                                  <li><a href="{{ route('hide-on-scroll') }}">Hide Nav Scroll</a></li>
                                  <li><a href="{{ route('footer-light') }}">Footer Light</a></li>
                                  <li><a href="{{ route('footer-dark') }}">Footer Dark</a></li>
                                  <li><a href="{{ route('footer-fixed') }}">Footer Fixed</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-main-title">
                              <div>
                                  <h6 class="lan-8">Applications</h6>
                              </div>
                          </li>
                          <li class="sidebar-list">
                              <label class="badge badge-light-secondary">New</label><a class="sidebar-link sidebar-title"
                                  href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-project') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-project') }}"></use>
                                  </svg><span>Project </span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('projects')}}">Project List</a></li>
                                  <li><a href="{{ route('projectcreate')}}">Create new</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('file-manager')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                  </svg><span>File manager</span></a></li>
                          <li class="sidebar-list">
                              <label class="badge badge-light-danger">Latest </label><a
                                  class="sidebar-link sidebar-title link-nav" href="{{ route('kanban')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-board') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-board') }}"></use>
                                  </svg><span>kanban Board</span></a>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                  </svg><span>Ecommerce</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('product')}}">Product</a></li>
                                  <li><a href="{{ route('product-page')}}">Product page</a></li>
                                  <li><a href="{{ route('list-products')}}">Product list</a></li>
                                  <li><a href="{{ route('payment-details')}}">Payment Details</a></li>
                                  <li><a href="{{ route('order-history')}}">Order History</a></li>
                                  <li><a href="{{ route('invoice-template')}}">Invoice</a></li>
                                  <li><a href="{{ route('cart')}}">Cart</a></li>
                                  <li><a href="{{ route('list-wish')}}">Wishlist</a></li>
                                  <li><a href="{{ route('checkout')}}">Checkout</a></li>
                                  <li><a href="{{ route('pricing')}}">Pricing </a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-email') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-email') }}"></use>
                                  </svg><span>Email</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('email-application')}}">Email App</a></li>
                                  <li><a href="{{ route('email-compose')}}">Email Compose</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-chat') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-chat') }}"></use>
                                  </svg><span>Chat</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('chat')}}">Chat App</a></li>
                                  <li><a href="{{ route('chat-video')}}">Video chat</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                  </svg><span>Users</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('user-profile')}}">Users Profile</a></li>
                                  <li><a href="{{ route('edit-profile')}}">Users Edit</a></li>
                                  <li><a href="{{ route('user-cards')}}">Users Cards</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('bookmark')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bookmark') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bookmark') }}"> </use>
                                  </svg><span>Bookmarks</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('contacts')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-contact') }}"> </use>
                                  </svg><span>Contacts</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('task')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-task') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-task') }}"> </use>
                                  </svg><span>Tasks</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                  href="{{ route('calendar-basic')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-calendar') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-calender') }}"></use>
                                  </svg><span>Calendar</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('social-app')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-social') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-social') }}"> </use>
                                  </svg><span>Social App</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('to-do')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-to-do') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-to-do') }}"> </use>
                                  </svg><span>To-Do</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('search')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-search') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-search') }}"> </use>
                                  </svg><span>Search Result</span></a></li>
                          <li class="sidebar-main-title">
                              <div>
                                  <h6>Forms & Table</h6>
                              </div>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-form') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"> </use>
                                  </svg><span>Forms</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a class="submenu-title" href="#">Form Controls<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('form-validation')}}">Form Validation</a></li>
                                          <li><a href="{{ route('base-input')}}">Base Inputs</a></li>
                                          <li><a href="{{ route('radio-checkbox-control')}}">Checkbox & Radio</a></li>
                                          <li><a href="{{ route('input-group')}}">Input Groups</a></li>
                                          <li><a href="{{ route('megaoptions')}}">Mega Options</a></li>
                                      </ul>
                                  </li>
                                  <li><a class="submenu-title" href="#">Form Widgets<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('datepicker')}}">Datepicker</a></li>
                                          <li><a href="{{ route('time-picker')}}">Timepicker</a></li>
                                          <li><a href="{{ route('datetimepicker')}}">Datetimepicker</a></li>
                                          <li><a href="{{ route('daterangepicker')}}">Daterangepicker</a></li>
                                          <li><a href="{{ route('touchspin')}}">Touchspin</a></li>
                                          <li><a href="{{ route('select2')}}">Select2</a></li>
                                          <li><a href="{{ route('switch')}}">Switch</a></li>
                                          <li><a href="{{ route('typeahead')}}">Typeahead</a></li>
                                          <li><a href="{{ route('clipboard')}}">Clipboard</a></li>
                                      </ul>
                                  </li>
                                  <li><a class="submenu-title" href="#">Form layout<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('default-form')}}">Default Forms</a></li>
                                          <li><a href="{{ route('form-wizard')}}">Form Wizard 1</a></li>
                                          <li><a href="{{ route('form-wizard-two')}}">Form Wizard 2</a></li>
                                          <li><a href="{{ route('form-wizard-three')}}">Form Wizard 3</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-table') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                                  </svg><span>Tables</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a class="submenu-title" href="#">Bootstrap Tables<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('bootstrap-basic-table')}}">Basic Tables</a></li>
                                          <li><a href="{{ route('table-components')}}">Table components</a></li>
                                      </ul>
                                  </li>
                                  <li><a class="submenu-title" href="#">Data Tables<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('datatable-basic-init')}}">Basic Init</a></li>
                                          <li><a href="{{ route('datatable-api')}}">API</a></li>
                                          <li><a href="{{ route('datatable-data-source')}}">Data Sources</a></li>
                                      </ul>
                                  </li>
                                  <li><a href="{{ route('datatable-ext-autofill')}}">Ex. Data Tables</a></li>
                                  <li><a href="{{ route('jsgrid-table')}}">Js Grid Table </a></li>
                              </ul>
                          </li>
                          <li class="sidebar-main-title">
                              <div>
                                  <h6>Components</h6>
                              </div>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ui-kits') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ui-kits') }}"></use>
                                  </svg><span>Ui Kits</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('typography')}}">Typography</a></li>
                                  <li><a href="{{ route('avatars')}}">Avatars</a></li>
                                  <li><a href="{{ route('helper-classes')}}">helper classes</a></li>
                                  <li><a href="{{ route('grid')}}">Grid</a></li>
                                  <li><a href="{{ route('tag-pills')}}">Tag & pills</a></li>
                                  <li><a href="{{ route('progress-bar')}}">Progress</a></li>
                                  <li><a href="{{ route('modal')}}">Modal</a></li>
                                  <li><a href="{{ route('alert')}}">Alert</a></li>
                                  <li><a href="{{ route('popover')}}">Popover</a></li>
                                  <li><a href="{{ route('tooltip')}}">Tooltip</a></li>
                                  <li><a href="{{ route('loader')}}">Spinners</a></li>
                                  <li><a href="{{ route('dropdown')}}">Dropdown</a></li>
                                  <li><a href="{{ route('accordion')}}">Accordion</a></li>
                                  <li><a class="submenu-title" href="#">Tabs<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('tab-bootstrap')}}">Bootstrap Tabs</a></li>
                                          <li><a href="{{ route('tab-material')}}">Line Tabs</a></li>
                                      </ul>
                                  </li>
                                  <li><a href="{{ route('box-shadow')}}">Shadow</a></li>
                                  <li><a href="{{ route('list')}}">Lists</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bonus-kit') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bonus-kit') }}"></use>
                                  </svg><span>Bonus Ui</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('scrollable')}}">Scrollable</a></li>
                                  <li><a href="{{ route('tree')}}">Tree view</a></li>
                                  <li><a href="{{ route('bootstrap-notify')}}">Bootstrap Notify</a></li>
                                  <li><a href="{{ route('rating')}}">Rating</a></li>
                                  <li><a href="{{ route('dropzone')}}">dropzone</a></li>
                                  <li><a href="{{ route('tour')}}">Tour</a></li>
                                  <li><a href="{{ route('sweet-alert2')}}">SweetAlert2</a></li>
                                  <li><a href="{{ route('modal-animated')}}">Animated Modal</a></li>
                                  <li><a href="{{ route('owl-carousel')}}">Owl Carousel</a></li>
                                  <li><a href="{{ route('ribbons')}}">Ribbons</a></li>
                                  <li><a href="{{ route('pagination')}}">Pagination</a></li>
                                  <li><a href="{{ route('breadcrumb')}}">Breadcrumb</a></li>
                                  <li><a href="{{ route('range-slider')}}">Range Slider</a></li>
                                  <li><a href="{{ route('image-cropper')}}">Image cropper</a></li>
                                  <li><a href="{{ route('sticky')}}">Sticky</a></li>
                                  <li><a href="{{ route('basic-card')}}">Basic Card</a></li>
                                  <li><a href="{{ route('creative-card')}}">Creative Card</a></li>
                                  <li><a href="{{ route('tabbed-card')}}">Tabbed Card</a></li>
                                  <li><a href="{{ route('dragable-card')}}">Draggable Card</a></li>
                                  <li><a class="submenu-title" href="#">Timeline<span class="sub-arrow"><i
                                                  class="fa fa-angle-right"></i></span></a>
                                      <ul class="nav-sub-childmenu submenu-content">
                                          <li><a href="{{ route('timeline-v-1')}}">Timeline 1</a></li>
                                          <li><a href="{{ route('timeline-v-2')}}">Timeline 2</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-builders') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-builders') }}"></use>
                                  </svg><span>Builders</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('form-builder-1')}}"> Form Builder 1</a></li>
                                  <li><a href="{{ route('form-builder-2')}}"> Form Builder 2</a></li>
                                  <li><a href="{{ route('pagebuild')}}">Page Builder</a></li>
                                  <li><a href="{{ route('button-builder')}}">Button Builder</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-animation') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-animation') }}"></use>
                                  </svg><span>Animation</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('animate')}}">Animate</a></li>
                                  <li><a href="{{ route('scroll-reval')}}">Scroll Reveal</a></li>
                                  <li><a href="{{ route('aos')}}">AOS animation</a></li>
                                  <li><a href="{{ route('tilt')}}">Tilt Animation</a></li>
                                  <li><a href="{{ route('wow')}}">Wow Animation</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-icons') }}"></use>
                                  </svg><span>Icons</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('flag-icon')}}">Flag icon</a></li>
                                  <li><a href="{{ route('font-awesome')}}">Fontawesome Icon</a></li>
                                  <li><a href="{{ route('ico-icon')}}">Ico Icon</a></li>
                                  <li><a href="{{ route('themify-icon')}}">Themify Icon</a></li>
                                  <li><a href="{{ route('feather-icon')}}">Feather icon</a></li>
                                  <li><a href="{{ route('whether-icon')}}">Whether Icon</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-button') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-botton') }}"></use>
                                  </svg><span>Buttons</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('buttons')}}">Default Style</a></li>
                                  <li><a href="{{ route('flat-buttons')}}">Flat Style</a></li>
                                  <li><a href="{{ route('buttons-edge')}}">Edge Style</a></li>
                                  <li><a href="{{ route('raised-button')}}">Raised Style</a></li>
                                  <li><a href="{{ route('button-group')}}">Button Group</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-charts') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-charts') }}"></use>
                                  </svg><span>Charts</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('echarts')}}">Echarts</a></li>
                                  <li><a href="{{ route('chart-apex')}}">Apex Chart</a></li>
                                  <li><a href="{{ route('chart-google')}}">Google Chart</a></li>
                                  <li><a href="{{ route('chart-sparkline')}}">Sparkline chart</a></li>
                                  <li><a href="{{ route('chart-flot')}}">Flot Chart</a></li>
                                  <li><a href="{{ route('chart-knob')}}">Knob Chart</a></li>
                                  <li><a href="{{ route('chart-morris')}}">Morris Chart</a></li>
                                  <li><a href="{{ route('chartjs')}}">Chatjs Chart</a></li>
                                  <li><a href="{{ route('chartist')}}">Chartist Chart</a></li>
                                  <li><a href="{{ route('chart-peity')}}">Peity Chart</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-main-title">
                              <div>
                                  <h6>Pages</h6>
                              </div>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('landing-page')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-landing-page') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-landing-page') }}"></use>
                                  </svg><span>Landing page</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('sample-page')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-sample-page') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-sample-page') }}"></use>
                                  </svg><span>Sample page</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                  href="{{ route('internationalization')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-internationalization') }}">
                                      </use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-internationalization') }}"></use>
                                  </svg><span>Internationalization</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                  href="#" target="_blank">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-starter-kit') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-starter-kit') }}"></use>
                                  </svg><span>Starter kit</span></a></li>
                          <li class="mega-menu"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-others') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-others') }}"></use>
                                  </svg><span>Others</span></a>
                              <div class="mega-menu-container menu-content">
                                  <div class="container-fluid">
                                      <div class="row">
                                          <div class="col mega-box">
                                              <div class="link-section">
                                                  <div class="submenu-title">
                                                      <h5>Error Page</h5>
                                                  </div>
                                                  <ul class="submenu-content opensubmegamenu">
                                                      <li><a href="{{ route('error-400')}}">Error 400</a></li>
                                                      <li><a href="{{ route('error-401')}}">Error 401</a></li>
                                                      <li><a href="{{ route('error-403')}}">Error 403</a></li>
                                                      <li><a href="{{ route('error-404')}}">Error 404</a></li>
                                                      <li><a href="{{ route('error-500')}}">Error 500</a></li>
                                                      <li><a href="{{ route('error-503')}}">Error 503</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                          <div class="col mega-box">
                                              <div class="link-section">
                                                  <div class="submenu-title">
                                                      <h5> Authentication</h5>
                                                  </div>
                                                  <ul class="submenu-content opensubmegamenu">
                                                      <li><a href="{{ route('login')}}" target="_blank">Login Simple</a></li>
                                                      <li><a href="{{ route('login-one')}}" target="_blank">Login with bg image</a>
                                                      </li>
                                                      <li><a href="{{ route('login-two')}}" target="_blank">Login with image two </a>
                                                      </li>
                                                      <li><a href="{{ route('login-bs-validation')}}" target="_blank">Login With
                                                              validation</a></li>
                                                      <li><a href="{{ route('login-bs-tt-validation')}}" target="_blank">Login with
                                                              tooltip</a></li>
                                                      <li><a href="{{ route('login-sa-validation')}}" target="_blank">Login with
                                                              sweetalert</a></li>
                                                      <li><a href="{{ route('sign-up')}}" target="_blank">Register Simple</a></li>
                                                      <li><a href="{{ route('sign-up-one')}}" target="_blank">Register with Bg Image
                                                          </a></li>
                                                      <li><a href="{{ route('sign-up-two')}}" target="_blank">Register with image
                                                              two</a></li>
                                                      <li><a href="{{ route('sign-up-wizard')}}" target="_blank">Register wizard</a>
                                                      </li>
                                                      <li><a href="{{ route('unlock')}}">Unlock User</a></li>
                                                      <li><a href="{{ route('forget-password')}}">Forget Password</a></li>
                                                      <li><a href="{{ route('reset-password')}}">Reset Password</a></li>
                                                      <li><a href="{{ route('maintenance')}}">Maintenance</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                          <div class="col mega-box">
                                              <div class="link-section">
                                                  <div class="submenu-title">
                                                      <h5>Coming Soon</h5>
                                                  </div>
                                                  <ul class="submenu-content opensubmegamenu">
                                                      <li><a href="{{ route('comingsoon')}}">Coming Simple</a></li>
                                                      <li><a href="{{ route('comingsoon-bg-video')}}">Coming with Bg video</a></li>
                                                      <li><a href="{{ route('comingsoon-bg-img')}}">Coming with Bg Image</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                          <div class="col mega-box">
                                              <div class="link-section">
                                                  <div class="submenu-title">
                                                      <h5>Email templates</h5>
                                                  </div>
                                                  <ul class="submenu-content opensubmegamenu">
                                                      <li><a href="{{ route('basic-template')}}">Basic Email</a></li>
                                                      <li><a href="{{ route('email-header')}}">Basic With Header</a></li>
                                                      <li><a href="{{ route('template-email')}}">Ecomerce Template</a></li>
                                                      <li><a href="{{ route('template-email-2')}}">Email Template 2</a></li>
                                                      <li><a href="{{ route('ecommerce-templates')}}">Ecommerce Email</a></li>
                              <li><a href="{{ route('email-order-success')}}">Order Success</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="sidebar-main-title">
                              <div>
                                  <h6>Miscellaneous</h6>
                              </div>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-gallery') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-gallery') }}"></use>
                                  </svg><span>Gallery</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('gallery')}}">Gallery Grid</a></li>
                                  <li><a href="{{ route('gallery-with-description')}}">Gallery Grid Desc</a></li>
                                  <li><a href="{{ route('gallery-masonry')}}">Masonry Gallery</a></li>
                                  <li><a href="{{ route('masonry-gallery-with-disc')}}">Masonry with Desc</a></li>
                                  <li><a href="{{ route('gallery-hover')}}">Hover Effects</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-blog') }}"></use>
                                  </svg><span>Blog</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('blog')}}">Blog Details</a></li>
                                  <li><a href="{{ route('blog-single')}}">Blog Single</a></li>
                                  <li><a href="{{ route('add-post')}}">Add Post</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('faq')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-faq') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-faq') }}"></use>
                                  </svg><span>FAQ</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-job-search') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-job-search') }}"></use>
                                  </svg><span>Job Search</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('job-cards-view')}}">Cards view</a></li>
                                  <li><a href="{{ route('job-list-view')}}">List View</a></li>
                                  <li><a href="{{ route('job-details')}}">Job Details</a></li>
                                  <li><a href="{{ route('job-apply')}}">Apply</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-learning') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-learning') }}"></use>
                                  </svg><span>Learning</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('learning-list-view')}}">Learning List</a></li>
                                  <li><a href="{{ route('learning-detailed')}}">Detailed Course</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-maps') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-maps') }}"></use>
                                  </svg><span>Maps</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('map-js')}}">Maps JS</a></li>
                                  <li><a href="{{ route('vector-map')}}">Vector Maps</a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-editors') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-editors') }}"></use>
                                  </svg><span>Editors</span></a>
                              <ul class="sidebar-submenu">
                                  <li><a href="{{ route('summernote')}}">Summer Note</a></li>
                                  <li><a href="{{ route('ckeditor')}}">CK editor</a></li>
                                  <li><a href="{{ route('simple-mde')}}">MDE editor</a></li>
                                  <li><a href="{{ route('ace-code-editor')}}">ACE code editor </a></li>
                              </ul>
                          </li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                  href="{{ route('knowledgebase')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-knowledgebase') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-knowledgebase') }}"></use>
                                  </svg><span>Knowledgebase</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                  href="{{ route('support-ticket')}}">
                                  <svg class="stroke-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-support-tickets') }}"></use>
                                  </svg>
                                  <svg class="fill-icon">
                                      <use href="{{ asset('assets/svg/icon-sprite.svg#fill-support-tickets') }}"></use>
                                  </svg><span>Support Ticket</span></a></li>
                      </ul>
                  </div>
                  <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
              </nav>
          </div>
      </div>      
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Default</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Default</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row widget-grid">
              <div class="col-xxl-4 col-sm-6 box-col-6">
                <div class="card profile-box">
                  <div class="card-body">
                    <div class="media">
                      <div class="media-body"> 
                        <div class="greeting-user">
                          <h4 class="f-w-600">Welcome to cuba</h4>
                          <p>Here whats happing in your account today</p>
                          <div class="whatsnew-btn"><a class="btn btn-outline-white">Whats New !</a></div>
                        </div>
                      </div>
                      <div>  
                        <div class="clockbox">
                          <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                            <g id="face">
                              <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                              <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                              <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                            </g>
                            <g id="hour">
                              <path class="hour-hand" d="M300.5 298V142"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="minute">
                              <path class="minute-hand" d="M300.5 298V67"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="second">
                              <path class="second-hand" d="M300.5 350V55"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9">   </circle>
                            </g>
                          </svg>
                        </div>
                        <div class="badge f-10 p-0" id="txt"></div>
                      </div>
                    </div>
                    <div class="cartoon"><img class="img-fluid" src="../assets/images/dashboard/cartoon.svg" alt="vector women with leptop"></div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-6"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card widget-1">
                      <div class="card-body"> 
                        <div class="widget-content">
                          <div class="widget-round secondary">
                            <div class="bg-round">
                              <svg class="svg-fill">
                                <use href="../assets/svg/icon-sprite.svg#cart"> </use>
                              </svg>
                              <svg class="half-circle svg-fill">
                                <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                              </svg>
                            </div>
                          </div>
                          <div> 
                            <h4>10,000</h4><span class="f-light">Purchase</span>
                          </div>
                        </div>
                        <div class="font-secondary f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+50%</span></div>
                      </div>
                    </div>
                    <div class="col-xl-12"> 
                      <div class="card widget-1">
                        <div class="card-body"> 
                          <div class="widget-content">
                            <div class="widget-round primary">
                              <div class="bg-round">
                                <svg class="svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#tag"> </use>
                                </svg>
                                <svg class="half-circle svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                                </svg>
                              </div>
                            </div>
                            <div> 
                              <h4>4,200</h4><span class="f-light">Sales</span>
                            </div>
                          </div>
                          <div class="font-primary f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+70%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-6"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card widget-1">
                      <div class="card-body"> 
                        <div class="widget-content">
                          <div class="widget-round warning">
                            <div class="bg-round">
                              <svg class="svg-fill">
                                <use href="../assets/svg/icon-sprite.svg#return-box"> </use>
                              </svg>
                              <svg class="half-circle svg-fill">
                                <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                              </svg>
                            </div>
                          </div>
                          <div> 
                            <h4>7000</h4><span class="f-light">Sales return</span>
                          </div>
                        </div>
                        <div class="font-warning f-w-500"><i class="icon-arrow-down icon-rotate me-1"></i><span>-20%</span></div>
                      </div>
                    </div>
                    <div class="col-xl-12"> 
                      <div class="card widget-1">
                        <div class="card-body"> 
                          <div class="widget-content">
                            <div class="widget-round success">
                              <div class="bg-round">
                                <svg class="svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#rate"> </use>
                                </svg>
                                <svg class="half-circle svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                                </svg>
                              </div>
                            </div>
                            <div> 
                              <h4>5700</h4><span class="f-light">Purchase rate</span>
                            </div>
                          </div>
                          <div class="font-success f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+70%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-auto col-xl-12 col-sm-6 box-col-6">
                <div class="row"> 
                  <div class="col-xxl-12 col-xl-6 box-col-12">
                    <div class="card widget-1 widget-with-chart">
                      <div class="card-body"> 
                        <div> 
                          <h4 class="mb-1">1,80k</h4><span class="f-light">Orders</span>
                        </div>
                        <div class="order-chart"> 
                          <div id="orderchart"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xxl-12 col-xl-6 box-col-12">
                    <div class="card widget-1 widget-with-chart">
                      <div class="card-body"> 
                        <div> 
                          <h4 class="mb-1">6,90k</h4><span class="f-light">Profit</span>
                        </div>
                        <div class="profit-chart"> 
                          <div id="profitchart"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-8 col-lg-12 box-col-12">
                <div class="card">
                  <div class="card-header card-no-border"> 
                    <h5>Overall balance</h5>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row m-0 overall-card">
                      <div class="col-xl-9 col-md-12 col-sm-7 p-0">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                        <div class="chart-right">
                          <div class="row">
                            <div class="col-xl-12">
                              <div class="card-body p-0">
                                <ul class="balance-data"> 
                                  <li><span class="circle bg-warning"> </span><span class="f-light ms-1">Earning</span></li>
                                  <li><span class="circle bg-primary"> </span><span class="f-light ms-1">Expense</span></li>
                                </ul>
                                <div class="current-sale-container">
                                  <div id="chart-currently"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-12 col-sm-5 p-0">
                        <div class="row g-sm-4 g-2">
                          <div class="col-xl-12 col-md-4">
                            <div class="light-card balance-card widget-hover">
                              <div class="svg-box">
                                <svg class="svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#income"></use>
                                </svg>
                              </div>
                              <div> <span class="f-light">Income</span>
                                <h6 class="mt-1 mb-0">$22,678</h6>
                              </div>
                              <div class="ms-auto text-end">
                                <div class="dropdown icon-dropdown">
                                  <button class="btn dropdown-toggle" id="incomedropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="incomedropdown"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday </a></div>
                                </div><span class="font-success">+$456</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-12 col-md-4">
                            <div class="light-card balance-card widget-hover">
                              <div class="svg-box">
                                <svg class="svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#expense"></use>
                                </svg>
                              </div>
                              <div> <span class="f-light">Expense</span>
                                <h6 class="mt-1 mb-0">$12,057</h6>
                              </div>
                              <div class="ms-auto text-end">
                                <div class="dropdown icon-dropdown">
                                  <button class="btn dropdown-toggle" id="expensedropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="expensedropdown"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday </a></div>
                                </div><span class="font-danger">+$256</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-12 col-md-4">
                            <div class="light-card balance-card widget-hover">
                              <div class="svg-box">
                                <svg class="svg-fill">
                                  <use href="../assets/svg/icon-sprite.svg#doller-return"></use>
                                </svg>
                              </div>
                              <div> <span class="f-light">Cashback</span>
                                <h6 class="mt-1 mb-0">8,475</h6>
                              </div>
                              <div class="ms-auto text-end">
                                <div class="dropdown icon-dropdown">
                                  <button class="btn dropdown-toggle" id="cashbackdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cashbackdropdown"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday </a></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-xl-7 col-md-6 col-sm-5 box-col-6">
                <div class="card height-equal"> 
                  <div class="card-header card-no-border"> 
                    <div class="header-top">
                      <h5>Recent Orders</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="recentdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentdropdown"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row recent-wrapper">
                      <div class="col-xl-6">
                        <div class="recent-chart"> 
                          <div id="recentchart"></div>
                        </div>
                      </div>
                      <div class="col-xl-6"> 
                        <ul class="order-content">
                          <li> <span class="recent-circle bg-primary"> </span>
                            <div> <span class="f-light f-w-500">Cancelled </span>
                              <h4 class="mt-1 mb-0">2,302<span class="f-light f-14 f-w-400 ms-1">(Last 6 Month) </span></h4>
                            </div>
                          </li>
                          <li> <span class="recent-circle bg-info"></span>
                            <div> <span class="f-light f-w-500">Delivered</span>
                              <h4 class="mt-1 mb-0">9,302<span class="f-light f-14 f-w-400 ms-1">(Last 6 Month) </span></h4>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-xl-5 col-md-6 col-sm-7 notification box-col-6">
                <div class="card height-equal"> 
                  <div class="card-header card-no-border">
                    <div class="header-top">
                      <h5 class="m-0">Activity</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday  </a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <ul> 
                      <li class="d-flex">
                        <div class="activity-dot-primary"></div>
                        <div class="w-100 ms-3">
                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">8th March, 2022 </span><span>1 day ago</span></p>
                          <h6>Updated Product<span class="dot-notification"></span></h6>
                          <p class="f-light">Quisque a consequat ante sit amet magna...</p>
                        </div>
                      </li>
                      <li class="d-flex">
                        <div class="activity-dot-warning"></div>
                        <div class="w-100 ms-3">
                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">15th Oct, 2022 </span><span>Today</span></p>
                          <h6>Tello just like your product<span class="dot-notification"></span></h6>
                          <p>Quisque a consequat ante sit amet magna... </p>
                        </div>
                      </li>
                      <li class="d-flex">
                        <div class="activity-dot-secondary"></div>
                        <div class="w-100 ms-3">
                          <p class="d-flex justify-content-between mb-2"><span class="date-content light-background">20th Sep, 2022 </span><span>12:00 PM</span></p>
                          <h6>Tello just like your product<span class="dot-notification"></span></h6>
                          <p>Quisque a consequat ante sit amet magna... </p>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6 appointment-sec box-col-6">
                <div class="appointment">
                  <div class="card">
                    <div class="card-header card-no-border">
                      <div class="header-top">
                        <h5 class="m-0">Recent Sales</h5>
                        <div class="card-header-right-icon">
                          <div class="dropdown">
                            <button class="btn dropdown-toggle" id="recentButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body pt-0">
                      <div class="appointment-table table-responsive">
                        <table class="table table-bordernone">
                          <tbody>
                            <tr>
                              <td><img class="img-fluid img-40 rounded-circle" src="../assets/images/dashboard/user/1.jpg" alt="user"></td>
                              <td class="img-content-box"><a class="d-block f-w-500" href="user-profile.html">Jane Cooper</a><span class="f-light">10 minutes ago</span></td>
                              <td class="text-end">
                                <p class="m-0 font-success">$200.00</p>
                              </td>
                            </tr>
                            <tr>
                              <td><img class="img-fluid img-40 rounded-circle" src="../assets/images/dashboard/user/2.jpg" alt="user"></td>
                              <td class="img-content-box"><a class="d-block f-w-500" href="user-profile.html">Brooklyn Simmons</a><span class="f-light">19 minutes ago</span></td>
                              <td class="text-end">
                                <p class="m-0 font-success">$970.00</p>
                              </td>
                            </tr>
                            <tr>
                              <td><img class="img-fluid img-40 rounded-circle" src="../assets/images/dashboard/user/3.jpg" alt="user"></td>
                              <td class="img-content-box"><a class="d-block f-w-500" href="user-profile.html">Leslie Alexander</a><span class="f-light">2 hours ago</span></td>
                              <td class="text-end">
                                <p class="m-0 font-success">$300.00</p>
                              </td>
                            </tr>
                            <tr>
                              <td><img class="img-fluid img-40 rounded-circle" src="../assets/images/dashboard/user/4.jpg" alt="user"></td>
                              <td class="img-content-box"><a class="d-block f-w-500" href="user-profile.html">Travis Wright</a><span class="f-light">8 hours ago</span></td>
                              <td class="text-end">
                                <p class="m-0 font-success">$450.00</p>
                              </td>
                            </tr>
                            <tr>
                              <td><img class="img-fluid img-40 rounded-circle" src="../assets/images/dashboard/user/5.jpg" alt="user"></td>
                              <td class="img-content-box"><a class="d-block f-w-500" href="user-profile.html">Mark Green</a><span class="f-light">1 day ago</span></td>
                              <td class="text-end">
                                <p class="m-0 font-success">$768.00</p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6 box-col-6">
                <div class="card">
                  <div class="card-header card-no-border">
                    <div class="header-top">
                      <h5 class="m-0">Timeline</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" id="dropdownschedules" type="button" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownschedules"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="schedule-container"> 
                      <div id="schedulechart"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-6 box-col-6 col-ed-none wow zoomIn">
                <div class="card purchase-card"><img class="img-fluid" src="../assets/images/dashboard/purchase.png" alt="vector mens with leptop">
                  <div class="card-body pt-3"> 
                    <h6 class="mb-3">Buy <a href="#">Pro Account </a>to Explore Primium Features</h6><a class="purchase-btn btn btn-primary btn-hover-effect f-w-500" href="https://1.envato.market/3GVzd" target="_blank">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6 box-col-6 col-ed-6"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card">
                      <div class="card-header card-no-border">
                        <div class="header-top">
                          <h5>Total Users</h5>
                          <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="userdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-0">
                        <ul class="user-list">
                          <li> 
                            <div class="user-icon primary">
                              <div class="user-box"><i class="font-primary" data-feather="user-plus"></i></div>
                            </div>
                            <div> 
                              <h5 class="mb-1">178,098</h5><span class="font-primary d-flex align-items-center"><i class="icon-arrow-up icon-rotate me-1"> </i><span class="f-w-500">+30.89</span></span>
                            </div>
                          </li>
                          <li> 
                            <div class="user-icon success">
                              <div class="user-box"><i class="font-success" data-feather="user-minus"></i></div>
                            </div>
                            <div> 
                              <h5 class="mb-1">178,098</h5><span class="font-danger d-flex align-items-center"><i class="icon-arrow-down icon-rotate me-1"></i><span class="f-w-500">-08.89</span></span>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12"> 
                    <div class="card growth-wrap">
                      <div class="card-header card-no-border">
                        <div class="header-top">
                          <h5>Followers Growth</h5>
                          <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="growthdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthdropdown"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-0">
                        <div class="growth-wrapper">
                          <div id="growthchart"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-5 col-lg-8 col-md-11 box-col-8 col-ed-6"> 
                <div class="card papernote-wrap">
                  <div class="card-header card-no-border">
                    <div class="header-top"> 
                      <h5>PaperNote</h5><a class="f-light d-flex align-items-center" href="#">View project <i class="f-w-700 icon-arrow-top-right"></i></a>
                    </div>
                  </div>
                  <div class="card-body pt-0"> <img class="banner-img img-fluid" src="../assets/images/dashboard/papernote.jpg" alt="multicolor background">
                    <div class="note-content mt-sm-4 mt-2">
                      <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                      <div class="note-labels">
                        <ul>
                          <li> <span class="badge badge-light-primary">SAAS</span></li>
                          <li> <span class="badge badge-light-success">E-Commerce</span></li>
                          <li> <span class="badge badge-light-warning">Crypto</span></li>
                          <li> <span class="badge badge-light-info">Project</span></li>
                          <li> <span class="badge badge-light-secondary">NFT</span></li>
                          <li> <span class="badge badge-light-light">+9</span></li>
                        </ul>
                        <div class="last-label"> <span class="badge badge-light-success">Inprogress</span></div>
                      </div>
                      <div class="mt-sm-4 mt-2 user-details">
                        <div class="customers">
                          <ul> 
                            <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/dashboard/user/1.jpg" alt="user"></li>
                            <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/dashboard/user/6.jpg" alt="user"></li>
                            <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/dashboard/user/7.jpg" alt="user"></li>
                            <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/dashboard/user/3.jpg" alt="user"></li>
                            <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/dashboard/user/8.jpg" alt="user"></li>
                            <li class="d-inline-block">
                              <div class="light-card"><span class="f-w-500">+5</span></div>
                            </li>
                          </ul>
                        </div>
                        <div class="d-flex align-items-center"> 
                          <h5 class="mb-0 font-primary f-18 me-1">$239,098</h5><span class="f-light f-w-500">(Budget)</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2022 © Cuba theme by pixelstrap  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/js/header-slick.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>new WOW().init();</script>
  <!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
        localStorage.clear();
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper dark-sidebar");
        localStorage.setItem('page-wrapper', 'compact-wrapper dark-sidebar');
    </script>
  </body>
</html>