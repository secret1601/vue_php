/* ===================================
    sticky nav
 ====================================== */
"use strict";
var $portfolio_filter;
var $grid_selectors;

var isMobile = false;
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
}

/* For remove conflict */
( function( $ ) {
    $(document).ready(function () {
        
        //Disable mouse scroll wheel zoom on embedded Google Maps
        $('.maps').on( 'click', function () {

            $('.maps iframe').css("pointer-events", "auto");
        });

        $(".maps").mouseleave(function () {
            $('.maps iframe').css("pointer-events", "none");
        });

        $(".blog-listing").find("a.comment,span.comment").addClass("alt-font font-weight-600");
        

    /* ===================================
        progressbar animate start
    ====================================== */

        $('.progress-bar').appear();
        $(document.body).on('appear', '.progress-bar', function (e) {
    		
            for(var i = 0; i < $(".progress-bar").length; i++) { 
                var width = $(".progress-bar:eq(" + i  + ")").attr('aria-valuenow');
                $(".progress-bar:eq(" + i  + ")").css( 'width', width + '%');
            }
        });

    /* ===================================
        progressbar animate End
    ====================================== */

    /* ===================================
        masonary js start
    ====================================== */

        $('.masonry-type').imagesLoaded( function () {
            $('.masonry-type').masonry({
                itemSelector: '.masonry-item-gallery',
                layoutMode: 'masonry'
            });
        });
        
    /* ===================================
        masonary js End
    ====================================== */ 

    /* ===================================
        counter number reset while scrolling
    ====================================== */

        $('.timer').appear();
        $(document.body).on('appear', '.timer', function (e) {
            // this code is executed for each appeared element
            if (!$(this).hasClass('appear')) {
                animatecounters();
                $(this).addClass('appear');
            }
        });

    /* ===================================
        owl slider
     ====================================== */

        $(".owl-slider-full").owlCarousel({
            nav: true, // Show next and prev buttons
            autoplaySpeed: 300,
            dotsSpeed: 400,
            items: 1,
            rtl: $("body").hasClass("rtl") ? true:false,
            loop: true,
            navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"]
        });


    /* ===================================
        shrink navigation
     ====================================== */

        $(window).scroll();
        $(window).scroll(function () {
            if(!$('nav').hasClass("non-sticky-nav")){
                if ($(window).scrollTop() > 10) {
                    $('nav').addClass('shrink');
                } else {
                    $('nav').removeClass('shrink');
                }
            }
        });
        
        $('.navbar a.inner-link, .pull-menu a.inner-link').each(function () {
            var currLink = $(this);
            var hasPos  = currLink.attr("href").indexOf("#");
            if( hasPos > -1 ) {
                var res = currLink.attr("href").substring( hasPos );
                if( $( res ).length <= 0 ) {
                    currLink.addClass("brando-stop-navigation");
                }
            }
        });
            
        $('.navigation-menu')
                .onePageNav({
                    scrollSpeed: 750,
                    scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
                    scrollOffset: 79, //Height of Navigation Bar
                    currentClass: 'active',
                    filter: ':not(.btn-very-small,.brando-stop-navigation, .widget_icl_lang_sel_widget .wpml-ls-item-toggle)'
                });
       

        setTimeout(function () {
            $(window).scroll();
        }, 500);

        //close navbar menu after clicking menu href
        $('ul.navbar-nav li a').on( 'click', function (e) {
            $(this).parents('div.navbar-collapse').removeClass('in');
        });

        // pull-menu close on href click event in all devices
        $('.pull-menu-hide a').on( 'click', function (e) {
            $('#close-button').click();
        });

        // pull-menu close on href click event in mobile devices
        $('.pull-menu a.section-link').on( 'click', function (e) {
            if ($(window).width() <= 500) {
                $('#close-button').click();
            }
        });


        $( '.mobile-menu-icon' ).on( 'click', function() {
            if($(this).parent().hasClass("arrow-up")){
                $(this).parent().removeClass("arrow-up");
                $(this).parent().addClass("arrow-down");
            }else{
                $(this).parent().removeClass("arrow-down");
                $(this).parent().addClass("arrow-up");
            }
        });

        // humberger-menu add class for wpml dropdown
        $( '.wpml-ls-item-legacy-dropdown' ).on( 'click', function() {
            if($(this).hasClass("arrow-up")){
                $(this).removeClass("arrow-up");
                $(this).addClass("arrow-down");
            }else{
                $(this).removeClass("arrow-down");
                $(this).addClass("arrow-up");
            }
        });

        /* Menu Outside click*/
        $('body').on('touchstart click', function (e) {
            if (!$('.navbar').has(e.target).is('.navbar') && $('.navbar').find(".navbar-collapse").hasClass('in')) {
                $('.navbar-toggle').click();
            }   
        });



    /*==============================================================
        smooth scroll
     ==============================================================*/
        var hash = window.location.hash.substr(1);
        if (hash != "") {
            var scrollAnimationTime = 1200,
                    scrollAnimation = 'easeInOutExpo';

            var target = '#' + hash;
            $('html, body').stop()
                    .animate({
                        'scrollTop': $(target)
                                .offset()
                                .top
                    }, scrollAnimationTime, scrollAnimation, function () {
                        window.location.hash = target;
                    });
        }



        var scrollAnimationTime = 1200,
                scrollAnimation = 'easeInOutExpo';
        $('a.scrollto').bind('click.smoothscroll', function (event) {
            event.preventDefault();
            var target = this.hash;
            $('html, body').stop()
                    .animate({
                        'scrollTop': $(target)
                                .offset()
                                .top
                    }, scrollAnimationTime, scrollAnimation, function () {
                        window.location.hash = target;
                    });
        });

        // Inner links
        if($("nav").hasClass("navbar")){
            var header_offset = $(".navbar, .menu-wrap").attr('data-offset');
            var general_offset = -59;
            if ( typeof header_offset !== typeof undefined && header_offset !== false ) {
                var general_offset = header_offset;
            }
            $('.inner-link').smoothScroll({
                speed: 900,
                offset: parseInt( general_offset )
            });
        }else{
            $('.inner-link').smoothScroll({
                speed: 900,
                offset: 1
            });
        }

        // Stop Propagation After Button Click
        $( '.scrollToDownSection .inner-link, .scrollToDownSection form' ).on( 'click', function( event ) {
            event.stopPropagation();
        });

        $( 'section.scrollToDownSection' ).on( 'click', function() {
           var section_id = $( $(this).attr('data-section-id') );
           $('html, body').animate({scrollTop: section_id.offset().top}, 800);
        });

        if(isMobile && $("nav").hasClass("sidebar-nav")){
            var header_offset = $(".navbar, .menu-wrap").attr('data-offset');
            var general_offset = -59;
            if ( typeof header_offset !== typeof undefined && header_offset !== false ) {
                var general_offset = header_offset;
            }
            $('.section-link').smoothScroll({
                speed: 900,
                offset: parseInt( general_offset )
            });
        }else{
            $('.section-link').smoothScroll({
                speed: 900,
                offset: 1
            });
        }

    /*==============================================================
        set parallax
     ==============================================================*/
        
        SetParallax();

        $('.parallax-fix').each(function () {
            if ($(this).children('.parallax-background-img').length) {
                var imgSrc = jQuery(this).children('.parallax-background-img').attr('src');
                jQuery(this).css('background', 'url("' + imgSrc + '")');
                jQuery(this).children('.parallax-background-img').remove();
                $(this).css('background-position', '50% 0%');
            }

        });
        var IsParallaxGenerated = false;
        function SetParallax() {
            if ($(window).width() > 1030 && !IsParallaxGenerated) {
                $('.parallax1').parallax("50%", 0.1);
                $('.parallax2').parallax("50%", 0.2);
                $('.parallax3').parallax("50%", 0.3);
                $('.parallax4').parallax("50%", 0.4);
                $('.parallax5').parallax("50%", 0.5);
                $('.parallax6').parallax("50%", 0.6);
                $('.parallax7').parallax("50%", 0.7);
                $('.parallax8').parallax("50%", 0.8);
                $('.parallax9').parallax("50%", 0.05);
                $('.parallax10').parallax("50%", 0.02);
                $('.parallax11').parallax("50%", 0.01);
                $('.parallax12').parallax("50%", 0.099);
                IsParallaxGenerated = true;
            }
        }

    /*==============================================================
        portfolio-filter
     ==============================================================*/

        // use for portfolio sotring with masonry
        var hidedefault = true;
        var defaultvalue = false;

        $portfolio_filter = $('.masonry-items');
        var portfolio_selector = $portfolio_filter.parents( 'section' ).find('.portfolio-filter li.nav.active a').attr('data-filter');
        $portfolio_filter.imagesLoaded(function () {

            $portfolio_filter.isotope({
                itemSelector: 'li',
                layoutMode: 'masonry',
            });
            $portfolio_filter.isotope();
        });

        var default_arr = [];

        $('.portfolio-filter > li.active > a').each(function( index ) {
            var selector = $(this).attr('data-filter');
            var uniqueid = $(this).attr('data-uniqueid');
            if( selector != '*'){
                hidedefault = false;
                $('.'+uniqueid).parent().find('.post-load').hide();
            }else{
                hidedefault = true;
                $('.'+uniqueid).parent().find('.post-load').show();
            }
            default_selector(hidedefault);
        });

        function default_selector(hidedefault){
            if( !hidedefault ) {
                $portfolio_filter.imagesLoaded(function () {
                    $('.portfolio-filter, .masonry-items').each(function() {    
                        if( $('#'+ $(this).attr( 'id' )+' > li.active > a').attr( 'data-id' ) != '' && typeof($('#'+ $(this).attr( 'id' )+' > li.active > a').attr( 'data-id' )) != "undefined" ){
                            if( $.inArray( $('#'+ $(this).attr( 'id' )+' > li.active > a').attr( 'data-id' ), default_arr ) == -1 ){
                                default_arr.push($('#'+ $(this).attr( 'id' )+' > li.active > a').attr( 'data-id' ));
                            }
                        }else if( $(this).attr( 'data-portfolio' ) != '' && typeof( $(this).attr( 'data-portfolio' ) ) != "undefined" ){
                            if( $.inArray( $(this).attr( 'data-portfolio' ), default_arr ) == -1 ){
                                default_arr.push($(this).attr( 'data-portfolio' ));
                            }
                        }else if( $(this).find("li.active > a").attr( 'data-uniqueid' ) != '' && typeof( $(this).find("li.active > a").attr( 'data-uniqueid' ) ) != "undefined" ){
                            if( $(this).find("li.active > a").attr( 'data-filter' ) != '*' ){
                                default_arr.push($(this).find("li.active > a").attr( 'data-uniqueid' ));
                                defaultvalue = true;
                            }
                        }
                    });
                    $(default_arr).each(function(key,value) {
                        var portfolio_filter = $('.masonry-items.'+value);
                        if( defaultvalue ){
                            var data_id = $($('.'+ value)).find('li.nav.active a').attr( 'data-filter' );
                        }else{
                            var data_id = $($('#'+ value)).find('li.nav.active a').attr( 'data-filter' );
                        }
                        var portfolio_selector = data_id;
                        if( portfolio_selector != '' && typeof(portfolio_selector) != 'undefined' ){
                            portfolio_filter.imagesLoaded(function () {
                                portfolio_filter.isotope({
                                    layoutMode: 'masonry',
                                    itemSelector: 'li',
                                    filter: portfolio_selector
                                });
                            });
                        }else{
                            var portfolio_filter = $('.'+value);
                            var portfolio_selector = portfolio_filter.find('li').attr("data-filter");
                            portfolio_filter.imagesLoaded(function () {
                                portfolio_filter.isotope({
                                    itemSelector: 'li',
                                    layoutMode: 'masonry',
                                    filter: '*'
                                });
                            });
                        }
                    });
                });
            }
        }

        $grid_selectors = $('.portfolio-filter > li > a');
        $grid_selectors.on('click', function () {
            var selector = $(this).attr('data-filter'); 
            var uniqueid = $(this).attr('data-uniqueid');
            if( $(this).attr( 'data-id' ) != '' ){
                $grid_selectors = $('#'+ $(this).attr( 'data-id' )+' > li > a');
                $grid_selectors.parent().removeClass('active');
                $(this).parent().addClass('active');

                $('.' + $(this).attr( 'data-id' )).isotope({filter: selector});                

            }else{
                $grid_selectors.parent().removeClass('active');
                $(this).parent().addClass('active');
                $portfolio_filter.isotope({filter: selector});
            } 

            if($(this).attr('data-filter') != '*'){
                $('.'+uniqueid).parent().find('.post-load').hide();
            }else{
                $('.'+uniqueid).parent().find('.post-load').show();
            }
            return false;
        });

        $(window).resize(function () {
            setTimeout(function () {
                $portfolio_filter.imagesLoaded( function() {
                    $portfolio_filter.isotope('layout');
                });
            }, 500);
        });

        $(window).unbind(".infscr");
        $( '.post-load' ).on( 'click', function( e ) {           
            e.preventDefault();
            var portfolio_select = $(this).parent().parent().find(".masonry-items").attr("data-portfolio");
            var portfolio_uniq_id = $(this).parent().parent().find(".masonry-items").attr("data-uniqueid");
            if( portfolio_select && typeof(portfolio_select) != 'undefined' ){
                portfolioinfinite(portfolio_select);
                $( '.masonry-items.'+portfolio_select ).infinitescroll('retrieve');
                $( '.masonry-items.'+portfolio_select ).infinitescroll('unbind');
            }else if( portfolio_uniq_id && typeof( portfolio_uniq_id ) != 'undefined' ){
                portfolioinfinite(portfolio_uniq_id);
                $( '.masonry-items.'+portfolio_uniq_id ).infinitescroll('retrieve');
                $( '.masonry-items.'+portfolio_uniq_id ).infinitescroll('unbind');
            }
        });

    /*==============================================================*/
    // Infinite Scroll jQuery - START CODE
    /*==============================================================*/
        function portfolioinfinite(portfolio_val) {
            var pagesNum = $('.masonry-items.'+portfolio_val).parent().find("div.brando-infinite-scroll").attr('data-pagination');  
            $('.masonry-items.'+portfolio_val).infinitescroll({
                nextSelector: 'div.brando-infinite-scroll a',
                loading: {
                    img: brandoajaxurl.loading_image,
                    msgText: '<div class="paging-loader" style="transform:scale(0.35);"><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div></div>',
                    finishedMsg: '<div class="finish-load">' + brando_infinite_scroll_message.message + '</div>',
                    speed: 'fast',
                },
                navSelector: 'div.brando-infinite-scroll',
                contentSelector: '.masonry-items.'+portfolio_val,
                itemSelector: '.masonry-items.'+portfolio_val+' .portfolio-single-post',
                maxPage: pagesNum,
            }, function (newElements,opts) {
                if(opts.state.currPage == opts.maxPage){
                    $('.masonry-items.'+portfolio_val).parent().find('.post-listing').hide(); 
                }
                //$('.brando-infinite-scroll').remove();
                //$('#infscr-loading').remove();       
                
                var $newblogpost = $(newElements);
                // append other items when they are loaded
                $newblogpost.imagesLoaded( function() {
                    $('.masonry-items.'+portfolio_val).append( $newblogpost )
                      .isotope( 'appended', $newblogpost );
                    });

                    $('.simple-ajax-popup-align-top').magnificPopup({
                        type: 'ajax',
                        alignTop: true,
                        closeOnContentClick: false,
                        fixedContentPos: true,
                        closeBtnInside: false,
                        overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
                        callbacks: {
                            open: function () {
                                $.magnificPopup.instance.close = function() {
                                    $(document).on('keyup',function(e) {
                                        if (e.keyCode == 27) {
                                           $.magnificPopup.proto.close.call(this);
                                        }
                                    });
                                    
                                    if( !$('body').hasClass('brando-custom-popup-close') ) {
                                        $.magnificPopup.proto.close.call(this);
                                    } else {
                                        $( document ).on('click','button.mfp-close', function() {
                                            $.magnificPopup.proto.close.call(this);
                                        });
                                    }
                                }

                                $('.navbar .collapse').removeClass('in');
                                $('.navbar a.dropdown-toggle').addClass('collapsed');
                            }
                        }
                    });

                    var lightboxgallerygroups = {};
                    $('.lightboxgalleryitem').each(function() {
                      var id = $(this).attr('data-group');
                      if(!lightboxgallerygroups[id]) {
                        lightboxgallerygroups[id] = [];
                      } 
                      lightboxgallerygroups[id].push( this );
                    });
                    
                    $.each(lightboxgallerygroups, function() {
                      $(this).magnificPopup({
                            type: 'image',
                            closeOnContentClick: true,
                            closeBtnInside: false,
                            gallery: { enabled:true },
                            image: {
                                titleSrc: function (item) {
                                    var title = '';
                                    var lightbox_caption = '';
                                    if( item.el.attr('title') ){
                                        title = item.el.attr('title');
                                    }
                                    if( item.el.attr('lightbox_caption') ){
                                        lightbox_caption = '<span class="brando-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                                    }
                                    return title + lightbox_caption;
                                }
                            },
                            callbacks: {
                                open: function () {
                                    $.magnificPopup.instance.close = function() {
                                        $(document).on('keyup',function(e) {
                                            if (e.keyCode == 27) {
                                               $.magnificPopup.proto.close.call(this);
                                            }
                                        });

                                        if( !$('body').hasClass('brando-custom-popup-close') ) {
                                            $.magnificPopup.proto.close.call(this);
                                        } else {
                                            $( document ).on('click','button.mfp-close', function() {
                                                $.magnificPopup.proto.close.call(this);
                                            });
                                        }
                                    }
                                }
                            }
                      })
                      
                    });
                });
            }

            $('.nav-tabs a[data-toggle="tab"]').each(function () {
                var $this = $(this);
                $this.on('shown.bs.tab', function () {
                    if( $('.grid').length > 0 ) {
                        $('.grid').imagesLoaded( function () {
                            $('.grid').masonry({
                                itemSelector: 'li',
                                layoutMode: 'masonry'
                            });
                        });
                    }
                });
            });
    /*==============================================================*/
    // Infinite Scroll jQuery - END CODE
    /*==============================================================*/

    /*==============================================================
        lightbox gallery
     ==============================================================*/

        $(".titlelightboxgallery").on('click', function () {
            $(this).parents("li").find(".lightboxgalleryitem").trigger( "click" );
        });
        
        var lightboxgallerygroups = {};
        $('.lightboxgalleryitem').each(function() {
          var id = $(this).attr('data-group');
          if(!lightboxgallerygroups[id]) {
            lightboxgallerygroups[id] = [];
          } 
          lightboxgallerygroups[id].push( this );
        });
        
        $.each(lightboxgallerygroups, function() {
          $(this).magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                gallery: { enabled:true },
                image: {
                    titleSrc: function (item) {
                        var title = '';
                        var lightbox_caption = '';
                        if( item.el.attr('title') ){
                            title = item.el.attr('title');
                        }
                        if( item.el.attr('lightbox_caption') ){
                            lightbox_caption = '<span class="brando-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                        }
                        return title + lightbox_caption;
                    }
                },
                callbacks: {
                    open: function () {
                        $.magnificPopup.instance.close = function() {
                            $(document).on('keyup',function(e) {
                                if (e.keyCode == 27) {
                                   $.magnificPopup.proto.close.call(this);
                                }
                            });

                            if( !$('body').hasClass('brando-custom-popup-close') ) {
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $( document ).on('click','button.mfp-close', function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    }
                }
          })
          
        });
    /*==============================================================
        single image lightbox - zoom animation
    ==============================================================*/

    /*==============================================================
        Ajax MagnificPopup For Portfolio - START CODE
    ==============================================================*/

    $('.simple-ajax-popup-align-top').magnificPopup({
            type: 'ajax',
            alignTop: true,
            closeOnContentClick: false,
            fixedContentPos: true,
            closeBtnInside: false,
            overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
            callbacks: {
                open: function () {
                    $.magnificPopup.instance.close = function() {
                        $(document).on('keyup',function(e) {
                            if (e.keyCode == 27) {
                               $.magnificPopup.proto.close.call(this);
                            }
                        });
                        
                        if( !$('body').hasClass('brando-custom-popup-close') ) {
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( document ).on('click','button.mfp-close', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }

                    $('.navbar .collapse').removeClass('in');
                    $('.navbar a.dropdown-toggle').addClass('collapsed');
                }
            }
    });

    /*==============================================================
    Ajax MagnificPopup For Portfolio - END CODE
    ==============================================================*/

        $('.single-image-lightbox').magnificPopup({
            type: 'image',
            fixedContentPos: true,
            closeOnContentClick: true,
            closeBtnInside: false,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                verticalFit: true,
            },
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            },
            callbacks: {
                open: function () {
                    $.magnificPopup.instance.close = function() {
                        $(document).on('keyup',function(e) {
                            if (e.keyCode == 27) {
                               $.magnificPopup.proto.close.call(this);
                            }
                        });

                        if( !$('body').hasClass('brando-custom-popup-close') ) {
                                $.magnificPopup.proto.close.call(this);
                        } else {
                            $( document ).on('click','button.mfp-close', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                }
            }
        });

    /*==============================================================
        zoom gallery
    ==============================================================*/

        var lightboxzoomgallerygroups = {};
        $('.lightboxzoomgalleryitem').each(function() {
          var id = $(this).attr('data-group');
          if(!lightboxzoomgallerygroups[id]) {
            lightboxzoomgallerygroups[id] = [];
          } 
          
          lightboxzoomgallerygroups[id].push( this );
        });


        $.each(lightboxzoomgallerygroups, function() {
            $(this).magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        var title = '';
                        var lightbox_caption = '';
                        if( item.el.attr('title') ){
                            title = item.el.attr('title');
                        }
                        if( item.el.attr('lightbox_caption') ){
                            lightbox_caption = '<span class="brando-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                        }
                        return title + lightbox_caption;
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't foget to change the duration also in CSS
                    opener: function (element) {
                        return element.find('img');
                    }
                },
                callbacks: {
                    open: function () {
                        $.magnificPopup.instance.close = function() {
                            $(document).on('keyup',function(e) {
                                if (e.keyCode == 27) {
                                   $.magnificPopup.proto.close.call(this);
                                }
                            });

                            if( !$('body').hasClass('brando-custom-popup-close') ) {
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $( document ).on('click','button.mfp-close', function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    }
                }
            })
        });

    /*==============================================================
        popup with form
    ==============================================================*/
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            closeBtnInside: true,
            fixedContentPos: true,
            focus: '#name',
            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                },
                open: function () {
                        $.magnificPopup.instance.close = function() {
                            $(document).on('keyup',function(e) {
                                if (e.keyCode == 27) {
                                   $.magnificPopup.proto.close.call(this);
                                }
                            });

                            if( !$('body').hasClass('brando-custom-popup-close') ) {
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $( document ).on('click','button.mfp-close', function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    }
            }
        });

    /*==============================================================
        video magnific popup
    ==============================================================*/

        $('.popup-youtube, .popup-vimeo, .popup-googlemap').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            closeOnContentClick: true,
            closeBtnInside: false,
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: true,
            callbacks: {
                    open: function () {
                        $.magnificPopup.instance.close = function() {
                            $(document).on('keyup',function(e) {
                                if (e.keyCode == 27) {
                                   $.magnificPopup.proto.close.call(this);
                                }
                            });
                            if( !$('body').hasClass('brando-custom-popup-close') ) {
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $( document ).on('click','button.mfp-close', function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    }
                }
        });

    /*==============================================================
        ajax magnific popup for onepage portfolio
    ==============================================================*/
        
        $('.ajax-popup').magnificPopup({
            type: 'ajax',
            closeOnContentClick: true,
            closeBtnInside: false,
            alignTop: true,
            fixedContentPos: true,
            overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
            callbacks: {
                open: function () {
                    $.magnificPopup.instance.close = function() {
                        $(document).on('keyup',function(e) {
                            if (e.keyCode == 27) {
                               $.magnificPopup.proto.close.call(this);
                            }
                        });

                        if( !$('body').hasClass('brando-custom-popup-close') ) {
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $( document ).on('click','button.mfp-close', function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }

                    $('.navbar .collapse').removeClass('in');
                    $('.navbar a.dropdown-toggle').addClass('collapsed');
                }
            }
        });

    /*==============================================================
        accordion
     ==============================================================*/

        $('.collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fas fa-minus"></i>');
        });
        $('.collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fas fa-plus"></i>');
        });
        $('.accordion-style2 .collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fas fa-angle-up"></i>');
        });
        $('.accordion-style2 .collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fas fa-angle-down"></i>');
        });

    /*==============================================================
        toggles
    ==============================================================*/

        $('.toggles-style2 .collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fas fa-angle-up"></i>');
        });
        $('.toggles-style2 .collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fas fa-angle-down"></i>');
        });

    /*==============================================================
        fit videos
    ==============================================================*/

        $(".fit-videos").fitVids();


    /*==============================================================
        form to email
    ==============================================================*/
        

    /*==============================================================*/
    // NewsLetter Validation - START CODE
    /*==============================================================*/

    $( '.submit_newsletter' ).on( 'click', function() {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var current = $(this);
        var address = $(this).closest('form').find('.xyz_em_email').val();
        if(reg.test(address) == false) {
            //alert('Please check whether the email is correct.');
            current.closest('form').find('.xyz_em_email').addClass('required-error');
        return false;
        }else{
        //document.subscription.submit();
        return true;
        }
    });

    $('.xyz_em_email').on('focus', function(){
      $(this).removeClass('required-error');
    });

    /*==============================================================*/
    // NewsLetter Validation - END CODE
    /*==============================================================*/

    //end ready
    });

    /*==============================================================*/
    //Reload popup OwlCarousel
    /*==============================================================*/

    function ReloadOwlCarousel(){
        $(".popup-main .owl-slider-full").owlCarousel({
            nav: true, // Show next and prev buttons
            autoplaySpeed: 300,
            dotsSpeed: 400,
            items: 1,
            rtl: $("body").hasClass("rtl") ? true:false,
            loop: true,
            navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"]
        });

        //Stop Closing magnificPopup on selected elements - START CODE

        $(".popup-main .owl-slider-full").on( 'click', function (e) {
            if ($(e.target).is('.mfp-close'))
                return;
            return false;
        });

    }

/*==============================================================
    full screen
 ==============================================================*/

function SetResizeContent() {
    var minheight = $(window).height();
    $(".full-screen").css('min-height', minheight);
}
SetResizeContent();

$(window).resize(function () {
    SetResizeContent();
});

/*==============================================================
    counter
 ==============================================================*/

jQuery(function ($) {
    // start all the timers
    animatecounters();
});

function animatecounters() {
    $('.timer').each(count);
    function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
    }
}
/*==============================================================
    elements active class
 ==============================================================*/

jQuery(function ($) {
    $('div.widget-body ul.category-list li a').on( 'click', function (e) {
        $('div.widget-body ul.category-list li a').removeClass('active');
        $(this).addClass('active');
    });
});

/*==============================================================
    wow animation - on scroll
 ==============================================================*/

var wow = new WOW({
    boxClass: 'wow',
    animateClass: 'animated',
    offset: 90,
    mobile: false,
    live: true
});
wow.init();

/*==============================================================
    ajax aagnific popup for onepage portfolio
==============================================================*/

$('.work-details-popup').on('click', function () {
    $.magnificPopup.open({
        items: {
            src: $(this).parents('li').find('.popup-main'),
        },
        type: 'inline',
        fixedContentPos: true,
        closeOnContentClick: true,
        callbacks: {
            beforeOpen: function () {
                startWindowScroll = $(window).scrollTop();
            },
            open: function () {
                $('.mfp-wrap').addClass('popup-bg');
                ReloadOwlCarousel();
            },
            close: function () {
                $('.mfp-wrap').removeClass('popup-bg');
                $(window).scrollTop(startWindowScroll);
            }
        }
    });
});

/*==============================================================
    pull menu
 ==============================================================*/

function bindEvent(el, eventName, eventHandler) {
    if (el.addEventListener) {
        el.addEventListener(eventName, eventHandler, false);
    } else if (el.attachEvent) {
        el.attachEvent('on' + eventName, eventHandler);
    }
}

(function () {

    var bodyEl = document.body,
            //content = document.querySelector( '.content-wrap' ),
            openbtn = document.getElementById('open-button'),
            closebtn = document.getElementById('close-button'),
            isOpen = false;

    function init() {
        initEvents();
    }

    function initEvents() {
        if (openbtn) {
            bindEvent(openbtn, 'click', toggleMenu);

        }
        //openbtn.addEventListener( 'click', toggleMenu );
        if (closebtn) {

            bindEvent(closebtn, 'click', toggleMenu);
            //closebtn.addEventListener( 'click', toggleMenu );
        }

        // close the menu element if the target itÂ´s not the menu element or one of its descendants..

    }

    function toggleMenu() {

        if (isOpen) {
            classie.remove(bodyEl, 'show-menu');
        }
        else {
            classie.add(bodyEl, 'show-menu');
        }
        isOpen = !isOpen;
    }

    init();

})();

/*==============================================================
    countdown timer
==============================================================*/

$(document).ready(function () {

    /* Get Counter texts */
    var $CounterDay, $CounterHours, $CounterMinutes, $CounterSeconds = '';
    if( $('.countdown-timer').hasClass('countdown') ){
        var CounterDayattr = $('.countdown.countdown-timer').attr('data-days-text');
        var CounterHoursattr = $('.countdown.countdown-timer').attr('data-hours-text');
        var CounterMinutesattr = $('.countdown.countdown-timer').attr('data-minutes-text');
        var CounterSecondsattr = $('.countdown.countdown-timer').attr('data-seconds-text');
    }else{
        var CounterDayattr = $('.slider-typography').find('.countdown-timer').attr('data-days-text');
        var CounterHoursattr = $('.slider-typography').find('.countdown-timer').attr('data-hours-text');
        var CounterMinutesattr = $('.slider-typography').find('.countdown-timer').attr('data-minutes-text');
        var CounterSecondsattr = $('.slider-typography').find('.countdown-timer').attr('data-seconds-text');
    }
    if( typeof CounterDayattr !== typeof undefined && CounterDayattr !== false ) {
        var $CounterDay = '<span>'+CounterDayattr+'</span>';
    }
    if( typeof CounterHoursattr !== typeof undefined && CounterHoursattr !== false ) {
        var $CounterHours = '<span>'+CounterHoursattr+'</span>';
    }
    if( typeof CounterMinutesattr !== typeof undefined && CounterMinutesattr !== false ) {
        var $CounterMinutes = '<span>'+CounterMinutesattr+'</span>';
    }
    if( typeof CounterSecondsattr !== typeof undefined && CounterSecondsattr !== false ) {
        var $CounterSeconds = '<span>'+CounterSecondsattr+'</span>';
    }
    $('#counter-event').countdown($('#counter-event').attr("data-enddate")).on('update.countdown', function (event) {
        var $this = $(this).html(event.strftime('' + '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div>'+$CounterDay+'</div>' + '<div class="counter-box"><div class="number">%H</div>'+$CounterHours+'</div>' + '<div class="counter-box"><div class="number">%M</div>'+$CounterMinutes+'</div>' + '<div class="counter-box last"><div class="number">%S</div>'+CounterSecondsattr+'</div></div>'))
    });
});


/*==============================================================
    scroll to top
==============================================================*/
$(window).on( 'scroll', function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollToTop').fadeIn();
    } else {
        $('.scrollToTop').fadeOut();
    }
});

    //Click event to scroll to top
$( '.scrollToTop' ).on( 'click', function () {
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
    return false;
});

$( '.panel a, .nav-tabs a' ).on( 'click', function (e) {
    if ($(this).is("[data-parent]") || $(this).is("[data-toggle]")) {
        e.preventDefault();
    }

});

/*==============================================================
    dropdown menu
==============================================================*/

$(function () {
    $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
});

/*==============================================================*/
// Menu Icon Add jQuery - START CODE
/*==============================================================*/

$(document).ready(function () {
    if($("li.menu-item-language").find("ul").first().length != 0){
        $("li.menu-item-language a:first").append("<i class='fas fa-angle-down mobile-menu-icon'></i>");
    }
});

/*==============================================================*/
// Menu Icon Add jQuery - END CODE
/*==============================================================*/

/*==============================================================*/
// Post Like Dislike Button JQuery - START CODE
/*==============================================================*/
$(document).ready(function () {
    $(document).on('click', '.sl-button', function() {
        var button = $(this);
        var post_id = button.attr('data-post-id');
        var security = button.attr('data-nonce');
        var iscomment = button.attr('data-iscomment');
        var allbuttons;
        if ( iscomment === '1' ) { /* Comments can have same id */
            allbuttons = $('.sl-comment-button-'+post_id);
        } else {
            allbuttons = $('.sl-button-'+post_id);
        }
        var loader = allbuttons.next('#sl-loader');
        if (post_id !== '') {
            $.ajax({
                type: 'POST',
                url: simpleLikes.ajaxurl,
                data : {
                    action : 'process_simple_like',
                    post_id : post_id,
                    nonce : security,
                    is_comment : iscomment
                },
                beforeSend:function(){
                    //loader.html('&nbsp;<div class="loader">Loading...</div>');
                },  
                success: function(response){
                    var icon = response.icon;
                    var count = response.count;
                    allbuttons.html(icon+count);
                    if(response.status === 'unliked') {
                        var like_text = simpleLikes.like;
                        allbuttons.prop('title', like_text);
                        allbuttons.removeClass('liked');
                    } else {
                        var unlike_text = simpleLikes.unlike;
                        allbuttons.prop('title', unlike_text);
                        allbuttons.addClass('liked');
                    }
                    loader.empty();                 
                }
            });
            
        }
        return false;
    });
});
/*==============================================================*/
// Post Like Dislike Button JQuery - END CODE
/*==============================================================*/

/*==============================================================*/
// Comment Validation - START CODE
/*==============================================================*/

$(document).ready(function () {
    $(".comment-button").on("click", function () {
        var fields;
            fields = "";
        if($(this).parent().parent().find('#author').length == 1) {
            if ($("#author").val().length == 0 || $("#author").val().value == '')
            {
                fields ='1';
                $("#author").addClass("required-error");
            }
        }
        if($(this).parent().parent().find('#comment').length == 1) {
            if ($("#comment").val().length == 0 || $("#comment").val().value == '')
            {
                fields ='1';
                $("#comment").addClass("required-error");
            }
        }
        if($(this).parent().parent().find('#email').length == 1) {
            if ($("#email").val().length == 0 || $("#email").val().length =='') {
                fields ='1';
                $("#email").addClass("required-error");
            } else {
                var re = new RegExp();
                re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                var sinput ;
                sinput= "" ;
                sinput = $("#email").val();
                if (!re.test(sinput)) {
                    fields ='1';
                    $("#email").addClass("required-error");
                }
            }
        }

        if(fields !="") {
            return false;
        } else {
            return true;
        }
    });

});

$( document ).on( 'focus click', '.comment-field', function() {
    var id = $( this ).attr( 'id' );
    if( id ){
        $( '#'+id ).removeClass( 'required-error' );
    }
});
/*==============================================================*/
// Comment Validation - END CODE
/*==============================================================*/

/*==============================================================*/
// VC Front Editor - START CODE
/*==============================================================*/

$(document).ready(function(){
    if( $( 'body').hasClass( 'vc_editor' ) ){
        $( '.vc_editor .brando-remove-frontend-editor-top' ).each(function() {
            $(this).parents('.vc_vc_column').addClass('remove-fronteditor-top');
        });
        $( '.front-column-class' ).each(function() {
            $(this).removeClass('vc_col-sm-12');
        });
    }
    $( '.wpb_column' ).each(function () {
        var CurrentColumn = $(this);
        var DataVCFrontClass = $(this).attr( 'data-front-class' );
        if( DataVCFrontClass && $( 'body').hasClass( 'vc_editor' ) ){
            CurrentColumn.parent().addClass( DataVCFrontClass );
            CurrentColumn.removeClass( DataVCFrontClass );
            CurrentColumn.attr('class', '');
            CurrentColumn.addClass('wpb_column');
        }
        CurrentColumn.removeAttr( 'data-front-class' );

        var DataBorderTop = $(this).attr( 'data-border-top' );
        var DataBorderBottom = $(this).attr( 'data-border-bottom' );
        var DataBorderLeft = $(this).attr( 'data-border-left' );
        var DataBorderRight = $(this).attr( 'data-border-right' );
        var DataMinHeight = $(this).attr( 'data-min-height' );
        var DataBackgroundColor = $(this).attr( 'data-background-color' );
        var DataBackground = $(this).attr( 'data-background' );

        if ( typeof DataBorderTop != "undefined" && DataBorderTop != '' ) {
            if( DataBorderTop && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataBorderTop ){
                    CurrentColumn.parent().css({ 'border-top': DataBorderTop });
                }
            }
            CurrentColumn.removeAttr( 'data-border-top' );
        }

        if ( typeof DataBorderBottom != "undefined" && DataBorderBottom != '' ) {
            if( DataBorderBottom && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataBorderBottom ){
                    CurrentColumn.parent().css({ 'border-bottom': DataBorderBottom });
                }
            }
            CurrentColumn.removeAttr( 'data-border-bottom' );
        }

        if ( typeof DataBorderLeft != "undefined" && DataBorderLeft != '' ) {
            if( DataBorderLeft && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataBorderLeft ){
                    CurrentColumn.parent().css({ 'border-left': DataBorderLeft });
                }
            }
            CurrentColumn.removeAttr( 'data-border-left' );
        }

        if ( typeof DataBorderRight != "undefined" && DataBorderRight != '' ) {
            if( DataBorderRight && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataBorderRight ){
                    CurrentColumn.parent().css({ 'border-right': DataBorderRight });
                }
            }
            CurrentColumn.removeAttr( 'data-border-right' );
        }

        if ( typeof DataMinHeight != "undefined" && DataMinHeight != '' ) {
            if( DataMinHeight && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataMinHeight ){
                    CurrentColumn.parent().css({ 'min-height': DataMinHeight });
                }
            }
            CurrentColumn.removeAttr( 'data-min-height' );
        }

        if ( typeof DataBackgroundColor != "undefined" && DataBackgroundColor != '' ) {
            if( DataBackgroundColor && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataBackgroundColor ){
                    CurrentColumn.parent().css({ 'background-color': DataBackgroundColor });
                }
            }
            CurrentColumn.removeAttr( 'data-background-color' );
        }

        if ( typeof DataBackground != "undefined" && DataBackground != '' ) {
            if( DataBackground && $( 'body').hasClass( 'vc_editor' ) ){
                if( DataBackground ){
                    CurrentColumn.parent().css({ 'background': 'url('+DataBackground+')' });
                }
            }
            CurrentColumn.removeAttr( 'data-background' );
        }

        if( CurrentColumn.attr("style") && $( 'body').hasClass( 'vc_editor' ) ){
            CurrentColumn.removeAttr('style');
        }
    }); 
});

/*==============================================================*/
// VC Front Editor - END CODE
/*==============================================================*/

/*==============================================================*/
// Add extra class into menu - START CODE
/*==============================================================*/

$(document).ready(function () {
    brandoMobileMenuDynamicClass();
});

$(window).resize(function () {
    brandoMobileMenuDynamicClass();
});

function brandoMobileMenuDynamicClass() {
    if (window.matchMedia('(max-width: 991px)').matches) {
        $( '.accordion-menu' ).addClass( 'mobile-accordion-menu' );
    } else {
        $( '.accordion-menu' ).removeClass( 'mobile-accordion-menu' );
    }
}

/*==============================================================*/
// Add extra class into menu - END CODE
/*==============================================================*/

/*==============================================================*/
// Add extra class into wpml vertical style - START CODE
/*==============================================================*/

if( $( '.wpml-ls' ).hasClass( 'wpml-ls-legacy-list-vertical' ) ) {
    $( '.header-right' ).addClass( 'vertical-style' );
}
/*==============================================================*/
// Add extra class into wpml vertical style - END CODE
/*==============================================================*/

})( jQuery );