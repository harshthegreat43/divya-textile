<?php 

$value = Session::get('user');

?>
    <link href="{{asset('admin/css/font.css')}}" rel="stylesheet">
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info" style="background: crimson;">
                <div class="image">
                    <img src="{{ asset('admin/img/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ucwords(strtolower($value->name))}}</div>
                    <div class="email">{{$value->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{url('admin/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('admin/password')}}"><i class="material-icons">key</i>Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                <?php $url = \Route::current()->uri; ?>
                 
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php if($url=="admin/dashboard") {echo "active";} ?>" >
                        <a href="{{url('admin/dashboard')}}"><i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/category") {echo "active";} ?>">
                        <a href="{{url('admin/category')}}"><i class="material-icons">apps</i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/product") {echo "active";} ?>">
                        <a href="{{url('admin/product')}}"><i class="material-icons">shop</i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/coupan") {echo "active";} ?>">
                        <a href="{{url('admin/coupan')}}"><i class="material-icons">local_activity</i>
                            <span>Coupons</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/video") {echo "active";} ?>">
                        <a href="{{url('admin/video')}}"><i class="material-icons">video_library</i>
                            <span>Videos</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/slider") {echo "active";} ?>">
                        <a href="{{url('admin/slider')}}"><i class="material-icons">view_carousel</i>
                            <span>Sliders</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/state") {echo "active";} ?>">
                        <a href="{{url('admin/state')}}"><i class="material-icons">my_location</i>
                            <span>States</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/city") {echo "active";} ?>">
                        <a href="{{url('admin/city')}}"><i class="material-icons">place</i>
                            <span>Cities</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/order") {echo "active";} ?>">
                        <a href="{{url('admin/order')}}"><i class="material-icons">shopping_cart</i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/email") {echo "active";} ?>">
                        <a href="{{url('admin/email')}}"><i class="material-icons">mail</i>
                            <span>Emails</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/enquiry") {echo "active";} ?>">
                        <a href="{{url('admin/enquiry')}}"><i class="material-icons">help</i>
                            <span>Enquiries</span>
                        </a>
                    </li>
                    <li class="<?php if($url=="admin/stat") {echo "active";} ?>">
                        <a href="{{url('admin/stat')}}"><i class="material-icons">web_asset</i>
                            <span>Statics</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy;<?php echo date("Y") .'-'. (date("Y")+1);?> <a href="#"><span>DIVYA TEXTILE</span></a> Inc.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

