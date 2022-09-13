<?php 

$value = Session::get('customer');

?>        
<!-- --------------------------footer-------------------------- -->
            <footer>
                <div class="container">

                   

                    <ul class="list-inline social_ul">
                        <li class="list-inline-item">
                            <a href="#" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank">
                                <i class="fa-brands fa-google"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>


                </div>
                <div class="copyright_dv">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p>Copyright © <?php echo date("Y") .'-'. (date("Y")+1);?> <a>Divya Textile</a> : All Rights Reserved.
                                </p>
                            </div>
                            <div class="col-md-6">
                                <ul class="d-flex align-items-center list-unstyled justify-content-end mb-0">
                                    <li class="me-3 mb-0"><a href="{{url('privacypolicy')}}">Privacy Policy</a></li>
                                    <li class="ms-3 mb-0"><a href="{{url('terms')}}">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>


    </body>

    </html>
</body>

</html>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{ asset('web/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('web/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('web/js/owl.carousel.js')}}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!--- used in order form -->
    <script>
    $(document).ready(function() {
        $(".state").change(function(){
            var stateid = $(this).val();
            var token = "{{ csrf_token()}}";
            $.ajax({
                type:'POST',
                url:"{{url('statecity')}}",
                data:{'stateid':stateid,'_token':token},
                success:function(data){
                    $('#show_cities').html(data.html);  
                }
            });
        });
    });
    </script>

    

    <script>
        $('.sliderCarousel').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 5000,
            animateOut: 'fadeOut',
            responsiveClass: true,
            items: 1,

        })
    </script>
    <script>
        // $('#bio1').delay(3000).fadeIn();
        $(function() {
            setTimeout(function() {
                $("#overlayWebsite").slideUp(500);
            }, 3000)
        });
    </script>



    <script src="{{ asset('web/js/datatables.min.js')}}"></script>
    <script src="{{ asset('web/js/datatables.bs5.min.js')}}"></script>

    <!--used in my oders-->
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </script>


    
    <script src="{{ asset('web/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('web/js/jquery.zoom.js')}}"></script>
    <script>
        var App = (function() {

            //=== Use Strict ===//
            'use strict';

            //=== Private Variables ===//
            var gallery = $('#js-gallery');
            $('.gallery__hero').zoom();


            //=== Gallery Object ===//
            var Gallery = {
                zoom: function(imgContainer, img) {
                    var containerHeight = imgContainer.outerHeight(),
                        src = img.attr('src');

                },
                switch: function(trigger, imgContainer) {
                    var src = trigger.attr('href'),
                        thumbs = trigger.siblings(),
                        img = trigger.parent().prev().children();

                    // Add active class to thumb
                    trigger.addClass('is-active');

                    // Remove active class from thumbs
                    thumbs.each(function() {
                        if ($(this).hasClass('is-active')) {
                            $(this).removeClass('is-active');
                        }
                    });


                    // Switch image source
                    img.attr('src', src);
                }
            };

            //=== Public Methods ===//
            function init() {


                // Listen for clicks on anchors within gallery
                gallery.delegate('a', 'click', function(event) {
                    var trigger = $(this);
                    var triggerData = trigger.data("gallery");

                    if (triggerData === 'zoom') {
                        var imgContainer = trigger.parent(),
                            img = trigger.siblings();
                        Gallery.zoom(imgContainer, img);
                    } else if (triggerData === 'thumb') {
                        var imgContainer = trigger.parent().siblings();
                        Gallery.switch(trigger, imgContainer);
                    } else {
                        return;
                    }

                    event.preventDefault();
                });
            }

            //=== Make Methods Public ===//
            return {
                init: init
            };

        })();

        App.init();
    </script>