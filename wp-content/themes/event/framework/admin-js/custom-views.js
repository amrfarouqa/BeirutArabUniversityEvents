(function($){

	function pix_vc_front_animate($elem){
	
		var $singleElement = $elem;

		// Get data-attr from element
		var animateTrans = $singleElement.data('trans') ? $singleElement.data('trans') : 'fadeIn';
		var animateDelay = $singleElement.data('delay') ? $singleElement.data('delay') : '';
		var animateDuration = $singleElement.data('duration') ? $singleElement.data('duration') : '';

		if(animateDelay != ''){
			$singleElement.css('animation-delay', animateDelay);
		}

		if(animateDuration != ''){
			$singleElement.css('animation-duration', animateDuration);
		}

		$singleElement.css('opacity','1').addClass('animated '+ animateTrans);
					

	}
	

	//Staffs
	window.InlineShortcodeView_staffs = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_staffs.__super__.render.call(this);
			var $placeholder = this.$el.find('.owl-carousel');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.owlCarousel({
					navigationText: false
				});
			});
			return this;
		}
	});

	//Blog
	window.InlineShortcodeView_blog = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_blog.__super__.render.call(this);
			var $placeholder = this.$el.find('.pix-recent-blog-posts.owl-carousel');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.owlCarousel({
					navigationText: false
				});
			});
			return this;
		}
	});

	//Button
	window.InlineShortcodeView_button = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_button.__super__.render.call(this);
			var $placeholder = this.$el.find('.pix-animate-cre');
			vc.frame_window.vc_iframe.addActivity(function(){
				pix_vc_front_animate($placeholder);
			});
			return this;
		}
	});

	//callout_box
	window.InlineShortcodeView_callout_box = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_callout_box.__super__.render.call(this);
			var $placeholder = this.$el.find('.pix-animate-cre');
			vc.frame_window.vc_iframe.addActivity(function(){
				pix_vc_front_animate($placeholder);
			});
			return this;
		}
	});

	//clients
	window.InlineShortcodeView_clients = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_clients.__super__.render.call(this);
			var $placeholder = this.$el.find('.owl-carousel');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.owlCarousel({
					navigationText: false
				});
			});
			return this;
		}
	});

	//counter
	window.InlineShortcodeView_counter = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_counter.__super__.render.call(this);
			var $placeholder = this.$el.find('.counter-value');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.counterUp({
					delay: 10,
					time: 1000
				});
			});
			return this;
		}
	});

	//IconBox
	window.InlineShortcodeView_icon_box = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_icon_box.__super__.render.call(this);
			var $placeholder = this.$el.find('.pix-animate-cre');
			vc.frame_window.vc_iframe.addActivity(function(){
				pix_vc_front_animate($placeholder);
			});
			return this;
		}
	});

	//Pie Chart
	window.InlineShortcodeView_pie_chart = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_pie_chart.__super__.render.call(this);
			var $pix_chart = this.$el.find('.pix-chart');
			vc.frame_window.vc_iframe.addActivity(function(){
				/* Pie Chart Used in Skills */
				$pix_chart.width($pix_chart.data('size')).height($pix_chart.data('size')).css('line-height', $pix_chart.data('size') +'px');

				//console.log($pix_chart);
				//console.log('Pie Front Triggered');

					$pix_chart.easyPieChart({  
						onStart: function(from, to){
							var canvas = $(this.el).find('canvas'),
								size = canvas.width(),
								$border = $(this.el).find('.border-bg'), 
								$bg = $(this.el).find('.bg'),
								$pix_chart = $(this.el);

							$pix_chart.css({
								'line-height': (size) +'px',
								'height': (size) +'px',
								'width': (size) +'px'
							});

						},      
						onStep: function(from, to, percent) {
							$(this.el).find('.percent-text').text(Math.round(percent));
						}
					});


			});
			return this;
		}
	});	

	//portfolio
	window.InlineShortcodeView_portfolio = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_portfolio.__super__.render.call(this);
			var $container = this.$el.find('.portfolio-contents'),
				$portExtend = this.$el.find('#portfolio-page.container-extend'),
				$masonryContainer = this.$el.find('.isotopeCon'), 
				$filterCon = this.$el.find("#filters"),
				$filterLink = this.$el.find('#filters a'),
				$owlCarousel = this.$el.find('.owl-carousel');

			vc.frame_window.vc_iframe.addActivity(function(){

				if($owlCarousel.length > 0){
					$owlCarousel.owlCarousel({
						navigationText: false
					});
				}
				else{
					$(window).load(function() {
						if($portExtend.length > 0 ){
							$portExtend.css('max-width', $(window).width());
						}

						$container.isotope({
							itemSelector : '.element',
							masonry : {
								columnWidth : 1
							}
						});

						$masonryContainer.isotope({
							itemSelector : '.element',
							masonry : {
								columnWidth : 1
							}
						});

						if($filterCon.hasClass('dropdown')){
							$filterCon.find('.selected').parent('li').css('display', 'none');
						}
						
						/* Portfolio Filter - Dropdown Style */
						$('.top-active').on('click', function(e) {
							e.preventDefault();
							
							$(this).next('#filters').slideToggle('400');

						});

						// filter items when filter link is clicked
						$filterLink.click(function(){
							var $this = $(this),
								$filter = $this.parents('#filters');

							if($filter.hasClass('dropdown')){
								$filter.slideUp(400, function(){
									$this.parent('li').css('display', 'none');
									$this.parent('li').siblings().css('display', 'block');
								});
								$filter.prev('.top-active').find('.txt').text($this.text());
							}

							// don't proceed if already selected
							if ( $this.hasClass('selected') ) {
								return false;
							}
							
							var $optionSet = $this.parents('.option-set');
							$optionSet.find('.selected').removeClass('selected');
							$this.addClass('selected');

							var selector = $(this).attr('data-filter');
							$container.isotope({ filter: selector });
							$masonryContainer.isotope({ filter: selector });
							return false;
						});	
					});					
				}		
				
			});
			return this;
		}
	});

	//Testimonial
	window.InlineShortcodeView_testimonial = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_testimonial.__super__.render.call(this);
			var $placeholder = this.$el.find('.owl-carousel');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.owlCarousel({
					navigationText: false
				});
			});
			return this;
		}
	});

	//Tweets
	window.InlineShortcodeView_tweets = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_tweets.__super__.render.call(this);
			var $placeholder = this.$el.find('.owl-carousel');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.owlCarousel({
					navigationText: false
				});
			});
			return this;
		}
	});

	//video popup
	window.InlineShortcodeView_video_popup = window.InlineShortcodeView.extend({
		render: function() {
			window.InlineShortcodeView_video_popup.__super__.render.call(this);
			var $placeholder = this.$el.find('.popup-video');
			vc.frame_window.vc_iframe.addActivity(function(){
				$placeholder.magnificPopup({
					disableOn: 700,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: true
				});
			});
			return this;
		}
	});

})(jQuery);