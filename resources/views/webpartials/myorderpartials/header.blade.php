<?php $url = Route::current()->uri;?>
<?php 

$value = Session::get('customer');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIVYA TEXTILE</title>
    <link rel="icon" href="{{asset('web/images/favicon.png')}}" type="image/x-icon">
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('web/css/all.min.css')}}" type="text/css">
        <link href="{{asset('web/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('web/css/owl.carousel.min.css')}}" rel="stylesheet" media="all">
        <link rel="stylesheet" href="{{asset('web/css/font.css')}}">
        <link rel="stylesheet" href="{{asset('web/css/datatables.bs5.min.css')}}">
        <link href="{{asset('web/css/font.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
    </head>

    <body>
        @if($url == '/')
        <div id="overlayWebsite">
            <div class="overflow-hidden">
                <h5 class="header drop-in">Welcome</h5>
            </div>
            <div class="overflow-hidden">
                <h3 class="header drop-in">Divya Textile</h3>
            </div>
            <div class="overflow-hidden">
                <p class="drop-in-2">
                    We are a leading manufacturer and wholesaler of all kinds of cloths
                </p>
            </div>
        </div>
        @endif
        <div class="pageContainer">
            <header id="header">
                <div class="headerTop">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <!-- <marquee direction="right">We are a leading manufacturer and wholesaler of all kinds of cloths
                                </marquee> -->
                                <p class="text-white mb-0" style="font-weight: 700;">We are a leading manufacturer and wholesaler of all kinds of cloths
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="#" target="_blank">
                                    <span class="heart">
                                        <!-- <i class="bi bi-whatsapp"></i> -->
                                        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_bhqtie3z.json"  background="transparent"  speed="1"  style="width: 40px; height: 40px; margin-right: 10px;"  loop  autoplay></lottie-player>
                                    </span> +91 7791812516
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="headerBottom sticky-top">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('web/images/logo.png')}}" alt="logo" class="logo"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('aboutus')}}">About Us</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="{{url('collection')}}">Collection</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="{{url('contactus')}}">Contact Us</a>
                                    </li>
                                    <?php if($value==null){?>
                                    <li class="nav-item dropdown" style="cursor:pointer;">
                                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#myModal" <?php if($url=="signin") {echo "hidden";}else if($url=="signup") {echo "hidden";} ?>>Sign In</a>
                                    </li>
                                    <?php }else{ ?>
                                    <li class="nav-item dropdown justify-content-center" style="cursor:pointer;">
                                        <a class="nav-link text-danger dropdown-toggle" data-bs-toggle="dropdown" ><i class="fa-regular fa-user"></i> {{ucwords(strtolower($value->name))}}</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{url('myorders/'.$value->id)}}">My Orders</a></li>
                                                <li><a class="dropdown-item" href="{{url('profileupdate')}}">Update Profile</a></li>
                                                <li><a class="dropdown-item" href="{{url('signout')}}">Logout</a></li>
                                            </ul>
                                    </li>
                                    <?php } ?>
                                </ul>  
                            </div>



                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal head -->
                                            <div class="modal-head d-flex justify-content-end">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body d-flex justify-content-center">
                                                <a href="{{url('signin')}}"><button type="button" class="btn btn-danger">Sign In</button></a>
                                            </div>
                                            <div class="modal-body">If not a customer yet, just be one and <a href="{{url('signup')}}">Sign Up</a> now.</div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </nav>
                    </div>
                </div>
            </header>