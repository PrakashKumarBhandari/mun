"use strict";
var munJS = {
    window: jQuery(window),
    document: jQuery(document),
    html: jQuery("html"),
    body: jQuery("body"),
    is_safari: /^((?!chrome|android).)*safari/i.test(navigator.userAgent),
    is_firefox: navigator.userAgent.toLowerCase().indexOf("firefox") > -1,
    is_chrome: /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
    is_ie10: navigator.appVersion.indexOf("MSIE 10") !== -1,
    transitionEnd: "transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",
    animIteration: "animationiteration webkitAnimationIteration oAnimationIteration MSAnimationIteration",
    animationEnd: "animationend webkitAnimationEnd",
    getMousePos: function (e) {
        var posx = 0;
        var posy = 0;
        if (!e) e = window.event;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY) {
            posx = e.clientX + munJS.body.scrollLeft() + munJS.document.scrollLeft();
            posy = e.clientY + munJS.body.scrollTop() + munJS.document.scrollTop();
        }
        return { x: posx, y: posy };
    },
};
munJS.isMobile = {
    Android: function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function () {
        return munJS.isMobile.Android() || munJS.isMobile.BlackBerry() || munJS.isMobile.iOS() || munJS.isMobile.Opera() || munJS.isMobile.Windows();
    },
};
var resizeArr = [];
var resizeTimeout;
munJS.window.on("load resize orientationchange", function (e) {
    if (resizeArr.length) {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            for (var i = 0; i < resizeArr.length; i++) {
                resizeArr[i](e);
            }
        }, 250);
    }
});
munJS.debounceResize = function (callback) {
    if (typeof callback === "function") {
        resizeArr.push(callback);
    } else {
        window.dispatchEvent(new Event("resize"));
    }
};
munJS.addLedingZero = function (number) {
    return ("0" + number).slice(-2);
};
var throttleArr = [];
var didScroll;
var delta = 5;
var lastScrollTop = 0;
munJS.window.on("load resize scroll orientationchange", function () {
    if (throttleArr.length) {
        didScroll = true;
    }
});
function hasScrolled() {
    var scrollTop = munJS.window.scrollTop(),
        windowHeight = munJS.window.height(),
        documentHeight = munJS.document.height(),
        scrollState = "";
    if (Math.abs(lastScrollTop - scrollTop) <= delta) {
        return;
    }
    if (scrollTop > lastScrollTop) {
        scrollState = "down";
    } else if (scrollTop < lastScrollTop) {
        scrollState = "up";
    } else {
        scrollState = "none";
    }
    if (scrollTop === 0) {
        scrollState = "start";
    } else if (scrollTop >= documentHeight - windowHeight) {
        scrollState = "end";
    }
    for (var i in throttleArr) {
        if (typeof throttleArr[i] === "function") {
            throttleArr[i](scrollState, scrollTop, lastScrollTop, munJS.window);
        }
    }
    lastScrollTop = scrollTop;
}
setInterval(function () {
    if (didScroll) {
        didScroll = false;
        window.requestAnimationFrame(hasScrolled);
    }
}, 250);
munJS.throttleScroll = function (callback) {
    if (typeof callback === "function") {
        throttleArr.push(callback);
    }
};
if (typeof cssVars !== "undefined") {
    cssVars({ onlyVars: true });
}


//  slider


$('.slider-partcipate').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    merge:true,
    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1200:{
            items:4
        }
    }
})

// banner

$('.banner_slider').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    merge:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
