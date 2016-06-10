/* 
 Plugin     : Strapslide
 Version    : 1.1
 Created on : Aug 13, 2013
 Author     : Grozav http://grozav.com
 Description: Strapslide is the ultimate premium slider offering the capability 
 to show images, videos and captions paired with simple, modern 
 and fancy 3D transitions. Even more important, it is fully responsive
 and mobile optimized and can take on any dimensions.
 */

(function($) {

    $.fn.strapslide = function(options, callback, callbackout) {

        var settings = $.extend({
            animation: 'fade',
            speed: 1000,
            timeout: 5000,
            autoHeight: true,
            autoplay: false,
            preload: 'all',
            pauseOnHover: false,
            pagination: false,
            mousewheel: false,
            keyboard: true
        }, options);

        if (callback == undefined) {
            callback = function() {
            };
        }
        if (callbackout == undefined) {
            callbackout = function() {
            };
        }

        var fx = {
            rotate: 0,
            scale: 1,
            opacity: 0,
            direction: 'none'
        };
        var fxdefault = {
            rotate: 60,
            scalelarge: 3,
            scalesmall: 0
        };

        var $this = $(this);
        var slider = $('.slider-container', $this);
        if( $('.bar', $this).length == 1 )
            var progress = $('.bar', $this);
        else
            var progress = $('.progress-bar', $this);
        var pagination = $('.strapslide-pagination', $this);

        var next = $('.next', $this);
        var prev = $('.prev', $this);

        var current;

        var count = 0;

        var end = slider.children('.slide').length - 1;

        var isFirefox = typeof InstallTrigger !== 'undefined';

        /*
         *
         *
         * Animation Parameters
         *
         *
         */
        switch (settings.animation) {
            case 'fade':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'fromright':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'left';
                }
                ;
                break;
            case 'fromleft':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'right';
                }
                ;
                break;
            case 'fromtop':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'bottom';
                }
                ;
                break;
            case 'frombottom':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'top';
                }
                ;
                break;
            case 'scaleup':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = fxdefault.scalesmall;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'scaledown':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = fxdefault.scalelarge;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'rotatecw':
                {
                    fx.rotate = fxdefault.rotate;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'rotateccw':
                {
                    fx.rotate = -fxdefault.rotate;
                    fx.opacity = 0;
                    fx.scale = 1;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'scaleuprotatecw':
                {
                    fx.rotate = fxdefault.rotate;
                    fx.opacity = 0;
                    fx.scale = fxdefault.scalesmall;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'scaledownrotatecw':
                {
                    fx.rotate = fxdefault.rotate;
                    fx.opacity = 0;
                    fx.scale = fxdefault.scalelarge;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'scaleuprotateccw':
                {
                    fx.rotate = fxdefault.rotate;
                    fx.opacity = 0;
                    fx.scale = fxdefault.scalesmall;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'scaledownrotateccw':
                {
                    fx.rotate = fxdefault.rotate;
                    fx.opacity = 0;
                    fx.scale = fxdefault.scalelarge;
                    fx.direction = 'none';
                }
                ;
                break;
            case 'custom':
                {
                    fx.rotate = 0;
                    fx.opacity = 0;
                    fx.scale = 0;
                    fx.direction = 'none';
                }
        }


        /**
         *
         *
         * Content Object Animation
         *
         *
         */
        (function($) {
            $.fn.animationIn = function(fx, fxspeed, fxcallback) {

                if (fxspeed === undefined) {
                    fxspeed = settings.speed;
                }
                if (fxcallback === undefined) {
                    fxcallback = function() {
                    };
                }

                var sliderWidth = slider.width();
                var sliderHeight = slider.height();

                var fxdirection = 'none';
                var fxpositionX = 0;
                var fxpositionY = 0;
                var fxdeg = 0;
                var fxscale = 1;
                var fxopacity = 1;

                switch (fx) {
                    case 'fade':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'fromright':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'right';
                        }
                        ;
                        break;
                    case 'fromleft':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'left';
                        }
                        ;
                        break;
                    case 'frombottom':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'top';
                        }
                        ;
                        break;
                    case 'fromtop':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'bottom';
                        }
                        ;
                        break;
                    case 'scaleup':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = fxdefault.scalesmall;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaledown':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = fxdefault.scalelarge;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'rotatecw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'rotateccw':
                        {
                            fxdeg = -fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaleuprotatecw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalesmall;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaledownrotatecw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalelarge;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaleuprotateccw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalesmall;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaledownrotateccw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalelarge;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'custom':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 0;
                            fxdirection = 'none';
                        }
                }

                if (fxdirection == 'left')
                    fxpositionX = -sliderWidth;
                else if (fxdirection == 'right')
                    fxpositionX = sliderWidth;
                else if (fxdirection == 'top')
                    fxpositionY = sliderHeight;
                else if (fxdirection == 'bottom')
                    fxpositionY = -sliderHeight;
                else if (fxdirection == 'none') {
                    fxpositionX = 0;
                    fxpositionY = 0;
                }


                if ($(this).attr('data-right')) {
                    $(this).css({
                        'right': fxpositionX + 'px',
                        'top': fxpositionY + 'px',
                        '-webkit-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-moz-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-ms-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-o-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        'transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity='" + fxopacity * 100 + "')",
                        'filter': 'alpha(opacity=' + fxopacity * 100 + ')',
                        '-moz-opacity': fxopacity,
                        '-khtml-opacity': fxopacity,
                        opacity: fxopacity
                    }).transition({
                        right: '0px',
                        top: '0px',
                        rotate: '0deg',
                        scale: '1',
                        opacity: 1
                    }, fxspeed);
                } else {
                    $(this).css({
                        'left': fxpositionX + 'px',
                        'top': fxpositionY + 'px',
                        '-webkit-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-moz-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-ms-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-o-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        'transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                        '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity='" + fxopacity * 100 + "')",
                        'filter': 'alpha(opacity=' + fxopacity * 100 + ')',
                        '-moz-opacity': fxopacity,
                        '-khtml-opacity': fxopacity,
                        opacity: fxopacity
                    }).transition({
                        left: '0px',
                        top: '0px',
                        rotate: '0deg',
                        scale: '1',
                        opacity: 1
                    }, fxspeed);
                }




                fxcallback();

            };
        }(jQuery));

        (function($) {
            $.fn.animationOut = function(fx, fxspeed, fxcallback) {

                if (fxspeed === undefined) {
                    fxspeed = settings.speed;
                }
                if (fxcallback === undefined) {
                    fxcallback = function() {
                    };
                }

                var sliderWidth = slider.width();
                var sliderHeight = slider.height();

                var fxdirection = 'none';
                var fxpositionX = 0;
                var fxpositionY = 0;
                var fxdeg = 0;
                var fxscale = 1;
                var fxopacity = 1;


                switch (fx) {
                    case 'fade':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'toleft':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'left';
                        }
                        ;
                        break;
                    case 'toright':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'right';
                        }
                        ;
                        break;
                    case 'tobottom':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'top';
                        }
                        ;
                        break;
                    case 'totop':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'bottom';
                        }
                        ;
                        break;
                    case 'scaledown':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = fxdefault.scalesmall;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaleup':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = fxdefault.scalelarge;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'rotatecw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'rotateccw':
                        {
                            fxdeg = -fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaleuprotatecw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalesmall;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaledownrotatecw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalelarge;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaleuprotateccw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalesmall;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'scaledownrotateccw':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = fxdefault.scalelarge;
                            fxdirection = 'none';
                        }
                        ;
                        break;
                    case 'fallleft':
                        {
                            fxdeg = fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'fallleft';
                        }
                        ;
                        break;
                    case 'fallright':
                        {
                            fxdeg = -fxdefault.rotate;
                            fxopacity = 0;
                            fxscale = 1;
                            fxdirection = 'fallright';
                        }
                        ;
                        break;
                    case 'custom':
                        {
                            fxdeg = 0;
                            fxopacity = 0;
                            fxscale = 0;
                            fxdirection = 'none';
                        }
                }


                if (fxdirection == 'left')
                    fxpositionX = -sliderWidth;
                else if (fxdirection == 'right')
                    fxpositionX = sliderWidth;
                else if (fxdirection == 'top')
                    fxpositionY = sliderHeight;
                else if (fxdirection == 'bottom')
                    fxpositionY = -sliderHeight;
                else if (fxdirection == 'fallleft') {
                    fxpositionX = -200;
                    fxpositionY = sliderHeight;
                } else if (fxdirection == 'fallright') {
                    fxpositionX = 200;
                    fxpositionY = sliderHeight;
                } else if (fxdirection == 'none') {
                    fxpositionX = 0;
                    fxpositionY = 0;
                }

                if ($(this).attr('data-right')) {
                    $(this).css({
                        'right': '0px',
                        'top': '0px',
                        '-webkit-transform': 'rotate(0deg) scale(1)',
                        '-moz-transform': 'rotate(0deg) scale(1)',
                        '-ms-transform': 'rotate(0deg) scale(1)',
                        '-o-transform': 'rotate(0deg) scale(1)',
                        'transform': 'rotate(0deg) scale(1)',
                        '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity='100')",
                        'filter': 'alpha(opacity=100)',
                        '-moz-opacity': 1,
                        '-khtml-opacity': 1,
                        opacity: 1
                    }).transition({
                        right: fxpositionX + 'px',
                        top: fxpositionY + 'px',
                        rotate: fxdeg + 'deg',
                        scale: fxscale,
                        opacity: fxopacity
                    }, fxspeed, fxcallback());
                } else {
                    $(this).css({
                        'left': '0px',
                        'top': '0px',
                        '-webkit-transform': 'rotate(0deg) scale(1)',
                        '-moz-transform': 'rotate(0deg) scale(1)',
                        '-ms-transform': 'rotate(0deg) scale(1)',
                        '-o-transform': 'rotate(0deg) scale(1)',
                        'transform': 'rotate(0deg) scale(1)',
                        '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity='100')",
                        'filter': 'alpha(opacity=100)',
                        '-moz-opacity': 1,
                        '-khtml-opacity': 1,
                        opacity: 1
                    }).transition({
                        left: fxpositionX + 'px',
                        top: fxpositionY + 'px',
                        rotate: fxdeg + 'deg',
                        scale: fxscale,
                        opacity: fxopacity
                    }, fxspeed, fxcallback());
                }


            };
        }(jQuery));


        /**
         *
         *
         *  Initialize Slide Options
         *
         *
         */
        var animations = ["rotate", "rotateinverse", "scaleup", "scaledown", "rotatescaleup", "rotatescaleupinverse", "rotatescaledown", "rotatescaledowninverse"];
        var randomAnimation = 0;
        if (settings.animation == "random") {
            randomAnimation = 1;
            settings.animation = animations[Math.floor(Math.random() * animations.length)];
        }

        /**
         *
         *
         *  Go to nth slide
         *
         *
         */

        function gotoslide(index) {

            if (settings.autoplay == true) {
                progress.css({
                    width: '0%'
                });
                count = 0;
                timer.pause();
                setTimeout(function() {
                    timer.play();
                }, settings.speed);
            }
            animated = 1;
            setTimeout(function() {
                animated = 0;
            }, settings.speed + 300);

            var temp = current;

            var slide = $('.slide', slider);
            var slidecontent = $('.slide-content', slider);
            var sliderWidth = slider.width();
            var sliderHeight = slider.height();

            var fxtransition = settings.animation;
            var fxdirection = fx.direction;
            var fxpositionX = 0;
            var fxpositionY = 0;
            var fxdeg = fx.rotate;
            var fxscale = fx.scale;
            var fxopacity = fx.opacity;

            if (slide.eq(index).attr('data-transition')) {
                fxtransition = slide.eq(index).attr('data-transition');
            }
            switch (fxtransition) {
                case 'fade':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'fromright':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'left';
                    }
                    ;
                    break;
                case 'fromleft':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'right';
                    }
                    ;
                    break;
                case 'fromtop':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'bottom';
                    }
                    ;
                    break;
                case 'frombottom':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'top';
                    }
                    ;
                    break;
                case 'scaleup':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = fxdefault.scalesmall;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'scaledown':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = fxdefault.scalelarge;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'rotatecw':
                    {
                        fxdeg = fxdefault.rotate;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'rotateccw':
                    {
                        fxdeg = -fxdefault.rotate;
                        fxopacity = 0;
                        fxscale = 1;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'scaleuprotatecw':
                    {
                        fxdeg = fxdefault.rotate;
                        fxopacity = 0;
                        fxscale = fxdefault.scalesmall;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'scaledownrotatecw':
                    {
                        fxdeg = fxdefault.rotate;
                        fxopacity = 0;
                        fxscale = fxdefault.scalelarge;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'scaleuprotateccw':
                    {
                        fxdeg = fxdefault.rotate;
                        fxopacity = 0;
                        fxscale = fxdefault.scalesmall;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'scaledownrotateccw':
                    {
                        fxdeg = fxdefault.rotate;
                        fxopacity = 0;
                        fxscale = fxdefault.scalelarge;
                        fxdirection = 'none';
                    }
                    ;
                    break;
                case 'custom':
                    {
                        fxdeg = 0;
                        fxopacity = 0;
                        fxscale = 0;
                        fxdirection = 'none';
                    }
            }
            if (fxdirection == 'left')
                fxpositionX = sliderWidth;
            else if (fxdirection == 'right')
                fxpositionX = -sliderWidth;
            else if (fxdirection == 'top')
                fxpositionY = sliderHeight;
            else if (fxdirection == 'bottom')
                fxpositionY = -sliderHeight;
            else if (fxdirection == 'none') {
                fxpositionX = 0;
                fxpositionY = 0;
            }
            if (slide.eq(index).attr('data-opacity')) {
                if (slide.eq(index).attr('data-opacity') == 'false')
                    var fxopacity = 1;
            }
            if (slide.eq(index).attr('data-scale')) {
                var fxscale = slide.eq(index).attr('data-scale');
            }
            if (slide.eq(index).attr('data-opacity')) {
                var fxopacity = slide.eq(index).attr('data-opacity');
            }
            
                
            callbackout();

            slide.eq(current).removeClass('active');

            slide.delay(500).eq(index).addClass('active').css({
                'display': 'block',
                'left': fxpositionX + 'px',
                'top': fxpositionY + 'px',
                '-webkit-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                '-moz-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                '-ms-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                '-o-transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                'transform': 'rotate(' + fxdeg + 'deg) scale(' + fxscale + ')',
                '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity='" + fxopacity * 100 + "')",
                'filter': 'alpha(opacity=' + fxopacity * 100 + ')',
                '-moz-opacity': fxopacity,
                '-khtml-opacity': fxopacity,
                opacity: fxopacity
            }).transition({
                left: '0px',
                top: '0px',
                rotate: '0deg',
                scale: '1',
                opacity: 1
            }, settings.speed, function() {
                slidecontent.eq(index).fadeIn(0);
                callback();
                slide.eq(temp).fadeOut(0);
                slidecontent.eq(temp).fadeOut(0);
                
                if( isFirefox && slide.eq(index).hasClass('withvideo') ){
                    $(slide).eq(index).attr('style','display:block ');
                }
            
            });

            $('.strapslide-pagination li', $this).eq(temp).removeClass('active');
            $('.strapslide-pagination li', $this).eq(index).addClass('active');

            current = index;


        }


        /**
         *
         *
         *  Timer Function
         *
         *
         */

        (function($) {
            $.timer = function(func, time, autostart) {
                this.set = function(func, time, autostart) {
                    this.init = true;
                    if (typeof func == 'object') {
                        var paramList = ['autostart', 'time'];
                        for (var arg in paramList) {
                            if (func[paramList[arg]] != undefined) {
                                eval(paramList[arg] + " = func[paramList[arg]]");
                            }
                        }
                        ;
                        func = func.action;
                    }
                    if (typeof func == 'function') {
                        this.action = func;
                    }
                    if (!isNaN(time)) {
                        this.intervalTime = time;
                    }
                    if (autostart && !this.isActive) {
                        this.isActive = true;
                        this.setTimer();
                    }
                    return this;
                };
                this.once = function(time) {
                    var timer = this;
                    if (isNaN(time)) {
                        time = 0;
                    }
                    window.setTimeout(function() {
                        timer.action();
                    }, time);
                    return this;
                };
                this.play = function(reset) {
                    if (!this.isActive) {
                        if (reset) {
                            this.setTimer();
                        } else {
                            this.setTimer(this.remaining);
                        }
                        this.isActive = true;
                    }
                    return this;
                };
                this.pause = function() {
                    if (this.isActive) {
                        this.isActive = false;
                        this.remaining -= new Date() - this.last;
                        this.clearTimer();
                    }
                    return this;
                };
                this.stop = function() {
                    this.isActive = false;
                    this.remaining = this.intervalTime;
                    this.clearTimer();
                    return this;
                };
                this.toggle = function(reset) {
                    if (this.isActive) {
                        this.pause();
                    } else if (reset) {
                        this.play(true);
                    } else {
                        this.play();
                    }
                    return this;
                };
                this.reset = function() {
                    this.isActive = false;
                    this.play(true);
                    return this;
                };
                this.clearTimer = function() {
                    window.clearTimeout(this.timeoutObject);
                };
                this.setTimer = function(time) {
                    var timer = this;
                    if (typeof this.action != 'function') {
                        return;
                    }
                    if (isNaN(time)) {
                        time = this.intervalTime;
                    }
                    this.remaining = time;
                    this.last = new Date();
                    this.clearTimer();
                    this.timeoutObject = window.setTimeout(function() {
                        timer.go();
                    }, time);
                };
                this.go = function() {
                    if (this.isActive) {
                        this.action();
                        this.setTimer();
                    }
                };

                if (this.init) {
                    return new $.timer(func, time, autostart);
                } else {
                    this.set(func, time, autostart);
                    return this;
                }
            };
        })(jQuery);


        /*
         *
         *
         * CONTENT POSITIONING
         *
         *
         */


        var $top = $('.slide-content', $this).find('[data-top]');
        var $bottom = $('.slide-content', $this).find('[data-bottom]');
        var $left = $('.slide-content', $this).find('[data-left]');
        var $right = $('.slide-content', $this).find('[data-right]');

        function position() {
            var sliderWidth = slider.width();
            var sliderHeight = slider.height();

            if ($(window).width() > 979) {
                $top.each(function() {
                    $(this).css({'position': 'absolute', 'margin-top': $(this).attr('data-top') * sliderHeight / 100 + 'px'});
                });
                $bottom.each(function() {
                    var thisHeight = $(this).height();
                    $(this).css({'position': 'absolute', 'margin-top': sliderHeight - $(this).attr('data-bottom') * sliderHeight / 100 - (thisHeight) + 'px'});
                });
                $left.each(function() {
                    $(this).css({'float': 'left', 'position': 'absolute', 'margin-left': $(this).attr('data-left') * sliderWidth / 100 + 'px'});
                });
                $right.each(function() {
                    $(this).css({'float': 'right', 'position': 'absolute', 'right': 0, 'margin-right': $(this).attr('data-right') * sliderWidth / 100 + 'px'});
                });
            } else if ($(window).width() < 980 && $(window).width() > 767) {
                $top.each(function() {
                    $(this).css({'position': 'absolute', 'margin-top': $(this).attr('data-top') * sliderHeight / 150 + 'px'});
                });
                $bottom.each(function() {
                    var thisHeight = $(this).height();
                    $(this).css({'position': 'absolute', 'margin-top': sliderHeight - $(this).attr('data-bottom') * sliderHeight / 150 - (thisHeight) + 'px'});
                });
                $left.each(function() {
                    $(this).css({'float': 'left', 'position': 'absolute', 'margin-left': $(this).attr('data-left') * sliderWidth / 200 + 'px'});
                });
                $right.each(function() {
                    $(this).css({'float': 'right', 'position': 'absolute', 'right': 0, 'margin-right': $(this).attr('data-right') * sliderWidth / 200 + 'px'});
                });
            } else {
                $top.each(function() {
                    $(this).css({'position': 'absolute', 'margin-top': $(this).attr('data-top') * sliderHeight / 250 + 'px'});
                });
                $bottom.each(function() {
                    var thisHeight = $(this).height();
                    $(this).css({'position': 'absolute', 'margin-top': sliderHeight - $(this).attr('data-bottom') * sliderHeight / 250 - (thisHeight) + 'px'});
                });
                $left.each(function() {
                    $(this).css({'float': 'left', 'position': 'absolute', 'margin-left': '0px'});
                });
                $right.each(function() {
                    $(this).css({'float': 'right', 'position': 'absolute', 'right': 0, 'margin-right': '0px'});
                });
            }
        }

        function fullscreenvideo() {
            if (current > 0) {
                var backgroundHeight = $('.slide', $this).eq(current - 1).height();
                var backgroundWidth = $('.slide', $this).eq(current - 1).width();
            }
            else {
                var backgroundHeight = $('.slide', $this).eq(current + 1).height();
                var backgroundWidth = $('.slide', $this).eq(current + 1).width();
            }

            $('.strapslide-videofullscreen', $this).height(backgroundHeight).width(backgroundWidth);
        }


        /**
         *
         *
         * Responsive Custom Height
         *
         *
         */
        var maxHeight;

        if (settings.autoHeight == false)
            maxHeight = slider.height();

        function setHeight() {
            var sliderHeight = slider.height();
            var slidesHeight = $('.active', slider).height();

            if (settings.autoHeight == true) {
                slider.css({
                    'height': slidesHeight
                });
            } else {
                if (maxHeight > slidesHeight) {
                    slider.css({
                        'height': slidesHeight
                    });
                } else {
                    slider.css({
                        'height': maxHeight
                    });
                }
            }
        }

        /*
         *
         *
         * Autoplay Controls
         *
         *
         */
        if (settings.autoplay == true) {
            var count = 0;
            var timer = $.timer(
                    function() {
                        count++;
                        if (count >= settings.timeout / 100) {
                            if (current < end) {
                                gotoslide(current + 1);
                            } else
                                gotoslide(0);
                        }
                        progress.css({
                            width: (count * 11000) / settings.timeout + '%'
                        });
                        if (settings.pauseOnHover == true) {
                            slider.hover(function() {
                                timer.pause();
                            }, function() {
                                timer.play();
                            });
                        }

                    }, 100, true);
        } else {
            $('.progress', $this).hide(0);
        }
        

        /**
         *
         *
         * Slider Preload
         *
         *
         */
        if (settings.autoplay == true)
            timer.pause();
        if (settings.preload == 'first') {
            var src = $('.active img', $this).attr('src');
            var preloadedImage = $(new Image()).attr('src', src);
            preloadedImage.load(function() {
                $('.loader', $this).fadeOut(300);
                setHeight();
                position();
                var gotostart = $('.active', $this).index();
                if ($('.active', $this).length == 0) {
                    gotostart = 0;
                }
                gotoslide(gotostart);
                fullscreenvideo();
                if (settings.autoplay == true)
                    timer.play();
            });
        } else if (settings.preload == 'all') {
            var loadcount = 0;
            var loadlength = $('img', $this).length;
            var images = $('img', $this);
            images.each(function() {
                var src = $(this).attr('src');
                var preloadedImage = $(new Image()).attr('src', src);
                preloadedImage.load(function() {
                    ++loadcount;
                    if (loadcount == loadlength) {
                        $('.loader', $this).fadeOut(300);
                        setHeight();
                        position();
                        var gotostart = $('.active', $this).index();
                        if ($('.active', $this).length == 0) {
                            gotostart = 0;
                        }
                        gotoslide(gotostart);
                        fullscreenvideo();
                        if (settings.autoplay == true)
                            timer.play();
                    }
                })
            });
        }
        else if (settings.preload == 'none') {
            $('.loader', $this).fadeOut(300);
            setHeight();
            position();
            var gotostart = $('.active', $this).index();
            if ($('.active', $this).length == 0) {
                gotostart = 0;
            }
            gotoslide(gotostart);
            fullscreenvideo();
            if (settings.autoplay == true)
                timer.play();
        }
        else {
            setTimeout(function() {
                $('.loader', $this).fadeOut(300);
                setHeight();
                position();
                var gotostart = $('.active', $this).index();
                if ($('.active', $this).length == 0) {
                    gotostart = 0;
                }
                gotoslide(gotostart);
                fullscreenvideo();
                if (settings.autoplay == true)
                    timer.play();
            }, settings.preload)
        }

        setTimeout(function() {
            position();
            fullscreenvideo();
        }, 2000)

        $(window).resize(function() {
            setHeight();
            position();
            fullscreenvideo();
        })

        $(window).bind('orientationchange resize', function() {
            setHeight();
            position();
            fullscreenvideo();
        });


        /**
         *
         *
         * Slider Controls
         *
         *
         */

        var animated = 0;


        /**
         *
         *
         * Next / Prev Buttons
         *
         *
         */
        next.click(function() {
            if (!animated) {
                if (current < end)
                    gotoslide(current + 1);
                else
                    gotoslide(0);
            }
        });
        prev.click(function() {
            if (!animated) {
                if (current > 0)
                    gotoslide(current - 1);
                else
                    gotoslide(end);
            }
        });

        /*
         *
         *
         * Swipe Controls
         *
         *
         */




        /*
         *
         *
         * Pagination
         *
         *
         */
        if (settings.pagination == true) {
            var slidesCount = $('.slide', $this).length;
            var i;
            for (i = 0; i < slidesCount; i++)
                pagination.append('<li><a href="#">' + (i + 1) + '</a></li>');

            if (pagination.hasClass('autocenter')) {
                var paginationWidth = pagination.width() / 2;
                pagination.css({
                    'margin-left': -paginationWidth
                });
            }

            $('.strapslide-pagination li', $this).eq(current).addClass('active');

            $('.strapslide-pagination li a', $this).click(function() {
                var dataslide = $(this).closest('li').index();
                if (current != dataslide && !animated) {
                    gotoslide(dataslide);
                }
            });

        }

        /*
         *
         *
         * Scroll
         *
         *
         */
        if (settings.mousewheel == true) {

            slider.bind('mousewheel', function(event, delta) {
                if (delta < 0 && !animated) {
                    if (current < end)
                        gotoslide(current + 1);
                    else
                        gotoslide(0);
                }
                if (delta > 0 && !animated) {
                    if (current > 0)
                        gotoslide(current - 1);
                    else
                        gotoslide(end);
                }
                event.stopPropagation();
                event.preventDefault();
            });
        }

        /*
         *
         *
         * Keyboard
         *
         *
         */
        if (settings.keyboard == true) {
            $(document).keydown(function(e) {
                if (e.keyCode == 37 && !animated) {
                    if (current > 0)
                        gotoslide(current - 1);
                    else
                        gotoslide(end);
                    return false;
                }
                if (e.keyCode == 39 && !animated) {
                    if (current < end)
                        gotoslide(current + 1);
                    else
                        gotoslide(0);
                    return false;
                }
            });

        }

        /*
         *
         *
         * Responsive videos
         *
         *
         */
        

        $(".strapslide-video", $this).fitVids();
    };

}(jQuery));