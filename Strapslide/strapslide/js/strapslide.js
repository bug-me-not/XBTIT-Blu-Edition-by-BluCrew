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

    $.fn.strapslide = function(options, callbackin, callbackout) {

        /*==== Initialize Callbacks ====*/
        if (callbackin == undefined)
            callbackin = function() {
            };
        if (callbackout == undefined)
            callbackout = function() {
            };

        /*==== Settings ====*/
        var settings = $.extend({
            animation: "fade",
            speed: 1000,
            timeout: 5000,
            responsive: 'resize',
            autoplay: true,
            preload: true,
            pauseOnHover: true,
            pagination: true,
            mousewheel: true,
            keyboard: true,
            touchscreen: true
        }, options);


        /*==== FX Variable ====*/
        var fx;
        var defaultfx = $.extend({
            fade: false,
            rotatecw: false,
            rotateccw: false,
            scaleup: false,
            scaledown: false,
            left: false,
            right: false,
            top: false,
            bottom: false
        }, fx);

        /*==== Default Animation Parameters ====*/
        var fxfade = 0;
        var fxdeg = 60;
        var fxlargescale = 2;
        var fxsmallscale = 0;

        /*==== Initialize Animation Settings ====*/

        function setAnimation(fx, string) {

            string = string.replace(/\s/g, '').toLowerCase().split(',');

            var i;
            for (i = 0; i < string.length; ++i) {
                switch (string[i]) {
                    case 'fade' :
                        fx.fade = true;
                        break;
                    case 'rotatecw' :
                        {
                            if (fx.rotateccw != true)
                                fx.rotatecw = true;
                        }
                        break;
                    case 'rotateccw' :
                        {
                            if (fx.rotatecw != true)
                                fx.rotateccw = true;
                        }
                        break;
                    case 'scaleup' :
                        {
                            if (fx.scaledown != true)
                                fx.scaleup = true;
                        }
                        break;
                    case 'scaledown' :
                        {
                            if (fx.scaleup != true)
                                fx.scaledown = true;
                        }
                        break;
                    case 'top' :
                        {
                            if (fx.bottom != true)
                                fx.top = true;
                        }
                        break;
                    case 'bottom' :
                        {
                            if (fx.top != true)
                                fx.bottom = true;
                        }
                        break;
                    case 'left' :
                        {
                            if (fx.right != true)
                                fx.left = true;
                        }
                        break;
                    case 'right' :
                        {
                            if (fx.left != true)
                                fx.right = true;
                        }
                        break;
                }
            }
        }

        setAnimation(defaultfx, settings.animation);


        /*==== Variables ====*/
        var $this = $(this);

        var $container = $('.strapslide-container', $this);

        var $slides = $('.slide', $this);

        var $window = $(window);

        var preloader = $('.preloader', $this);

        var $active = $('.active', $this);

        var $background = $('.background-image', $this);

        var startHeight = $container.height();

        var first = $active.index();

        var aspectRatio = $background.width() / $background.height();

        var maxHeight = $container.height();

        var supportMode = $.support.leadingWhitespace ? true : false;

        if ($('.bar', $this).length == 1)
            var progress = $('.bar', $this);
        else
            var progress = $('.progress-bar', $this);

        var pagination = $('.strapslide-pagination', $this);
        /*==== Responsive Function ====*/

        if (!supportMode) {
            settings.responsive = 'ie8';
        }

        function responsive() {
            if (settings.responsive == 'none') {
                if (($container.width() / $container.height()) < (aspectRatio)) {
                    $background.removeClass('background-fullwidth').css({
                        'height': $container.height() + 'px',
                        'width': $container.height() * aspectRatio + 'px'
                    })
                } else {
                    $background.attr('style', '');
                    $background.addClass('background-fullwidth');
                }
            }
            else if (settings.responsive == 'ie8') {
                $container.append($background.eq(0).clone());
                $background.addClass('background-fullwidth');
                $('.background-image:last', $this).addClass('reference-image');
                $container.css({
                    'height':$('.background-image:last', $this).height()
                })
            }
        }

        if (settings.responsive == 'after') {
            $background.addClass('background-fullwidth');
            if (supportMode) {
                $container.append($background.eq(0).clone());
                $('.background-image:last', $this).addClass('reference-image');
            }
            $container.css({
                'height': 'auto',
                'max-height': maxHeight + 'px'
            })
        } else if (settings.responsive == 'resize') {
            $background.addClass('background-fullwidth');
            if (supportMode) {
                $container.append($background.eq(0).clone());
                $('.background-image:last', $this).addClass('reference-image');
                $container.css({
                    'height': 'auto'
                })
            }
        }





        /*==== Slider Preload Function ====*/
        $slides.hide(0);

        if (settings.preload == true) {
            if (supportMode) {

                var currentimg = 0;
                var lastimg = $('img', $this).length;
                $('img', $this).each(function() {
                    var src = $(this).attr('src');
                    var preloadedImage = $(new Image()).attr('src', src);

                    preloadedImage.load(function() {
                        ++currentimg;
                        if (currentimg == lastimg) {
                            preloader.fadeOut(settings.speed, function() {
                                (first >= 0) ? gotoslide(first) : gotoslide(0);
                            });
                        }
                    })
                })
            } else {
                preloader.fadeOut(settings.speed, function() {
                    (first >= 0) ? gotoslide(first) : gotoslide(0);
                });
            }
        } else {
            $active.show(0);
            preloader.hide(0);
            (first >= 0) ? gotoslide(first) : gotoslide(0);
        }


        /*==== Slide Enter Function ====*/

        var fade = 1;
        var rotate = 0;
        var scale = 1;
        var vertical = 0;
        var horizontal = 0;

        (function($) {
            $.fn.enter = function() {
                var $slide = $(this);

                var animation = $slide.attr('data-animation');

                var sliderWidth = $container.width();
                var sliderHeight = $container.height();

                var custom;
                var customAnimation = $.extend({
                    fade: false,
                    rotatecw: false,
                    rotateccw: false,
                    scaleup: false,
                    scaledown: false,
                    left: false,
                    right: false,
                    top: false,
                    bottom: false
                }, custom);

                /*==== Switch between custom and default animation ====*/
                if (animation) {

                    setAnimation(customAnimation, animation);

                    if (customAnimation.fade == true)
                        fade = fxfade;
                    if (customAnimation.rotatecw == true)
                        rotate = -fxdeg + 'deg';
                    else if (customAnimation.rotateccw == true)
                        rotate = fxdeg + 'deg';
                    if (customAnimation.scaleup == true)
                        scale = fxsmallscale;
                    else if (customAnimation.scaledown == true)
                        scale = fxlargescale;
                    if (customAnimation.left == true)
                        horizontal = -sliderWidth;
                    else if (customAnimation.right == true)
                        horizontal = sliderWidth;
                    if (customAnimation.top == true)
                        vertical = -sliderHeight;
                    else if (customAnimation.bottom == true)
                        vertical = sliderHeight;
                } else {
                    if (defaultfx.fade == true)
                        fade = fxfade;
                    if (defaultfx.rotatecw == true)
                        rotate = -fxdeg + 'deg';
                    else if (defaultfx.rotateccw == true)
                        rotate = fxdeg + 'deg';
                    if (defaultfx.scaleup == true)
                        scale = fxsmallscale;
                    else if (defaultfx.scaledown == true)
                        scale = fxlargescale;
                    if (defaultfx.left == true)
                        horizontal = -sliderWidth;
                    else if (defaultfx.right == true)
                        horizontal = sliderWidth;
                    if (defaultfx.top == true)
                        vertical = -sliderHeight;
                    else if (defaultfx.bottom == true)
                        vertical = sliderHeight;
                }

                callbackin();

                if (supportMode) {
                    $slide.velocity({
                        'margin-left': horizontal + 'px',
                        'margin-top': vertical + 'px',
                        'scale' : scale,
                        'rotate': rotate,
                        'opacity': fade
                    }, 0).show(0).velocity({
                        'margin-left': '0px',
                        'margin-top': '0px',
                        'opacity': 1,
                        'rotate': 0,
                        'scale': 1
                    }, settings.speed, function() {
                        $slide.attr('style', '');
                    });
                } else {
                    $slide.delay(settings.speed).fadeOut(0).fadeIn(settings.speed, function() {
                        $slide.attr('style', '').show(0);
                    });
                }

            }
        }(jQuery));

        /*==== Slide Exit Function ====*/
        (function($) {
            $.fn.exit = function() {
                var $slide = $(this);

                var animation = $slide.attr('data-animation');

                var sliderWidth = $container.width();
                var sliderHeight = $container.height();

                var custom;
                var customAnimation = $.extend({
                    fade: false,
                    rotatecw: false,
                    rotateccw: false,
                    scaleup: false,
                    scaledown: false,
                    left: false,
                    right: false,
                    top: false,
                    bottom: false
                }, custom);

                if (animation) {

                    setAnimation(customAnimation, animation);

                    if (customAnimation.fade == true)
                        fade = fxfade;
                    if (customAnimation.rotatecw == true)
                        rotate = -fxdeg + 'deg';
                    else if (customAnimation.rotateccw == true)
                        rotate = fxdeg + 'deg';
                    if (customAnimation.scaleup == true)
                        scale = fxsmallscale;
                    else if (customAnimation.scaledown == true)
                        scale = fxlargescale;
                    if (customAnimation.left == true)
                        horizontal = -sliderWidth;
                    else if (customAnimation.right == true)
                        horizontal = sliderWidth;
                    if (customAnimation.top == true)
                        vertical = -sliderHeight;
                    else if (customAnimation.bottom == true)
                        vertical = sliderHeight;
                } else {
                    if (defaultfx.fade == true)
                        fade = fxfade;
                    if (defaultfx.rotatecw == true)
                        rotate = -fxdeg + 'deg';
                    else if (defaultfx.rotateccw == true)
                        rotate = fxdeg + 'deg';
                    if (defaultfx.scaleup == true)
                        scale = fxsmallscale;
                    else if (defaultfx.scaledown == true)
                        scale = fxlargescale;
                    if (defaultfx.left == true)
                        horizontal = -sliderWidth;
                    else if (defaultfx.right == true)
                        horizontal = sliderWidth;
                    if (defaultfx.top == true)
                        vertical = -sliderHeight;
                    else if (defaultfx.bottom == true)
                        vertical = sliderHeight;
                }

                if (supportMode) {
                    $slide.delay(1000).velocity({
                        'margin-left': horizontal + 'px',
                        'margin-top': vertical + 'px',
                        'opacity': fade,
                        'rotate': rotate,
                        'scale': scale
                    }, settings.speed * 3 / 4, function() {
                        $slide.hide(0);
                    });
                } else {
                    $slide.fadeOut(settings.speed * 3 / 4);
                }

                fade = 1;
                rotate = 0;
                scale = 1;
                vertical = 0;
                horizontal = 0;

            }
        }(jQuery));


        /*==== Content Enter Animation ====*/
        (function($) {
            $.fn.fxenter = function(animation, speed) {

                var fade = 1;
                var rotate = 0;
                var scale = 1;
                var vertical = 0;
                var horizontal = 0;

                if (speed == undefined)
                    speed = settings.speed;

                var $content = $(this);

                var sliderWidth = $container.width();
                var sliderHeight = $container.height();

                var content;
                var contentAnimation = $.extend({
                    fade: false,
                    rotatecw: false,
                    rotateccw: false,
                    scaleup: false,
                    scaledown: false,
                    left: false,
                    right: false,
                    top: false,
                    bottom: false
                }, content);

                /*==== Switch between custom and default animation ====*/

                setAnimation(contentAnimation, animation);

                if (contentAnimation.fade == true)
                    fade = fxfade;
                if (contentAnimation.rotatecw == true)
                    rotate = -fxdeg + 'deg';
                else if (contentAnimation.rotateccw == true)
                    rotate = fxdeg + 'deg';
                if (contentAnimation.scaleup == true)
                    scale = fxsmallscale;
                else if (contentAnimation.scaledown == true)
                    scale = fxlargescale;
                if (contentAnimation.left == true)
                    horizontal = -sliderWidth;
                else if (contentAnimation.right == true)
                    horizontal = sliderWidth;
                if (contentAnimation.top == true)
                    vertical = -sliderHeight;
                else if (contentAnimation.bottom == true)
                    vertical = sliderHeight;

                if (supportMode) {
                    $content.velocity({
                        'margin-left': horizontal + 'px',
                        'margin-top': vertical + 'px',
                        'scale' : scale,
                        'rotate': rotate,
                        'opacity': fade
                    }, 0).stop().delay(settings.speed).velocity({
                        'margin-left': '0px',
                        'margin-top': '0px',
                        'opacity': 1,
                        'rotate': 0,
                        'scale': 1
                    }, speed);
                } else {
                    if (fade == 0)
                        $content.delay(settings.speed).fadeIn()

                    $content.delay(settings.speed).animate({
                        'margin-left': '0px',
                        'margin-top': '0px'
                    }, speed)
                }


            }
        }(jQuery));

        /*==== Content Exit Animation ====*/
        (function($) {
            $.fn.fxexit = function(animation, speed) {

                var fade = 1;
                var rotate = 0;
                var scale = 1;
                var vertical = 0;
                var horizontal = 0;

                if (speed == undefined)
                    speed = settings.speed;

                var $content = $(this);

                var sliderWidth = $container.width();
                var sliderHeight = $container.height();

                var content;
                var contentAnimation = $.extend({
                    fade: false,
                    rotatecw: false,
                    rotateccw: false,
                    scaleup: false,
                    scaledown: false,
                    left: false,
                    right: false,
                    top: false,
                    bottom: false
                }, content);

                /* Switch between custom and default animation */

                setAnimation(contentAnimation, animation);

                if (contentAnimation.fade == true)
                    fade = 0;
                if (contentAnimation.rotatecw == true)
                    rotate = -fxdeg + 'deg';
                else if (contentAnimation.rotateccw == true)
                    rotate = fxdeg + 'deg';
                if (contentAnimation.scaleup == true)
                    scale = fxlargescale;
                else if (contentAnimation.scaledown == true)
                    scale = fxsmallscale;
                if (contentAnimation.left == true)
                    horizontal = -sliderWidth;
                else if (contentAnimation.right == true)
                    horizontal = sliderWidth;
                if (contentAnimation.top == true)
                    vertical = -sliderHeight;
                else if (contentAnimation.bottom == true)
                    vertical = sliderHeight;

                if (supportMode) {
                    $content.velocity({
                        'margin-left': horizontal + 'px',
                        'margin-top': vertical + 'px',
                        'scale' : scale,
                        'rotate': rotate,
                        'opacity': fade
                    }, 0).stop().velocity({
                        'margin-left': horizontal + 'px',
                        'margin-top': vertical + 'px',
                        'opacity': fade,
                        'rotate': rotate,
                        'scale': scale
                    }, speed);
                } else {
                    if (fade == 0)
                        $content.fadeOut()
                    $content.animate({
                        'margin-left': horizontal + 'px',
                        'margin-top': vertical + 'px'
                    }, speed)
                }

            }
        }(jQuery));


        /*==== Go To Slide ====*/
        var $current;
        var $length = $slides.length - 1;

        var animated = 0;

        function gotoslide(index) {
            if (animated)
                return;
            if (index == $current)
                return;
            
            if (index > $length)
                index = 0;
            else if (index < 0)
                index = $length;

            if (settings.autoplay == true) {
                timerinit();
            }

            var tempcurrent = $current;

            if ($current != undefined)
                callbackout();

            animated = 1;

            $slides.eq(tempcurrent).removeClass('active').exit();
            $slides.eq(index).addClass('active').enter();

            setTimeout(function() {
                animated = 0;
            }, settings.speed + 250)

            if (settings.pagination == true) {
                $('.strapslide-pagination li', $this).eq(tempcurrent).removeClass('active');
                $('.strapslide-pagination li', $this).eq(index).addClass('active');
            }

            $current = index;
        }


        /*==== Bind Buttons ====*/
        var $prev = $('.prev', $this);
        var $next = $('.next', $this);

        $prev.click(function() {
            gotoslide($current - 1);
        })
        $next.click(function() {
            gotoslide($current + 1);
        })

        /*==== Bind Swipe ====*/
        if (settings.touchscreen == true) {
            $container.swipe({
                swipe: function(event, direction) {
                    if (direction == 'left') {
                        gotoslide($current + 1)
                    }
                    if (direction == 'right') {
                        gotoslide($current - 1)
                    }
                }
            });
        }

        /*==== Bind Scroll ====*/
        if (settings.mousewheel == true) {
            $container.bind('mousewheel', function(event, delta) {
                if (delta < 0) {
                    gotoslide($current + 1);
                }
                if (delta > 0) {
                    gotoslide($current - 1);
                }
                event.stopPropagation();
                event.preventDefault();
            });
        }

        /*==== Bind Keyboard ====*/
        if (settings.keyboard == true) {
            $(document).keydown(function(e) {
                if (e.keyCode == 37 && !animated) {
                    gotoslide($current - 1)
                }
                if (e.keyCode == 39 && !animated) {
                    gotoslide($current + 1)
                }
            });
        }

        /*==== Generate Pagination ====*/
        if (settings.pagination == true) {
            var i;
            for (i = 1; i <= $length + 1; i++)
                $('ul', pagination).append('<li><a href="#">' + i + '</a></li>');

            $('ul li', pagination).eq($current).addClass('active');

            $('ul li a', pagination).click(function() {
                var gotoindex = $(this).closest('li').index();
                gotoslide(gotoindex);
            });
        } else {
            pagination.hide();
        }

        /*==== Autoplay Function ====*/
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

        function timerinit() {
            count = -settings.speed / 100;
            progress.css({
                width: '0%'
            });


        }

        if (settings.autoplay == true) {
            var count = 0;
            var timer = $.timer(
                    function() {
                        count++;
                        if (count >= settings.timeout / 100) {
                            gotoslide($current + 1)
                        }
                        progress.css({
                            width: (count * 11000) / settings.timeout + '%'
                        });

                    }, 100, true);
            if (settings.pauseOnHover == true) {
                $container.hover(function() {
                    timer.pause();
                }, function() {
                    timer.play();
                });
            }
            timer.go();
        } else {
            progress.closest('.progress').hide(0);
        }

        /*==== Responsive Videos ====*/
        $('.strapslide-video').fitVids();

        function fullvideo() {
            var sliderWidth = $container.width();
            var sliderHeight = $container.height();
            $('.strapslide-videofullscreen').css({
                'width': sliderWidth + 'px',
                'height': sliderHeight + 'px'
            });
        }

        /*==== Window Resize ====*/
        $window.resize(function() {
            fullvideo();
            if ((settings.responsive == 'none') || (settings.responsive == 'ie8')) {
                responsive();
            }
        }).trigger("resize");

        $window.load(function() {
            $window.trigger("resize");
        })

        /*==== Element Positioning ====*/
        var $top = $('.slide-content', $this).find('[data-top]');
        var $bottom = $('.slide-content', $this).find('[data-bottom]');
        var $left = $('.slide-content', $this).find('[data-left]');
        var $right = $('.slide-content', $this).find('[data-right]');

        $top.each(function() {
            var element = $(this);
            var cssdata = $(this).attr('data-top');
            element.css({
                'position': 'absolute',
                'top': cssdata
            });
        })
        $bottom.each(function() {
            var element = $(this);
            var cssdata = $(this).attr('data-bottom');
            element.css({
                'position': 'absolute',
                'bottom': cssdata
            });
        })
        $left.each(function() {
            var element = $(this);
            var cssdata = $(this).attr('data-left');
            element.css({
                'position': 'absolute',
                'left': cssdata
            });
        })
        $right.each(function() {
            var element = $(this);
            var cssdata = $(this).attr('data-right');
            element.css({
                'position': 'absolute',
                'right': cssdata
            });
        })

    };

}(jQuery));