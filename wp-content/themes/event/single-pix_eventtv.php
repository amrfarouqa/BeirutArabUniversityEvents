<?php 
	get_header();

	//Show/Hide single event tv sub banner
	$s_tv_sub_banner = isset($smof_data['s_tv_sub_banner']) ? $smof_data['s_tv_sub_banner'] : 1;
	if($s_tv_sub_banner){
		subBanner(get_the_title());
	}    	
?>

	<div class="container">
        <div class="row">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php

					$post_id = get_the_ID();

					$event_tv_details = get_post_meta(get_the_ID(),'event_tv_video');
                    if( !empty($event_tv_details) && !empty($event_tv_details[0])){
                        extract($event_tv_details[0]);
                    }

					$internal_vid = htmlspecialchars_decode($pix_internal_vid_url);
            		$internal_vid_url = json_decode($internal_vid,true);
				?>

				<section class="single-event newsection">
					<div class="container">
						<div class="row">
							<div class="col-md-9">

								<?php 
									if(!empty($internal_vid_url) || !empty($pix_external_vid_url)){

										if(!empty($internal_vid_url)){
											$vid_url = $internal_vid_url[0]['url'];
											$vid_format = 'type="video/'.$internal_vid_url[0]['format'].'"';
										}
										else{
											$vid_url = $pix_external_vid_url;
											$vid_format = '';
										}

										$ext = array("mp3", "mp4","webm", "flv", "wmv", "ogg", "acc");

										if (preg_match('/\.('.implode('|', $ext).')$/', $vid_url, $matches)) {

											echo '<video width="100%" height="100%" src="'.$vid_url.'" ' .$vid_format.' id="player1" poster="" controls="controls" preload="none"></video>';
										}
										else{
											echo '<div><p>Please vefify the video url. It may be not supported or not a video file.</p></div>';
										}

										

									}

									else{
										echo '<div><p>No videos added yet</p></div>';
									}
								?>


							</div>

							<div class="col-md-3">

								<div class="single-event-content">
								<h2 class="title"><?php the_title(); ?></h2>
									<?php

				                		//Event TV Meta 

										$s_tv_meta = isset($smof_data['s_tv_meta']) ? $smof_data['s_tv_meta'] : 1;
										$s_tv_meta_date = isset($smof_data['s_tv_meta_date']) ? $smof_data['s_tv_meta_date'] : 1;

										$s_tv_meta_author = isset($smof_data['s_tv_meta_author']) ? $smof_data['s_tv_meta_author'] : 1;

										if($s_tv_meta){

											pix_blog_meta(NULL , $s_tv_meta_date, NULL, $s_tv_meta_author);

										}

									?>


									<?php

										//Description

										$content = get_the_content();

				                		$s_tv_title = isset($smof_data['s_tv_title']) ? $smof_data['s_tv_title'] : "About Video";

										if(!empty($content)){
											echo '<h3>'.$s_tv_title.'</h3>';

											echo '<p>'.$content.'</p>';	
										}

									?>

								</div>

								<?php

									//Single Event TV share

			                		$s_tv_share = isset($smof_data['s_tv_share']) ? $smof_data['s_tv_share'] : 1;
			                		$s_tv_share_title = isset($smof_data['s_tv_share_title']) ? $smof_data['s_tv_share_title'] : "Share";
			                		$s_tv_facebook = isset($smof_data['s_tv_facebook']) ? $smof_data['s_tv_facebook'] : 1;
			                		$s_tv_twitter = isset($smof_data['s_tv_twitter']) ? $smof_data['s_tv_twitter'] : 1;
			                		$s_tv_google_plus = isset($smof_data['s_tv_google_plus']) ? $smof_data['s_tv_google_plus'] : 1;

									if($s_tv_share && ($s_tv_facebook || $s_tv_twitter || $s_tv_google_plus)){
										echo '<div class="share">
											<h3 class="title">'.$s_tv_share_title.'</h3>
											<div class="social-icon">';
												if($s_tv_facebook){
													echo '<a href="http://www.facebook.com/sharer.php?u='.get_permalink().'" target="_blank" class="facebook fa fa-facebook"></a>';
												}
												if($s_tv_twitter){
													echo '<a href="http://twitter.com/share?url='.get_permalink().'&amp;text=Check out this Project " target="_blank" class="twitter fa fa-twitter"></a>';
												}
												if($s_tv_google_plus){
													echo '<a href="https://plus.google.com/share?url='.get_permalink().'" target="_blank" class="googleplus fa fa-google-plus"></a>';
												}
												
										echo '</div>
										</div>';
									}

								?>

								

							</div> 
						</div>
					</div> 
				</section>

			<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>			

		</div>

		<?php 



			global $wpdb;

			$eventtv_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
				FROM $wpdb->posts WHERE post_type = 'pix_eventtv' AND post_status = 'publish'", ARRAY_N);

			$popular_id = $recent_id = $recent_arr = $popular_arr = array();


			//Number of Videos
			$s_tv_no_videos = isset($smof_data['s_tv_no_videos']) ? $smof_data['s_tv_no_videos'] : 4;

	        //Recent Event TV Arguements

            $recent_arr = array(
                'post_type'      => 'pix_eventtv',
                'posts_per_page' => $s_tv_no_videos,
                'order' => 'DESC'
            );

			//Popular Event TV Arguements

	        foreach ( $eventtv_cpt_ID as $value ){

	            $popular = get_post_meta( $value[0], 'popular', true );

	            if($popular == 'yes'){
	            	$popular_id[] = $value[0];
	            }

	        }


	        if(!empty($popular_id)){
	            $popular_arr = array(
					'post_type'      => 'pix_eventtv',
					'posts_per_page' => $s_tv_no_videos,
					'order_by'       => 'post__in',
					'post__in'       => $popular_id, 
					'order'          => 'DESC',
					'post__not_in'   => $post_id        
	            );
	        }			

			//Recent and Popular Event Tab
			$s_tv_recent_popular = isset($smof_data['s_tv_recent_popular']) ? $smof_data['s_tv_recent_popular'] : 1;

			if($s_tv_recent_popular){

				$tab_one_id = rand(); $tab_one_title = 'Recent Videos';

				$tab_two_id = rand(); $tab_two_title = 'Popular Videos';

				$tabs = array($tab_one_id => $tab_one_title, $tab_two_id => $tab_two_title );


				echo '<div class="tabs event-tab 	.upcoming-popular-tab newsection">';

					echo '<ul class="clearfix">';


					foreach ($tabs as $tab_id => $tab_title) {
						echo '<li><a href="#tabs'.$tab_id.'">'.$tab_title.'</a></li>';
					}

					echo '</ul>';

					foreach ($tabs as $tab_id => $tab_title) {

						

						if($tab_title == $tab_one_title){
							$the_query = new WP_Query( $recent_arr );
						}
						else{
							$the_query = new WP_Query( $popular_arr );
						}					

						echo '<div id="tabs'.$tab_id.'">
							<div class="event-container event-tv">
								<div class="row">';

									if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

										$title =  get_the_title(); //title
										$content = strip_tags(strip_shortcodes(ShortenText(get_the_content(),200))); //content
										$link = get_permalink(); //link

										//feature thumbnail
										if (has_post_thumbnail()) {    
											$image_id = get_post_thumbnail_id ($the_query->post->ID );  
											$image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
											if(!empty($image_thumb_url)){
												$img = aq_resize($image_thumb_url[0], 263, 200, true, true); 			
											}

											if($img){
												$feature_img = "<div class='eventsimg'><img src='$img' alt=''></div>";
											}else{
												$feature_img = "<div class='eventsimg'><img src='$image_thumb_url[0]' alt=''></div>";                                     
											}
										}
										else {
											$feature_img = '<div class="eventsimg"><img src="'.get_template_directory_uri().'/library/img/recent-post-col4.gif" alt=""></div>';
										}


										//Meta Section
										$s_tv_post_meta = isset($smof_data['s_tv_post_meta']) ? $smof_data['s_tv_post_meta'] : 1;
										$s_tv_post_meta_author = isset($smof_data['s_tv_post_meta_author']) ? $smof_data['s_tv_post_meta_author'] : 1;
										$s_tv_post_meta_date = isset($smof_data['s_tv_post_meta_date']) ? $smof_data['s_tv_post_meta_date'] : 1;

										//Charecter limit
						                $s_tv_post_limit = isset($smof_data['s_tv_post_limit']) ? $smof_data['s_tv_post_limit'] : 200; 
						                $content = strip_shortcodes(ShortenText(get_the_excerpt(),$s_tv_post_limit));

						                //Read More Button
						                $s_tv_post_button = isset($smof_data['s_tv_post_button']) ? $smof_data['s_tv_post_button'] : 1;
						                $s_tv_post_button_text = isset($smof_data['s_tv_post_button_text']) ? $smof_data['s_tv_post_button_text'] : "Read More";


						                //Share and Like Option
						                $s_tv_post_share_like = isset($smof_data['s_tv_post_share_like']) ? $smof_data['s_tv_post_share_like'] : 1;

										if($tab_title == $tab_one_title){

												echo '<div class="col-md-3">
													<div class="event bg">
														'.$feature_img.'
														<div class="event-content">
															<h3 class="title">'.$title.'</h3>';

															if($s_tv_post_meta && ($s_tv_post_meta_author || $s_tv_post_meta_date)){

																echo '<ul class="meta clearfix">';

																	if($s_tv_post_meta_date){
																		echo '<li class="date"><i class="icon fa fa-calendar"></i>'.get_the_time('d M, Y').'</li>';
																	}
																	if($s_tv_post_meta_author){
																		echo '<li><i class="icon fa fa-user"></i>'.get_the_author_link( get_the_author_meta( 'ID' ) ).'</li>';
																	}		   												

				   												echo '</ul>';
				   											}

			   												echo '<span class="sep"></span>';

															if(!empty($content)){
																echo '<p>'.$content.' [...] </p>';
															}

															if($s_tv_post_button){
																echo '<a href="'.$link.'" class="btn btn-solid btn-grey btn-md">'.$s_tv_post_button_text.'</a>';
															}
															

															echo '</div>';

															
															//Single Event TV Share and Like
												            $s_tv_share_like = isset($smof_data['s_tv_share_like']) ? $smof_data['s_tv_share_like'] : 1;
												            $s_tv_share = isset($smof_data['s_tv_share']) ? $smof_data['s_tv_share'] : 1;
												            $s_tv_like = isset($smof_data['s_tv_like']) ? $smof_data['s_tv_like'] : 1;

												            if($s_tv_share_like){
												                pix_share_like_comment($s_tv_share,$s_tv_like,0);
												            }

															

												echo '</div></div>';

																
											

										}
										if($tab_title == $tab_two_title){
												
											echo '<div class="col-md-3">
												<div class="event bg">
													'.$feature_img.'
													<div class="event-content">
														<h3 class="title">'.$title.'</h3>';

														if($s_tv_post_meta && ($s_tv_post_meta_author || $s_tv_post_meta_date)){

															echo '<ul class="meta clearfix">';

																if($s_tv_post_meta_date){
																	echo '<li class="date"><i class="icon fa fa-calendar"></i>'.get_the_time('d M, Y').'</li>';
																}
																if($s_tv_post_meta_author){
																	echo '<li><i class="icon fa fa-user"></i>'.get_the_author_link( get_the_author_meta( 'ID' ) ).'</li>';
																}		   												

															echo '</ul>';
														}

		   												echo '<span class="sep"></span>';

		   												if(!empty($content)){
		   													echo '<p>'.$content.' [...] </p>';
		   												}

		   												if($s_tv_post_button){
		   													echo '<a href="'.$link.'" class="btn btn-solid btn-grey btn-md">'.$s_tv_post_button_text.'</a>';
		   												}

														echo '</div>';

														if($s_tv_share_like){
												            pix_share_like_comment($s_tv_share,$s_tv_like,0);
												        }

															

												echo '</div></div>';	

																		
												

											}


									endwhile;

									else:
										echo '<div>'.__('No Event Videos Found.', 'innwit').'</div>';
									endif;


						

						echo '</div>';

						//View All Button
		                $s_tv_view_all_button = isset($smof_data['s_tv_view_all_button']) ? $smof_data['s_tv_view_all_button'] : 1;
		                $event_tv_template_url = isset($smof_data['event_tv_template_url']) ? $smof_data['event_tv_template_url'] : '';
		                $s_tv_view_all_button_text = isset($smof_data['s_tv_view_all_button_text']) ? $smof_data['s_tv_view_all_button_text'] : 'View All Events';

		                if($s_tv_view_all_button && !empty($event_tv_template_url)){
		                	echo '<a href="'.$event_tv_template_url.'" class="btn btn-border btn-md btn-grey">'.$s_tv_view_all_button_text.'</a>';
		                }

						
						echo '</div>
								</div>';
					}

				echo '</div>';
			}


			

		?>
	</div>

<?php get_footer(); ?>