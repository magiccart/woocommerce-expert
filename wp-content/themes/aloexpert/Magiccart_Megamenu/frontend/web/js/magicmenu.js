  /**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2014-04-25 13:16:48
 * @@Modify Date: 2018-09-18 18:01:49
 * @@Function:
 */
jQuery(document).ready(function($) {
    
	!(function($){"use strict";$.fn.magicaccordion=function(options){var defaults={accordion:true,mouseType:false,speed:300,closedSign:'collapse',openedSign:'expand',openedActive:true,};var opts=$.extend(defaults,options);var $this=$(this);$this.find("li").each(function(){if($(this).find("ul").size()!=0){$(this).find("a:first").after("<span class='"+opts.closedSign+"'>"+opts.closedSign+"</span>");if($(this).find("a:first").attr('href')=="#"){$(this).find("a:first").click(function(){return false})}}});if(opts.openedActive){$this.find("li.active").each(function(){$(this).parents("ul").slideDown(opts.speed,opts.easing);$(this).parents("ul").parent("li").find("a:first").next().html(opts.openedSign).removeClass(opts.closedSign).addClass(opts.openedSign);$(this).find("ul:first").slideDown(opts.speed,opts.easing);$(this).find("a:first").next().html(opts.openedSign).removeClass(opts.closedSign).addClass(opts.openedSign)})}if(opts.mouseType){$this.find("li a").mouseenter(function(){if($(this).parent().find("ul").size()!=0){if(opts.accordion){if(!$(this).parent().find("ul").is(':visible')){var parents=$(this).parent().parents("ul");var visible=$this.find("ul:visible");visible.each(function(visibleIndex){var close=true;parents.each(function(parentIndex){if(parents[parentIndex]==visible[visibleIndex]){close=false;return false}});if(close){if($(this).parent().find("ul")!=visible[visibleIndex]){$(visible[visibleIndex]).slideUp(opts.speed,function(){$(this).parent("li").find("a:first").next().html(opts.closedSign).addClass(opts.closedSign)})}}})}}if($(this).parent().find("ul:first").is(":visible")){$(this).parent().find("ul:first").slideUp(opts.speed,function(){$(this).parent("li").find("a:first").next().delay(opts.speed+1000).html(opts.closedSign).removeClass(opts.openedSign).addClass(opts.closedSign)})}else{$(this).parent().find("ul:first").slideDown(opts.speed,function(){$(this).parent("li").find("a:first").next().delay(opts.speed+1000).html(opts.openedSign).removeClass(opts.closedSign).addClass(opts.openedSign)})}}})}else{$this.find("li span").click(function(){if($(this).parent().find("ul").size()!=0){if(opts.accordion){if(!$(this).parent().find("ul").is(':visible')){var parents=$(this).parent().parents("ul");var visible=$this.find("ul:visible");visible.each(function(visibleIndex){var close=true;parents.each(function(parentIndex){if(parents[parentIndex]==visible[visibleIndex]){close=false;return false}});if(close){if($(this).parent().find("ul")!=visible[visibleIndex]){$(visible[visibleIndex]).slideUp(opts.speed,function(){$(this).parent("li").find("a:first").next().html(opts.closedSign).addClass(opts.closedSign)})}}})}}if($(this).parent().find("ul:first").is(":visible")){$(this).parent().find("ul:first").slideUp(opts.speed,opts.easing,function(){$(this).parent("li").find("a:first").next().delay(opts.speed+1000).html(opts.closedSign).removeClass(opts.openedSign).addClass(opts.closedSign)})}else{$(this).parent().find("ul:first").slideDown(opts.speed,opts.easing,function(){$(this).parent("li").find("a:first").next().delay(opts.speed+1000).html(opts.openedSign).removeClass(opts.closedSign).addClass(opts.openedSign)})}}})}var catplus=$this.find('.nav-accordion >.level0:hidden').not('.all-cat');if(catplus.length)$this.find('.all-cat').show().click(function(event){$(this).children().toggle();catplus.slideToggle('slow')});else $this.find('.all-cat').hide()}})(jQuery);
     
    (function ($) {
        "use strict";
        $.fn.magicmenu = function (options) {
            var defaults = {
                breakpoint : 991,
                horizontal : '.magicmenu',
                vertical   : '.vmagicmenu',
                sticky     : '.header-sticker',
            };

            var settings   = $.extend(defaults, options);
            var breakpoint = settings.breakpoint;
            var hSelector  = settings.horizontal;
            var vSelector  = settings.vertical;
            var sticky     = settings.sticky;

            var methods = {
                init : function() {
                    return this.each(function() {
                        // Topmenu
                        var topmenu = $(hSelector);
                        methods.toggleHorizontal(topmenu);
                        var navDesktop = topmenu.find('.nav-desktop');
                        if(navDesktop.hasClass('sticker')) methods.sticky(topmenu);
                        var fullWidth = navDesktop.data('fullwidth');
                        var leveltop = topmenu.find('li.level0.hasChild, li.level0.home').not('.dropdown');
                        methods.horizontal(leveltop, fullWidth, true);

                        // Vertical Menu
                        var vmenu   = $(vSelector);
                        methods.toggleVertical(vmenu);
                        var vLeveltop = vmenu.find('li.level0.hasChild, li.level0.home').not('.dropdown');
                        methods.vertical(vLeveltop, fullWidth, true);
                        // Responsive
                        $(window).resize(function(){
                            if ( breakpoint <= $(window).width()){
                                $('.nav-mobile').hide();
                                navDesktop.show();
                                methods.horizontal(leveltop, fullWidth, false);
                                methods.vertical(vLeveltop, fullWidth, false);
                            } else {
                                $('.nav-mobile').show();
                                navDesktop.hide();
                            }
                        })
                    });
                },

                sticky: function(topmenu){
                    var menuHeight  = topmenu.height()/2;
                    var postionTop  = topmenu.offset().top + menuHeight;
                    var fixedMenu   = $(sticky);
                    var parrentMenu = fixedMenu.parent();
                    var body        = $('body');
                    var heightItem  =  0;
                    var heightAIO   = 0
                    var vmagicmenu = topmenu.parent().find('.vmagicmenu');
                    var menuAIO = vmagicmenu.find('.nav-desktop');
                    if(body.hasClass('home') && menuAIO.length){
                        heightItem  = menuAIO.height();
                        vmagicmenu.hover(
                            function() { heightAIO = menuAIO.height() ; menuAIO.addClass('over').css({"overflow": "", "height": 'auto', "display": ''}); }, 
                            function() { menuAIO.removeClass('over').css({"overflow": "hidden", "height": heightAIO}); }
                        );
                    }
                    $('<div class="fixed-height-sticky"></div>').insertBefore(fixedMenu).height(fixedMenu.height()).hide();
                    $(window).scroll(function () {
                        var postion = $(this).scrollTop();
                        if (postion > postionTop ){
                            fixedMenu.addClass('header-container-fixed').parent('.fixed-height-sticky').show();
                            if(heightItem && !menuAIO.hasClass('over')){
                                heightAIO = heightItem - (postion - postionTop) - menuHeight;
                                if(heightAIO > 0 )menuAIO.css({"height": heightAIO, "overflow": "hidden", "display": ''});
                                else{
                                    menuAIO.css({"height": 'auto', "display": 'none', "overflow": "" });
                                }
                            } else {
                                menuAIO.css({"height": 'auto', "display": '', "overflow": "" });
                            }
                        } else {
                            fixedMenu.removeClass('header-container-fixed').parent('.fixed-height-sticky').hide();
                            menuAIO.css({"height": 'auto'});
                        }
                    });
                },

                initMenu: function($navtop, fullWidth){
                    $navtop.each(function(index, val) {
                        var $item     = $(this);
                        if(fullWidth) $item.find('.level-top-mega').addClass('parent-full-width').wrap( '<div class="full-width"></div>' );
                        var options   = $item.data('options');
                        var $catMega = $item.find('.cat-mega');
                        var $children = $catMega.find('.children');
                        var columns   = $children.length;
                        var wchil     = $children.outerWidth();
                        if(options){
                            var col     = parseInt(options.cat_col);
                            if(!isNaN(col)) columns = col;
                            var cat         = parseFloat(options.cat_proportion);
                            var left        = parseFloat(options.left_proportion);
                            var right       = parseFloat(options.right_proportion);
                            if(isNaN(left)) left = 0; if(isNaN(right)) right = 0;
                            var proportion  = cat + left + right;
                            var wCat        = Math.ceil(100*cat/proportion);
                            var wLeft       = Math.floor(100*left/proportion);
                            var wRight      = Math.floor(100*right/proportion);
                            // Init Responsive
                            $catMega.width(wCat + '%');
                            $item.find('.mega-block-left').width(wLeft + '%');
                            $item.find('.mega-block-right').width(wRight + '%');
                            $children.each(function(idx) { if(idx % columns ==0 && idx != 0) $(this).css("clear", "both"); });
                            $item.attr({'data-wcat': wCat, 'data-wleft': wLeft,'data-wright': wRight });
                        } 

                    });
                },

                horizontal: function ($navtop, fullWidth, init) {
                    if(init) methods.initMenu($navtop, fullWidth);
                    var menuBox = $('.container');
                    var maxW      = fullWidth ? $('body').width() : menuBox.width();
                    var wMenuBox  = menuBox.width();
                    $navtop.hover(function(){
                        var $item       = $(this);
                        var options     = $item.data('options');
                        var $children   = $item.find('.cat-mega .children');
                        var columns     = $children.length;
                        var wChild      = $children.outerWidth(true);
                        var wMega       = wChild*columns;
                        if(options){
                            var col     = parseInt(options.cat_col);
                            if(!isNaN(col)) wMega = wChild*col;
                            var wCat    = $item.data('wcat');
                            var wLeft   = Math.ceil($item.data('wleft')*wMega/wCat);
                            var wRight  = Math.ceil($item.data('wright')*wMega/wCat);
                            if( wLeft || wRight ) wMega = wMega + wLeft + wRight;
                        }
                        if(wMega > maxW) wMega = Math.floor(maxW / wChild)*wChild;
                        $item.find('.content-mega-horizontal').width(wMega);
                        var topMega     = $item.find('.level-top-mega');
                        if(topMega.length){
                            var offsetMenuBox        = menuBox.offset();
                            var offsetMega           = $item.offset();
                            var xLeft                = wMenuBox - topMega.outerWidth(true);
                            var xLeft2               = offsetMega.left - offsetMenuBox.left;
                            if(xLeft > xLeft2) xLeft = xLeft2;
                            if(xLeft < 0)      xLeft = xLeft/2;
                            topMega.css('left',xLeft);                          
                        }
                    })
                },

                vertical: function ($navtop, fullWidth, init)  {
                    if(init) methods.initMenu($navtop, fullWidth);
                    var menuBox = $('.container');
                    var maxW    = menuBox.width();
                    $navtop.hover(function(){
                        var $item       = $(this);
                        var options     = $item.data('options');
                        var $children   = $item.find('.cat-mega .children');
                        var columns     = $children.length;
                        var wChild      = $children.outerWidth(true);
                        var topMega     = $item.find('.level-top-mega');
                        var wMega           = wChild*columns;
                        if(options){
                            var col     = parseInt(options.cat_col);
                            if(!isNaN(col)) wMega = wChild*col;
                            var wCat    = $item.data('wcat');
                            var wLeft   = Math.ceil($item.data('wleft')*wMega/wCat);
                            var wRight  = Math.ceil($item.data('wright')*wMega/wCat);
                            if( wLeft || wRight ) wMega = wMega + wLeft + wRight;
                        }
                        var wVmenu          = $navtop.closest(vSelector).outerWidth(true);
                        var wMageMax        = maxW- wVmenu - (topMega.outerWidth(true) - topMega.width());
                        if(wMega > wMageMax) wMega = Math.floor(wMageMax / wChild)*wChild;
                        var postionMega     = $item.position();
                        topMega.css('top', postionMega.top);
                        $item.find('.content-mega-horizontal').width(wMega);
                    })
                },

                toggleHorizontal: function ($menu) {
                    var catplus = $menu.find('li.level0').not('.all-cat');
                    if(catplus.length) $menu.find('.all-cat').show().click(function(event) {$(this).children().toggle(); catplus.slideToggle('slow');});
                    else $menu.find('.all-cat').hide();
                },

                toggleVertical: function ($vmenu) {
                    var catplus = $vmenu.find('li.level0:hidden').not('.all-cat');
                    var nav_hidden = $vmenu.find('.nav-desktop').is(":hidden"); 
                    $vmenu.find('.v-title').click(function() {
                        // $vmenu.find('.nav-desktop').parent().toggle();
                        $vmenu.find('.nav-desktop').slideToggle(400);
                        catplus = $vmenu.find('li.level0:hidden').not('.all-cat');
                    });

                    if(nav_hidden){
                        $vmenu.find('.v-title').hover(function() {
                            catplus = $vmenu.find('li.level0:hidden').not('.all-cat');
                            if(catplus.length) $vmenu.find('.all-cat').show();
                            else $vmenu.find('.all-cat').hide();
                        });
                    }

                    var catmore = $vmenu.find('.nav-desktop > .level0');
                    // if(catplus.length) $vmenu.find('.all-cat').show().click(function(event) {$(this).children().toggle(); catplus.slideToggle('slow');});
                    if(catplus.length) $vmenu.find('.all-cat').show().click(function(event) {$(this).children().toggle(); catmore.slideToggle('slow');});
                    else $vmenu.find('.all-cat').hide();
                }
            };

            if(methods[options]) { // $("#element").pluginName('methodName', 'arg1', 'arg2');
                return methods[options].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if (typeof options === 'object' || !options) { // $("#element").pluginName({ option: 1, option:2 });
                return methods.init.apply(this);
            } else {
                $.error('Method "' + method + '" does not exist in timer plugin!');
            }
        }

    })(jQuery);

    $('.openNav').click(function(){
        $('body').addClass('nav-opencanvas');
        $("#mobileSidenav").addClass('opencanvas');
        // $("#container-main").addClass('opencanvas');
    })
    $('.nav-mobile-overlay-fixed').click(function(event){
        $('.sidenav .closebtn').trigger('click');
    })
    $('.sidenav .closebtn').click(function(){
        $('body').removeClass('nav-opencanvas');
        $("#mobileSidenav").removeClass('opencanvas');
        // $("#container-main").removeClass('opencanvas');
    }) 

    // For accordion
	$(".meanmenu-accordion").magicaccordion({
		accordion:true,
		speed: 400,
		closedSign: 'collapse',
		openedSign: 'expand',
		easing: 'easeInOutQuad'
	});
    // End For accordion

    // For Mobile
    $('.navigation-mobile').magicaccordion({
		accordion:true,
		speed: 400,
		closedSign: 'collapse',
		openedSign: 'expand',
		easing: 'easeInOutQuad',
		openedActive: false,
	});

    // End for Mobile
    $(document).magicmenu();
});
