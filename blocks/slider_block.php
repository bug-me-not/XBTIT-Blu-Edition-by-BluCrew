
<html>
    <head>
        <link href="Strapslide/strapslide/css/strapslide.css" rel="stylesheet" media="screen" />
        <link href="Strapslide/strapslide/css/strapslide-metro.css" rel="stylesheet" media="screen" />
    </head>
    <body>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Featured Torrent(Under Development)</h4>
</div>
        <div class="container-fluid" style="padding:0;">
            <div class="row-fluid">

                <!-- STRAPSLIDE -->
                <div class="strapslide" id="strapslide">

                    <!-- PRELOADER -->
                    <div class="preloader text-center">
                        <img src="Strapslide/images/loader.gif" alt="Loading.." id="loader" />
                    </div>
                    <!-- /PRELOADER -->

                    <!-- STRAPSLIDE CONTAINER -->
                    <div class="strapslide-container">

                        <!-- SLIDE -->
                        <div class="slide active" data-animation="fade, scaledown, top" id="slide1">
                        <!-- BACKGROUND IMAGE -->
                        <img src="Strapslide/images/tron1.jpg" class="background-image" alt=""/>
                        <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                         <!-- SLIDE -->
                        <div class="slide" data-animation="fade, rotatecw, top" id="slide2">
                        <!-- BACKGROUND IMAGE -->
                        <img src="Strapslide/images/tron2.jpg" class="background-image" alt=""/>
                         <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                         <!-- SLIDE -->
                        <div class="slide" data-animation="fade, scaleup, top" id="slide3">
                        <!-- BACKGROUND IMAGE -->
                        <img src="Strapslide/images/tron.jpg" class="background-image" alt=""/>
                        <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                        <!-- SLIDE -->
                        <div class="slide" data-animation="fade, scaleup, top" id="slide4">
                        <!-- BACKGROUND IMAGE -->
                        <img src="Strapslide/images/tron1.jpg" class="background-image" alt=""/>
                        <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                        <!-- SLIDE -->
                        <div class="slide" data-animation="fade, scaleup, top" id="slide5">
                        <!-- BACKGROUND IMAGE -->
                        <img src="Strapslide/images/tron2.jpg" class="background-image" alt=""/>
                        <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                    </div>
                    <!-- /STRAPSLIDE CONTAINER --> 

                    <!-- PROGRESS BAR -->
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 20%;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /PROGRESS BAR -->

                    <!-- TORRENT INFO -->
                    <div>
                    <h2>Tron Legacy 2010 Blu ray 1080p AVC DTS HD MA 7 1 tater44 BluRG</h2>
                    <p>Size: 10.05 GB | Seeders: 3 | Leechers: 0 | Completed: 25</p>
                    </div>
                    <!-- TORRENT INFO -->

                    <!-- DOWNLOAD BUTTON -->
                    <button class="btn btn-labeled btn-danger" type="button">
                    <span class="btn-label"><i class="fa fa-download"></i></span><a href="#" target="_blank">Download</a></button>
                    <!-- DOWNLAOD BUTTON -->

                    <!-- NEXT-PREV NAVIGATION -->
                    <div class="row-fluid strapslide-nav">
                        <div class="prev red" href="#">
                            <a href="#">&lt;</a>
                        </div>
                        <div class="next red" href="#">
                            <a href="#">&gt;</a>
                        </div>
                    </div>
                    <!-- /NEXT-PREV NAVIGATION -->

                    <!-- PAGINATION -->
                    <div class="row-fluid strapslide-pagination">
                        <div class="span12 text-center" style="text-align:center;">
                            <ul>

                            </ul>
                        </div>
                    </div>
                    <!-- /PAGINATION -->

                </div>
                <!-- /STRAPSLIDE -->

            </div>
        </div>
        </div>


        <!-- JavaScript plugins (requires jQuery) -->
        <script src="Strapslide/strapslide/js/jquery.touchSwipe.min.js"></script>
        <script src="Strapslide/strapslide/js/jquery.transit.min.js"></script>
        <script src="Strapslide/strapslide/js/jquery.mousewheel.js"></script>
        <script src="Strapslide/strapslide/js/jquery.fitVids.js"></script>
        <!-- Slider plugin -->
        <script src="Strapslide/strapslide/js/strapslide.js"></script>

        <script>
        jQuery.noConflict()(function($){
            $(document).ready(function() {
                $('#strapslide').strapslide({
                    animation: "fade, top",
                    speed: 1000,
                    timeout: 5000,
                    responsive: 'resize',
                    autoplay: true,
                    preload: true,
                    pauseOnHover: true,
                    pagination: true,
                    mousewheel: false,
                    keyboard: true,
                    touchscreen: true
                }, function() {
                    if ($('#strapslide .active').attr('id') == 'slide1') {
                        $('#slide1_content').fxenter('fade, bottom', 800);
                    }
                    if ($('#strapslide .active').attr('id') == 'slide2') {
                        $('#tile1').fxenter('fade, scaleup', 800);
                        $('#tile2').fxenter('fade, scaledown', 800);
                    }
                }, function() {
                    if ($('#strapslide .active').attr('id') == 'slide1') {
                        $('#slide1_content').fxexit('fade, scaledown, rotatecw, bottom', 800);
                    }
                    if ($('#strapslide .active').attr('id') == 'slide2') {
                        $('#tile1').fxexit('fade, scaledown', 800);
                        $('#tile2').fxexit('fade, scaleup', 800);
                    }
                });
            })
            });
        </script>

    </body>
</html>