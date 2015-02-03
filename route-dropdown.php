<?php ?>
<ul id="route-dropdown">
<li class="linked-div"><a href="<?php echo get_site_url(); ?>/routes-schedules">------- Overview -------</a></li>

					<?php 
								
							$query = new WP_Query(array(
							'posts_per_page' => -1,
							"post_type"=>"route", 
							//'meta_key'		=> 'display_order',
							'orderby'		=> 'order',
							'order'			=> 'ASC'
								

							));

						
						
								if ( $query->have_posts() ) {
									?>
									
									<?php
										while ( $query->have_posts() ) {
											$query->the_post();
											
										
											?>
											
												
												<li value="<?php echo get_site_url().'/routes-and-schedules/'.$post->post_name; ?>" class="linked-div"><i class="route-dropdown-icon" style="background:#<?php the_field('route_color'); ?>;"></i><a href="<?php the_permalink();?>"><?php the_field('route_short_name'); ?></a></li>

										<?php
										}
										?>
										
										<?php
									}  
							wp_reset_postdata();
							?>
						
		
		<br style="clear: both;" />		
</ul>
	<br style="clear: both;" />	