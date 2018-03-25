<?php 
	get_header();
	$time = $place = '';

	subBanner(get_the_title());
?>

	<div class="container">
        <div class="row">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php
					$event_schedule = get_post_meta(get_the_ID(),'event_schedule');
                    if( !empty($event_schedule) && !empty($event_schedule[0])){
                        extract($event_schedule[0]);
                    }
				?>

				<section class="single-event newsection">
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<?php pix_featured_thumbnail(515, 390); //Width, Height ?>
							</div>

							<div class="col-md-9">

								<div class="single-event-content">
								<h2 class="title"><?php the_title(); ?></h2>
									<ul class="meta clearfix">
										<?php
											echo '<li class="date"><i class="icon fa fa-calendar"></i>'.get_the_time('d M, Y').'</li>';
											echo '<li><i class="icon fa fa-user"></i>'.get_the_time('d M, Y'),get_the_author_link( get_the_author_meta( 'ID' ) ).'</li>';
										?>
									</ul>

									<ul class="clearfix">
										<?php
											if(!empty($schedule_time_from) || !empty($schedule_time_to)){

												$time = '<li><b>'.__('Schedule Time:', 'innwit').'</b> ';

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

											if(!empty($schedule_place)){

												$place = '<li><b>'.__('Schedule Place:', 'innwit').'</b> '.$schedule_place.'</li>';

											}

											echo $time . $place;											
										?>
									</ul>
									

									<p><?php the_content(); ?></p>
								</div>

								<div class="share">
								
									<div class="social-icon">
										<a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink() ?>" target="_blank" class="facebook fa fa-facebook"></a>
										<a href="http://twitter.com/share?url=<?php echo get_permalink() ?>&amp;text=Check out this Project <a href="" " target="_blank" class="twitter fa fa-twitter"></a>
										<a href="https://plus.google.com/share?url=<?php echo get_permalink() ?>" target="_blank" class="googleplus fa fa-google-plus"></a>
									</div>
								</div>

							</div> 
						</div>
					</div> 
				</section>

			<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>			

		</div>

		
	</div>

<?php get_footer(); ?>