<?php 
	global $smof_data;

	get_header();
?>

<?php 
	//Show/Hide single event sub banner
	$s_event_sub_banner = isset($smof_data['s_event_sub_banner']) ? $smof_data['s_event_sub_banner'] : 1;
	if($s_event_sub_banner){
		subBanner(get_the_title());
	}    
?>

	<div class="container newsection">
        <div class="row">

        	<?php

        		//Sidebar Position 
				$sidebar_position = isset($smof_data['s_event_sidebar']) ? $smof_data['s_event_sidebar'] : 'left_sidebar';

				if($sidebar_position == 'full_width'){
					$columns = 'col-md-12';
					$check_column = 'checkcolumn';
				}

				else{
					$columns = 'col-md-9';
					$check_column = '';
				}

	        	//Sidebar

                $s_event_select_sidebar = isset($smof_data['s_event_select_sidebar']) ? $smof_data['s_event_select_sidebar'] : 0;
                $s_event_styles = isset($smof_data['s_event_styles']) ? $smof_data['s_event_styles'] : 'style1';

                if($s_event_styles == 'style2'){
                	$style = 'style-two';
                }
                else{
                	$style = '';
                }
				$s_event_search_filter = isset($smof_data['s_event_search_filter']) ? $smof_data['s_event_search_filter'] : 1;
				$s_event_venue = isset($smof_data['s_event_venue']) ? $smof_data['s_event_venue'] : 1;
				$s_event_counter = isset($smof_data['s_event_counter']) ? $smof_data['s_event_counter'] : 1;
				$s_event_organizer = isset($smof_data['s_event_organizer']) ? $smof_data['s_event_organizer'] : 1;
				$s_event_cart = isset($smof_data['s_event_cart']) ? $smof_data['s_event_cart'] : 1;

				if($sidebar_position == 'left_sidebar'){

					pix_event_detail_sidebar($s_event_select_sidebar , 'event-sidebar', $style, $s_event_search_filter, $s_event_venue , $s_event_counter, $s_event_organizer, $s_event_cart); // Sidebar Name, Default Sidebar, Sidebar Style, Filter, Venue, Counter, Organizer, Cart
				}

        	?>
            <!-- col-md-9 -->
            <div class="<?php echo $columns; ?>">

				<?php

					$event_cpt_ID = $wpdb->get_results("SELECT ID
						FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);


					foreach ( $event_cpt_ID as $value ){
						
						$event_id[] = $value[0];

					}


					if (have_posts()) : while (have_posts()) : the_post();

						if(class_exists('woocommerce')){
			                /**
			                 * woocommerce_before_single_product hook
			                 *
			                 * @hooked wc_print_notices - 10
			                 */
			                 do_action( 'woocommerce_before_single_product' );
			            }

						$event_id = get_the_ID();
						$event_title = get_the_title();
						$event_content = get_the_content();

						$event_details = get_post_meta($event_id,'event_details');
						if( !empty($event_details) && !empty($event_details[0])){
							extract($event_details[0]);
						}


						//Event Date & Event Time
                        $event_date_from = isset($event_date_from) ? $event_date_from : '';
                        $event_time = isset($event_time) ? $event_time : '';

                        $now = time();

                        //YYYY/MM/DD hh:mm:ss

                        $evt_start_date =  date("m/d/Y", strtotime($event_date_from));

                        $evt_time = date(" H:i", strtotime($event_time));

                        $event_start_timestamp = strtotime($evt_start_date.' '.$evt_time);

                        $event_end_timestamp =  strtotime($event_date_to. ' 24:00');

                        if($event_start_timestamp <= $now && $now <= $event_end_timestamp){
                        	echo '<div class="event-info">';
                        		echo '<p>'.__('This Event has been already started.', 'innwit').'</p>';
                        	echo '</div>';
                        }
                        if($now > $event_end_timestamp){
                        	echo '<div class="event-info">';
                        		echo '<p>'.__('This Event already finished.', 'innwit').'</p>';
                        	echo '</div>';
                        }

						echo '<section class="event-detail newsection">
                    		<h2 class="main-title">'.$event_title.'</h2>';

	    					//Event Meta
			                $s_event_meta = isset($smof_data['s_event_meta']) ? $smof_data['s_event_meta'] : 1;

			                $s_event_meta_date = isset($smof_data['s_event_meta_date']) ? $smof_data['s_event_meta_date'] : 1;
			                $s_event_meta_venue = isset($smof_data['s_event_meta_venue']) ? $smof_data['s_event_meta_venue'] : 1;
			                $s_event_meta_country = isset($smof_data['s_event_meta_country']) ? $smof_data['s_event_meta_country'] : 1;

			                if($s_event_meta){

			                    pix_event_meta($s_event_meta_date , $s_event_meta_venue, $s_event_meta_country);

			                }			            

				            if($sidebar_position == 'full_width'){
								pix_featured_thumbnail(1140, 390); //Width, Height
							}
							else{
								pix_featured_thumbnail(870, 460); //Width, Height
							}

				            echo '<div class="sep event-detail-sep"></div>';

				            //Event Description Title
			                $s_event_description_title = isset($smof_data['s_event_description_title']) ? $smof_data['s_event_description_title'] : "Whats About";

				            echo '<h3 class="title">'.$s_event_description_title.'</h3>';

				            if(!empty($event_content)){
				            	echo '<p>'.$event_content.'</p>';
				            }

							//Single Event share 
	                		$s_event_share = isset($smof_data['s_event_share']) ? $smof_data['s_event_share'] : 1;
	                		$s_event_facebook_page = isset($smof_data['s_event_facebook_page']) ? $smof_data['s_event_facebook_page'] : 1;
	                		$s_event_facebook_page_url = isset($smof_data['s_event_facebook_page_url']) ? $smof_data['s_event_facebook_page_url'] : '';
	                		$s_event_facebook = isset($smof_data['s_event_facebook']) ? $smof_data['s_event_facebook'] : 1;
	                		$s_event_twitter = isset($smof_data['s_event_twitter']) ? $smof_data['s_event_twitter'] : 1;
	                		$s_event_gplus = isset($smof_data['s_event_gplus']) ? $smof_data['s_event_gplus'] : 1;

							if($s_event_share && ($s_event_facebook_page || $s_event_facebook || $s_event_twitter || $s_event_gplus)){
								echo '<div class="social-icon">';
									if(!empty($s_event_facebook_page_url)){
										echo '<a href="'.$s_event_facebook_page_url.'" class="facebook facebook-page">FACEBOOK PAGE</a>';
									}
									if($s_event_facebook){
										echo '<a href="http://www.facebook.com/sharer.php?u='.get_permalink().'" target="_blank" class="facebook fa fa-facebook"></a>';
									}
									if($s_event_twitter){
										echo '<a href="http://twitter.com/share?url='.get_permalink().'&amp;text=Check out this Project " target="_blank" class="twitter fa fa-twitter"></a>';
									}
									if($s_event_gplus){
										echo '<a href="https://plus.google.com/share?url='.get_permalink().'" target="_blank" class="googleplus fa fa-google-plus"></a>';
									}
										
								echo '</div>';
							}

			            echo '</section>';


				//SCHEDULE WITH SPEAKER
			    $s_event_schedule = isset($smof_data['s_event_schedule']) ? $smof_data['s_event_schedule'] : 1;
			    $s_event_schedule_title = isset($smof_data['s_event_schedule_title']) ? $smof_data['s_event_schedule_title'] : 'Schedule with Speakers';
			    $s_event_schedule_speaker = isset($smof_data['s_event_schedule_speaker']) ? $smof_data['s_event_schedule_speaker'] : 1;
			    $s_event_schedule_meta_time = isset($smof_data['s_event_schedule_meta_time']) ? $smof_data['s_event_schedule_meta_time'] : 1;
			    $s_event_schedule_meta_venue = isset($smof_data['s_event_schedule_meta_venue']) ? $smof_data['s_event_schedule_meta_venue'] : 1;
			    $s_event_schedule_limit = isset($smof_data['s_event_schedule_limit']) ? $smof_data['s_event_schedule_limit'] : 200;
			    $s_event_single_schedule_btn = isset($smof_data['s_event_single_schedule_btn']) ? $smof_data['s_event_single_schedule_btn'] : 1;
			    $s_event_single_schedule_btn_text = isset($smof_data['s_event_single_schedule_btn_text']) ? $smof_data['s_event_single_schedule_btn_text'] : 'Read More';
			    $s_event_single_speaker_btn = isset($smof_data['s_event_single_speaker_btn']) ? $smof_data['s_event_single_speaker_btn'] : 1;
			    $s_event_single_speaker_btn_text = isset($smof_data['s_event_single_speaker_btn_text']) ? $smof_data['s_event_single_speaker_btn_text'] : 'About Speaker';
			    $s_event_schedule_break = isset($smof_data['s_event_schedule_break']) ? $smof_data['s_event_schedule_break'] : 1;
			    $s_event_single_schedule_break_text = isset($smof_data['s_event_single_schedule_break_text']) ? $smof_data['s_event_single_schedule_break_text'] : 'LETS HAVE A BREAK, ENJOY IT';


			    //Modified Element
			    if(!$s_event_schedule){
			    	$display = 'hide';
			    }
			    else{
			    	$display = 'show';
			    }



				if(!empty($first_day_schedule) || !empty($second_day_schedule) || !empty($third_day_schedule) || !empty($fourth_day_schedule)){

					$time = $place = '';

					echo '<section class="speakers-tabs newsection '.$display.'">
	                    <h2 class="title">'.$s_event_schedule_title.'</h2>
	                  <div id="speakers-tabs">';

	                echo '<ul class="speaker-ul resp-tabs-list clearfix">';

		                if(!empty($first_schedule_date)){
		                	$first_schedule_date = date("d F", strtotime($first_schedule_date));
		                }
		                else{
		                	$first_schedule_date = date("d F", strtotime($event_date_from));
		                }

		                if(!empty($second_schedule_date)){
		                	$second_schedule_date = date("d F", strtotime($second_schedule_date));
		                }
		                else{
		                	$second_schedule_date = date('d F',strtotime($first_schedule_date . "+1 days"));
		                }

		                if(!empty($third_schedule_date)){
		                	$third_schedule_date = date("d F", strtotime($third_schedule_date));
		                }
		                else{
		                	$third_schedule_date = date('d F',strtotime($second_schedule_date . "+1 days"));
		                }

		                if(!empty($fourth_schedule_date)){
		                	$fourth_schedule_date = date("d F", strtotime($fourth_schedule_date));
		                }
		                else{
		                	$fourth_schedule_date = date('d F',strtotime($third_schedule_date . "+1 days"));
		                }

						if(!empty($first_day_schedule)){
							echo '<li>Day 1 ('.$first_schedule_date.')</li>';
							
						}

						if(!empty($second_day_schedule)){
							echo '<li>Day 2 ('.$second_schedule_date.')</li>';
							
						}

						if(!empty($third_day_schedule)){
							echo '<li>Day 3 ('.$third_schedule_date.')</li>';
						}

						if(!empty($fourth_day_schedule)){
							echo '<li>Day 4 ('.$fourth_schedule_date.')</li>';
						}

					echo '</ul>';
	                    

	 				echo '<div class="resp-tabs-container">';

	 				$selected_speaker_id = '';

	 					//FIRST DAY SCHEDULE

		 				$with_time = $without_time = array();

		 				if(!empty($first_day_schedule)){

			 				foreach ($first_day_schedule as $key => $id) {
			 					$val = get_post_meta($id,'event_schedule');
								if( !empty($val) && !empty($val[0])){
									extract($val[0]);
								}

								if(!empty($schedule_time_from)){
									$with_time[$id] = date("H/i", strtotime($schedule_time_from));
								}
								else{
									$without_time[$id] = '';
								}

			 				}
			 			}

		 				asort($with_time);

		 				$sorted_first_day_schedule = array_replace($with_time, $without_time);

	 					if(!empty($first_day_schedule)){
	 						echo '<div>';

	 							$key = '';

				                foreach ($sorted_first_day_schedule as $key => $value) {

				                	//Get Schedule Details

				                	$schedule_content = $schedule_image = $schedule_time_from = $schedule_time_to = $schedule_place = '';

				                	$event_schedule = get_post_meta($key,'event_schedule');
									if( !empty($event_schedule) && !empty($event_schedule[0])){
										extract($event_schedule[0]);
									}

									$schedule_title = get_the_title($key);

									$post = get_post($key);

									$schedule_content = $post->post_content;

                					$schedule_content = strip_shortcodes(ShortenText($schedule_content,$s_event_schedule_limit));

									$schedule_link = get_permalink($key);

									$schedule_image_id = get_post_thumbnail_id ($key);

									$schedule_img = '';

									if(!empty($schedule_image_id)){
										$schedule_image_thumb_url = wp_get_attachment_image_src( $schedule_image_id, 'full');
										if(!empty($schedule_image_thumb_url)){
											$schedule_img = aq_resize($schedule_image_thumb_url[0], 300, 225, true, true); 
										}
										else {
											$schedule_img = '';
										}

										if($schedule_img){
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_img.'" alt=""></div>';
										}
										else{
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_image_thumb_url[0].'" alt=""></div>';                                     
										}
									}
									else{
										$schedule_image = '';
									}

									//Get Speaker Details

									if(!empty($schedule_speaker)){
										$speaker_title = get_the_title($schedule_speaker);

										$speaker_link = get_permalink($schedule_speaker);
									}

									


									$professions = get_the_term_list($schedule_speaker , 'pix_professions','',', ');
									$professions = !empty($professions) ? '<span class="job">'.ucwords(strip_tags( $professions )).'</span>' : '';

									if(!empty($speaker_title) && $s_event_schedule_speaker){
										$speaker_name = '<p class="author">'.$speaker_title.' '.$professions.'</p>';
									}
									else{
										$speaker_name = '';
									}

									echo '<div class="speakers">';

				                    	echo '<div class="speaker clearfix">
				                                '.$schedule_image.'
				                                <div class="speaker-content">
				                                    '.$speaker_name.'
				                                    <h3 class="title"><a href="'.$schedule_link.'">'.$schedule_title.'</a></h3>';

				                        if((!empty($schedule_time_from) || !empty($schedule_time_to) || !empty($schedule_place)) && ($s_event_schedule_meta_time || $s_event_schedule_meta_venue)){

				                        	$time = $place = '';

				                        	echo '<ul class="meta clearfix">';

						                        if((!empty($schedule_time_from) || !empty($schedule_time_to)) && $s_event_schedule_meta_time){
						                        	
						                        	$time = '<li><i class="icon fa fa-clock-o"></i>';

							                        	if(!empty($schedule_time_from)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_from));
							                        	}

							                        	if(!empty($schedule_time_from) && !empty($schedule_time_to)){
							                        		$time .= ' to ';
							                        	}

							                        	if(!empty($schedule_time_to)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_to));
							                        	}	

						                        	$time .= '</li>';

						                        }

						                        if(!empty($schedule_place) && $s_event_schedule_meta_venue){
						                        	
						                        	$place = '<li><i class="icon fa fa-map-marker"></i>'.$schedule_place.'</li>';

						                        }
						                        echo $time . $place;

					                        echo '</ul>';
				                        }                            
				                        if(!empty($schedule_content)){
				                        	echo '<p>'.$schedule_content.'[...] </p>';
				                        }

				                        
				                        if((!empty($schedule_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$schedule_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_schedule_btn_text.'</a>';
				                        }

				                        if((!empty($speaker_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$speaker_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_speaker_btn_text.'</a>';
				                        }
				                        	
				                       	echo '</div>
				                            </div>';				                        
		
										if($s_event_schedule_break){
											echo '<div class="bar"><p><i class="icon fa fa-glass"></i>'.$s_event_single_schedule_break_text.'</p></div>';
										}
				                    	
				                	echo '</div>';

				                	if(!empty($schedule_speaker) ){
										$selected_speaker_id[] = $schedule_speaker;
									}
								}
	                		echo '</div>';

	 					}

	                	


	                	//SECOND DAY SCHEDULE

	                	$with_time = $without_time = array();

		 				if(!empty($second_day_schedule)){
			 				foreach ($second_day_schedule as $key => $id) {
			 					$val = get_post_meta($id,'event_schedule');
								if( !empty($val) && !empty($val[0])){
									extract($val[0]);
								}

								if(!empty($schedule_time_from)){
									$with_time[$id] = date("H/i", strtotime($schedule_time_from));
								}
								else{
									$without_time[$id] = '';
								}

			 				}
			 			}

		 				asort($with_time);

		 				$sorted_second_day_schedule = array_replace($with_time, $without_time);

	 					if(!empty($second_day_schedule)){
	 						echo '<div>';

	 							$key = '';

				                foreach ($sorted_second_day_schedule as $key => $value) {

				                	//Get Schedule Details

				                	$schedule_content = $schedule_image = $schedule_time_from = $schedule_time_to = $schedule_place = '';

				                	$event_schedule = get_post_meta($key,'event_schedule');
									if( !empty($event_schedule) && !empty($event_schedule[0])){
										extract($event_schedule[0]);
									}

									$schedule_title = get_the_title($key);

									$post = get_post($key);

									$schedule_content = $post->post_content;

                					$schedule_content = strip_shortcodes(ShortenText($schedule_content,$s_event_schedule_limit));

									$schedule_link = get_permalink($key);

									$schedule_image_id = get_post_thumbnail_id ($key); 

									$schedule_img = '';

									if(!empty($schedule_image_id)){
										$schedule_image_thumb_url = wp_get_attachment_image_src( $schedule_image_id, 'full');
										if(!empty($schedule_image_thumb_url)){
											$schedule_img = aq_resize($schedule_image_thumb_url[0], 300, 225, true, true); 
										}

										if($schedule_img){
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_img.'" alt=""></div>';
										}
										else{
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_image_thumb_url[0].'" alt=""></div>';                                     
										}
									}
									else{
										$schedule_image = '';
									}							


									//Get Speaker Details

									if(!empty($schedule_speaker)){
										$speaker_title = get_the_title($schedule_speaker);

										$speaker_link = get_permalink($schedule_speaker);
									}

									


									$professions = get_the_term_list($schedule_speaker , 'pix_professions','',', ');
									$professions = !empty($professions) ? '<span class="job">'.ucwords(strip_tags( $professions )).'</span>' : '';

									if(!empty($speaker_title) && $s_event_schedule_speaker){
										$speaker_name = '<p class="author">'.$speaker_title.' '.$professions.'</p>';
									}
									else{
										$speaker_name = '';
									}

									echo '<div class="speakers">';

				                    	echo '<div class="speaker clearfix">
				                                '.$schedule_image.'
				                                <div class="speaker-content">
				                                    '.$speaker_name.'
				                                    <h3 class="title"><a href="'.$schedule_link.'">'.$schedule_title.'</a></h3>';

				                        if((!empty($schedule_time_from) || !empty($schedule_time_to) || !empty($schedule_place)) && ($s_event_schedule_meta_time || $s_event_schedule_meta_venue)){

				                        	$time = $place = '';

				                        	echo '<ul class="meta clearfix">';

						                        if((!empty($schedule_time_from) || !empty($schedule_time_to)) && $s_event_schedule_meta_time){
						                        	
						                        	$time = '<li><i class="icon fa fa-clock-o"></i>';

							                        	if(!empty($schedule_time_from)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_from));
							                        	}

							                        	if(!empty($schedule_time_from) && !empty($schedule_time_to)){
							                        		$time .= ' to ';
							                        	}

							                        	if(!empty($schedule_time_to)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_to));
							                        	}	

						                        	$time .= '</li>';

						                        }

						                        if(!empty($schedule_place) && $s_event_schedule_meta_venue){
						                        	
						                        	$place = '<li><i class="icon fa fa-map-marker"></i>'.$schedule_place.'</li>';

						                        }
						                        echo $time . $place;

					                        echo '</ul>';
				                        }                           
				                        if(!empty($schedule_content)){
				                        	echo '<p>'.$schedule_content.'[...] </p>';
				                        }
				                        
				                        if((!empty($schedule_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$schedule_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_schedule_btn_text.'</a>';
				                        }

				                        if((!empty($speaker_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$speaker_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_speaker_btn_text.'</a>';
				                        }
				                        	
				                       	echo '</div>
				                            </div>';
				                    	if($s_event_schedule_break){
											echo '<div class="bar"><p><i class="icon fa fa-glass"></i>'.$s_event_single_schedule_break_text.'</p></div>';
										}
				                	echo '</div>';

				                	if(!empty($schedule_speaker) ){
										$selected_speaker_id[] = $schedule_speaker;
									}
								}
	                		echo '</div>';

	 					}


	                	//THIRD DAY SCHEDULE

	                	$with_time = $without_time = array();

	                	if(!empty($third_day_schedule)){
			 				foreach ($third_day_schedule as $key => $id) {
			 					$val = get_post_meta($id,'event_schedule');
								if( !empty($val) && !empty($val[0])){
									extract($val[0]);
								}

								if(!empty($schedule_time_from)){
									$with_time[$id] = date("H/i", strtotime($schedule_time_from));
								}
								else{
									$without_time[$id] = '';
								}

			 				}
			 			}

		 				asort($with_time);

		 				$sorted_third_day_schedule = array_replace($with_time, $without_time);

	 					if(!empty($third_day_schedule)){
	 						echo '<div>';

	 							$key = '';

				                foreach ($sorted_third_day_schedule as $key => $value) {

				                	//Get Schedule Details

				                	$schedule_content = $schedule_image = $schedule_time_from = $schedule_time_to = $schedule_place = '';

				                	$event_schedule = get_post_meta($key,'event_schedule');
									if( !empty($event_schedule) && !empty($event_schedule[0])){
										extract($event_schedule[0]);
									}

									$schedule_title = get_the_title($key);

									$post = get_post($key);

									$schedule_content = $post->post_content;

                					$schedule_content = strip_shortcodes(ShortenText($schedule_content,$s_event_schedule_limit));

									$schedule_link = get_permalink($key);

									$schedule_image_id = get_post_thumbnail_id ($key); 

									$schedule_img = '';

									if(!empty($schedule_image_id)){
										$schedule_image_thumb_url = wp_get_attachment_image_src( $schedule_image_id, 'full');
										if(!empty($schedule_image_thumb_url)){
											$schedule_img = aq_resize($schedule_image_thumb_url[0], 300, 225, true, true); 
										}

										if($schedule_img){
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_img.'" alt=""></div>';
										}
										else{
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_image_thumb_url[0].'" alt=""></div>';                                     
										}
									}
									else{
										$schedule_image = '';
									}							


									//Get Speaker Details

									if(!empty($schedule_speaker)){
										$speaker_title = get_the_title($schedule_speaker);

										$speaker_link = get_permalink($schedule_speaker);
									}


									$professions = get_the_term_list($schedule_speaker , 'pix_professions','',', ');
									$professions = !empty($professions) ? '<span class="job">'.ucwords(strip_tags( $professions )).'</span>' : '';

									if(!empty($speaker_title) && $s_event_schedule_speaker){
										$speaker_name = '<p class="author">'.$speaker_title.' '.$professions.'</p>';
									}
									else{
										$speaker_name = '';
									}

									echo '<div class="speakers">';

				                    	echo '<div class="speaker clearfix">
				                                '.$schedule_image.'
				                                <div class="speaker-content">
				                                    '.$speaker_name.'
				                                    <h3 class="title"><a href="'.$schedule_link.'">'.$schedule_title.'</a></h3>';

				                        if((!empty($schedule_time_from) || !empty($schedule_time_to) || !empty($schedule_place)) && ($s_event_schedule_meta_time || $s_event_schedule_meta_venue)){

				                        	$time = $place = '';

				                        	echo '<ul class="meta clearfix">';

						                        if((!empty($schedule_time_from) || !empty($schedule_time_to)) && $s_event_schedule_meta_time){
						                        	
						                        	$time = '<li><i class="icon fa fa-clock-o"></i>';

							                        	if(!empty($schedule_time_from)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_from));
							                        	}

							                        	if(!empty($schedule_time_from) && !empty($schedule_time_to)){
							                        		$time .= ' to ';
							                        	}

							                        	if(!empty($schedule_time_to)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_to));
							                        	}	

						                        	$time .= '</li>';

						                        }

						                        if(!empty($schedule_place) && $s_event_schedule_meta_venue){
						                        	
						                        	$place = '<li><i class="icon fa fa-map-marker"></i>'.$schedule_place.'</li>';

						                        }
						                        echo $time . $place;

					                        echo '</ul>';
				                        }                           
				                        if(!empty($schedule_content)){
				                        	echo '<p>'.$schedule_content.'[...] </p>';
				                        }
				                        
				                        if((!empty($schedule_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$schedule_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_schedule_btn_text.'</a>';
				                        }

				                        if((!empty($speaker_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$speaker_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_speaker_btn_text.'</a>';
				                        }
				                        	
				                       	echo '</div>
				                            </div>';
				                    	if($s_event_schedule_break){
											echo '<div class="bar"><p><i class="icon fa fa-glass"></i>'.$s_event_single_schedule_break_text.'</p></div>';
										}
				                	echo '</div>';

				                	if(!empty($schedule_speaker) ){
										$selected_speaker_id[] = $schedule_speaker;
									}
								}
	                		echo '</div>';

	 					}


	                	//FOURTH DAY SCHEDULE

	                	$with_time = $without_time = array();

	                	if(!empty($fourth_day_schedule)){

			 				foreach ($fourth_day_schedule as $key => $id) {
			 					$val = get_post_meta($id,'event_schedule');
								if( !empty($val) && !empty($val[0])){
									extract($val[0]);
								}

								if(!empty($schedule_time_from)){
									$with_time[$id] = date("H/i", strtotime($schedule_time_from));
								}
								else{
									$without_time[$id] = '';
								}

			 				}
			 			}

		 				asort($with_time);

		 				$sorted_fourth_day_schedule = array_replace($with_time, $without_time);

	 					if(!empty($fourth_day_schedule)){
	 						echo '<div>';

	 							$key = '';

				                foreach ($sorted_fourth_day_schedule as $key => $value) {

				                	//Get Schedule Details

				                	$schedule_content = $schedule_image = $schedule_time_from = $schedule_time_to = $schedule_place = '';

				                	$event_schedule = get_post_meta($key,'event_schedule');
									if( !empty($event_schedule) && !empty($event_schedule[0])){
										extract($event_schedule[0]);
									}

									$schedule_title = get_the_title($key);

									$post = get_post($key);

									$schedule_content = $post->post_content;

                					$schedule_content = strip_shortcodes(ShortenText($schedule_content,$s_event_schedule_limit));

									$schedule_link = get_permalink($key);

									$schedule_image_id = get_post_thumbnail_id ($key); 

									$schedule_img = '';

									if(!empty($schedule_image_id)){
										$schedule_image_thumb_url = wp_get_attachment_image_src( $schedule_image_id, 'full');
										if(!empty($schedule_image_thumb_url)){
											$schedule_img = aq_resize($schedule_image_thumb_url[0], 300, 225, true, true); 
										}

										if($schedule_img){
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_img.'" alt=""></div>';
										}
										else{
											$schedule_image = '<div class="speaker-img"><img src="'.$schedule_image_thumb_url[0].'" alt=""></div>';                                     
										}
									}
									else{
										$schedule_image = '';
									}							


									//Get Speaker Details

									if(!empty($schedule_speaker)){
										$speaker_title = get_the_title($schedule_speaker);

										$speaker_link = get_permalink($schedule_speaker);
									}

									


									$professions = get_the_term_list($schedule_speaker , 'pix_professions','',', ');
									$professions = !empty($professions) ? '<span class="job">'.ucwords(strip_tags( $professions )).'</span>' : '';

									if(!empty($speaker_title) && $s_event_schedule_speaker){
										$speaker_name = '<p class="author">'.$speaker_title.' '.$professions.'</p>';
									}
									else{
										$speaker_name = '';
									}

									echo '<div class="speakers">';

				                    	echo '<div class="speaker clearfix">
				                                '.$schedule_image.'
				                                <div class="speaker-content">
				                                    '.$speaker_name.'
				                                    <h3 class="title"><a href="'.$schedule_link.'">'.$schedule_title.'</a></h3>';

				                        if((!empty($schedule_time_from) || !empty($schedule_time_to) || !empty($schedule_place)) && ($s_event_schedule_meta_time || $s_event_schedule_meta_venue)){

				                        	$time = $place = '';

				                        	echo '<ul class="meta clearfix">';

						                        if((!empty($schedule_time_from) || !empty($schedule_time_to)) && $s_event_schedule_meta_time){
						                        	
						                        	$time = '<li><i class="icon fa fa-clock-o"></i>';

							                        	if(!empty($schedule_time_from)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_from));
							                        	}

							                        	if(!empty($schedule_time_from) && !empty($schedule_time_to)){
							                        		$time .= ' to ';
							                        	}

							                        	if(!empty($schedule_time_to)){
							                        		$time .= date("g:i A" ,strtotime($schedule_time_to));
							                        	}	

						                        	$time .= '</li>';

						                        }

						                        if(!empty($schedule_place) && $s_event_schedule_meta_venue){
						                        	
						                        	$place = '<li><i class="icon fa fa-map-marker"></i>'.$schedule_place.'</li>';

						                        }
						                        echo $time . $place;

					                        echo '</ul>';
				                        }                           
				                        if(!empty($schedule_content)){
				                        	echo '<p>'.$schedule_content.'[...] </p>';
				                        }
				                        
				                        if((!empty($schedule_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$schedule_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_schedule_btn_text.'</a>';
				                        }

				                        if((!empty($speaker_link)) && $s_event_single_schedule_btn){
				                        	echo '<a href="'.$speaker_link.'" class="btn btn-border btn-grey btn-md">'.$s_event_single_speaker_btn_text.'</a>';
				                        }
				                        	
				                       	echo '</div>
				                            </div>';
				                    	if($s_event_schedule_break){
											echo '<div class="bar"><p><i class="icon fa fa-glass"></i>'.$s_event_single_schedule_break_text.'</p></div>';
										}
				                	echo '</div>';

				                	if(!empty($schedule_speaker) ){
										$selected_speaker_id[] = $schedule_speaker;
									}
								}
	                		echo '</div>';

	 					}


	                echo '</div>';
	                
	                echo '</div>       
	                </section> ';

	            }


	            //SPEAKER OF EVENT

	            $s_event_speakers = isset($smof_data['s_event_speakers']) ? $smof_data['s_event_speakers'] : 1;
	            $s_event_speakers_title = isset($smof_data['s_event_speakers_title']) ? $smof_data['s_event_speakers_title'] : "Speakers of Event";
	            $s_event_speaker_job = isset($smof_data['s_event_speaker_job']) ? $smof_data['s_event_speaker_job'] : 1;
	            $s_event_speakers_limit = isset($smof_data['s_event_speakers_limit']) ? $smof_data['s_event_speakers_limit'] : 150;
	            $s_event_speaker_social = isset($smof_data['s_event_speaker_social']) ? $smof_data['s_event_speaker_social'] : 1;

	            

                if(!empty($selected_speaker_id)){
                	$selected_speaker_id = array_unique($selected_speaker_id);
                }

                if(!empty($selected_speaker_id) && $s_event_speakers){

                	$speaker_content = '';

	                echo '<section class="speaker-event newsection">
	                    <h2 class="title">'.$s_event_speakers_title.'</h2>
	                    	<div class="owl-team">';

		                foreach ($selected_speaker_id as $key => $value) {

		                	$social_icons = '';

		                	$speaker_title = get_the_title($value);

							$post = get_post($value);

							$speaker_content = $post->post_content;

							$speaker_content = strip_shortcodes(ShortenText($speaker_content,$s_event_speakers_limit));

							$speaker_link = get_permalink($value);

							$professions = get_the_term_list($value , 'pix_professions','',', ');
							$professions = !empty($professions) ? '<p class="job">'.ucwords(strip_tags( $professions )).'</p>' : '';

							$speaker_image_id = get_post_thumbnail_id ($value); 

							if(!empty($speaker_image_id)){
								$speaker_image_thumb_url = wp_get_attachment_image_src( $speaker_image_id, 'full');
								if(!empty($speaker_image_thumb_url)){
									$speaker_img = aq_resize($speaker_image_thumb_url[0], 300, 225, true, true); 
								}
								else {
										$speaker_img = '';
									}
								if($speaker_img){
									$speaker_image = '<div class="eventsimg"><img src="'.$speaker_img.'" alt=""></div>';
								}
								else{
									$speaker_image = '<div class="eventsimg"><img src="'.$speaker_image_thumb_url[0].'" alt=""></div>';                                     
								}
							}
							else{

								$protocol = is_ssl() ? 'https' : 'http';
                				$speaker_image = '<div class="eventsimg"><img src="'.$protocol.'://placehold.it/300
									x225" alt=""></div>';
							}


							$speaker_social_links = get_post_meta($value,'speaker_social_links');
							if( !empty($speaker_social_links) && !empty($speaker_social_links[0])){
								extract($speaker_social_links[0]);
							}

							$i=1;

							if(!empty($speaker_email) || !empty($facebook) || !empty($twitter) || !empty($gplus) || !empty($linkedin) || !empty($dribbble) || !empty($flickr)){

								$j=0;

								if(!empty($speaker_email)){
									$j++;
								}
								if(!empty($facebook)){
									$j++;
								}
								if(!empty($twitter)){
									$j++;
								}
								if(!empty($gplus)){
									$j++;
								}
								if(!empty($linkedin)){
									$j++;
								}
								if(!empty($dribbble)){
									$j++;
								}
								if(!empty($flickr)){
									$j++;
								}

								if($j > 5){
									$j = 5;
								}

								$num = convertNumber($j);

								$social_icons = '<div class="social-icon links clearfix '.$num.'">';
									$social_icons .= '<ul>';

										if(!empty($speaker_email)){
											$social_icons .= '<li><a href="'.esc_url($speaker_email).'" class="email fa fa-envelope-o"></a></li>';
											$i++;	
										}
										if(!empty($facebook)){
											$social_icons .= '<li><a href="'. esc_url($facebook) .'" class="facebook fa fa-facebook"></a></li>';
											$i++;	
										}
										if(!empty($twitter)){
											$social_icons .= '<li><a href="'. esc_url($twitter)  .'" class="twitter fa fa-twitter"></a></li>';
											$i++;	
										}
										if(!empty($gplus)){
											$social_icons .= '<li><a href="'. esc_url($gplus).'" class="googleplus fa fa-google-plus"></a></li>';
											$i++;	
										}
										if(!empty($linkedin)){
											$social_icons .= '<li><a href="'. esc_url($linkedin) .'" class="linkedin fa fa-linkedin"></a></li>';
											$i++;	
										}

										if(!empty($dribbble) && ($i <= 5)){
											$social_icons .= '<li><a href="'. esc_url($dribbble) .'" class="dribbble fa fa-dribbble"></a></li>';
											$i++;	
										}
										if(!empty($flickr)  && $i <= 5){
											$social_icons .= '<li><a href="'. esc_url($flickr) .'" class="flickr fa fa-flickr"></a></li>';
											$i++;	
										}
									$social_icons .= '</ul>';

								$social_icons .= '</div>';
							}

		                	echo '<div class="event bg">
		                            '.$speaker_image.'
		                            <div class="event-content">
		                                <h3 class="title"><a href="'.$speaker_link.'">'.$speaker_title.'</a></h3>';
		                                
		                                if($s_event_speaker_job){
		                                	echo $professions;
		                                }
		                                
		                                echo '<p>'.$speaker_content.' [...] </p>

		                            </div>';
		                            if($s_event_speaker_social){
		                            	echo $social_icons;
		                            }
		                            
		                        echo '</div>';

		                }


	                echo '</div>
	                    </section>';
	            }


	            //SPONSORED BY
	            $s_event_sponsored = isset($smof_data['s_event_sponsored']) ? $smof_data['s_event_sponsored'] : 1;
	            $s_event_sponsor_title = isset($smof_data['s_event_sponsor_title']) ? $smof_data['s_event_sponsor_title'] : 'Sponsored By';

	            if($s_event_sponsored){
					$event_sponsor_logo = get_post_meta($event_id,'event_sponsor_logo');
	                if( !empty($event_sponsor_logo)){
	                    extract($event_sponsor_logo[0]);
	                }

	                

	                if(!empty($pix_images)){
	                	$pix_images_gallery = htmlspecialchars_decode($pix_images);
	                	$images_gallery = json_decode($pix_images_gallery,true);



	                	foreach($images_gallery as $src){
	                		$sponsor_img[] = $src['itemId'];
	                	}

	                	$count = count($sponsor_img);

	                	//Sponsor Links

		                if(!empty($sponsor_links)){
		                	$sponsor_links_arr = explode(',', $sponsor_links);

		                	$counts = count($sponsor_links_arr);

		                	for ($i=0; $i < $count ; $i++) { 
		                		if(!empty($sponsor_links_arr[$i])){
		                			$sponsor_link[] = $sponsor_links_arr[$i];
		                		}
		                		else{
		                			$sponsor_link[] = NULL;
		                		}
		                	}

		                	$sponsor = array_combine($sponsor_img,$sponsor_link);
		                }
		                else{
		                	$sponsor = $sponsor_img;
		                }


	                	if($images_gallery){
	                		echo '<section class="sponsored newsection">
	                    		<h2 class="title">'.$s_event_sponsor_title.'</h2>
	                    		<div class=" owl-sponsored">';

		                    		$i = 0;

		                			foreach ($sponsor as $key => $value) {
		                				
		                				if(!empty($sponsor_links)){
		                					$image_thumb_url = wp_get_attachment_image_src( $key, 'full');
		                				}
		                				else{
		                					$image_thumb_url = wp_get_attachment_image_src( $value, 'full');
		                				}
		                				$img = aq_resize($image_thumb_url[0], 120, 40, true, true);
		                				if(!$img){
		                					$img = $image_thumb_url[0];    
		                				}
		                				echo '<div class="sponsored-logo">';
			                				if(!empty($sponsor_links[$i])){
			                					echo '<a href="'.$value.'">';
			                				}
			                				
			                					echo '<img src="'.$img.'" alt="">';

			                				if(!empty($sponsor_links[$i])){
			                					echo '</a>';
			                				}
			                			echo '</div>';	

			                			$i++;
		                			}

	                			echo '</div>';
	                		echo '</section>';
	                	}
	                }
	            }


				//GALLERY OF EVENT

	            $s_event_gallery = isset($smof_data['s_event_gallery']) ? $smof_data['s_event_gallery'] : 1;
	            $s_event_gallery_title = isset($smof_data['s_event_gallery_title']) ? $smof_data['s_event_gallery_title'] : 'Gallery of Event';
	            $s_event_gallery_item = isset($smof_data['s_event_gallery_item']) ? $smof_data['s_event_gallery_item'] : 1;

	            if($s_event_gallery){
	            	echo do_shortcode('[event_gallery_slider main_title="'.$s_event_gallery_title.'" no_of_items="'.$s_event_gallery_item.'"]');
	            }                

                comments_template();                

					endwhile;
					else : 
					endif;
				?>

			</div>

			<?php

	        	if($sidebar_position == 'right_sidebar'){

					pix_event_detail_sidebar($s_event_select_sidebar , 'event-sidebar', $style, $s_event_search_filter, $s_event_venue , $s_event_counter, $s_event_organizer, $s_event_cart); // Sidebar Name, Default Sidebar, Sidebar Style, Filter, Venue, Counter, Organizer, Cart
				}
        	?>

		</div>
	</div>

<?php get_footer(); ?>