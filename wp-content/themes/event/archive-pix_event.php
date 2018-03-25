<?php

	$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
	$date = isset($_GET['date']) ? $_GET['date'] : '';
	$loc = isset($_GET['loc']) ? $_GET['loc'] : '';
	$search = isset($_GET['event_search']) ? $_GET['event_search'] : '';

	if(!empty($date)){
		$date = str_replace('/', '-', $date);

		$date = date("m/d/Y", strtotime($date));
	}

	$search_query = '';

	if(!empty($keyword) || !empty($date) || $loc){
		if(!empty($keyword)){
			$search_query .= ' '.$keyword .' ';
		}
		if(!empty($date)){
			if(!empty($keyword)){
				$search_query .= '|';
			}

			$search_date = date("d F, Y", strtotime($date));
			
			$search_query .= ' '.$search_date.' ';
		}
		if($loc){
			if(!empty($date) || !empty($keyword)){
				$search_query .= '|';
			}
			$search_query .= ' '.$loc.' ';
		}
	}

	else{
		$search_query = 'Please enter or select any of the keyword';
	}	

	$event_cpt_ID = $wpdb->get_results("SELECT DISTINCT ID
		FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

	$filter_id = '';

	if(!empty($keyword)){
		$id_keyword = $wpdb->get_results("SELECT DISTINCT ID
		FROM $wpdb->posts WHERE (post_content LIKE '%$keyword%' OR post_title LIKE '%$keyword%')  AND post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);

		if(!empty($id_keyword)){

			$filter_id = call_user_func_array('array_merge', $id_keyword);
		}
	}

	$event_details = get_post_meta(285,'event_details');
	if( !empty($event_details) && !empty($event_details[0])){
		extract($event_details[0]);
	}


	foreach ( $event_cpt_ID as $key => $value ){

		global $post;

		$event_details = get_post_meta($value[0],'event_details');
		if( !empty($event_details) && !empty($event_details[0])){
			extract($event_details[0]);
		}

		$event_date_from = $event_details[0]['event_date_from'];
		$event_date_to = $event_details[0]['event_date_to'];
		$select_country = $event_details[0]['select_country'];		

		if (($date >= $event_date_from) && ($date <= $event_date_to)){
			$filter_id[] = $value[0];
		}

		if($loc){
			if($loc == $venue_name){
				$filter_id[] = $value[0];
			}	
		}

	}

	if(!empty($filter_id)){
		$filter_id = array_unique($filter_id);
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
	

	if(empty($search) || $search == 0){
		$args = array(
			'post_type' => 'pix_event',
			'posts_per_page' => 5,
			'paged' => $paged
		);
	}
	if($search){
		$args = array(
			'post_type' => 'pix_event',
			'post__in' => $filter_id,
			'paged' => $paged
		);
	}

	


	get_header();

	query_posts( $args );

	?>

	<?php

		//Show/Hide blog sub banner
    	$s_event_search_sub_banner = isset($smof_data['s_event_search_sub_banner']) ? $smof_data['s_event_search_sub_banner'] : 1;

    	if($s_event_search_sub_banner){
    		if($search){
    			subBanner(__( 'Search Result For: ', 'innwit' ) . $search_query );
    		}
    		else{
    			subBanner(__( 'All Event', 'innwit' ));	
    		}
    	}

		
	?>


	<section class="events  newsection">
 
		<div class="container">

			<div class="row">

				<?php

					//Blog 
    				$sidebar_position = isset($smof_data['s_event_search_sidebar']) ? $smof_data['s_event_search_sidebar'] : 'left_sidebar';

					//Assign blog style column settings
					if($sidebar_position == 'full_width'){
						$columns = 'col-md-12';
					}
					else{
						$columns = 'col-md-9';
					}

		            //Get event search values from theme option
	                $s_event_search_select_sidebar = isset($smof_data['s_event_search_select_sidebar']) ? $smof_data['s_event_search_select_sidebar'] : 0;
	                $s_event_search_styles = isset($smof_data['s_event_search_styles']) ? $smof_data['s_event_search_styles'] : 'style1';
	                $s_event_search_search_filter = isset($smof_data['s_event_search_search_filter']) ? $smof_data['s_event_search_search_filter'] : 0;
	                

	                if($s_event_search_styles == 'style2'){
	                	$style = 'style-two';
	                }
	                else{
	                	$style = '';
	                }

					if($sidebar_position == 'left_sidebar'){

						pix_sidebar($s_event_search_select_sidebar, 'event-sidebar', $s_event_search_styles, $s_event_search_search_filter);
					}
	        	?>
                       
				<div id="main" class="blog <?php echo $columns; ?>" role="main">
					<?php

						//Event Search Meta
		                $s_event_search_meta = isset($smof_data['s_event_search_meta']) ? $smof_data['s_event_search_meta'] : 1;

		                $s_event_search_date = isset($smof_data['s_event_search_date']) ? $smof_data['s_event_search_date'] : 1;
		                $s_event_search_venue = isset($smof_data['s_event_search_venue']) ? $smof_data['s_event_search_venue'] : 1;
		                $s_event_search_place = isset($smof_data['s_event_search_place']) ? $smof_data['s_event_search_place'] : 1;

		                //Get Event Content limit
		                $limit = isset($smof_data['s_event_search_text_limit']) ? $smof_data['s_event_search_text_limit'] : 200; 

						if(!empty($filter_id) && $search){
							if (have_posts()) { while (have_posts()) : the_post(); 
									
				                $content = strip_shortcodes(ShortenText(get_the_content(),$limit));
				                ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container event-border clearfix' ); ?> role="article">


								    <div class="event clearfix bg">

								        <?php pix_featured_thumbnail(515, 390); //Width, Height ?>

										<div class="entry-content cf event-content">
											<h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

											<?php 
									    	
											    if($s_event_search_meta){

								                    pix_event_meta($s_event_search_date , $s_event_search_venue, $s_event_search_place);

								                }

											?>

											<?php 

								                if(!empty($content)){
								                    echo '<p>'.$content.'</p>';
								                }
								            ?>  

											<?php
								                //Event Button
								                $s_event_search_button = isset($smof_data['s_event_search_button']) ? $smof_data['s_event_search_button'] : 1;
								                    
								                if($s_event_search_button){

								                	if(class_exists('Woocommerce')){

									                    global $product;                        

									                    $woo_product_id = get_post_meta(get_the_ID(), 'woo_product_id', true);

									                    $product = get_product($woo_product_id);



									                    if(is_object($product) && !empty($product) && ($product->get_price() > 0)){
									                        if($product->is_in_stock()){
									                            echo '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">Buy Ticket</a>';                           
									                        }else{
									                            echo '<a href="'.get_permalink().'" class="btn disabled btn-solid btn-grey btn-md">Sold Out</a>';
									                        }

									                        
									                    }
									                    if(is_object($product) && !empty($product) && $product->get_price() <= 0){
									                        echo '<a href="'.get_permalink().'" class="btn btn-solid btn-brown btn-md">Free Entry</a>';
									                    }
									                }
									                
								                    if(empty($product)){
								                        echo '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">View Event</a>';
								                    }
								                }
								            ?>


										</div>


									</div> 
								</article>

							<?php

								endwhile;

								bones_page_navi();
							}
						}
						
						else{
							if($search){
								echo '<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1>'._e( 'Oops, Search Result Not Found!', 'innwit' ).'</h1>
									</header>
								</article>';
							}
							
						}

					?>

					<?php

						if(empty($search) || $search == 0){
							if (have_posts()) { while (have_posts()) : the_post(); 
								$content = strip_shortcodes(ShortenText(get_the_content(),$limit));
								?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-container event-border clearfix' ); ?> role="article">


								    <div class="event clearfix bg">

								        <?php pix_featured_thumbnail(515, 390); //Width, Height ?>


										<div class="entry-content cf event-content">
											<h2 class="title"><a href="<?php the_permalink() ?>" title = "<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

											<?php 
												if($s_event_search_meta){

								                    pix_event_meta($s_event_search_date , $s_event_search_venue, $s_event_search_place);

								                }
								            ?>

											<?php 
								                if(!empty($content)){
								                    echo '<p>'.$content.'</p>';
								                }
								            ?>            
											<?php
								                //Event Button
								                $s_event_search_button = isset($smof_data['s_event_search_button']) ? $smof_data['s_event_search_button'] : 1;
								                    
								                if($s_event_search_button){

								                    global $product;                        

								                    $woo_product_id = get_post_meta(get_the_ID(), 'woo_product_id', true);

								                    $product = get_product($woo_product_id);



								                    if(is_object($product) && !empty($product) && ($product->get_price() > 0)){
								                        if($product->is_in_stock()){
								                            echo '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">Buy Ticket</a>';                           
								                        }else{
								                            echo '<a href="'.get_permalink().'" class="btn disabled btn-solid btn-grey btn-md">Sold Out</a>';
								                        }

								                        
								                    }
								                    if(is_object($product) && !empty($product) && $product->get_price() <= 0){
								                        echo '<a href="'.get_permalink().'" class="btn btn-solid btn-brown btn-md">Free Entry</a>';
								                    }
								                    if(empty($product)){
								                        echo '<a href="'.get_permalink().'" class="btn btn-solid btn-blue btn-md">View Event</a>';
								                    }
								                }
								            ?>


										</div>


									</div> 
								</article>

							<?php

								endwhile;

								bones_page_navi();
							}
						}
						
						else{
							if(!$search){
								echo '<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1>'._e( 'Oops, Post Not Found!', 'innwit' ).'</h1>
									</header>
									<section class="entry-content">
										<p>'._e( 'Uh Oh. Something is missing. Try double checking things.', 'innwit' ).'</p>
									</section>
									<footer class="article-footer">
											<p>'._e( 'This is the error message in the index.php template.', 'innwit' ).'</p>
									</footer>
								</article>';
							}
							
						}

					?>

				</div>

				<?php 
					if($sidebar_position == 'right_sidebar'){

						pix_sidebar($s_event_search_select_sidebar, 'event-sidebar', $s_event_search_styles, $s_event_search_search_filter);
					}
				?>

			</div>

		</div>
	
	</section>


<?php get_footer(); ?>
