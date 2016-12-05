(function() {
  var Helpers;

  Helpers = (function() {
    function Helpers() {}

    Helpers.prototype.createDiv = function(o) {
      var $cont, $el;
      if (o == null) {
        o = {};
      }
      $el = $('<div />');
      (o["class"] != null) && $el.addClass(o["class"]);
      $cont = (o != null ? o.container : void 0) || $(document.body);
      $cont.append($el);
      return $el;
    };

    Helpers.prototype.cloneBits = function($proto, cnt, $container) {
      var $cont, $new, circles, i, _i;
      if (cnt == null) {
        cnt = 20;
      }
      circles = [];
      for (i = _i = 0; 0 <= cnt ? _i < cnt : _i > cnt; i = 0 <= cnt ? ++_i : --_i) {
        $new = $proto.clone();
        $cont = $container || $(document.body);
        $cont.append($new);
        circles.push($new);
      }
      return circles;
    };

    Helpers.prototype.rand = function(min, max) {
      return Math.floor((Math.random() * ((max + 1) - min)) + min);
    };

    return Helpers;

  })();

  window.helpers = new Helpers;

  $.easing.quake = function(t) {
    var b;
    b = Math.exp(-t * 10) * Math.cos(Math.PI * 2 * t * 10);
    if (t >= 1) {
      return 1;
    }
    return 1 - b;
  };

  $.easing.elasticOut = function(t) {
    var a, p, s;
    s = void 0;
    a = 0.1;
    p = 0.4;
    if (t === 0) {
      return 0;
    }
    if (t === 1) {
      return 1;
    }
    if (!a || a < 1) {
      a = 1;
      s = p / 4;
    } else {
      s = p * Math.asin(1 / a) / (2 * Math.PI);
    }
    return a * Math.pow(2, -10 * t) * Math.sin((t - s) * (2 * Math.PI) / p) + 1;
  };

}).call(this);

(function() {
  var Spark;

  Spark = (function() {
    function Spark(o) {
      this.o = o != null ? o : {};
      this.vars();
      this.init();
    }

    Spark.prototype.vars = function() {};

    Spark.prototype.init = function() {
      var $proto, $spark, i, size, _i, _len, _ref, _results;
      $proto = helpers.createDiv({
        "class": 'spark'
      });
      this.sparks = helpers.cloneBits($proto, this.o.cnt || helpers.rand(10, 20));
      size = this.o.size || 2;
      _ref = this.sparks;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        $spark = _ref[i];
        _results.push($spark.css({
          width: size + helpers.rand(0, size),
          height: size + helpers.rand(0, size),
          left: this.o.left || '50%',
          top: "" + (this.o.top || 50) + "%",
          marginTop: this.o.shiftY,
          marginLeft: this.o.shiftX
        }));
      }
      return _results;
    };

    Spark.prototype.run = function() {
      var $spark, blowSize, i, top, _i, _len, _ref, _results;
      _ref = this.sparks;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        $spark = _ref[i];
        blowSize = this.o.blowSize || 100;
        top = 2 * this.o.top || 100;
        if (top < 100) {
          top = 100;
        }
        _results.push($spark.velocity({
          translateX: helpers.rand(-blowSize, blowSize),
          translateY: helpers.rand(-blowSize, blowSize),
          opacity: 1
        }, {
          duration: 500 + blowSize,
          easing: 'easeInOutQuad',
          delay: (this.o.delay || 0) + helpers.rand(0, 100)
        }).velocity({
          top: "" + top + "%",
          translateY: 0,
          marginTop: 0,
          opacity: -2
        }, {
          duration: this.o.duration || 2500,
          easing: 'easeInOutExp'
        }));
      }
      return _results;
    };

    return Spark;

  })();

  window.Spark = Spark;

}).call(this);

(function() {
  var Bubbles;

  Bubbles = (function() {
    function Bubbles(o) {
      this.o = o != null ? o : {};
      this.vars();
      this.init();
    }

    Bubbles.prototype.vars = function() {
      this.$el = helpers.createDiv({
        "class": "bubbles"
      });
      return this.$proto = $('<div class="bubble" />');
    };

    Bubbles.prototype.init = function() {
      var $bit, i, size, _i, _len, _ref, _results;
      this.bits = helpers.cloneBits(this.$proto, 30, this.$el);
      _ref = this.bits;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        $bit = _ref[i];
        size = helpers.rand(12, 24);
        _results.push($bit.css({
          width: size,
          height: size,
          borderWidth: size / 2
        }));
      }
      return _results;
    };

    Bubbles.prototype.run = function(delay) {
      var $bit, i, _i, _len, _ref;
      _ref = this.bits;
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        $bit = _ref[i];
        $bit.velocity({
          top: '-10%',
          borderWidth: 0,
          translateX: helpers.rand(-120, 120),
          translateY: helpers.rand(0, 300),
          opacity: 100
        }, {
          duration: 1400,
          delay: helpers.rand(i * 25, i * 25 + 1000) + delay
        });
      }
      return this.$el.velocity({
        marginTop: 0
      }, {
        duration: 1000,
        delay: delay
      });
    };

    return Bubbles;

  })();

  window.Bubbles = Bubbles;

}).call(this);

(function() {
  var Drop;

  Drop = (function() {
    function Drop(o) {
      this.o = o != null ? o : {};
      this.vars();
      this.init();
    }

    Drop.prototype.vars = function() {
      return this.$proto = $('<div class="circle c-green-g drop" />');
    };

    Drop.prototype.init = function() {
      this.radius = this.o.radius;
      if (this.radius == null) {
        this.radius = 200;
      }
      this.cnt = this.radius / 10;
      return this.$els = helpers.cloneBits(this.$proto, this.cnt, this.o.$container);
    };

    Drop.prototype.run = function() {
      var $el, angle, centerX, centerY, coef, delay, delayStep, i, left, left2, step, stepCalc, top, top2, _i, _j, _k, _len, _ref, _results;
      step = (2 * Math.PI) / this.cnt;
      angle = 0;
      centerX = 0;
      centerY = 0;
      _ref = this.$els;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        $el = _ref[i];
        left = parseInt(centerX + (Math.cos(angle) * (this.radius / 1.25)), 10);
        top = parseInt(centerY + (Math.sin(angle) * (this.radius / 1.25)), 10);
        $el.css({
          marginLeft: left,
          marginTop: top
        });
        left2 = parseInt(centerY + (Math.cos(angle) * (1.1 * this.radius)), 10);
        top2 = parseInt(centerY + (Math.sin(angle) * (1.1 * this.radius)), 10);
        left2 -= left;
        top2 -= top;
        $el.velocity({
          translateX: left2,
          translateY: top2,
          opacity: 1
        }, {
          delay: this.o.i * 15,
          easing: 'easeOutElastic',
          duration: 1500
        });
        coef = 1;
        if (left >= 0) {
          delayStep = 100 * coef;
          stepCalc = 50;
          for (i = _j = 0; _j <= 1200; i = _j += stepCalc) {
            if ((top >= i) && (top <= i + stepCalc)) {
              delay = (i / stepCalc) * delayStep;
            }
          }
          delayStep = 20 * coef;
          for (i = _k = 0; _k <= 1200; i = _k += stepCalc) {
            if ((top <= -i) && (top >= -i - stepCalc)) {
              delay = (i / stepCalc) * delayStep;
            }
          }
          if (delay == null) {
            delay = 100 * coef;
          }
          $el.velocity({
            translateX: -helpers.rand(20, 400),
            translateY: helpers.rand(-600, 600),
            left: 0
          }, {
            delay: ((10 - this.o.i) * 50 * coef) + delay + helpers.rand(0, delayStep) + 3350,
            duration: 1000 * coef
          });
        }
        _results.push(angle += step);
      }
      return _results;
    };

    return Drop;

  })();

  window.Drop = Drop;

}).call(this);

(function() {
  var Cloud, CloudBit;

  Cloud = (function() {
    function Cloud(o) {
      var timeout;
      this.o = o != null ? o : {};
      this.vars();
      this.init();
      timeout = setTimeout((function(_this) {
        return function() {
          clearTimeout(timeout);
          return _this.hide();
        };
      })(this), this.o.hideDelay);
    }

    Cloud.prototype.vars = function() {
      this.$el = helpers.createDiv({
        "class": 'center c-green-g'
      });
      return window.$cloud = this.$el;
    };

    Cloud.prototype.init = function() {
      var className;
      className = 'inherit-bg circle center';
      this.bits = [];
      this.bits.push(new CloudBit({
        width: 90,
        height: 120,
        deg: 5,
        "class": className,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 80,
        height: 90,
        deg: 45,
        "class": className,
        shiftY: 40,
        shiftX: -5,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 80,
        height: 100,
        deg: -35,
        "class": className,
        shiftY: 20,
        shiftX: -90,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 60,
        height: 60,
        deg: 0,
        "class": className,
        shiftY: 30,
        shiftX: -40,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 70,
        height: 70,
        deg: 10,
        "class": className,
        shiftX: 55,
        shiftY: 40,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 60,
        height: 30,
        deg: 0,
        "class": className,
        shiftX: 75,
        shiftY: 60,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 70,
        height: 30,
        deg: 0,
        "class": className,
        shiftX: -100,
        shiftY: 60,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 80,
        height: 50,
        deg: 0,
        "class": className,
        shiftX: -60,
        shiftY: 55,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 40,
        height: 30,
        deg: 0,
        "class": className,
        shiftX: 25,
        shiftY: 55,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 10,
        height: 10,
        deg: 0,
        "class": className,
        shiftX: 103,
        shiftY: 65,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 5,
        height: 5,
        deg: 0,
        "class": className,
        shiftX: 110,
        shiftY: 66,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      this.bits.push(new CloudBit({
        width: 10,
        height: 10,
        deg: 0,
        "class": className,
        shiftX: -128,
        shiftY: 65,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
      return this.bits.push(new CloudBit({
        width: 8,
        height: 5,
        deg: 0,
        "class": className,
        shiftX: -135,
        shiftY: 65,
        container: this.$el,
        delay: this.o.delay,
        hideDelay: this.o.hideDelay
      }));
    };

    Cloud.prototype.hide = function() {
      var bit, i, _i, _len, _ref, _results;
      _ref = this.bits;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        bit = _ref[i];
        _results.push(bit.hide());
      }
      return _results;
    };

    return Cloud;

  })();

  CloudBit = (function() {
    function CloudBit(o) {
      this.o = o != null ? o : {};
      this.vars();
      this.$el = helpers.createDiv({
        "class": this.o["class"],
        container: this.o.container
      });
      this.setAttrs();
      this.loop();
      this.show();
    }

    CloudBit.prototype.vars = function() {
      this.scale = 0;
      return this.opacity = 0;
    };

    CloudBit.prototype.setAttrs = function() {
      var _base, _base1;
      return this.$el.css({
        width: this.o.width,
        height: this.o.height,
        marginLeft: (-this.o.width / 2) + ((_base = this.o).shiftX != null ? _base.shiftX : _base.shiftX = 0),
        marginTop: (-this.o.height / 2) + ((_base1 = this.o).shiftY != null ? _base1.shiftY : _base1.shiftY = 0),
        'opacity': 0
      }).velocity({
        scale: 0
      }, {
        duration: 0
      });
    };

    CloudBit.prototype.show = function() {
      return this.$el.velocity({
        opacity: 100,
        scale: 1
      }, {
        easing: 'easeOutElastic',
        delay: this.o.delay + helpers.rand(0, 100),
        duration: 1200
      });
    };

    CloudBit.prototype.loop = function() {
      return this.$el.velocity({
        scaleX: .9,
        scaleY: 1,
        translateX: this.o.width / 20,
        translateY: 0,
        rotateZ: this.o.deg
      }, {
        duration: 500
      }).velocity({
        scaleY: .9,
        scaleX: 1,
        translateX: 0,
        translateY: this.o.height / 20,
        rotateZ: this.o.deg,
        complete: (function(_this) {
          return function() {
            return !_this.disallowAnimation && _this.loop();
          };
        })(this)
      }, {
        duration: 500
      });
    };

    CloudBit.prototype.destroy = function() {
      return this.disallowAnimation = true;
    };

    CloudBit.prototype.hide = function() {
      this.destroy();
      return this.$el.velocity({
        scale: 0,
        translateX: -500
      }, {
        duration: 750
      });
    };

    return CloudBit;

  })();

  window.Cloud = Cloud;

}).call(this);

(function() {
  var Thunder;

  Thunder = (function() {
    function Thunder(o) {
      this.o = o != null ? o : {};
      this.vars();
      this.init();
    }

    Thunder.prototype.vars = function() {
      this.$background = $('#js-thunder-bg');
      this.$robust = $('#js-robust');
      this.$robustScreen = $('#js-robust-screen');
      this.$robustScreen2 = $('#js-robust-screen2');
      return this.boomCnt = 0;
    };

    Thunder.prototype.init = function() {
      this.spark1 = new Spark({
        shiftY: -140,
        shiftX: -120,
        top: 100,
        blowSize: 50
      });
      this.spark2 = new Spark({
        shiftY: -80,
        shiftX: -210,
        top: 100,
        blowSize: 50
      });
      this.spark3 = new Spark({
        shiftY: -100,
        shiftX: 50,
        top: 100,
        blowSize: 75
      });
      this.spark4 = new Spark({
        shiftY: -120,
        shiftX: -190,
        top: 100
      });
      this.$bit = helpers.createDiv({
        "class": 'c-grey-g center circle'
      });
      this.$bit.css({
        width: 2,
        height: 0,
        marginLeft: -1,
        'transform-origin': 'top center'
      });
      return this.thunder = helpers.cloneBits(this.$bit, 20);
    };

    Thunder.prototype.run = function() {
      return setTimeout((function(_this) {
        return function() {
          _this.makeBoom(_this.thunder, _this.$bit);
          return setTimeout(function() {
            return _this.makeBoom(_this.thunder, _this.$bit);
          }, 320);
        };
      })(this), this.o.delay);
    };

    Thunder.prototype.makeBoom = function(thunder, $bit) {
      var $bit1, $prevBit, i, jump, sign, size, _fn, _i, _len;
      this.boomCnt++;
      this.prevAngle = 100;
      $prevBit = $bit;
      $bit.css({
        'z-index': 9
      });
      $cloud.addClass('c-grey-g').removeClass('c-green-g');
      this.$robust.css('color', '#383838');
      this.$background.velocity({
        'opacity': 1
      }, {
        duration: 40
      }).velocity({
        'opacity': 0
      }, {
        delay: 200,
        duration: 40,
        complete: (function(_this) {
          return function() {
            $cloud.removeClass('c-grey-g').addClass('c-green-g');
            return _this.$robust.css('color', '#00FFC6');
          };
        })(this)
      });
      _fn = function(i) {
        return $bit1.velocity({
          height: size.height,
          rotateZ: size.angle,
          opacity: 1,
          width: 4,
          marginLeft: -2
        }, {
          duration: 200
        }).velocity({
          width: 0,
          marginLeft: 0
        }, {
          duration: 50
        });
      };
      for (i = _i = 0, _len = thunder.length; _i < _len; i = ++_i) {
        $bit1 = thunder[i];
        $bit1.css({
          top: '100%',
          opacity: 0
        });
        $prevBit.append($bit1);
        size = this.calcSize(i);
        _fn(i);
        $prevBit = $bit1;
      }
      this.s = 1;
      if (this.boomCnt === 1) {
        this.$robust.css({
          'transform-origin': 'center bottom'
        });
        sign = helpers.rand(-1, 1);
        (sign === 0) && (sign = 1);
        this.$robust.velocity({
          rotateZ: helpers.rand(15, 25) * sign
        }, {
          duration: 100 * this.s,
          delay: 160 * this.s
        }).velocity({
          rotateZ: 0
        }, {
          duration: 500 * this.s,
          easing: 'easeOutBounce'
        });
        jump = 100;
        this.$robustScreen.velocity({
          marginTop: -jump
        }, {
          duration: 50 * this.s,
          delay: 160 * this.s
        });
        this.$robustScreen2.velocity({
          marginTop: jump
        }, {
          duration: 900 * this.s,
          delay: 150 * this.s,
          easing: 'easeOutBounce'
        });
      }
      if (this.boomCnt === 1) {
        this.spark1.run();
        setTimeout((function(_this) {
          return function() {
            return _this.spark3.run();
          };
        })(this), 100);
      }
      if (this.boomCnt === 2) {
        this.spark2.run();
        return setTimeout((function(_this) {
          return function() {
            return _this.spark4.run();
          };
        })(this), 50);
      }
    };

    Thunder.prototype.calcSize = function(i) {
      var angle, height;
      angle = 0;
      if (i === 0) {
        angle = helpers.rand(15, 25);
        height = 50;
      } else {
        if (i % 2 === 0) {
          angle = -this.prevAngle + helpers.rand(0, 10);
          this.prevAngle = angle;
          height = helpers.rand(40, 150);
        } else {
          angle = -this.prevAngle + helpers.rand(0, 20);
          height = helpers.rand(10, 40);
          this.prevAngle = angle;
        }
      }
      return {
        angle: angle,
        height: height
      };
    };

    return Thunder;

  })();

  window.Thunder = Thunder;

}).call(this);

(function() {


}).call(this);

(function() {
  var Main;

  Main = (function() {
    function Main(o) {
      this.o = o != null ? o : {};
      this.vars();
      this.init();
    }

    Main.prototype.vars = function() {
      var $lineProto, i;
      this.$fast = $('#js-fast');
      this.$car1 = $('#js-car1');
      this.$car2 = $('#js-car2');
      this.$arrow1 = $('#js-arrow1');
      this.$arrow2 = $('#js-arrow2');
      this.$arrow3 = $('#js-arrow3');
      this.$arrow4 = $('#js-arrow4');
      this.$arrowWrap = $('#js-arrow-wrap');
      this.$robust = $('#js-robust');
      this.$robustShade1 = this.$robust.find('#js-robust-shade1');
      this.$robustShade2 = this.$robust.find('#js-robust-shade2');
      this.$easy = $('#js-easy');
      this.$easyWrapper = $('#js-easy-wrapper');
      this.$easyText = $('#js-easy-text');
      this.$easyScreen = $('#js-easy-screen');
      this.$screen1 = $('#js-screen1');
      this.$screen2 = $('#js-screen2');
      this.$logosScreen = $('#js-logos-screen');
      this.$restart = $('#js-restart');
      this.$github = $('#js-github');
      this.$lego = $('#js-lego');
      this.$easyLine1 = $('#js-easy-line1');
      this.$easyLine2 = $('#js-easy-line2');
      this.$restart.on('click', function() {
        return location.href = location.href;
      });
      this.$velocity = $('#js-velocity');
      this.$line = $('#js-line');
      $lineProto = this.$line.clone();
      $lineProto.css({
        top: '100%',
        transform: "none"
      });
      this.lines = helpers.cloneBits($lineProto, 20, this.$screen1);
      this.thunder = new Thunder;
      this.drops = (function() {
        var _i, _results;
        _results = [];
        for (i = _i = 0; _i < 10; i = ++_i) {
          _results.push(new Drop({
            radius: i * 50,
            i: i,
            $container: this.$screen2
          }));
        }
        return _results;
      }).call(this);
      return this.bubbles = new Bubbles;
    };

    Main.prototype.init = function() {
      this.s = 1;
      this.car1(0);
      this.car2(700);
      this.arrows();
      this.throwFA(2200);
      this.shiftRobustArrow(3400);
      this.fallRobust(3800);
      this.showCloud(3200 * this.s);
      this.showThunder(5200 * this.s);
      this.waterDrop(7400 * this.s);
      this.showBubbles(8800 * this.s);
      this.shiftScreen(10900 * this.s);
      this.blow(12100 * this.s);
      return this.showLogos(14000 * this.s);
    };

    Main.prototype.showLogos = function(delay) {
      return this.$logosScreen.velocity({
        opacity: 1
      }, {
        delay: delay,
        complete: (function(_this) {
          return function() {
            var amount;
            _this.$logosScreen.show();
            amount = 15;
            _this.$github.velocity({
              translateY: -amount
            }, {
              duration: 1
            }).velocity({
              translateY: 0,
              opacity: 1
            }, {
              easing: 'easeInOutQuad',
              duration: 1500 * _this.s,
              delay: 0 * _this.s
            });
            _this.$lego.velocity({
              translateY: amount
            }, {
              duration: 1
            }).velocity({
              translateY: 0,
              opacity: 1
            }, {
              easing: 'easeInOutQuad',
              duration: 1500 * _this.s,
              delay: 0 * _this.s
            });
            return _this.$restart.velocity({
              translateY: -amount
            }, {
              duration: 1
            }).velocity({
              opacity: 1,
              translateY: 0
            }, {
              easing: 'easeInOutQuad',
              duration: 1500 * _this.s,
              delay: 0 * _this.s
            });
          };
        })(this)
      });
    };

    Main.prototype.blow = function(delay) {
      var $child, childs, coef, i, _i, _ref;
      coef = 1;
      childs = this.$velocity.children();
      for (i = _i = _ref = childs.length - 1; _ref <= 0 ? _i <= 0 : _i >= 0; i = _ref <= 0 ? ++_i : --_i) {
        $child = $(childs[i]);
        $child.velocity({
          translateX: -2000,
          translateY: -200 - helpers.rand(0, 400),
          rotateZ: helpers.rand(-500, 500)
        }, {
          delay: delay + ((childs.length - i) * 75),
          duration: 2000 * this.s * coef
        });
      }
      return setTimeout((function(_this) {
        return function() {
          var $line, _j, _len, _ref1, _results;
          _ref1 = _this.lines;
          _results = [];
          for (i = _j = 0, _len = _ref1.length; _j < _len; i = ++_j) {
            $line = _ref1[i];
            _results.push((function(i) {
              return $line.velocity({
                rotateZ: -90
              }, {
                duration: 600 * _this.s * coef,
                delay: 450 + ((_this.lines.length - i) * 100 * coef),
                easing: 'easeOutBounce',
                complete: function() {
                  return $(this).css({
                    'display': 'none'
                  });
                }
              });
            })(i));
          }
          return _results;
        };
      })(this), delay);
    };

    Main.prototype.shiftScreen = function(delay) {
      var dur;
      dur = 1400 * this.s;
      this.$screen1.velocity({
        translateX: -2000
      }, {
        delay: delay,
        duration: dur
      });
      this.$screen2.velocity({
        left: '-50%'
      }, {
        delay: delay,
        duration: dur
      });
      return this.$velocity.velocity({
        translateX: -1500
      }, {
        delay: delay,
        duration: dur
      });
    };

    Main.prototype.showBubbles = function(delay) {
      this.bubbles.run(delay);
      return setTimeout((function(_this) {
        return function() {
          var $line, h, i, y, _i, _len, _ref, _results;
          _this.$easyText.css({
            height: 240,
            width: 240
          }).velocity({
            translateX: -120,
            translateY: -120
          }, {
            duration: 1400 * _this.s,
            delay: 115 * _this.s
          });
          _this.$easy.velocity({
            width: 0,
            height: 0
          }, {
            duration: 1400 * _this.s
          });
          _this.$line.velocity({
            height: 200,
            translateY: -200
          }, {
            delay: 1000 * _this.s,
            duration: 700 * _this.s
          }).velocity({
            top: '100%'
          }, {
            easing: 'easeInExpo',
            duration: 500 * _this.s
          }).velocity({
            rotateZ: 20
          }, {
            duration: 1
          }).velocity({
            rotateZ: 0
          }, {
            easing: 'quake',
            duration: 1500 * _this.s
          });
          _ref = _this.lines;
          _results = [];
          for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
            $line = _ref[i];
            y = (i + 1) % 5 === 0 ? -200 : -100;
            h = (i + 1) % 5 === 0 ? 200 : 100;
            $line.css({
              height: h,
              marginLeft: "" + (-1 + ((i + 1) * 100)) + "px",
              transform: "rotate(20deg)"
            });
            _results.push($line.velocity({
              translateY: y
            }, {
              delay: 2250 + (i * 50),
              duration: 100 * _this.s
            }));
          }
          return _results;
        };
      })(this), delay);
    };

    Main.prototype.waterDrop = function(delay) {
      return setTimeout((function(_this) {
        return function() {
          _this.$easy.velocity({
            width: 240,
            height: 240
          }, {
            easing: 'easeOutElastic',
            duration: 1500 * _this.s
          });
          _this.$easyWrapper.velocity({
            rotateZ: -30
          }, {
            duration: 1
          }).velocity({
            rotateZ: 0
          }, {
            easing: 'quake',
            duration: 6000 * _this.s
          });
          return setTimeout(function() {
            var drop, _i, _len, _ref;
            _ref = _this.drops;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              drop = _ref[_i];
              drop.run();
            }
            return _this.$robust.velocity({
              top: '100%',
              marginTop: 0
            });
          }, 100);
        };
      })(this), delay);
    };

    Main.prototype.showThunder = function(delay) {
      return setTimeout((function(_this) {
        return function() {
          return _this.thunder.run();
        };
      })(this), delay);
    };

    Main.prototype.showCloud = function(delay) {
      return this.cloud = new Cloud({
        delay: delay,
        hideDelay: 6000 * this.s
      });
    };

    Main.prototype.car1 = function(delay) {
      var $child, child, i, _i, _len, _ref, _results;
      this.$car1.velocity({
        right: '-40%',
        opacity: 2
      }, {
        duration: 400 * this.s,
        delay: delay * this.s
      });
      this.fastChilds = this.$fast.children();
      _ref = this.fastChilds;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        child = _ref[i];
        $child = $(child);
        $child = $child.find('#js-bit-inner');
        _results.push($child.velocity({
          rotateZ: 40
        }, {
          delay: (delay + 160 + (i * 15)) * this.s,
          duration: 100 * this.s
        }).velocity({
          rotateZ: 0
        }, {
          delay: (60 + (i * 15)) * this.s,
          duration: 5000 * this.s,
          easing: 'quake'
        }));
      }
      return _results;
    };

    Main.prototype.car2 = function(delay) {
      var $child, child, i, _i, _len, _ref, _results;
      this.$car2.velocity({
        left: '-40%',
        opacity: 1
      }, {
        delay: delay * this.s,
        duration: 400 * this.s
      });
      _ref = this.fastChilds;
      _results = [];
      for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
        child = _ref[i];
        $child = $(child);
        $child = $child.find('#js-span');
        $child.css({
          'transform-origin': 'center top'
        });
        _results.push($child.velocity({
          rotateZ: 40
        }, {
          delay: (delay + 160 + (this.fastChilds.length - i) * 15) * this.s,
          duration: 100 * this.s
        }).velocity({
          rotateZ: 0
        }, {
          delay: (60 + (this.fastChilds.length - i) * 15) * this.s,
          duration: 5000 * this.s,
          easing: 'quake'
        }));
      }
      return _results;
    };

    Main.prototype.fallRobust = function(delay) {
      var $arrow, arrows, i, _i, _len;
      this.$robust.velocity({
        top: '100%',
        rotateZ: -50,
        marginTop: -55
      }, {
        delay: delay * this.s,
        easing: 'easeInQuad',
        duration: 300 * this.s
      }).velocity({
        rotateZ: 0
      }, {
        duration: 500 * this.s,
        easing: 'easeOutBounce'
      });
      arrows = [this.$arrow1, this.$arrow2, this.$arrow3];
      for (i = _i = 0, _len = arrows.length; _i < _len; i = ++_i) {
        $arrow = arrows[i];
        $arrow.velocity({
          'top': '100%',
          marginTop: 0,
          rotateZ: 60 + helpers.rand(0, 20)
        }, {
          easing: 'easeInQuad'
        }).velocity({
          rotateZ: 90
        }, {
          easing: 'easeOutBounce',
          duration: 400 * this.s,
          complete: function() {
            return $(this).hide();
          }
        });
      }
      return this.$arrow4.velocity({
        'top': '100%',
        marginTop: 0,
        rotateZ: 60 + helpers.rand(0, 20)
      }, {
        easing: 'easeInQuad'
      }).velocity({
        rotateZ: 90
      }, {
        easing: 'easeOutBounce',
        duration: 400 * this.s,
        complete: function() {
          return $(this).hide();
        }
      });
    };
    
    Main.prototype.shiftRobustArrow = function(delay) {
      this.$arrowWrap.velocity({
        translateX: -208
      }, {
        delay: delay * this.s
      });
      return this.$robustShade1.velocity({
        marginLeft: -208
      }, {
        delay: delay * this.s,
        complete: (function(_this) {
          return function() {
            _this.$robustShade2.hide();
            return _this.$fast.hide();
          };
        })(this)
      });
    };

    Main.prototype.throwFA = function(delay) {
      var $child, angle, attrs2, i, _i, _results;
      _results = [];
      for (i = _i = 0; _i <= 1; i = ++_i) {
        $child = $(this.fastChilds[i]);
        $child.css({
          'transform-origin': 'center center',
          'position': 'absolute'
        });
        if (i === 1) {
          angle = 280;
          _results.push($child.velocity({
            rotateZ: angle / 5,
            left: '45%',
            top: '55%'
          }, {
            duration: 50 * this.s,
            easing: 'linear',
            delay: delay * this.s
          }).velocity({
            rotateZ: angle,
            left: '-10%',
            top: '110%'
          }, {
            duration: 1000 * this.s,
            easing: 'linear'
          }));
        } else {
          angle = 600;
          attrs2 = {
            rotateZ: angle + helpers.rand(0, 40),
            left: '-10%',
            top: '20%'
          };
          _results.push($child.velocity({
            rotateZ: angle / 10,
            left: '50%',
            top: '50%'
          }, {
            duration: 50 * this.s,
            easing: 'linear',
            delay: delay * this.s
          }).velocity(attrs2, {
            duration: 1000 * this.s,
            easing: 'linear'
          }));
        }
      }
      return _results;
    };

    Main.prototype.arrows = function() {
      var angle, arrowAngle, delay, duration;
      arrowAngle = 20;
      delay = 1400;
      duration = 2000;
      angle = arrowAngle + helpers.rand(0, arrowAngle);
      this.$arrow1.velocity({
        rotateZ: 90,
        left: '150%'
      }, {
        duration: 1,
        delay: delay * this.s
      }).velocity({
        left: '70%',
        top: '50%',
        rotateZ: angle
      }, {
        duration: 400 * this.s
      }).velocity({
        rotateZ: 1.5 * angle
      }, {
        duration: 1
      }).velocity({
        rotateZ: angle
      }, {
        duration: duration * this.s,
        easing: 'quake'
      });
      angle = arrowAngle + helpers.rand(0, arrowAngle);
      this.$arrow2.velocity({
        rotateZ: 90,
        left: '150%'
      }, {
        duration: 1,
        delay: (delay + 200) * this.s
      }).velocity({
        left: '10%',
        top: '50%',
        rotateZ: angle
      }, {
        duration: 400 * this.s
      }).velocity({
        rotateZ: 1.5 * angle
      }, {
        duration: 1
      }).velocity({
        rotateZ: angle
      }, {
        duration: duration * this.s,
        easing: 'quake'
      });
      angle = arrowAngle + helpers.rand(0, arrowAngle);
      this.$arrow3.velocity({
        rotateZ: 90,
        left: '150%'
      }, {
        duration: 1,
        delay: (delay + 250) * this.s
      }).velocity({
        left: '20%',
        top: '50%',
        rotateZ: angle
      }, {
        duration: 400 * this.s
      }).velocity({
        rotateZ: 1.5 * angle
      }, {
        duration: 1
      }).velocity({
        rotateZ: angle
      }, {
        duration: duration * this.s,
        easing: 'quake'
      });
      angle = 20;
      return this.$arrow4.velocity({
        rotateZ: 90,
        left: '150%'
      }, {
        duration: 1,
        delay: (delay + 400) * this.s
      }).velocity({
        left: '50%',
        top: '50%',
        rotateZ: angle
      }, {
        duration: 400 * this.s
      }).velocity({
        rotateZ: 1.5 * angle
      }, {
        duration: 1
      }).velocity({
        rotateZ: angle
      }, {
        duration: duration * this.s,
        easing: 'quake'
      });
    };

    return Main;

  })();

  setTimeout(function() {
    return new Main;
  }, 1000);

}).call(this);




/*! VELOCITY.JS */

/*!
* Velocity.js: Accelerated JavaScript animation.
* @version 0.0.0
* @requires jQuery.js
* @docs julian.com/research/velocity
* @license Copyright 2014 Julian Shapiro. MIT License: http://en.wikipedia.org/wiki/MIT_License
*/
!function(e,t,a,r){function o(e){for(var t=-1,a=e?e.length:0,r=[];++t<a;){var o=e[t];o&&r.push(o)}return r}function i(e){return"[object Function]"===Object.prototype.toString.call(e)}function l(t){if(t)for(var a=(new Date).getTime(),o=0,i=e.velocity.State.calls.length;i>o;o++)if(e.velocity.State.calls[o]){var s=e.velocity.State.calls[o],g=s[0],d=s[2],f=s[3];f||(f=e.velocity.State.calls[o][3]=a-16);for(var y=Math.min((a-f)/d.duration,1),m=0,h=g.length;h>m;m++){var v=g[m],x=v.element;if(e.data(x,u)){var P=!1;d.display&&"none"!==d.display&&(p.setPropertyValue(x,"display",d.display),e.velocity.State.calls[o][2].display=!1);for(var b in v)if("element"!==b){var V=v[b],S=V.currentValue,k;if(1===y)k=V.endValue;else if(k=V.startValue+(V.endValue-V.startValue)*e.easing[V.easing](y),!/translate/i.test(b)&&y>.2&&.8>y&&("px"===V.unitType||""===V.unitType)&&Math.abs((k-S)/S)<.005)break;if(V.currentValue=k,p.Hooks.registered[b]){var w=p.Hooks.getRoot(b),C=e.data(x,u).rootPropertyValueCache[w];C&&(V.rootPropertyValue=C)}var T=p.setPropertyValue(x,b,V.currentValue+("auto"===k?"":V.unitType),V.rootPropertyValue);p.Hooks.registered[b]&&(e.data(x,u).rootPropertyValueCache[w]=p.Normalizations.registered[w]?p.Normalizations.registered[w]("extract",null,T[1]):T[1]),"transform"===T[0]&&(P=!0)}d.mobileHA&&(e.data(x,u).transformCache.translate3d===r?(e.data(x,u).transformCache.translate3d="(0, 0, 0)",P=!0):1===y&&(delete e.data(x,u).transformCache.translate3d,P=!0)),P&&p.flushTransformCache(x)}}1===y&&n(o)}e.velocity.State.isTicking&&c(l)}function n(t){for(var a=e.velocity.State.calls[t][0],o=e.velocity.State.calls[t][1],i=e.velocity.State.calls[t][2],l=!1,n=0,s=a.length;s>n;n++){var c=a[n].element;"none"===i.display&&i.loop===!1&&p.setPropertyValue(c,"display",i.display),e.queue(c)[1]!==r&&/\$\.velocity\.queueEntryFlag/i.test(e.queue(c)[1])||e.data(c,u)&&(e.data(c,u).isAnimating=!1,e.data(c,u).rootPropertyValueCache={}),e.dequeue(c)}e.velocity.State.calls[t]=!1;for(var g=0,d=e.velocity.State.calls.length;d>g;g++)if(e.velocity.State.calls[g]!==!1){l=!0;break}l===!1&&(e.velocity.State.isTicking=!1,delete e.velocity.State.calls,e.velocity.State.calls=[]),i.complete&&i.complete.call(o)}var s=function(){if(a.documentMode)return a.documentMode;for(var e=7;e>4;e--){var t=a.createElement("div");if(t.innerHTML="<!--[if IE "+e+"]><span></span><![endif]-->",t.getElementsByTagName("span").length)return t=null,e}return r}(),c=t.requestAnimationFrame||function(){var e=0;return t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||function(t){var a=(new Date).getTime(),r;return r=Math.max(0,16-(a-e)),e=a+r,setTimeout(function(){t(a+r)},r)}}();if(7>=s)return void(e.fn.velocity=e.fn.animate);if(e.velocity!==r||e.fn.velocity!==r)return void console.log("Velocity is already loaded or its namespace is occupied.");!function(){var t={};e.each(["Quad","Cubic","Quart","Quint","Expo"],function(e,a){t[a]=function(t){return Math.pow(t,e+2)}}),e.extend(t,{Sine:function(e){return 1-Math.cos(e*Math.PI/2)},Circ:function(e){return 1-Math.sqrt(1-e*e)},Elastic:function(e){return 0===e||1===e?e:-Math.pow(2,8*(e-1))*Math.sin((80*(e-1)-7.5)*Math.PI/15)},Back:function(e){return e*e*(3*e-2)},Bounce:function(e){for(var t,a=4;e<((t=Math.pow(2,--a))-1)/11;);return 1/Math.pow(4,3-a)-7.5625*Math.pow((3*t-2)/22-e,2)}}),e.each(t,function(t,a){e.easing["easeIn"+t]=a,e.easing["easeOut"+t]=function(e){return 1-a(1-e)},e.easing["easeInOut"+t]=function(e){return.5>e?a(2*e)/2:1-a(-2*e+2)/2}}),e.easing.spring=function(e){return 1-Math.cos(4.5*e*Math.PI)*Math.exp(6*-e)}}();var u="velocity";e.velocity={State:{isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),prefixElement:a.createElement("div"),prefixMatches:{},scrollAnchor:null,scrollProperty:null,isTicking:!1,calls:[]},Classes:{extracted:{},extract:function(){}},CSS:{},animate:function(){},debug:!1},t.pageYOffset!==r?(e.velocity.State.scrollAnchor=t,e.velocity.State.scrollProperty="pageYOffset"):(e.velocity.State.scrollAnchor=a.documentElement||a.body.parentNode||a.body,e.velocity.State.scrollProperty="scrollTop"),e.velocity.Classes.extract=function(){for(var t=a.styleSheets,r={},o=0,i=t.length;i>o;o++){var l=t[o],n;try{if(!l.cssText&&!l.cssRules)continue;n=l.cssText?l.cssText.replace(/[\r\n]/g,"").match(/[^}]+\{[^{]+\}/g):l.cssRules;for(var s=0,c=n.length;c>s;s++){var u;if(l.cssText)u=n[s];else{if(!n[s].cssText)continue;u=n[s].cssText}var p=u.match(/\.animate_([A-z0-9_-]+)(?:(\s+)?{)/);if(p){var g=p[1],d=u.toLowerCase().match(/\{([\S\s]*)\}/)[1].match(/[A-z-][^;]+/g);r[g]||(r[g]={});for(var f=0,y=d.length;y>f;f++){var m=d[f].match(/([^:]+):\s*(.+)/);r[g][m[1]]=m[2]}}}}catch(h){}}return e.velocity.Classes.extracted=r,e.velocity.debug&&console.log("Classes: "+JSON.stringify(e.velocity.Classes.extracted)),r},e.velocity.Classes.extract();var p=e.velocity.CSS={RegEx:{valueUnwrap:/^[A-z]+\((.*)\)$/i,wrappedValueAlreadyExtracted:/[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,valueSplit:/([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi},Hooks:{templates:{color:["Red Green Blue Alpha","255 255 255 1"],backgroundColor:["Red Green Blue Alpha","255 255 255 1"],borderColor:["Red Green Blue Alpha","255 255 255 1"],outlineColor:["Red Green Blue Alpha","255 255 255 1"],textShadow:["Color X Y Blur","black 0px 0px 0px"],boxShadow:["Color X Y Blur Spread","black 0px 0px 0px 0px"],clip:["Top Right Bottom Left","0px 0px 0px 0px"],backgroundPosition:["X Y","0% 0%"],transformOrigin:["X Y Z","50% 50% 0%"],perspectiveOrigin:["X Y","50% 50%"]},registered:{},register:function(){var e,t,a;if(s)for(e in p.Hooks.templates){t=p.Hooks.templates[e],a=t[0].split(" ");var r=t[1].match(p.RegEx.valueSplit);"Color"===a[0]&&(a.push(a.shift()),r.push(r.shift()),p.Hooks.templates[e]=[a.join(" "),r.join(" ")])}for(e in p.Hooks.templates){t=p.Hooks.templates[e],a=t[0].split(" ");for(var o in a){var i=e+a[o],l=o;p.Hooks.registered[i]=[e,l]}}},getRoot:function(e){var t=p.Hooks.registered[e];return t?t[0]:e},cleanRootPropertyValue:function(e,t){return p.RegEx.valueUnwrap.test(t)&&(t=t.match(p.Hooks.RegEx.valueUnwrap)[1]),p.Values.isCSSNullValue(t)&&(t=p.Hooks.templates[e][1]),t},extractValue:function(e,t){var a=p.Hooks.registered[e];if(a){var r=a[0],o=a[1];return t=p.Hooks.cleanRootPropertyValue(r,t),t.toString().match(p.RegEx.valueSplit)[o]}return t},injectValue:function(e,t,a){var r=p.Hooks.registered[e];if(r){var o=r[0],i=r[1],l,n;return a=p.Hooks.cleanRootPropertyValue(o,a),l=a.toString().match(p.RegEx.valueSplit),l[i]=t,n=l.join(" ")}return a}},Normalizations:{registered:{clip:function(e,t,a){switch(e){case"name":return"clip";case"extract":var r;return p.RegEx.wrappedValueAlreadyExtracted.test(a)?r=a:(r=a.toString().match(p.RegEx.valueUnwrap),r&&(r=r[1].replace(/,(\s+)?/g," "))),r;case"inject":return"rect("+a+")"}},opacity:function(e,t,a){if(8>=s)switch(e){case"name":return"filter";case"extract":var r=a.toString().match(/alpha\(opacity=(.*)\)/i);return a=r?r[1]/100:1;case"inject":return t.style.zoom=1,"alpha(opacity="+parseInt(100*a)+")"}else switch(e){case"name":return"opacity";case"extract":return a;case"inject":return a}}},register:function(){function t(e){var t=/^#?([a-f\d])([a-f\d])([a-f\d])$/i,a=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i,r;return e=e.replace(t,function(e,t,a,r){return t+t+a+a+r+r}),r=a.exec(e),r?"rgb("+(parseInt(r[1],16)+" "+parseInt(r[2],16)+" "+parseInt(r[3],16))+")":"rgb(0 0 0)"}var a=["translateX","translateY","scale","scaleX","scaleY","skewX","skewY","rotateZ"];9>=s||(a=a.concat(["translateZ","scaleZ","rotateX","rotateY"]));for(var o=0,i=a.length;i>o;o++)!function(){var t=a[o];p.Normalizations.registered[t]=function(a,o,i){switch(a){case"name":return"transform";case"extract":return e.data(o,u).transformCache[t]===r?/^scale/i.test(t)?1:0:e.data(o,u).transformCache[t].replace(/[()]/g,"");case"inject":var l=!1;switch(t.substr(0,t.length-1)){case"translate":l=!/(%|px|em|rem|\d)$/i.test(i);break;case"scale":l=!/(\d)$/i.test(i);break;case"skew":l=!/(deg|\d)$/i.test(i);break;case"rotate":l=!/(deg|\d)$/i.test(i)}return l||(e.data(o,u).transformCache[t]="("+i+")"),e.data(o,u).transformCache[t]}}}();for(var l=["color","backgroundColor","borderColor","outlineColor"],o=0,n=l.length;n>o;o++)!function(){var e=l[o];p.Normalizations.registered[e]=function(a,o,i){switch(a){case"name":return e;case"extract":var l;if(p.RegEx.wrappedValueAlreadyExtracted.test(i))l=i;else{var n,c={aqua:"rgb(0, 255, 255);",black:"rgb(0, 0, 0)",blue:"rgb(0, 0, 255)",fuchsia:"rgb(255, 0, 255)",gray:"rgb(128, 128, 128)",green:"rgb(0, 128, 0)",lime:"rgb(0, 255, 0)",maroon:"rgb(128, 0, 0)",navy:"rgb(0, 0, 128)",olive:"rgb(128, 128, 0)",purple:"rgb(128, 0, 128)",red:"rgb(255, 0, 0)",silver:"rgb(192, 192, 192)",teal:"rgb(0, 128, 128)",white:"rgb(255, 255, 255)",yellow:"rgb(255, 255, 0)"};/^[A-z]+$/i.test(i)?n=c[i]!==r?c[i]:c.black:/^#([A-f\d]{3}){1,2}$/i.test(i)?n=t(i):/^rgba?\(/i.test(i)||(n=c.black),l=(n||i).toString().match(p.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g," ")}return 8>=s||3!==l.split(" ").length||(l+=" 1"),l;case"inject":return 8>=s?4===i.split(" ").length&&(i=i.split(/\s+/).slice(0,3).join(" ")):3===i.split(" ").length&&(i+=" 1"),(8>=s?"rgb":"rgba")+"("+i.replace(/\s+/g,",").replace(/\.(\d)+(?=,)/g,"")+")"}}}()}},Names:{camelCase:function(e){return e.replace(/-(\w)/g,function(e,t){return t.toUpperCase()})},prefixCheck:function(t){if(e.velocity.State.prefixMatches[t])return[e.velocity.State.prefixMatches[t],!0];for(var a=["","Webkit","Moz","ms","O"],r=0,o=a.length;o>r;r++){var i;if(i=0===r?t:a[r]+t.replace(/^\w/,function(e){return e.toUpperCase()}),"string"==typeof e.velocity.State.prefixElement.style[i])return e.velocity.State.prefixMatches[t]=i,[i,!0]}return[t,!1]}},Values:{isCSSNullValue:function(e){return 0==e||/^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(e)},getUnitType:function(e){return/^(rotate|skew)/i.test(e)?"deg":/(^(scale|scaleX|scaleY|scaleZ|opacity|alpha|fillOpacity|flexGrow|flexHeight|zIndex|fontWeight)$)|color/i.test(e)?"":"px"}},getPropertyValue:function(a,o,i,l){function n(a,o){if(!l){if("height"===o&&"border-box"!==p.getPropertyValue(a,"boxSizing").toLowerCase())return a.offsetHeight-(parseFloat(p.getPropertyValue(a,"borderTopWidth"))||0)-(parseFloat(p.getPropertyValue(a,"borderBottomWidth"))||0)-(parseFloat(p.getPropertyValue(a,"paddingTop"))||0)-(parseFloat(p.getPropertyValue(a,"paddingBottom"))||0);if("width"===o&&"border-box"!==p.getPropertyValue(a,"boxSizing").toLowerCase())return a.offsetWidth-(parseFloat(p.getPropertyValue(a,"borderLeftWidth"))||0)-(parseFloat(p.getPropertyValue(a,"borderRightWidth"))||0)-(parseFloat(p.getPropertyValue(a,"paddingLeft"))||0)-(parseFloat(p.getPropertyValue(a,"paddingRight"))||0)}var i=0;if(8>=s)i=e.css(a,o);else{var c;c=e.data(a,u)===r?t.getComputedStyle(a,null):e.data(a,u).computedStyle?e.data(a,u).computedStyle:e.data(a,u).computedStyle=t.getComputedStyle(a,null),s&&"borderColor"===o&&(o="borderTopColor"),i=9===s&&"filter"===o?c.getPropertyValue(o):c[o],""===i&&(i=a.style[o])}if("auto"===i&&/^(top|right|bottom|left)$/i.test(o)){var g=n(a,"position");("fixed"===g||"absolute"===g&&/top|left/i.test(o))&&(i=e(a).position()[o]+"px")}return i}var c;if(p.Hooks.registered[o]){var g=o,d=p.Hooks.getRoot(g);i===r&&(i=p.getPropertyValue(a,p.Names.prefixCheck(d)[0])),p.Normalizations.registered[d]&&(i=p.Normalizations.registered[d]("extract",a,i)),c=p.Hooks.extractValue(g,i)}else if(p.Normalizations.registered[o]){var f,y;f=p.Normalizations.registered[o]("name",a),"transform"!==f&&(y=n(a,p.Names.prefixCheck(f)[0]),p.Values.isCSSNullValue(y)&&p.Hooks.templates[o]&&(y=p.Hooks.templates[o][1])),c=p.Normalizations.registered[o]("extract",a,y)}return/^[\d-]/.test(c)||(c=n(a,p.Names.prefixCheck(o)[0])),p.Values.isCSSNullValue(c)&&(c=0),e.velocity.debug>=2&&console.log("Get "+o+": "+c),c},setPropertyValue:function(a,r,o,i){var l=r;if("scroll"===r)t.scrollTo(null,o);else if(p.Normalizations.registered[r]&&"transform"===p.Normalizations.registered[r]("name",a))p.Normalizations.registered[r]("inject",a,o),l="transform",o=e.data(a,u).transformCache[r];else{if(p.Hooks.registered[r]){var n=r,c=p.Hooks.getRoot(r);i=i||p.getPropertyValue(a,c),o=p.Hooks.injectValue(n,o,i),r=c}if(p.Normalizations.registered[r]&&(o=p.Normalizations.registered[r]("inject",a,o),r=p.Normalizations.registered[r]("name",a)),l=p.Names.prefixCheck(r)[0],8>=s)try{a.style[l]=o}catch(g){console.log("Error setting ["+l+"] to ["+o+"]")}else a.style[l]=o;e.velocity.debug>=2&&console.log("Set "+r+" ("+l+"): "+o)}return[l,o]},flushTransformCache:function(t){var a="",r,o;for(r in e.data(t,u).transformCache)o=e.data(t,u).transformCache[r],9===s&&"rotateZ"===r&&(r="rotate"),a+=r+o+" ";p.setPropertyValue(t,"transform",a)}};p.Hooks.register(),p.Normalizations.register(),e.fn.velocity=e.velocity.animate=function(){function t(){var t=this,n=e.extend({},e.fn.velocity.defaults,e.data(t,"uiVelocityOptions"),g),d={};if("stop"===y)return e.queue(t,"string"==typeof g?g:"",[]),!0;switch(e.data(t,u)===r&&e.data(t,u,{isAnimating:!1,computedStyle:null,tweensContainer:null,rootPropertyValueCache:{},transformCache:{}}),n.duration.toString().toLowerCase()){case"fast":n.duration=200;break;case"normal":n.duration=400;break;case"slow":n.duration=600;break;default:n.duration=parseFloat(n.duration)||parseFloat(e.fn.velocity.defaults.duration)||400}e.easing[n.easing]||(n.easing=e.easing[e.fn.velocity.defaults.easing]?e.fn.velocity.defaults.easing:"swing"),/^\d/.test(n.delay)&&e.queue(t,n.queue,function(t){e.velocity.queueEntryFlag=!0,setTimeout(t,parseFloat(n.delay))}),n.display&&(n.display=n.display.toLowerCase()),n.mobileHA=n.mobileHA&&e.velocity.State.isMobile,e.queue(t,n.queue,function(f){function m(a){var o=r,l=r,s=r;return"[object Array]"===Object.prototype.toString.call(a)?(o=a[0],/^[\d-]/.test(a[1])||i(a[1])?s=a[1]:"string"==typeof a[1]&&(e.easing[a[1]]!==r&&(l=a[1]),a[2]&&(s=a[2]))):o=a,l=l||n.easing,i(o)&&(o=o.call(t,x,v)),i(s)&&(s=s.call(t,x,v)),[o||0,l,s]}function h(e,t){var a,r;return r=(t||0).toString().toLowerCase().replace(/[%A-z]+$/,function(e){return a=e,""}),a||(a=p.Values.getUnitType(e)),[r,a]}function V(){var r={parent:t.parentNode,position:p.getPropertyValue(t,"position"),fontSize:p.getPropertyValue(t,"fontSize")},o=r.position===P.lastPosition&&r.parent===P.lastParent,i=r.fontSize===P.lastFontSize;P.lastParent=r.parent,P.lastPosition=r.position,P.lastFontSize=r.fontSize,null===P.remToPxRatio&&(P.remToPxRatio=parseFloat(p.getPropertyValue(a.body,"fontSize"))||16);var l={overflowX:null,overflowY:null,boxSizing:null,width:null,minWidth:null,maxWidth:null,height:null,minHeight:null,maxHeight:null,paddingLeft:null},n={},s=10;n.remToPxRatio=P.remToPxRatio,l.overflowX=p.getPropertyValue(t,"overflowX"),l.overflowY=p.getPropertyValue(t,"overflowY"),l.boxSizing=p.getPropertyValue(t,"boxSizing"),l.width=p.getPropertyValue(t,"width",null,!0),l.minWidth=p.getPropertyValue(t,"minWidth"),l.maxWidth=p.getPropertyValue(t,"maxWidth")||"none",l.height=p.getPropertyValue(t,"height",null,!0),l.minHeight=p.getPropertyValue(t,"minHeight"),l.maxHeight=p.getPropertyValue(t,"maxHeight")||"none",l.paddingLeft=p.getPropertyValue(t,"paddingLeft"),o?(n.percentToPxRatioWidth=P.lastPercentToPxWidth,n.percentToPxRatioHeight=P.lastPercentToPxHeight):(p.setPropertyValue(t,"overflowX","hidden"),p.setPropertyValue(t,"overflowY","hidden"),p.setPropertyValue(t,"boxSizing","content-box"),p.setPropertyValue(t,"width",s+"%"),p.setPropertyValue(t,"minWidth",s+"%"),p.setPropertyValue(t,"maxWidth",s+"%"),p.setPropertyValue(t,"height",s+"%"),p.setPropertyValue(t,"minHeight",s+"%"),p.setPropertyValue(t,"maxHeight",s+"%")),i?n.emToPxRatio=P.lastEmToPx:p.setPropertyValue(t,"paddingLeft",s+"em"),o||(n.percentToPxRatioWidth=P.lastPercentToPxWidth=(parseFloat(p.getPropertyValue(t,"width",null,!0))||0)/s,n.percentToPxRatioHeight=P.lastPercentToPxHeight=(parseFloat(p.getPropertyValue(t,"height",null,!0))||0)/s),i||(n.emToPxRatio=P.lastEmToPx=(parseFloat(p.getPropertyValue(t,"paddingLeft"))||0)/s);for(var c in l)p.setPropertyValue(t,c,l[c]);return e.velocity.debug>=1&&console.log("Unit ratios: "+JSON.stringify(n),t),n}if(e.velocity.queueEntryFlag=!0,"scroll"===y){var S=e.velocity.State.scrollAnchor[e.velocity.State.scrollProperty],k=parseFloat(n.offset)||0;d={scroll:{rootPropertyValue:!1,startValue:S,currentValue:S,endValue:e(t).offset().top+k,unitType:"",easing:n.easing},element:t}}else if("reverse"===y){if(!e.data(t,u).tweensContainer)return void e.dequeue(t,n.queue);"none"===e.data(t,u).opts.display&&(e.data(t,u).opts.display="block"),e.data(t,u).opts.loop=!1,n=e.extend({},e.data(t,u).opts,g);var w=e.extend(!0,{},e.data(t,u).tweensContainer);for(var C in w)if("element"!==C){var T=w[C].startValue;w[C].startValue=w[C].currentValue=w[C].endValue,w[C].endValue=T,g&&(w[C].easing=n.easing)}d=w}else if("start"===y){var w;e.data(t,u).tweensContainer&&e.data(t,u).isAnimating===!0&&(w=e.data(t,u).tweensContainer);for(var H in c){H=p.Names.camelCase(H);var R=m(c[H]),z=R[0],N=R[1],A=R[2],E=p.Hooks.getRoot(H),F=!1;if(p.Names.prefixCheck(E)[1]!==!1||p.Normalizations.registered[E]!==r){n.display&&"none"!==n.display&&/opacity|filter/.test(H)&&!A&&0!==z&&(A=0),n._cacheValues&&w&&w[H]?(A=w[H].endValue+w[H].unitType,F=e.data(t,u).rootPropertyValueCache[E]):p.Hooks.registered[H]?A===r?(F=p.getPropertyValue(t,E),A=p.getPropertyValue(t,H,F)):F=p.Hooks.templates[E][1]:A===r&&(A=p.getPropertyValue(t,H));var M,q,j,W;M=h(H,A),A=M[0],j=M[1],M=h(H,z),z=M[0].replace(/^([+-\/*])=/,function(e,t){return W=t,""}),q=M[1],A=parseFloat(A)||0,z=parseFloat(z)||0;var $;if("%"===q&&(/^(fontSize|lineHeight)$/.test(H)?(z/=100,q="em"):/^scale/.test(H)?(z/=100,q=""):/(Red|Green|Blue)$/i.test(H)&&(z=z/100*255,q="")),/[\/*]/.test(W))q=j;else if(j!==q&&0!==A)if(0===z)q=j;else{$=$||V();var O=/margin|padding|left|right|width|text|word|letter/i.test(H)||/X$/.test(H)?"x":"y";switch(j){case"%":A*="x"===O?$.percentToPxRatioWidth:$.percentToPxRatioHeight;break;case"em":A*=$.emToPxRatio;break;case"rem":A*=$.remToPxRatio;break;case"px":}switch(q){case"%":A*=1/("x"===O?$.percentToPxRatioWidth:$.percentToPxRatioHeight);break;case"em":A*=1/$.emToPxRatio;break;case"rem":A*=1/$.remToPxRatio;break;case"px":}}switch(W){case"+":z=A+z;break;case"-":z=A-z;break;case"*":z=A*z;break;case"/":z=A/z}d[H]={rootPropertyValue:F,startValue:A,currentValue:A,endValue:z,unitType:q,easing:N},e.velocity.debug&&console.log("tweensContainer ("+H+"): "+JSON.stringify(d[H]),t)}else e.velocity.debug&&console.log("Skipping ["+E+"] due to a lack of browser support.")}d.element=t}d.element&&(b.push(d),e.data(t,u).tweensContainer=d,e.data(t,u).opts=n,e.data(t,u).isAnimating=!0,x===v-1?(e.velocity.State.calls.length>1e4&&(e.velocity.State.calls=o(e.velocity.State.calls)),e.velocity.State.calls.push([b,s,n]),e.velocity.State.isTicking===!1&&(e.velocity.State.isTicking=!0,l())):x++),""!==n.queue&&"fx"!==n.queue&&setTimeout(f,n.duration+n.delay)}),(n.queue===!1||(""===n.queue||"fx"===n.queue)&&"inprogress"!==e.queue(t)[0])&&e.dequeue(t)}var n,s,c,g,d,f;this.jquery?(n=!0,s=this,c=arguments[0],g=arguments[1]):(n=!1,s=arguments[0],c=arguments[1],g=arguments[2]);var y;switch(c){case"scroll":y="scroll";break;case"reverse":y="reverse";break;case"stop":y="stop";break;default:if(e.isPlainObject(c)&&!e.isEmptyObject(c))y="start";else{if("string"!=typeof c||!e.velocity.Classes.extracted[c])return e.velocity.debug&&console.log("First argument was not a property map, a CSS class reference, or a known action. Aborting."),s;c=e.velocity.Classes.extracted[c],y="start"}}if("stop"!==y&&"object"!=typeof g){var m=n?1:2;g={};for(var h=m;h<arguments.length;h++)/^\d/.test(arguments[h])?g.duration=parseFloat(arguments[h]):"string"==typeof arguments[h]?g.easing=arguments[h].replace(/^\s+|\s+$/g,""):i(arguments[h])&&(g.complete=arguments[h])}var v=s.length||1,x=0,P={lastParent:null,lastPosition:null,lastFontSize:null,lastPercentToPxWidth:null,lastPercentToPxHeight:null,lastEmToPx:null,remToPxRatio:null},b=[];if(g&&!i(g.complete)&&(g.complete=null),n)s.each(t);else if(s.nodeType)t.call(s);else if(s[0]&&s[0].nodeType)for(var V in s)t.call(s[V]);var S=e.extend({},e.fn.velocity.defaults,g);if(S.loop=parseInt(S.loop),S.loop)for(var k=0;k<2*S.loop-1;k++)n?s.velocity("reverse",{delay:S.delay}):e.velocity.animate(s,"reverse",{delay:S.delay});return s}}(jQuery,window,document),$.fn.velocity.defaults={queue:"",duration:400,easing:"swing",complete:null,display:null,loop:!1,delay:!1,mobileHA:!0,_cacheValues:!0};