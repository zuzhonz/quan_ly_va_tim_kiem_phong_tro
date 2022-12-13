<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/findhouses/pricing-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Sep 2022 14:25:22 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>Pricing Table</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{asset('assets/client/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/fontawesome-5-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/font-awesome.min.css')}}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/styles.css')}}">
    <link rel="stylesheet" id="color" href="{{asset('assets/client/css/default.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        #header {
            background-color: #ffffff;
        }
        li{
            list-style: none;
        }
    </style>
</head>

<body class="inner-pages hd-white">
<!-- Wrapper -->
<div id="wrapper">
    <!-- START SECTION HEADINGS -->
    <!-- Header Container
    ================================================== -->
    @include('layouts.client.header')
    <div class="clearfix"></div>
    <!-- Header Container / End -->

    <section class="headings" style="back">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Bảng giá dịch vụ</h1>
                <h2><a href="{{route('home')}}">Trang chủ </a> &nbsp;/&nbsp; Bảng giá dịch vụ</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION PRICING -->
    <section class="pricing-table bg-white-2">
        <div class="container">
            <div class="section-title">
                <h3>Gói</h3>
                <h2>đăng tin thuê trọ</h2>
            </div>
            <div class="row">
                @foreach($plans as $plan)
                    @if($plan->type == 1)
                        <div class="col-lg-3 col-md-6 col-xs-12">
                            <div class="plan text-center {{ $plan->price >= 50 ? 'featured no-mgb yes-mgb' : '' }}">
                                <span class="plan-name ">{{$plan->name}} <small>Gói ngày</small></span>
                                <p class="plan-price"><sup class="currency">$</sup><strong>{{$plan->price}}</strong></p>
                                <div class="p-2">
                                    {!! $plan->desc !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <section class="pricing-table bg-white-2">
        <div class="container">
            <div class="section-title">
                <h3>Gói</h3>
                <h2>đăng tin ở ghép</h2>
            </div>
            <div class="row">
                @foreach($plans as $plan)
                    @if($plan->type == 2)
                        <div class="col-lg-3 col-md-6 col-xs-12">
                            <div class="plan text-center {{ $plan->price >= 50 ? 'featured no-mgb yes-mgb' : '' }}">
                                <span class="plan-name ">{{$plan->name}} <small>Gói ngày</small></span>
                                <p class="plan-price"><sup class="currency"><i
                                            class="fa-brands fa-bitcoin"></i></sup><strong>{{$plan->price}}</strong></p>
                                <div class="p-2">
                                    {!! $plan->desc !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- END SECTION PRICING -->

    <!-- START FOOTER -->
    <footer class="first-footer">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="netabout">
                            <a href="index.html" class="logo">
                                <img src="{{asset('assets/client/images/logo-footer.svg')}}" alt="netcom">
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum incidunt architecto soluta
                                laboriosam, perspiciatis, aspernatur officiis esse.</p>
                        </div>
                        <div class="contactus">
                            <ul>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p class="in-p">95 South Park Avenue, USA</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <p class="in-p">+456 875 369 208</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <p class="in-p ti">support@findhouses.com</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="navigation">
                            <h3>Navigation</h3>
                            <div class="nav-footer">
                                <ul>
                                    <li><a href="index.html">Home One</a></li>
                                    <li><a href="properties-right-sidebar.html">Properties Right</a></li>
                                    <li><a href="properties-full-list.html">Properties List</a></li>
                                    <li><a href="properties-details.html">Property Details</a></li>
                                    <li class="no-mgb"><a href="agents-listing-grid.html">Agents Listing</a></li>
                                </ul>
                                <ul class="nav-right">
                                    <li><a href="agent-details.html">Agents Details</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="blog.html">Blog Default</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                    <li class="no-mgb"><a href="contact-us.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget">
                            <h3>Twitter Feeds</h3>
                            <div class="twitter-widget contuct">
                                <div class="twitter-area">
                                    <div class="single-item">
                                        <div class="icon-holder">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h5><a href="#">@findhouses</a> all share them with me baby said inspet.
                                            </h5>
                                            <h4>about 5 days ago</h4>
                                        </div>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-holder">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h5><a href="#">@findhouses</a> all share them with me baby said inspet.
                                            </h5>
                                            <h4>about 5 days ago</h4>
                                        </div>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-holder">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h5><a href="#">@findhouses</a> all share them with me baby said inspet.
                                            </h5>
                                            <h4>about 5 days ago</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="newsletters">
                            <h3>Newsletters</h3>
                            <p>Sign Up for Our Newsletter to get Latest Updates and Offers. Subscribe to receive news in
                                your inbox.</p>
                        </div>
                        <form class="bloq-email mailchimp form-inline" method="post">
                            <label for="subscribeEmail" class="error"></label>
                            <div class="email">
                                <input type="email" id="subscribeEmail" name="EMAIL" placeholder="Enter Your Email">
                                <input type="submit" value="Subscribe">
                                <p class="subscription-success"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="second-footer">
            <div class="container">
                <p>2021 © Copyright - All Rights Reserved.</p>
                <ul class="netsocials">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>

    <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <!-- END FOOTER -->

    <!--register form -->
    <div class="login-and-register-form modal">
        <div class="main-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="close-reg"><i class="fa fa-times"></i></div>
                <h3>Welcome to <span>Find<strong>Houses</strong></span></h3>
                <div class="soc-log fl-wrap">
                    <p>Login</p>
                    <a href="#" class="facebook-log"><i class="fa fa-facebook-official"></i>Log in with Facebook</a>
                    <a href="#" class="twitter-log"><i class="fa fa-twitter"></i> Log in with Twitter</a>
                </div>
                <div class="log-separator fl-wrap"><span>Or</span></div>
                <div id="tabs-container">
                    <ul class="tabs-menu">
                        <li class="current"><a href="#tab-1">Login</a></li>
                        <li><a href="#tab-2">Register</a></li>
                    </ul>
                    <div class="tab">
                        <div id="tab-1" class="tab-contents">
                            <div class="custom-form">
                                <form method="post" name="registerform">
                                    <label>Username or Email Address * </label>
                                    <input name="email" type="text" onClick="this.select()" value="">
                                    <label>Password * </label>
                                    <input name="password" type="password" onClick="this.select()" value="">
                                    <button type="submit" class="log-submit-btn"><span>Log In</span></button>
                                    <div class="clearfix"></div>
                                    <div class="filter-tags">
                                        <input id="check-a" type="checkbox" name="check">
                                        <label for="check-a">Remember me</label>
                                    </div>
                                </form>
                                <div class="lost_password">
                                    <a href="#">Lost Your Password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div id="tab-2" class="tab-contents">
                                <div class="custom-form">
                                    <form method="post" name="registerform" class="main-register-form"
                                          id="main-register-form2">
                                        <label>First Name * </label>
                                        <input name="name" type="text" onClick="this.select()" value="">
                                        <label>Second Name *</label>
                                        <input name="name2" type="text" onClick="this.select()" value="">
                                        <label>Email Address *</label>
                                        <input name="email" type="text" onClick="this.select()" value="">
                                        <label>Password *</label>
                                        <input name="password" type="password" onClick="this.select()" value="">
                                        <button type="submit" class="log-submit-btn"><span>Register</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--register form end -->

    <!-- ARCHIVES JS -->
    <script src="{{asset('assets/client/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/client/js/tether.min.js')}}"></script>
    <script src="{{asset('assets/client/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/client/js/mmenu.min.js')}}"></script>
    <script src="{{asset('assets/client/js/mmenu.js')}}"></script>
    <script src="{{asset('assets/client/js/smooth-scroll.min.js')}}"></script>
    <script src="{{asset('assets/client/js/color-switcher.js')}}"></script>
    <script src="{{asset('assets/client/js/inner.js')}}"></script>

</div>
<!-- Wrapper / End -->
</body>


<!-- Mirrored from code-theme.com/html/findhouses/pricing-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Sep 2022 14:25:22 GMT -->
</html>
