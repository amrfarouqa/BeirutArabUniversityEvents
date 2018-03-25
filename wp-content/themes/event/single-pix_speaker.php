<?php get_header(); ?>

	<?php subBanner(get_the_title()); ?>

	<div class="container">
        <div class="row">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php
					$event_speaker = get_post_meta(get_the_ID(),'speaker_social_links');
                    if( !empty($event_speaker) && !empty($event_speaker[0])){
                        extract($event_speaker[0]);
                    }

                    $professions = get_the_term_list(get_the_id() , 'pix_professions','',', ');
					$professions = !empty($professions) ? '<p class="job">'.ucwords(strip_tags( $professions )).'</p>' : '';
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
									<?php echo $professions; ?>
									<p><?php the_content(); ?></p>
									<?php wp_link_pages('before=<p class="page-links">Pages: &after=</p>'); ?>
								</div>

								<?php
									$social_icons = '<div class="social-icon">';
									if(!empty($speaker_email)){
										$social_icons .= '<a href="'.esc_url($speaker_email).'" class="email fa fa-envelope-o"></a>';
									}
									if(!empty($facebook)){
										$social_icons .= '<a href="'. esc_url($facebook) .'" class="facebook fa fa-facebook"></a>';
									}
									if(!empty($twitter)){
										$social_icons .= '<a href="'. esc_url($twitter)  .'" class="twitter fa fa-twitter"></a>';
									}
									if(!empty($gplus)){
										$social_icons .= '<a href="'. esc_url($gplus).'" class="googleplus fa fa-google-plus"></a>';
									}
									if(!empty($linkedin)){
										$social_icons .= '<a href="'. esc_url($linkedin) .'" class="linkedin fa fa-linkedin"></a>';
									}

									if(!empty($dribbble)){
										$social_icons .= '<a href="'. esc_url($dribbble) .'" class="dribbble fa fa-dribbble"></a>';
									}
									if(!empty($flickr)){
										$social_icons .= '<a href="'. esc_url($flickr) .'" class="flickr fa fa-flickr"></a>';
									}

									$social_icons .= '</div>';

									echo $social_icons;
								?>
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