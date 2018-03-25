(function($){

	$(document).ready(function() {
		'use strict';

		if($('#sb-search').length > 0){
			new UISearch( document.getElementById( 'sb-search' ) );	
		}

		function woo_drop_down (){
			/* WOO COMMERCE Cart */
			var $cartBtn = $('.cart-trigger'),
			$cartDropdown = $('.cart-trigger').find('.woo-cart-dropdown');

			if($cartBtn.length > 0 && $cartDropdown.length > 0){

				$cartBtn.mouseover(function(){
					$(this).find('.woo-cart-dropdown').stop().fadeIn();
				}).mouseout(function(){
					$(this).find('.woo-cart-dropdown').stop().fadeOut();
				});

			}
		}

		woo_drop_down ();

		var seconds = new Date().getTime() / 1000;

		if($(".clock").length > 0){
			var clock = $('.clock'),
			time = clock.data('eventtimer'),
			color = clock.data('color');
			console.log(time);
			$('.clock').final_countdown({

				'start': undefined,
				'end': time,
				'now': seconds,

				seconds: {
					borderColor: color,
					borderWidth: '5'
				},
				minutes: {
					borderColor: color,
					borderWidth: '5'
				},
				hours: {
					borderColor: color,
					borderWidth: '5'
				},
				days: {
					borderColor: color,
					borderWidth: '5'
				}

			});

		}	


		//Affix Navigation	
		if($(".main-header").length > 0){			
			$('.main-header').affix({
				offset: {
					top: 50
				}
			});
		}




		if($(".tabs").length > 0){
			$(".tabs").tabs();
		}

		if($("#speakers-tabs").length > 0){
			$('#speakers-tabs').easyResponsiveTabs({
		        type: 'default', //Types: default, vertical, accordion           
		        width: 'auto', //auto or any width like 600px
		        fit: true,   // 100% fit in a container
		        closed: 'accordion', // Start closed if in accordion view
		        activate: function(event) { // Callback function if tab is switched
		        	var $tab = $(this);
		        	var $info = $('#tabInfo');
		        	var $name = $('span', $info);

		        	$name.text($tab.text());

		        	$info.show();
		        }
		        
		    });
		}

		if($(".owl-team").length > 0){ 
			$('.owl-team').owlCarousel({
				loop:true,
				items:3,
				navigation:true,
				margin:20,
				navigationText:[" "," "],
				navSpeed:100,
				responsiveClass:true,
				responsive:{
					320:{
						items:1
					},  
					500:{
						items:1
					},
					782:{
						items:2
					},	
					991:{
						items:3
					},
					1170:{
						items:3
					}
				}
			});
		}

		if($(".owl-sponsored").length > 0){ 
			$('.owl-sponsored').owlCarousel({
				loop:true,
				items:4,
				navigation:true,
				navigationText:[" "," "],
				navSpeed:100,
				responsiveClass:true,
				responsive:{
					320:{
						items:2
					}, 
					480:{
						items:3
					},
					782:{
						items:3
					},	
					991:{
						items:4
					},

					1170:{
						items:5
					}
				}
			});
		}


		if($(".owl-testimonial").length > 0){ 
			$('.owl-testimonial').owlCarousel({
				loop:true,
				items:1,
				autoPlay:true,
				navSpeed:100,
				responsiveClass:true,
				responsive:{
					1170:{
						items:1
					}
				}
			});
			
		}

		if($(".owl-carousel-banner").length > 0){ 
			$('.owl-carousel-banner').owlCarousel({
				loop:true,	
				items:1,
				nav:true,
				navText:['',''],
				responsiveClass:true,
				navSpeed:100,

			})
		}


		/*
		===============
		 * EVENT SORT *
		===============
		*/

		if($(".sortSubmit").length > 0){ 
			$(".sortSubmit").on('change',function () {
				sortformSubmit();
			});
		}

		var $sort_method = $(".sort_method"),
		$icon = $(".sort_method").find('i'),
		$sort_method_input = $icon.parents('.sort_method_con').find('input'),
		$sort_style_con = $('#sort_style_con'),
		$sort_style = $('.sort_style'),
		$sort_style_input = $sort_style_con.find('input');

		

		$sort_method.on('click',function () {

			var $sort_method_val = $sort_method_input.val();

			if($sort_method_val == 'asc'){
				$sort_method_input.val('desc');
			}
			if($sort_method_val == 'desc'){
				$sort_method_input.val('asc');
			}

			sortformSubmit();

		});


		$('.itemgrid .col-md-12').addClass('col-md-4').removeClass('col-md-12');
		$('.checkcolumn.itemgrid .col-md-4').addClass('col-md-3').removeClass('col-md-4');
		$('.itemlist .col-md-4').addClass('col-md-12').removeClass('col-md-4');
		$('.itemlist .col-md-3').addClass('col-md-12').removeClass('col-md-3');


		$sort_style.on('click',function () {

			var $sort_style_val = $sort_style_input.val();

			$(this).addClass('active');
			$(this).siblings().removeClass('active');

			if($sort_style_val == 'grid'){
				$sort_style_input.val('list');
				$('.grid-list').addClass('itemlist');
				$('.grid-list').removeClass('itemgrid');
				$('.itemlist .col-md-4').addClass('col-md-12').removeClass('col-md-4');
				$('.itemlist .col-md-3').addClass('col-md-12').removeClass('col-md-3');
			}
			if($sort_style_val == 'list'){
				$sort_style_input.val('grid');
				$('.grid-list').addClass('itemgrid');
				$('.grid-list').removeClass('itemlist');
				$('.itemgrid .col-md-12').addClass('col-md-4').removeClass('col-md-12');
				$('.checkcolumn.itemgrid .col-md-4').addClass('col-md-3').removeClass('col-md-4');
			}
		});

		function sortformSubmit(){
			$('#sort_form').submit();
		}

		/*
		===================
		 * DROP DOWN MENU *
		===================
		*/

		$('.main-nav li').has('ul').find('ul').after('<span class="arrow closed"></span>');

		var windowWidth = $( window ).width();
		
		$( window ).resize(function() {
	  		var windowWidth = $( window ).width();  		
		});

		window.menuoff = 0;

		if(windowWidth > 991){
			mouseOver('on');
		}
		else{
			mouseOver('off');
			if(window.menuoff == 0){
				mouseClick();
			}
		}

		

		$( window ).resize(function() {
	  		var windowWidth = $( window ).width();
			
	  		if(windowWidth > 991){
	  			mouseOver('on');
	  		}
	  		else{
	  			mouseOver('off');
	  			if(window.menuoff == 0){
	  				mouseClick();
	  			}
	  			
	  		}  		
	  		
		});

		function mouseOver(action){

			if(action == 'on'){
				$('.main-nav li.pix-submenu,.main-nav li.pix-submenu .sub-menu li, .main-nav li.pix-megamenu').on('mouseover', function() {
				    $(this).find('a').addClass('current');
				    $(this).children('ul').stop().slideDown(400);
				});
				$('.main-nav li.pix-submenu,.main-nav li.pix-submenu .sub-menu li, .main-nav li.pix-megamenu').on('mouseleave', function() {
				    $(this).find('a').removeClass('current');
				    $(this).children('ul').stop().slideUp(400);
				});
			}
			else{
				$('.main-nav li.pix-submenu,.main-nav li.pix-submenu .sub-menu li, .main-nav li.pix-megamenu').off('mouseover');
				$('.main-nav li.pix-submenu,.main-nav li.pix-submenu .sub-menu li, .main-nav li.pix-megamenu').off('mouseleave');
			}
		}

		function mouseClick(){

			$('.arrow').on('click',function(event){

				if ( $(this).hasClass("closed") ) {
					$(this).parent('li').find('a').addClass('current');
					$(this).prev().slideDown(400);
					$(this).addClass('opened').removeClass('closed');
				}
				else{
					$(this).parent('li').find('a').removeClass('current');
					$(this).prev().slideUp(400);
					$(this).addClass('closed').removeClass('opened');
				}

				window.menuoff = 1;

				event.stopPropagation();
				
			});
		}


		$(".mobile-menu-icon").click(function(){

			$('.mobile-menu ul.nav').slideToggle(400);

		});

		// Log in and Registration Pop up
		$('.signupBtn').on('click', function(e) {
			console.log('clicked');
			e.preventDefault();
			$('#overlayBg').addClass('overlay');

			var type = $(this).data('type');

			$('.popupform').removeClass('not-visible');

			if(type == 'login') {
				$('.popupform').removeClass('Twocolumn');
				$('.login-form').slideDown(500);
				$('.register-form').slideUp(0);

			}
			else {
				$('.popupform').addClass('Twocolumn');
				$('.register-form').slideDown(500);
				$('.login-form').slideUp(0);        
			}
		});

		$('#overlayBg').on('click', function(event) {
			event.preventDefault();
			$('#overlayBg').removeClass('overlay');
			$('.popupform').addClass('not-visible');
			$('.login-form').slideUp(500);
			$('.register-form').slideUp(500);
		});



		/*datetimepicker8*/
		$('.open').click(function(){
			$('.date_timepicker_start').datetimepicker('show');
		})

		$('.end').click(function(){
			$('.date_timepicker_end').datetimepicker('show');
		})

		$(function(){
			$('.date_timepicker_start').datetimepicker({
				format:'d/m/Y',
				onShow:function( ct ){
					this.setOptions({
						maxDate:$('.date_timepicker_end').val()?$('.date_timepicker_end').val():false
					})
				},

				timepicker:false
			});

			$('.date_timepicker_end').datetimepicker({
				format:'d/m/Y',
				onShow:function( ct ){
					this.setOptions({
						minDate:$('.date_timepicker_start').val()?$('.date_timepicker_start').val():false
					})
				},
				timepicker:false
			});
		});


		/*map*/
		if($("#contact-map").length > 0){
			$("#contact-map").gmap3({
				marker:{
					latLng: [46.578498,2.457275],
					options:{
						draggable:true
					},
					events:{
						dragend: function(marker){
							$(this).gmap3({
								getaddress:{
									latLng:marker.getPosition(),
									callback:function(results){
										var map = $(this).gmap3("get"),
										infowindow = $(this).gmap3({get:"infowindow"}),
										content = results && results[1] ? results && results[1].formatted_address : "no address";
										if (infowindow){
											infowindow.open(map, marker);
											infowindow.setContent(content);
										} else {
											$(this).gmap3({
												infowindow:{
													anchor:marker, 
													options:{content: content}
												}
											});
										}
									}
								}
							});
						}
					}
				},
				map:{
					options:{
						zoom: 5
					}
				}
			});
		}


		// validate form on keyup and submit
		if($("#contactform").length > 0){
			$("#contactform").validate({
				rules: {
					contactname: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true
					},
					subject: {
						required: true,
						minlength: 2
					},
					message: {
						required: true,
						minlength: 10
					}
				},
				messages: {
					contactname: {
						required: "Please enter your name",
						minlength: jQuery.format("Your name needs to be at least {0} characters")
					},
					email: {
						required: "Please enter a valid email address",
						minlength: "Please enter a valid email address"
					},
					subject: {
						required: "You need to enter a subject!",
						minlength: jQuery.format("Enter at least {0} characters")
					},
					message: {
						required: "You need to enter a message!",
						minlength: jQuery.format("Enter at least {0} characters")
					}
				},
				// set this class to error-labels to indicate valid fields
				success: function(label) {
					label.addClass("checked");
				},
				submitHandler: function() {
					$('#contactform').prepend('<p class="loaderIcon"><img src="img/ajax-loader.gif" alt="Loading..."></p>');
					var name = $('input#contactname').val();
					var email = $('input#email').val();
					var subject = $('input#subject').val();
					var message = $('textarea#message').val();

					$.ajax({
						type: 'post',
						url: 'sendMail.php',
						data: 'contactname=' + name + '&email=' + email + '&subject=' + subject + '&message=' + message,
						success: function(results) {
							$('#contactform p.loaderIcon').fadeOut(1000);
							$('#contactform div.response').html(results);
						}
					});	

					$(':input','#contactform').not(':button, :submit, :reset, :hidden').val('');

				}
			});
		}

		/*slider-range*/
		if($("#slider-range").length > 0){
			$( "#slider-range" ).slider({
				range: true,
				min: 0,
				max: 100000,
				values: [ 20000, 90000],
				slide: function( event, ui ) {
					$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
				}
			});
			$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
				" - $" + $( "#slider-range" ).slider( "values", 1 ) );
		}

	});


	$(window).on('load', function() {

		var countdowntime = $('.timer').data('countdown');
		var nextYear = countdowntime,
		template = _.template($('#upcoming-events-template').html()),
		currDate = '00:00:00:00',
		nextDate = '00:00:00:00',
		parser = /([0-9]{2})/gi;

	    // Parse countdown string to an object		    
	    function strfobj(str) {
	    	var parsed = str.match(parser),
	    	obj = {};
	    	obj['days'] = parsed[0];
	    	obj['hours'] = parsed[1];
	    	obj['minutes'] = parsed[2];
	    	obj['seconds'] = parsed[3];
	    	return obj;
	    }

	    // Return the time components that diffs
	    function diff(obj1, obj2) {
	    	var diff = [];
	    	['days', 'hours', 'minutes', 'seconds'].forEach(function(key) {
	    		if (obj1[key] !== obj2[key]) {
	    			diff.push('.' + key);
	    		}
	    	});
	    	return diff;
	    }


	    // Starts the countdown
	    if($('#upcoming-events').length > 0){	

		    $('#upcoming-events').countdown(nextYear, function(event) {
		    	var newDate = event.strftime('%D:%H:%M:%S'),
		    	data, $countdown;
		    	if (newDate !== nextDate) {
		    		$countdown = $(this);
		    		currDate = nextDate;
		    		nextDate = newDate;
			        // Setup the data
			        data = {
			        	'curr': strfobj(currDate),
			        	'next': strfobj(nextDate)
			        };
			        // Update the template
			        $countdown.html(template(data));
			        // Delay this function to after this callback
			        _.delay(function() {
			        	$countdown.find(diff(data.curr, data.next).join(', '))
			        	.addClass('animate')
			        }, 1);
		    	}
			});
		}

	});


	//video
	if($("audio,video").length > 0){	
		$('audio,video').mediaelementplayer({
			success: function(player, node) {
				$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
			}
		});
	}

	
})(jQuery);

