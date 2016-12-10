<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hi-Tech. Maintenance System</title>
        <meta name="description" content="Hi-Tech. Maintenance System" />
        <meta name="keywords" content="Hi-Tech, Hi, Tech, Maintenance, System, Maintenance System, surat" />
        <meta name="author" content="SocialInfotech" />

        <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() . 'assets/frontend/' ?>img/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?= base_url() . 'assets/frontend/' ?>img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?= base_url() . 'assets/frontend/' ?>img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?= base_url() . 'assets/frontend/' ?>img/favicons/manifest.json">
        <link rel="mask-icon" href="<?= base_url() . 'assets/frontend/' ?>img/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <!-- Normalize -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>css/normalize.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>css/bootstrap.css">
        <!-- Owl -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>css/owl.css">
        <!-- Animate.css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>css/animate.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>fonts/font-awesome-4.1.0/css/font-awesome.min.css">
        <!-- Elegant Icons -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>fonts/eleganticons/et-icons.css">
        <!-- Main style -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/frontend/' ?>css/responsive.css">
    </head>

    <body>
        <div class="preloader">
            <img src="<?= base_url() . 'assets/frontend/' ?>img/loader.gif" alt="Preloader image">
        </div>
        <nav class="navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?= base_url() . 'assets/frontend/' ?>img/logo.png" data-active-url="<?= base_url() . 'assets/frontend/' ?>img/logo-active.png" alt=""></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-nav">
                        <li><a href="#">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Contact Us</a></li>
                        <li><a href="<?= base_url('login') ?>" class="login_btn"><img src="<?= base_url() . 'assets/frontend/' ?>img/icons/user2.svg" ><span>Login</span></a></li>
                    </ul>
                </div>

            </div>
            <!-- /.container-fluid -->
        </nav>
        <div class="carousel slide carousel-fade carousel_custom" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                </div>
                <div class="item">
                </div>
                <div class="item">
                </div>
            </div>
        </div>
        <header id="intro">
            <div class="container">
                <div class="table">
                    <div class="header-text">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="light white" style="color:#000;">Welcome to</h3>
                                <h1 class="red typed">Hi-Tech. Maintenance System</h1>
                                <span class="typed-cursor">|</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="white-bg">
            <div class="cut cut-top"></div>
            <div class="container-fluid">
                <div class="row intro-tables">
                    <div class="col-md-4 col-sm-4">
                        <div class="intro-table intro-table-first intro-table-hover">
                            <h5 class="white heading  hide-hover">Contact Us</h5>
                            <div class="bottom">
                                <h4 class="white heading small-heading no-margin regular">Have questions?</h4>
                                <h4 class="white heading small-pt">Want to talk a professional?</h4>
                                <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-white-fill expand">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="intro-table intro-table-hover">
                            <h5 class="white heading hide-hover">Our Services</h5>
                            <div class="bottom">
                                <h4 class="white heading small-heading no-margin regular">Promote Business With</h4>
                                <h4 class="white heading small-pt">Maintenance System</h4>
                                <a href="#services" class="btn btn-white-fill expand">Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="intro-table intro-table-third">
                            <h5 class="white heading">Testimonials</h5>
                            <div class="owl-testimonials bottom">
                                <div class="item">
                                    <h4 class="white heading content">I couldn't be more happy with the results!</h4>
                                    <h5 class="white heading light author">Adam Jordan</h5>
                                </div>
                                <div class="item">
                                    <h4 class="white heading content">I couldn't be more happy with the results!</h4>
                                    <h5 class="white heading light author">Greg Pardon</h5>
                                </div>
                                <div class="item">
                                    <h4 class="white heading content">I couldn't be more happy with the results!</h4>
                                    <h5 class="white heading light author">Christina Goldman</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="services" class="section section-padded">
            <div class="container-fluid">
                <div class="row text-center title">
                    <h2>Services</h2>
                    <h4 class="light muted">"Essential features that make you more efficient..."</h4>
                </div>
                <div class="row services">
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <div class="icon-holder">
                                <img src="<?= base_url() . 'assets/frontend/' ?>img/icons/cogwheel.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Preventive Maintenance</h4>
                            <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <div class="icon-holder">
                                <img src="<?= base_url() . 'assets/frontend/' ?>img/icons/repair-tools.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Repair Maintenance</h4>
                            <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <div class="icon-holder">
                                <img src="<?= base_url() . 'assets/frontend/' ?>img/icons/screwdriver.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Maintenance Due Notifications</h4>
                            <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <div class="icon-holder">
                                <img src="<?= base_url() . 'assets/frontend/' ?>img/icons/spanner.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">History Recording</h4>
                            <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <div class="icon-holder">
                                <img src="<?= base_url() . 'assets/frontend/' ?>img/icons/timing-belt.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Parts (Deluxe and Pro Editions only)</h4>
                            <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service">
                            <div class="icon-holder">
                                <img src="<?= base_url() . 'assets/frontend/' ?>img/icons/wrench.png" alt="" class="icon">
                            </div>
                            <h4 class="heading">Reporting & More</h4>
                            <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cut cut-bottom"></div>
        </section>

        <section id="pricing" class="section">
            <div class="container-fluid">
                <div class="row title text-center">
                    <h2 class="margin-top white">Pricing</h2>
                    <h4 class="light white">Choose your favorite pricing plan and sign up today!</h4>
                </div>
                <div class="row no-margin">
                    <div class="col-md-7 no-padding col-md-offset-5 pricings text-center">
                        <div class="pricing">
                            <div class="box-main active" data-img="<?= base_url() . 'assets/frontend/' ?>img/pricing1.jpg">
                                <h4 class="white">Pricing and Ordering</h4>
                                <h4 class="white regular light">$850.00 <span class="small-font">/ year</span></h4>
                                <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-white-fill">Contact Now</a>
                                <i class="info-icon icon_question"></i>
                            </div>
                            <div class="box-second active">
                                <ul class="white-list text-left">
                                    <li>Ordering Information</li>
                                    <li>Upgrade Information</li>
                                    <li>Fleet Maintenance Pro</li>
                                    <li>Maintenance Pro</li>
                                    <li>Auto Maintenance Pro</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pricing">
                            <div class="box-main" data-img="<?= base_url() . 'assets/frontend/' ?>img/pricing2.jpg">
                                <h4 class="white">Maintenance Pro</h4>
                                <h4 class="white regular light">$100.00 <span class="small-font">/ year</span></h4>
                                <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-white-fill">Contact Now</a>
                                <i class="info-icon icon_question"></i>
                            </div>
                            <div class="box-second">
                                <ul class="white-list text-left">
                                    <li>Ordering Information</li>
                                    <li>Upgrade Information</li>
                                    <li>Fleet Maintenance Pro</li>
                                    <li>Maintenance Pro</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-padded blue-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="owl-twitter owl-carousel">
                            <div class="item text-center">
                                <i class="icon fa fa-twitter"></i>
                                <h4 class="white light">I couldn't be more happy with the results!</h4>
                                <h4 class="light-white light">#google #marketing #business</h4>
                            </div>
                            <div class="item text-center">
                                <i class="icon fa fa-twitter"></i>
                                <h4 class="white light">I couldn't be more happy with the results!</h4>
                                <h4 class="light-white light">#google #marketing #business</h4>
                            </div>
                            <div class="item text-center">
                                <i class="icon fa fa-twitter"></i>
                                <h4 class="white light">I couldn't be more happy with the results!</h4>
                                <h4 class="light-white light">#google #marketing #business</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-popup">
                    <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                    <h3 class="white">Contact Us</h3>
                    <form action="" class="popup-form">
                        <input type="text" class="form-control form-white" placeholder="Full Name">
                        <input type="text" class="form-control form-white" placeholder="Email Address">
                        <div class="dropdown">
                            <button id="dLabel" class="form-control form-white dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pricing Plan
                            </button>
                            <ul class="dropdown-menu animated fadeIn" role="menu" aria-labelledby="dLabel">
                                <li class="animated lightSpeedIn"><a href="#">1 month membership ($150)</a></li>
                                <li class="animated lightSpeedIn"><a href="#">3 month membership ($350)</a></li>
                                <li class="animated lightSpeedIn"><a href="#">1 year membership ($1000)</a></li>
                                <li class="animated lightSpeedIn"><a href="#">Free trial class</a></li>
                            </ul>
                        </div>
                        <div class="checkbox-holder text-left">
                            <div class="checkbox">
                                <input type="checkbox" value="None" id="squaredOne" name="check" />
                                <label for="squaredOne"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <div class="container-fluid">

                <div class="row bottom-footer text-center-mobile">
                    <div class="col-sm-8">
                        <p>&copy; 2016 All Rights Reserved. Powered by <a href="#" class="white">Hi-Tech. Maintenance System.</a></p>
                    </div>
                    <div class="col-sm-4 text-right text-center-mobile">
                        <ul class="social-footer">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Holder for mobile navigation -->
        <div class="mobile-nav">
            <ul>
            </ul>
            <a href="#" class="close-link"><i class="arrow_up"></i></a>
        </div>
        <!-- Scripts -->
        <script src="<?= base_url() . 'assets/frontend/' ?>js/jquery-1.11.1.min.js"></script>
        <script src="<?= base_url() . 'assets/frontend/' ?>js/owl.carousel.min.js"></script>
        <script src="<?= base_url() . 'assets/frontend/' ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url() . 'assets/frontend/' ?>js/wow.min.js"></script>
        <script src="<?= base_url() . 'assets/frontend/' ?>js/typewriter.js"></script>
        <script src="<?= base_url() . 'assets/frontend/' ?>js/jquery.onepagenav.js"></script>
        <script src="<?= base_url() . 'assets/frontend/' ?>js/main.js"></script>
        <script type="text/javascript">
            $('.carousel').carousel();
        </script>
    </body>

</html>
