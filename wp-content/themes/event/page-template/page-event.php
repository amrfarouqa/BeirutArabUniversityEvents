<?php 
/*
	Template Name: Event
*/

get_header(); 


?>

<?php


	$event_template_id = get_the_ID();


	$sort_style = isset($_GET['sort_style']) ? $_GET['sort_style'] : 'grid';
?>

<?php 
    //Show/Hide event sub banner
	$event_sub_banner = isset($smof_data['event_sub_banner']) ? $smof_data['event_sub_banner'] : 1;
	if($event_sub_banner){
		subBanner(get_the_title());
	}    	
?>

<?php

	global $wpdb;

	$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '0';
	$sort_method = isset($_GET['sort_method']) ? $_GET['sort_method'] : 'asc';
	$no_of_events = isset($_GET['no_of_events']) ? $_GET['no_of_events'] : '10';

	$with_date = $without_date = $with_price = $without_price = array();

	$event_cpt_ID = $wpdb->get_results("SELECT ID
		FROM $wpdb->posts WHERE post_type = 'pix_event' AND post_status = 'publish'", ARRAY_N);
	
	foreach ($event_cpt_ID as $key => $value) {

		//echo $value[0];

		$val = get_post_meta($value[0],'event_details');
		if( !empty($val) && !empty($val[0])){
			extract($val[0]);
		}

		//echo $event_date_from;

		if($sort_by == 'event_date'){
			if(!empty($event_date_from)){
				$event_date = date("d/m/Y", strtotime($event_date_from));

				$get_date = array();

				$get_date = explode('/', $event_date); // dd/mm/yyyy

				$timestamp = mktime(0, 0, 0, $get_date[1], $get_date[0], $get_date[2]);

				$with_date[$value[0]] = $timestamp;
			}
			else{
				$without_date[$value[0]] = 0;
			}
		}

		if(class_exists('Woocommerce')){

			global $product;                        

			$woo_product_id = get_post_meta($value[0], 'woo_product_id', true);

			$product = get_product($woo_product_id);

			if($sort_by == 'event_price'){
				if(is_object($product) && !empty($product) && ($product->get_price() >= 0) && ($product->get_price() != '')){
					
					$with_price[$value[0]] = $product->get_price();
				}
				if(!is_object($product) ){
					$without_price[$value[0]] = 0;
				}
				if(is_object($product) && !empty($product) && ($product->get_price() == '')){
					$without_price[$value[0]] = 0;
				}
			}
		}
	}

	if($sort_by == 'event_date'){
		if($sort_method == 'asc'){
			asort($with_date); // asort = Ascending Order Array, arsort = Descending Order Array
		}
		else{
			arsort($with_date);
		}

		if($sort_method == 'asc'){
			$sort = array_replace($without_date , $with_date);
		}
		else{
			$sort = array_replace($with_date , $without_date);
		}

		$sort_id = array_keys($sort);
	}

	if(class_exists('Woocommerce')){
	
		if($sort_by == 'event_price'){
			if($sort_method == 'asc'){
				asort($with_price); // asort = Ascending Order Array, arsort = Descending Order Array
			}
			else{
				arsort($with_price);
			}

			if($sort_method == 'asc'){
				$sort = array_replace($without_price , $with_price);
			}
			else{
				$sort = array_replace($with_price , $without_price);
			}

			

			$sort_id = array_keys($sort);
		}
	}
	

?>

	<section class="events  newsection">
 
		<div class="container">

			<div class="row">

				<?php



					//Sidebar Position 
    				$sidebar_position = isset($smof_data['event_sidebar']) ? $smof_data['event_sidebar'] : 'left_sidebar';

					if($sidebar_position == 'full_width'){
						$columns = 'col-md-12';
						$check_column = 'checkcolumn';
					}

					else{
						$columns = 'col-md-9';
						$check_column = '';
					}


					//Get event page sidebar values

	                $event_select_sidebar = isset($smof_data['event_select_sidebar']) ? $smof_data['event_select_sidebar'] : 0;
	                $event_styles = isset($smof_data['event_styles']) ? $smof_data['event_styles'] : 'style1';

	                if($event_styles == 'style2'){
	                	$style = 'style-two';
	                }
	                else{
	                	$style = '';
	                }					

				?>

				<?php



					//Sidebar
					$event_search_filter = isset($smof_data['event_search_filter']) ? $smof_data['event_search_filter'] : 1;

					if($sidebar_position == 'left_sidebar'){

						pix_sidebar($event_select_sidebar, 'event-sidebar', $event_styles, $event_search_filter); // Sidebar Name, Default Sidebar, Sidebar Style, Filter
					}
					if($sidebar_position == 'fullwidth'){

						pix_sidebar($event_select_sidebar, 'event-sidebar', $event_styles, 0); // Sidebar Name, Default Sidebar, Sidebar Style, Filter
					}
				?>
				<div class="<?php echo $columns; ?>">

					<?php


						//Event Sort
		                $event_sort_filter = isset($smof_data['event_sort_filter']) ? $smof_data['event_sort_filter'] : 0;

						if($sidebar_position == 'full_width'){
						
							event_sort($event_sort_filter, $sidebar_position);//Show or Hide Event Sort Filter , Sort Position
						}
						else{
							event_sort($event_sort_filter, $sidebar_position);
						}
					?>
				
					<?php

						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

						if($sort_by == 'event_date' || $sort_by == 'event_price'){
							$args = array(
								'post_type' => 'pix_event',
								'post__in' => $sort_id,
								'orderby' => 'post__in',
								'paged' => $paged,
								'posts_per_page' => $no_of_events
								);
						}

						else{

							$args = array(
								'post_type' => 'pix_event',
								'orderby' => 'title',
								'order' => $sort_method,
								'paged' => $paged,
								'posts_per_page' => $no_of_events
								);
						}				

						query_posts( $args );

					?>	

					<div class="grid-list event-container clearfix <?php echo $check_column; ?> <?php if($sort_style == 'grid'){ echo 'itemgrid'; } else{echo 'itemlist';}  ?>">
           				<div class="row">  
		           			<?php

								if (have_posts()) : while (have_posts()) : the_post();

									get_template_part( 'includes/event', 'content' );

								endwhile;									
								
								else:

							   	endif;

			   				?>
						</div>

						<?php
							if ( function_exists( 'bones_page_navi' ) ) {
								echo bones_page_navi(); 
							}
							else { 
								echo '<nav class="wp-prev-next ">
									<ul class="clearfix">
										<li class="prev-link">'.next_posts_link( __( '&laquo; Older Entries', 'innwit' )).'</li>
										<li class="next-link">'.previous_posts_link( __( 'Newer Entries &raquo;', 'innwit' )).'</li>
									</ul>
								</nav>';
							}

						?>
					</div>


   				</div>



				<?php

					if($sidebar_position == 'right_sidebar'){

						pix_sidebar($event_select_sidebar, 'event-sidebar', $event_styles, $event_search_filter); // Sidebar Name, Default Sidebar, Sidebar Style, Filter
					}
					if($sidebar_position == 'fullwidth'){

						pix_sidebar($event_select_sidebar, 'event-sidebar', $event_styles, 0); // Sidebar Name, Default Sidebar, Sidebar Style, Filter
					}

				?>

			</div>



		</div>
	
	</section>

	

	<?php

		wp_reset_query(); 

		get_footer();
	?>