jQuery.fn.buildCounter = function(settings) {
    
    var glob = {
        element  : this,
        settings : settings
    };
    
    if (typeof glob.settings.unique === "undefined") {
        glob.settings.unique = "countdown-instance-id-" + Math.floor((Math.random()*100000)+1);
    }
    
    
    glob.settings.now       = typeof glob.settings.now_timestamp !== "undefined" && glob.settings.now_timestamp !== "" ? glob.settings.now_timestamp : Math.floor(new Date()) / 1000;
    glob.settings.startdate = typeof glob.settings.stardate_timestamp !== "undefined" && glob.settings.stardate_timestamp !== "" ? glob.settings.stardate_timestamp : Math.floor(new Date(glob.settings.startdate)) / 1000;
    glob.settings.enddate   = typeof glob.settings.enddate_timestamp !== "undefined" && glob.settings.enddate_timestamp !== "" ? glob.settings.enddate_timestamp : Math.floor(new Date(glob.settings.enddate))   / 1000;
    
    /* Defaults */
    typeof glob.settings.color1           !== "undefined" ? null : glob.settings.color1            = "#ff6565"; /* Days Circle Color */
    typeof glob.settings.color2           !== "undefined" ? null : glob.settings.color2            = "#378cff"; /* Hours Circle Color */
    typeof glob.settings.color3           !== "undefined" ? null : glob.settings.color3            = "#9cdb7d"; /* Minutes Circle Color */
    typeof glob.settings.color4           !== "undefined" ? null : glob.settings.color4            = "#ffdc50"; /* Seconds Circle Color */
    typeof glob.settings.backgroundcolor1 !== "undefined" ? null : glob.settings.backgroundcolor1  = "#ccc";    /* Days Circle Background Color */
    typeof glob.settings.backgroundcolor2 !== "undefined" ? null : glob.settings.backgroundcolor2  = "#ccc";    /* Hours Circle Background Color */
    typeof glob.settings.backgroundcolor3 !== "undefined" ? null : glob.settings.backgroundcolor3  = "#ccc";    /* Minutes Circle Background Color */
    typeof glob.settings.backgroundcolor4 !== "undefined" ? null : glob.settings.backgroundcolor4  = "#ccc";    /* Seconds Circle Background Color */
    typeof glob.settings.glow1            !== "undefined" ? null : glob.settings.glow1             = "#ff6565"; /* Days Circle Color Glow */
    typeof glob.settings.glow2            !== "undefined" ? null : glob.settings.glow2             = "#378cff"; /* Hours Circle Color Glow */
    typeof glob.settings.glow3            !== "undefined" ? null : glob.settings.glow3             = "#9cdb7d"; /* Minutes Circle Color Glow */
    typeof glob.settings.glow4            !== "undefined" ? null : glob.settings.glow4             = "#ffdc50"; /* Seconds Circle Color Glow */
    typeof glob.settings.glowwidth1       !== "undefined" ? null : glob.settings.glowwidth1        = "5";       /* Days Circle Glow Width */
    typeof glob.settings.glowwidth2       !== "undefined" ? null : glob.settings.glowwidth2        = "5";       /* Hours Circle Glow Width */
    typeof glob.settings.glowwidth3       !== "undefined" ? null : glob.settings.glowwidth3        = "5";       /* Minutes Circle Glow Width */
    typeof glob.settings.glowwidth4       !== "undefined" ? null : glob.settings.glowwidth4        = "5";       /* Seconds Circle Glow Width */
    typeof glob.settings.backgroundwidth1 !== "undefined" ? null : glob.settings.backgroundwidth1  = "25";      /* Days Circle Background Width */
    typeof glob.settings.backgroundwidth2 !== "undefined" ? null : glob.settings.backgroundwidth2  = "25";      /* Hours Circle Background Width */
    typeof glob.settings.backgroundwidth3 !== "undefined" ? null : glob.settings.backgroundwidth3  = "25";      /* Minutes Circle Background Width */
    typeof glob.settings.backgroundwidth4 !== "undefined" ? null : glob.settings.backgroundwidth4  = "25";      /* Seconds Circle Background Width */
    typeof glob.settings.frontwidth1      !== "undefined" ? null : glob.settings.frontwidth1       = "30";      /* Days Circle Width */
    typeof glob.settings.frontwidth2      !== "undefined" ? null : glob.settings.frontwidth2       = "30";      /* Hours Circle Width */
    typeof glob.settings.frontwidth3      !== "undefined" ? null : glob.settings.frontwidth3       = "30";      /* Minutes Circle Width */
    typeof glob.settings.frontwidth4      !== "undefined" ? null : glob.settings.frontwidth4       = "30";      /* Seconds Circle Width */
    typeof glob.settings.size1            !== "undefined" ? null : glob.settings.size1             = "150";     /* Days Clock Size */
    typeof glob.settings.size2            !== "undefined" ? null : glob.settings.size2             = "150";     /* Hours Clock Size */
    typeof glob.settings.size3            !== "undefined" ? null : glob.settings.size3             = "150";     /* Minutes Clock Size */ 
    typeof glob.settings.size4            !== "undefined" ? null : glob.settings.size4             = "150";     /* Seconds Clock Size */
    typeof glob.settings.textsize1        !== "undefined" ? null : glob.settings.textsize1         = "14";      /* Days Font Size */
    typeof glob.settings.textsize2        !== "undefined" ? null : glob.settings.textsize2         = "14";      /* Hours Font Size */
    typeof glob.settings.textsize3        !== "undefined" ? null : glob.settings.textsize3         = "14";      /* Minutes Font Size */
    typeof glob.settings.textsize4        !== "undefined" ? null : glob.settings.textsize4         = "14";      /* Seconds Font Size */
    typeof glob.settings.countsize1       !== "undefined" ? null : glob.settings.countsize1        = "30";      /* Days Count Font Size */
    typeof glob.settings.countsize2       !== "undefined" ? null : glob.settings.countsize2        = "30";      /* Hours Count Font Size */
    typeof glob.settings.countsize3       !== "undefined" ? null : glob.settings.countsize3        = "30";      /* Minutes Count Font Size */
    typeof glob.settings.countsize4       !== "undefined" ? null : glob.settings.countsize4        = "30";      /* Seconds Count Font Size */
    typeof glob.settings.textcolor1       !== "undefined" ? null : glob.settings.textcolor1        = "#ff6565"; /* Days Font Color */
    typeof glob.settings.textcolor2       !== "undefined" ? null : glob.settings.textcolor2        = "#378cff"; /* Hours Font Color */
    typeof glob.settings.textcolor3       !== "undefined" ? null : glob.settings.textcolor3        = "#9cdb7d"; /* Minutes Font Color */ 
    typeof glob.settings.textcolor4       !== "undefined" ? null : glob.settings.textcolor4        = "#ffdc50"; /* Seconds Font Color */
    typeof glob.settings.countcolor1      !== "undefined" ? null : glob.settings.countcolor1       = "#ff6565"; /* Days Count Font Color */
    typeof glob.settings.countcolor2      !== "undefined" ? null : glob.settings.countcolor2       = "#378cff"; /* Hours Count Font Color */
    typeof glob.settings.countcolor3      !== "undefined" ? null : glob.settings.countcolor3       = "#9cdb7d"; /* Minutes Count Font Color */
    typeof glob.settings.countcolor4      !== "undefined" ? null : glob.settings.countcolor4       = "#ffdc50"; /* Seconds Count Font Color */
    typeof glob.settings.layout           !== "undefined" ? null : glob.settings.layout            = "dhms";    /* Clock layouts - dhms; hms; ms; s */
    typeof glob.settings.callback         !== "undefined" ? null : glob.settings.callback          = function(){};    /* Clock layouts - dhms; hms; ms; s */

    var HTML = '<div class="countitround" id="'+glob.settings.unique+'">';
        
        if (glob.settings.layout.indexOf("d") !== -1) {
            HTML += '<div class="countitround_days"> '                   +
                        '<canvas class="canvas_background"></canvas>'    +
                        '<canvas class="canvas_days"></canvas>'          +
                        '<div class="countitround_days_count">0</div>'   +
                        '<div class="countitround_days_text">Days</div>' +
                    '</div>';
        };

        if (glob.settings.layout.indexOf("h") !== -1) {
            HTML += '<div class="countitround_hours">'+
                        '<canvas class="canvas_background"></canvas>'+
                        '<canvas class="canvas_hours"></canvas>'+
                        '<div class="countitround_hours_count">0</div>'+
                        '<div class="countitround_hours_text">Hours</div>'+
                    '</div>';
        };

        if (glob.settings.layout.indexOf("m") !== -1) {
            HTML += '<div class="countitround_minutes">'+
                        '<canvas class="canvas_background"></canvas>'+
                        '<canvas class="canvas_minutes"></canvas>'+
                        '<div class="countitround_minutes_count">0</div>'+
                        '<div class="countitround_minutes_text">Minutes</div>'+
                    '</div>';
        };

        if (glob.settings.layout.indexOf("s") !== -1) {
            HTML += '<div class="countitround_seconds">'+
                        '<canvas class="canvas_background"></canvas>'+
                        '<canvas class="canvas_seconds"></canvas>'+
                        '<div class="countitround_seconds_count">0</div>'+
                        '<div class="countitround_seconds_text">Seconds</div>'+
                    '</div>';
        };
        
    HTML += '</div>';
    
    jQuery(HTML).appendTo(glob.element);
    
    jQuery("#"+glob.settings.unique).find(".countitround_days").css({
        width: glob.settings.size1,
        height: glob.settings.size1
    });
    
    jQuery("#"+glob.settings.unique).find(".countitround_hours").css({
        width: glob.settings.size2,
        height: glob.settings.size2
    });
    
    jQuery("#"+glob.settings.unique).find(".countitround_minutes").css({
        width: glob.settings.size3,
        height: glob.settings.size3
    });
        
    jQuery("#"+glob.settings.unique).find(".countitround_seconds").css({
        width: glob.settings.size4,
        height: glob.settings.size4
    });
                
    jQuery("#"+glob.settings.unique).find(".countitround_days_count").css({
        width: glob.settings.size1,
        height: glob.settings.size1,
        lineHeight: Number(glob.settings.size1) - Number(glob.settings.textsize1) + "px",
        fontSize: glob.settings.countsize1 + "px",
        color: glob.settings.countcolor1 
    });
        
    jQuery("#"+glob.settings.unique).find(".countitround_hours_count").css({
        width: glob.settings.size2,
        height: glob.settings.size2,
        lineHeight: Number(glob.settings.size2) - Number(glob.settings.textsize2) + "px",
        fontSize: glob.settings.countsize2 + "px",
        color: glob.settings.countcolor2 
    });
   
    jQuery("#"+glob.settings.unique).find(".countitround_minutes_count").css({
        width: glob.settings.size3,
        height: glob.settings.size3,
        lineHeight: Number(glob.settings.size3) - Number(glob.settings.textsize3) + "px",
        fontSize: glob.settings.countsize3 + "px",
        color: glob.settings.countcolor3 
    });
   
    jQuery("#"+glob.settings.unique).find(".countitround_seconds_count").css({
        width: glob.settings.size4,
        height: glob.settings.size4,
        lineHeight: Number(glob.settings.size4) - Number(glob.settings.textsize4) + "px",
        fontSize: glob.settings.countsize4 + "px",
        color: glob.settings.countcolor4 
    });
   
    jQuery("#"+glob.settings.unique).find(".countitround_days_text").css({
        width: glob.settings.size1,
        height: glob.settings.size1,
        lineHeight: Number(glob.settings.size1) + Number(glob.settings.countsize1) + "px",
        fontSize: glob.settings.textsize1 + "px",
        color: glob.settings.textcolor1 
    });
   
    jQuery("#"+glob.settings.unique).find(".countitround_hours_text").css({
        width: glob.settings.size2,
        height: glob.settings.size2,
        lineHeight: Number(glob.settings.size2) + Number(glob.settings.countsize2) + "px",
        fontSize: glob.settings.textsize2 + "px",
        color: glob.settings.textcolor2 
    });
    
    jQuery("#"+glob.settings.unique).find(".countitround_minutes_text").css({
        width: glob.settings.size3,
        height: glob.settings.size3,
        lineHeight: Number(glob.settings.size3) + Number(glob.settings.countsize3) + "px",
        fontSize: glob.settings.textsize3 + "px",
        color: glob.settings.textcolor3 
    });
    
    jQuery("#"+glob.settings.unique).find(".countitround_seconds_text").css({
        width: glob.settings.size4,
        height: glob.settings.size4,
        lineHeight: Number(glob.settings.size4) + Number(glob.settings.countsize4) + "px",
        fontSize: glob.settings.textsize4 + "px",
        color: glob.settings.textcolor4 
    });
    
    if (typeof countitroundinstance === "undefined") {
        var countitroundinstance = [];
    }
    
    new countitround().init(glob.settings);
};

function countitround() {
    var glob = {
        deg: function(deg){
            return (Math.PI/180)*deg - (Math.PI/180)*90;
        },
        size: {
            x : function(i){
                return (glob.settings["size"+i] / 2);
            },
            y : function(i){
                return (glob.settings["size"+i] / 2);
            },
            z : function(i){
                return (glob.settings["size"+i] / 2 - (Number(glob.settings["backgroundwidth"+i]) > Number(glob.settings["frontwidth"+i]) ? glob.settings["backgroundwidth"+i] : glob.settings["frontwidth"+i]) / 2 - glob.settings["glowwidth"+i]);
            }
        },
        complete: function(){
            glob.settings.callback.call();
            return;
        }
    };
    
    this.init = function(settings) {
        glob.settings = settings;
        
        if (glob.settings.now >= glob.settings.enddate) {
            glob.complete();
            return;
        }
        
        glob.total    =      Math.floor((glob.settings.enddate - glob.settings.startdate)/86400);
        glob.days     =      Math.floor((glob.settings.enddate - glob.settings.now)/86400);
        glob.hours    = 24 - Math.floor((glob.settings.enddate - glob.settings.now)%86400/3600);
        glob.minutes  = 60 - Math.floor((glob.settings.enddate - glob.settings.now)%86400%3600/60);
        glob.seconds  = 60 - Math.floor((glob.settings.enddate - glob.settings.now)%86400%3600%60);
            
        if (jQuery("#"+glob.settings.unique).find(".countitround_days").length <= 0) {
            glob.hours = Math.floor((glob.settings.enddate - glob.settings.now)/3600);
        }    
            
        if (jQuery("#"+glob.settings.unique).find(".countitround_hours").length <= 0) {
            glob.minutes = Math.floor((glob.settings.enddate - glob.settings.now)/60);
        }    
            
        if (jQuery("#"+glob.settings.unique).find(".countitround_minutes").length <= 0) {
            glob.seconds = Math.floor(glob.settings.enddate - glob.settings.now);
        }    
            
            
            
            
        clock.set.background();
        clock.set.seconds();
        clock.set.minutes();
        clock.set.hours();
        clock.set.days();
        clock.start();
    };
   
        
    var clock = {
        set: {
            background:function(){
                jQuery("#"+glob.settings.unique).find(".canvas_background").each(function(){
                    var i;
                    
                    if (jQuery(this).parent().attr("class").indexOf("days")    >= 1) i = 1;
                    if (jQuery(this).parent().attr("class").indexOf("hours")   >= 1) i = 2;
                    if (jQuery(this).parent().attr("class").indexOf("minutes") >= 1) i = 3;
                    if (jQuery(this).parent().attr("class").indexOf("seconds") >= 1) i = 4;
                   
                    var bg = jQuery(this).get(0);
                    var ctx = bg.getContext("2d");
                    ctx.canvas.height = glob.settings["size"+i];
                    ctx.canvas.width  = glob.settings["size"+i];
                    ctx.clearRect(0, 0, bg.width, bg.height);
                    ctx.beginPath();
                    ctx.strokeStyle = glob.settings["backgroundcolor"+i];
                    ctx.arc(glob.size.x(i), glob.size.y(i), glob.size.z(i), glob.deg(0), glob.deg(360));
                    ctx.lineWidth = glob.settings["backgroundwidth"+i];
                    ctx.stroke();
                });
            },
            days: function(){
                var cdays = jQuery("#"+glob.settings.unique).find(".canvas_days").get(0);
                if (!cdays) return;
                var ctx = cdays.getContext("2d");
                ctx.canvas.height = glob.settings.size1;
                ctx.canvas.width  = glob.settings.size1;
                ctx.clearRect(0, 0, cdays.width, cdays.height);
                ctx.beginPath();
                ctx.strokeStyle = glob.settings.color1;
                    
                ctx.shadowBlur    = glob.settings.glowwidth1;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                ctx.shadowColor = glob.settings.glow1;
                
                ctx.arc(glob.size.x(1), glob.size.y(1), glob.size.z(1), glob.deg(0), glob.deg((360/glob.total)*(glob.total - glob.days)));
                ctx.lineWidth = glob.settings.frontwidth1;
                ctx.stroke();
                jQuery("#"+glob.settings.unique).find(".countitround_days_count").text(glob.days);
            },
            
            hours: function(){
                var cHr = jQuery("#"+glob.settings.unique).find(".canvas_hours").get(0);
                if (!cHr) return;
                var ctx = cHr.getContext("2d");
                ctx.canvas.height = glob.settings.size2;
                ctx.canvas.width  = glob.settings.size2;
                ctx.clearRect(0, 0, cHr.width, cHr.height);
                ctx.beginPath();
                ctx.strokeStyle = glob.settings.color2;
                
                ctx.shadowBlur    = glob.settings.glowwidth2;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                ctx.shadowColor = glob.settings.glow2;
                
                var deg      = 15 * glob.hours;
                var countext = 24 - glob.hours;
                
                if (jQuery("#"+glob.settings.unique).find(".countitround_days").length <= 0) {
                    deg = (360 / Math.floor((glob.settings.enddate - glob.settings.startdate)/3600))* (Math.floor((glob.settings.enddate - glob.settings.startdate)/3600) - glob.hours);
                    countext = glob.hours;
                }  
                
                ctx.arc(glob.size.x(2), glob.size.y(2), glob.size.z(2), glob.deg(0), glob.deg(deg));
                ctx.lineWidth = glob.settings.frontwidth2;
                ctx.stroke();
                jQuery("#"+glob.settings.unique).find(".countitround_hours_count").text(countext);
            },
            
            minutes : function(){
                var cMin = jQuery("#"+glob.settings.unique).find(".canvas_minutes").get(0);
                if (!cMin) return;
                var ctx = cMin.getContext("2d");
                ctx.canvas.height = glob.settings.size3;
                ctx.canvas.width  = glob.settings.size3;
                ctx.clearRect(0, 0, cMin.width, cMin.height);
                ctx.beginPath();
                ctx.strokeStyle = glob.settings.color3;
                
                ctx.shadowBlur    = glob.settings.glowwidth3;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                ctx.shadowColor = glob.settings.glow3;
                
                var deg      = 6 * glob.minutes;
                var countext = 60 - glob.minutes;
                
                if (jQuery("#"+glob.settings.unique).find(".countitround_hours").length <= 0) {
                    deg = (360 / Math.floor((glob.settings.enddate - glob.settings.startdate)/60))* (Math.floor((glob.settings.enddate - glob.settings.startdate)/60) - glob.minutes);
                    countext = glob.minutes;
                }
                
                ctx.arc(glob.size.x(3), glob.size.y(3), glob.size.z(3), glob.deg(0), glob.deg(deg));
                ctx.lineWidth = glob.settings.frontwidth3;
                ctx.stroke();
                jQuery("#"+glob.settings.unique).find(".countitround_minutes_count").text(countext);
            },
            seconds: function(){
                var cSec = jQuery("#"+glob.settings.unique).find(".canvas_seconds").get(0);
                var ctx = cSec.getContext("2d");
                ctx.canvas.height = glob.settings.size4;
                ctx.canvas.width  = glob.settings.size4;
                ctx.clearRect(0, 0, cSec.width, cSec.height);
                ctx.beginPath();
                ctx.strokeStyle = glob.settings.color4;
                
                ctx.shadowBlur    = glob.settings.glowwidth4;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                ctx.shadowColor = glob.settings.glow4;
                
                var deg      = 6 * glob.seconds;
                var countext = 60 - glob.seconds;
                
                if (jQuery("#"+glob.settings.unique).find(".countitround_minutes").length <= 0) {
                    deg = (360 / Math.floor(glob.settings.enddate - glob.settings.startdate))* (Math.floor(glob.settings.enddate - glob.settings.startdate) - glob.seconds);
                    countext = glob.seconds;
                }
                
                ctx.arc(glob.size.x(4), glob.size.y(4), glob.size.z(4), glob.deg(0), glob.deg(deg));
                ctx.lineWidth = glob.settings.frontwidth4;
                ctx.stroke();
        
                jQuery("#"+glob.settings.unique).find(".countitround_seconds_count").text(countext);
            }
        },
        start: function(){
            var cdown;
            
            /* Count SS */
            if (jQuery("#"+glob.settings.unique).find(".countitround_minutes").length <= 0) {
                cdown = setInterval(function(){
                    if ( glob.seconds <= 0 ) {
                        glob.complete();
                        clearInterval(cdown);
                        return;
                    } else {
                        glob.seconds--;
                    }
                    clock.set.seconds();
                },1000);
                return;
            }
            
            /* Count MM:SS */
            if (jQuery("#"+glob.settings.unique).find(".countitround_hours").length <= 0) {
                cdown = setInterval(function(){
                    if ( glob.seconds > 59 ) {
                        if (glob.minutes === 0) {
                            clearInterval(cdown);
                            glob.complete();
                            return;
                        }
                        glob.seconds = 1;
                        glob.minutes--;
                        clock.set.minutes();
                    } else {
                        glob.seconds++;
                    }
                    clock.set.seconds();
                },1000);
                return;
            }
            
            /* Count HH:MM:SS */
            if (jQuery("#"+glob.settings.unique).find(".countitround_days").length <= 0) {
                cdown = setInterval(function(){
                    if ( glob.seconds > 59 ) {
                        if (60 - glob.minutes <= 0 && glob.hours <= 0) {
                            clearInterval(cdown);
                            glob.complete();
                            return;
                        }
                        glob.seconds = 1;
                        if (glob.minutes > 59) {
                            glob.minutes = 1;
                            clock.set.minutes();
                            glob.hours--;
                            clock.set.hours();
                        } else {
                            glob.minutes++;
                        }
                        clock.set.minutes();
                    } else {
                        glob.seconds++;
                    }
                    clock.set.seconds();
                },1000);
                return;
            }
            
            /* Count DD:HH:MM:SS */
            cdown = setInterval(function(){
                if ( glob.seconds > 59 ) {
                    if (60 - glob.minutes <= 0 && 24 - glob.hours <= 0 && glob.days <= 0) {
                        clearInterval(cdown);
                        glob.complete();
                        return;
                    }
                    glob.seconds = 1;
                    if (glob.minutes > 59) {
                        glob.minutes = 1;
                        clock.set.minutes();
                        if (glob.hours > 23) {
                            glob.hours = 1;
                            if (glob.days > 0) {
                                glob.days--;
                                clock.set.days();
                            }
                        } else {
                            glob.hours++;
                        }
                        clock.set.hours();
                    } else {
                        glob.minutes++;
                    }
                    clock.set.minutes();
                } else {
                    glob.seconds++;
                }
                clock.set.seconds();
            },1000);
        }
    };
}