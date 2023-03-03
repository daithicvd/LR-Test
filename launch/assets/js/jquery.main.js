jQuery(document).ready(function($) {

  // onload
  if(document.body.clientWidth > 1024) {
    $('video').attr('autoplay', true);
  }

  // If you want to autoplay when the window is resized wider than 780px 
  // after load, you can add this:

  $(window).resize(function() {
    if(document.body.clientWidth > 1024) {
      $('video').attr('autoplay', true);
    }
  });

	function removeIOSRubberEffect( element ) {

		element.addEventListener( "touchstart", function () {
	
			var top = element.scrollTop, totalScroll = element.scrollHeight, currentScroll = top + element.offsetHeight;
	
			if ( top === 0 ) {
				element.scrollTop = 1;
			} else if ( currentScroll === totalScroll ) {
				element.scrollTop = top - 1;
			}
	
		} );
	
	}
	
	removeIOSRubberEffect( document.querySelector( ".nav" ) );

	// Clear Inputs
	clearInputs();
	equalHeight();
    addSelectPlaceholder();
    function addSelectPlaceholder (){
        if ($('.contact-form .work_type').length) {
            $('.work_type select').attr('data-placeholder', 'Type of Work');
        }
        if ($('.contact-form .category').length) {
        $('.category select').attr('data-placeholder', 'Job Categories');
        }
    }
	$(document).bind('gform_post_render', function(event, form_id, current_page) {
		clearInputs();
    if (form_id==2) {
      setTimeout(function() {
        if (jQuery('#gform_confirmation_message_2').length) {
          jQuery('html, body').animate({
              scrollTop: jQuery("#gform_confirmation_message_2").offset().top - 80
          }, 500);          
        }
      }, 500);
    }
	});
    $(window).on('load', function() { 
        if ($('.main-h').height() > 0) {
            sameHeight();
        }
    });
	/*if($('.video-background').length) {
		$('.video-background').load(function(){
			setTimeout(function() {
        jQuery('.video-background').css('opacity', '1');
        jQuery('span#grey-overlay').fadeOut(1000);
			}, 2000);
		});
	}
  else if ($('span#grey-overlay').length) {
      setTimeout(function() {
        jQuery('span#grey-overlay').fadeOut(1000);
      }, 1000);
  }*/
  
	/*$(window).on('resize', function () {
	  $('iframe').each(function () {
		this.contentWindow.location.reload();
	  });
	});*/
  
	jQuery(window).resize(function() { 
        equalHeight();
    });
    $(document).bind('gform_post_render', function(){
        if ($('select').length) {
            addSelectPlaceholder();
            $("select").not(".defaultSelect").multipleSelect({
                width: '100%',
                multiple: true,
                multipleWidth: false
            });
        }
        if ($('input[type=file]').length && !$('.file-upload-wrapper').length) {
            $('input[type=file]').customFile();
        }
    });
    if ($('.scrollbar').length) {
        $(".scrollbar").mCustomScrollbar({
            theme:"minimal"
        });
    }
    if ($('select').length) {
        $("select").not(".defaultSelect").multipleSelect({
            width: '100%',
            multiple: true,
            multipleWidth: false
        });
    }
    $('.values-tabs a').on('click', function() {
        var parentContainer = $(this).closest('.values-tabs')
        if (!parentContainer.is('.mobile')) {
            var target = $(this).data('target'),
                targetContent = $('#' + target);
            $('.values-tabs a').removeClass('active');
            $('.values-content .content').removeClass('active');
            $(this).addClass('active');
            targetContent.addClass('active');
            sameHeight();
        } else {
            $(this).toggleClass('active');
            $(this).siblings('.values-content').toggleClass('active');
        }
	});
	
    jQuery('.menu-item-has-children').each(function(){
        var menu = jQuery(this).find('.sub-menu');
        var menuText = jQuery(this).children('a').text();
        jQuery(this).prepend('<button type="button">></button>');
        menu.prepend('<div class="header"></div>');
        jQuery(this).find('.header').html(menuText);
    });
    /*Sliders*/
    $(".clients-slider").slick({
        dots: false,
        infinite: true,
        centerMode: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
        {
          breakpoint: 1245,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    $(".testimonial-slider").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $(".awards-slider").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 1,
		asNavFor: '.awards-image-slider'
    });
    $(".awards-image-slider").slick({
        dots: false,
        infinite: true,
        centerMode: true,
		asNavFor: '.awards-slider',
		arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.menu-button').on('click', function() {
		if ($('.main-container').is('.st-menu-open')) {
      $('.main-container').removeClass('st-menu-open');
			$('body').removeClass('popup-open');
		} else {
      $('.main-container').addClass('st-menu-open');
			$('body').addClass('popup-open');
		}
        $('.sub-menu').css('display','none');
    }); 
	$('.specialisations-list article').on('touchstart', function(e) {
		$(this).toggleClass('hover');
		e.stopPropagation();
	});
  $('button.mobile.done').on('click', function() {
    var popup = $(this).parent();
    popup.removeClass('open');
    $('body').css('overflow', '');
    $('body').removeClass('filter-open');
     $('body').removeClass('disable-scrolling');
  });
	$(document).on('click touchstart', function(e) {
	  if (!$(e.target).closest(".menu-button").length && !$(e.target).closest(".nav").length) {
			$('.main-container').removeClass('st-menu-open');
			$('body').removeClass('popup-open');
	  }
	  e.stopPropagation();
	});
	var jump = 10;
	window.scrollHeight = 0;
	$(window).scroll(function () {
		if ($(window).scrollTop() <= 0) {
			$('.header-fixed').css({
				'display':'none',
			});
			$('.pusher').css('padding', '0');
		}
		else if ($(window).scrollTop() <= 68) {
			if ($(window).outerWidth() > 767) {
				var sidePadding = $(this).scrollTop() / 2.8;
			} else {
				var sidePadding = 0;
			}
			$('.header-fixed').css({
				'height': $(this).scrollTop() + 'px',
				'display':'block',
				});
			$('.pusher').css('padding', '0 ' + sidePadding + 'px');
			
		} else {
			if ($(window).outerWidth() > 767) {
				$('.pusher').css('padding', '0 25px 25px');
			} else {
				$('.pusher').css('padding', '0');
			}
			$('.header-fixed').css({
				'height':'69px',
				'display':'block',
			});
		}
		$('.main-header').css('top', $(window).scrollTop());
    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
    } else {  
       $('.search-filter.mobile.clearer-block').css('margin-top', $(window).scrollTop()); // new code
    }
		if ($(window).scrollTop() > 150) {
			$('.button-top').fadeIn('slow');
		} else {
			$('.button-top').fadeOut('slow');
		}
	});   
	if ($(window).scrollTop() > 69) {
		$('.main-header').css('top', $(window).scrollTop());
    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
    } else {  
       $('.search-filter.mobile.clearer-block').css('margin-top', $(window).scrollTop()); // new code
    }
    $('.header-fixed').css({
			'height':'69px',
			'display':'block',
		});
		if ($(window).outerWidth() > 767) {
			$('.pusher').css('padding', '0 25px 25px');
		} else {
			$('.pusher').css('padding', '0');
		}
	}
	if ($(window).scrollTop() > 150) {
		$('.button-top').fadeIn('slow');
	} else {
		$('.button-top').hide();
	}
	$('.button-top').click(function() {
		$('html,body').animate({scrollTop:0}, 1000);
	});
    $('.deselect button').on('click', function() {
      $('.search-filter input[type="checkbox"]').prop('checked', false);
      $('.search-filter .multiple').removeClass('selected');
    });
    $('.menu-item-has-children button').on('click', function() {
        var parentLI = $(this).parent('li');
        var menu = parentLI.find('.sub-menu');
        menu.css('display','block');
        menu.animate({right: "0px"}, 300);
    });
    $('.sub-menu .header').on('click', function() {
        var menu = $(this).parent('.sub-menu');
        menu.animate({right: "-100%"}, 300, function () {
			menu.css('display','none');
		});
    });
    $('.filter-btn').on('click', function() {
        var searchFilter = $('.search-filter');
        searchFilter.addClass('open');
        $('body').css('overflow', 'hidden');
        $('body').addClass('filter-open');
        $('body').addClass('disable-scrolling');
    });
    $('.close').on('click', function() {
        var popup = $(this).parent();
        popup.removeClass('open');
        $('body').css('overflow', '');
        $('body').removeClass('filter-open');
        $('body').removeClass('disable-scrolling');
    });
	
	document.ontouchmove = function ( event ) {

		var isTouchMoveAllowed = true, target = event.target;
	
		while ( target !== null ) {
			if ( target.classList && target.classList.contains( 'disable-scrolling' ) ) {
				isTouchMoveAllowed = false;
				break;
			}
			target = target.parentNode;
		}
	
		if ( !isTouchMoveAllowed ) {
			event.preventDefault();
		}
	
	};
	
	$('.menu-dropdown .special-menu-dropdown.menu-item-has-children>button').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).closest('.special-menu-dropdown').toggleClass('opened');
	});
	
	
	jobFilter();
});
/*--- ---*/
function jobFilter(){
	var cat_sel = jQuery('#category-select');
	var s_cat_sel = jQuery('#type-select');
	if(cat_sel.length && s_cat_sel.length){
		var s_cat_items = s_cat_sel.find('option').clone();
		
		cat_sel.change(function(){
			s_cat_items.removeAttr('selected');
			upList();
		});
		upList();
	}
	function upList(){
		var val_list = cat_sel.val();
		var s_items = s_cat_items.clone();
		if(val_list){
			s_items = s_items.filter(function(){
				return jQuery.inArray(jQuery(this).data('cat'), val_list) != -1;
			});
		}
		jQuery('#type-select').html(s_items).multipleSelect('refresh');
	}
}

/*---- clear inputs ---*/
function clearInputs(){
	jQuery('input:text,input:password,textarea').each(function(){
		var _el = jQuery(this);
		_el.data('val', _el.val());
		_el.bind('focus', function(){
			if(_el.val() == _el.data('val')) _el.val('');
		}).bind('blur', function(){
			if(_el.val() == '') _el.val(_el.data('val'));
		});
	});
}
function subHeader(){
    jQuery('.menu-item-has-children').each(function(){
        var menu = jQuery(this).find('.sub-menu');
        var menuText = jQuery(this).children('a').text();
        jQuery(this).prepend('<button type="button">></button>');
        menu.prepend('<div class="header"></div>');
        jQuery('.sub-menu .header').html(menuText);
    });
}
function sameHeight(){
    jQuery('.main-h').each(function(){
        var mainH = jQuery(this).outerHeight();
        var sameH = jQuery(this).siblings('.same-h');
        sameH.css('height', mainH);
    });
}
function equalHeight(){
    if (jQuery('.resources').length) {
		if (jQuery(window).outerWidth() > 767) {
			jQuery('.resources .block').css('height', '');
			var highestBox = 0;
			jQuery('.resources .block').each(function(){  
					if(jQuery(this).height() > highestBox){  
					highestBox = jQuery(this).height();  
				}
			});    
			jQuery('.resources .block').height(highestBox);
		} else {
			jQuery('.resources .block').css('height', '');
		}
		
	}
}
/*Custom file button*/
(function($) {

      // Browser supports HTML5 multiple file?
      var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
          isIE = /msie/i.test( navigator.userAgent );

      $.fn.customFile = function() {

        return this.each(function() {

          var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
              $wrap = $('<div class="file-upload-wrapper">'),
              $input = $('<input type="text" class="file-upload-input" />'),
              // Button that will be used in non-IE browsers
              $button = $('<button type="button" class="file-upload-button">Upload CV</button>'),
              // Hack for IE
              $label = $('<label class="file-upload-button" for="'+ $file[0].id +'">Select a File</label>');

          // Hide by shifting to the left so we
          // can still trigger events
          $file.css({
            position: 'absolute',
            left: '-9999px'
          });

          $wrap.insertAfter( $file )
            .append( $file, $input, ( isIE ? $label : $button ) );

          // Prevent focus
          $file.attr('tabIndex', -1);
          $button.attr('tabIndex', -1);

          $button.click(function () {
            $file.focus().click(); // Open dialog
          });

          $file.change(function() {

            var files = [], fileArr, filename;

            // If multiple is supported then extract
            // all filenames from the file array
            if ( multipleSupport ) {
              fileArr = $file[0].files;
              for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                files.push( fileArr[i].name );
              }
              filename = files.join(', ');

            // If not supported then just take the value
            // and remove the path to just show the filename
            } else {
              filename = $file.val().split('\\').pop();
            }

            $input.val( filename ) // Set the value
              .attr('title', filename) // Show filename in title tootlip
              .focus(); // Regain focus

          });

          $input.on({
            blur: function() { $file.trigger('blur'); },
            keydown: function( e ) {
              if ( e.which === 13 ) { // Enter
                if ( !isIE ) { $file.trigger('click'); }
              } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
                // On some browsers the value is read-only
                // with this trick we remove the old input and add
                // a clean clone with all the original events attached
                $file.replaceWith( $file = $file.clone( true ) );
                $file.trigger('change');
                $input.val('');
              } else if ( e.which === 9 ){ // TAB
                return;
              } else { // All other keys
                return false;
              }
            }
          });

        });

      };

      // Old browser fallback
      if ( !multipleSupport ) {
        $( document ).on('change', 'input.customfile', function() {

          var $this = $(this),
              // Create a unique ID so we
              // can attach the label to the input
              uniqId = 'customfile_'+ (new Date()).getTime(),
              $wrap = $this.parent(),

              // Filter empty input
              $inputs = $wrap.siblings().find('.file-upload-input')
                .filter(function(){ return !this.value }),

              $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

          // 1ms timeout so it runs after all other events
          // that modify the value have triggered
          setTimeout(function() {
            // Add a new input
            if ( $this.val() ) {
              // Check for empty fields to prevent
              // creating new inputs when changing files
              if ( !$inputs.length ) {
                $wrap.after( $file );
                $file.customFile();
              }
            // Remove and reorganize inputs
            } else {
              $inputs.parent().remove();
              // Move the input so it's always last on the list
              $wrap.appendTo( $wrap.parent() );
              $wrap.find('input').focus();
            }
          }, 1);

        });
      }

      // Add & check style mobile
     /* function check_mobile_css(){
        if(window.devicePixelRatio*100 < 125 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            $('#mobile_css').remove();
            var ss = document.createElement("link");
            ss.type = "text/css";
            ss.rel = "stylesheet";
            ss.href = '/launchrec/wp-content/themes/launch/assets/css/mobile-style.css?v=1';
            ss.id = 'mobile_css';
            document.getElementsByTagName("body")[0].appendChild(ss);
        }else{           
            $('#mobile_css').remove();
        }
      }
      check_mobile_css();
      $(window).resize(function(){
          check_mobile_css();
      });*/

      setTimeout(function(){
        // Scroll down home page
        $('.scroll-down img').click(function(){        
            $('html, body').animate({
                scrollTop: $(".launch.table").offset().top - 68
            }, 1100);
        });      
      }, 2000);      

}(jQuery));