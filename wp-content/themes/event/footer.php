		<?php

			global $smof_data;

			//Footer Widget Columns
			$f_widget_col = isset($smof_data['f_widget_col']) ? $smof_data['f_widget_col'] : "col3";

		?>

		<footer class="footer <?php echo $f_widget_col; ?>" role="contentinfo">

							

					<?php

						//Footer Widget
						$f_widget = isset($smof_data['f_widget']) ? $smof_data['f_widget'] : 1;
						$sidebar_name = isset($smof_data['f_select_sidebar']) ? $smof_data['f_select_sidebar'] : 0;

						if($f_widget){

							echo '<div class="main-footer">';

								echo '<div id="inner-footer" class="container">';
									if ( is_active_sidebar( $sidebar_name )){
				                        dynamic_sidebar( $sidebar_name );
				                    }
				                    elseif($sidebar_name == 0){

				                        if ( is_active_sidebar( 'footer-widgets' )){
				                            dynamic_sidebar( 'footer-widgets' );
				                        }
				                        else{
				                            echo '<div><p>Please active footer widget or disable it from theme option.</p></div>';
				                        }
				                    }

		                    	echo '</div>';
							echo '</div>';
	                    }	
					?>

				

			<?php


				//Small Footer
				$f_small = isset($smof_data['f_small']) ? $smof_data['f_small'] : 1;
				$f_small_sl_nav = isset($smof_data['f_small_sl_nav']) ? $smof_data['f_small_sl_nav'] : 1;
				$f_copyright_t = isset($smof_data['f_copyright_t']) ? $smof_data['f_copyright_t'] : "<p>&copy; [year] [blog-link] , All Rights Reserved.</p>";

				if($f_small){

					//Social Links
			        $bottom_facebook = isset($smof_data['bottom_facebook']) ? $smof_data['bottom_facebook'] : '';
			        $bottom_twitter = isset($smof_data['bottom_twitter']) ? $smof_data['bottom_twitter'] : '';
			        $bottom_gplus = isset($smof_data['bottom_gplus']) ? $smof_data['bottom_gplus'] : '';
			        $bottom_linkedin = isset($smof_data['bottom_linkedin']) ? $smof_data['bottom_linkedin'] : '';
			        $bottom_dribbble = isset($smof_data['bottom_dribbble']) ? $smof_data['bottom_dribbble'] : '';
			        $bottom_flickr = isset($smof_data['bottom_flickr']) ? $smof_data['bottom_flickr'] : '';
			        $bottom_pinterest = isset($smof_data['bottom_pinterest']) ? $smof_data['bottom_pinterest'] : '';
			        $bottom_tumblr = isset($smof_data['bottom_tumblr']) ? $smof_data['bottom_tumblr'] : '';
			        $bottom_rss = isset($smof_data['bottom_rss']) ? $smof_data['bottom_rss'] : '';
					echo '<div id="copyright">
						<div class="container">
							<div class="copyright row">';
								echo '<div class="col-md-6">'.do_shortcode($f_copyright_t).'</div>';
								echo '<div class="col-md-6">';
                                    
                                    if($f_small_sl_nav){
	                                    if(!empty($bottom_facebook) || !empty($bottom_twitter) || !empty($bottom_gplus) || !empty($bottom_linkedin) || !empty($bottom_dribbble) || !empty($bottom_flickr) || !empty($bottom_pinterest) || !empty($bottom_tumblr) || !empty($bottom_rss)){
	                                        echo '<div class="social-icon pull-right">';
	                                            if(!empty($bottom_facebook)){
	                                                echo '<a href="'.$bottom_facebook.'" class="facebook fa fa-facebook"></a>';
	                                            }
	                                            if(!empty($bottom_twitter)){
	                                                echo '<a href="'.$bottom_twitter.'" class="twitter fa fa-twitter"></a>';
	                                            }
	                                            if(!empty($bottom_gplus)){
	                                                echo '<a href="'.$bottom_gplus.'" class="googleplus fa fa-google-plus"></a>';
	                                            }
	                                            if(!empty($bottom_dribbble)){
	                                                echo '<a href="'.$bottom_dribbble.'" class="dribbble fa fa-dribbble"> </a>';
	                                            }
	                                            if(!empty($bottom_linkedin)){
	                                                echo '<a href="'.$bottom_linkedin.'" class="linkedin fa fa-linkedin"></a>';
	                                            }
	                                            if(!empty($bottom_flickr)){
	                                                echo '<a href="'.$bottom_flickr.'" class="flickr fa fa-flickr"></a>';
	                                            }
	                                            if(!empty($bottom_pinterest)){
	                                                echo '<a href="'.$bottom_pinterest.'" class="pinterest fa fa-pinterest"></a>';
	                                            }
	                                            if(!empty($bottom_tumblr)){
	                                                echo '<a href="'.$bottom_tumblr.'" class="tumblr fa fa-tumblr"></a>';
	                                            }
	                                            if(!empty($bottom_rss)){
	                                                echo '<a href="'.$bottom_rss.'" class="rss fa fa-rss"></a>';
	                                            }


	                                        echo '</div>';
	                                    }
	                                }
	                                else{
	                                	echo '<div>';
	                                		eventon_footer_nav();
	                                	echo '</div>';
	                                }
                                    

                                echo '</div>';
							echo '</div>
						</div>
					</div>';
                }	
			?>

		</footer>

		

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->