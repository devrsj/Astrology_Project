$(document).ready(function(){


    // Menu js for Position fixed
    $(window).scroll(function(){
        var window_top = $(window).scrollTop() + 1;
        if (window_top > 300) {
            $('.as_header_wrapper').addClass('menu_fixed animated fadeInDown');
        } else {
            $('.as_header_wrapper').removeClass('menu_fixed animated fadeInDown');
        }
    });

    jQuery(window).on('scroll', function() {
        if ($(this).scrollTop() > 5) {
            $('.ast_top_header').hide();
            $('.as_header_wrapper').addClass("sticky");
        } else {
            $('.ast_top_header').show();

            $('.as_header_wrapper').removeClass("sticky");
        }

    });

    $('.myaccount-tab-menu a').click( function(){
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        } else {
            $('.myaccount-tab-menu a').removeClass('active');
            $(this).addClass('active');
        }
    });


    // banner slider
    $('.as_banner_slider').slick({
        dots: false,
        speed:800,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow:'<button type="button" class="slick-prev as_btn"><span><i class="fa fa-angle-left"></i> </span> </button>',
        nextArrow:'<button type="button" class="slick-next as_btn"> <span><i class="fa fa-angle-right"></i> </span></button>'
    });


    // customer slider
    $('.as_customer_slider').slick({
        infinite: false,
        dots: true,
        speed: 800,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows:false
              }
            },
          ]
    });


    // service slider
    $('.as_service_slider').slick({
        infinite: true,
        dots: false,
        speed: 800,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow:'<button type="button" class="slick-prev as_btn"><span><i class="fa fa-angle-left"></i> </span> </button>',
        nextArrow:'<button type="button" class="slick-next as_btn"> <span><i class="fa fa-angle-right"></i> </span></button>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    dots: false,
                    arrows:false
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: false,
                    arrows:false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    arrows:false
                }
            },
        ]
    });


    // service slider
    $('.service_slider').slick({
        infinite: true,
        dots: false,
        speed: 800,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow:'<button type="button" class="slick-prev as_btn"><span><i class="fa fa-angle-left"></i> </span> </button>',
        nextArrow:'<button type="button" class="slick-next as_btn"> <span><i class="fa fa-angle-right"></i> </span></button>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false,
                    arrows:false
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: false,
                    arrows:false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: false,
                    arrows:false
                }
            },
            
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    arrows:false
                }
            },
        ]
    });

    // product slider
    $('.as_product_slider').slick({
        arrows: false,
        infinite:true,
        speed:800,
        dots:true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
            {
              breakpoint: 1199,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: true,
                arrows:false
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows:false
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows:false
              }
            },
          ]
       
    });


    $('.btn-number').click(function(e){
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });

    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('.gallery-grid').isotope({
        itemSelector: '.gallery-grid-item',
        percentPosition: true,
        masonry: {
            columnWidth: '.gallery-grid-sizer'


        }
    });
    $.fancybox.defaults.animationEffect = "zoom-in-out";
    $.fancybox.defaults.transitionEffect = "zoom-in-out";

    $("#google_translate_element").click(function(e){
        e.stopPropagation();
    });

    // Image zoom effect
    $('.img-zoom').zoom();


    // quantity change js
    $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
    $('.pro-qty').append('<span class="inc qtybtn">+</span>');
    $('.qtybtn').on('click', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });



    // overview slider
    $('.as_about_slider').slick({
        infinite:true,
        speed:800,
        dots:true,
        arrows:false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000
    });
    // overview slider
    $('.as_overview_slider').slick({
        infinite:true,
        speed:800,
        dots:true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        prevArrow:'<button type="button" class="slick-prev as_btn"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="12" height="16" viewBox="0 0 12 16"> <path d="M12.003,15.996 L-0.000,7.997 L12.002,-0.001 L10.062,7.997 L12.003,15.996 ZM10.102,2.762 L2.246,7.997 L10.102,13.233 L8.832,7.997 L10.102,2.762 ZM3.824,7.997 L8.256,5.043 L7.539,7.997 L8.256,10.951 L3.824,7.997 Z" class="cls-1"/> </svg></span> Prev</button>',
        nextArrow:'<button type="button" class="slick-next as_btn">next <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="12" viewBox="0 0 8 12"><path d="M8.000,5.998 L-0.002,11.997 L1.292,5.998 L-0.002,-0.001 L8.000,5.998 ZM1.265,9.924 L6.502,5.998 L1.265,2.071 L2.112,5.998 L1.265,9.924 ZM5.451,5.998 L2.496,8.213 L2.974,5.998 L2.496,3.783 L5.451,5.998 Z" class="cls-1"/> </svg></span></button>' ,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                arrows:false
              }
            },
          ]
    });
    //  shop single slider
    $('.as_shopsingle_for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite:true,
        speed:800,
        arrows: false,
        fade: true,
        asNavFor: '.as_shopsingle_nav'
    });
    $('.as_shopsingle_nav').slick({
      slidesToShow: 4,
      arrows: false,
      slidesToScroll: 1,
      asNavFor: '.as_shopsingle_for',
      dots: false,
      centerMode: true,
      focusOnSelect: true
    });
    // card slider
    $('.as_card_slider').slick({
        infinite:true,
        speed:800,
        dots:false,
        arrows:false,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }
        ]
    });
    
    // datepicker
    $('.as_datepicker').datepicker({
        language: 'en'
    });

    // timepicker
    $('.as_timepicker').datepicker({
        dateFormat: ' ',
        timepicker: true,
        classes: 'only-timepicker',
        language: 'en' 
    });



    // countTo
    $('.as_number>span>span').countTo();
    
    // search popup
    $('.as_search').on('click', function(){
        $(this).parent().find('.as_search_boxpopup').addClass('popup_open');
    })
    $('.as_cancel').on('click', function(){
        $(this).parent().removeClass('popup_open');
    })

    // menu toggle
    $('.as_toggle').on('click',function(){
        $(this).parent().toggleClass('menu_open');
        $(this).parent().find('.as_menu ul  li .as_submenu').parent().addClass('as_submenu_li')
    })
    // responsive menu
    $(document).on('click','.as_menu > ul > li >a',function(){
      // console.log($(this).closest('li').find('ul.submenu'))
      $('.as_menu >ul > li>.as_submenu').removeClass('active');
      $(this).closest('li').find('>ul.as_submenu').addClass('active')
    })
    $(document).on('click','.as_menu > ul > li > ul > li >a',function(){
      // console.log($(this).closest('li').find('ul.submenu'))
      $(this).closest('li').find('>ul.as_submenu').toggleClass('active')
    })

    // cart box
    $('.as_cart_wrapper').on('click',function(){
        $(this).parent().toggleClass('cart_open');
    })

    // login popup
    $('.as_signup').on('click',function(){
      $(this).closest('.modal-body').find('.as_login_box').removeClass('active');
      $(this).closest('.modal-body').find('.as_signup_box').addClass('active');
      $(this).closest('.modal-content').find('.modal-title').text('Sign Up');
    })
    $('.as_login').on('click',function(){
      $(this).closest('.modal-body').find('.as_login_box').addClass('active');
      $(this).closest('.modal-body').find('.as_signup_box').removeClass('active');
      $(this).closest('.modal-content').find('.modal-title').text('Login');
    })

    if($('.as_select_box').length){
      $(".as_select_box select").select2({
          placeholder: 'data-placeholder',
          allowClear: true
      });
  }
    // circle
    if($('.as_progressbar').length){
      $(".as_progressbar.p1").circularProgress({
          color:'#ff7010',
          starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
          percent: 0, // percent starts from
          percentage: true,
      }).circularProgress('animate', 45, 5000);
      $(".as_progressbar.p2").circularProgress({
          color:'#ff7010',
          starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
          percent: 0, // percent starts from
          percentage: true,
      }).circularProgress('animate', 94, 5000);
      $(".as_progressbar.p3").circularProgress({
          color:'#ff7010',
          starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
          percent: 0, // percent starts from
          percentage: true,
      }).circularProgress('animate', 84, 5000);
      $(".as_progressbar.p4").circularProgress({
          color:'#ff7010',
          starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
          percent: 0, // percent starts from
          percentage: true,
      }).circularProgress('animate', 64, 5000);
      $(".as_progressbar.p5").circularProgress({
          color:'#ff7010',
          starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
          percent: 0, // percent starts from
          percentage: true,
      }).circularProgress('animate', 76, 5000);
   }

  // step
  $(document).on('click','.checkout_wrapper_box .next',function(){
    var targetNum = $(this).attr('data-step');
    $(this).closest('.checkout_wrapper_box').find('.step').css('display','none');
    $(this).closest('.checkout_wrapper_box').find('[data-target="'+targetNum+'"]').css('display','block');
    $(this).closest('.checkout_wrapper_box').find('[data-active="'+targetNum+'"]').addClass('active');
    // $(this).cloasest('.checkout_wrapper_box').find('data-target="'+targetNum+'"').css('display','block');
  })

  // number increase
  $('.quantity .plus').on('click', function(){
    var num = parseInt($('.quantity').find('input').val())+1; 
    $(this).closest('.quantity').find('input').val(num);
  }) 
  $('.quantity .minus').on('click', function(){
    var num = parseInt($('.quantity').find('input').val())-1; 
    $(this).closest('.quantity').find('input').val(num);
  }) 

  

  
  
})
$(window).on('load',function(){
    $('.as_loader').addClass('hide')
})