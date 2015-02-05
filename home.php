
<?php get_header(); ?>

			<div id="content">
				
				<div id="home-wood-top" class="wrap cf">
					<div id="center-wood-base"></div>
					<div id="left-wood-base">  </div>
					<div id="right-wood-base"> </div>
				</div><!-- end #home-wood-top -->
				<div id="inner-content" class="wrap cf">
				
				<div id="top-home">
						
						<?php
							
								
							$query = new WP_Query(array(
							'posts_per_page' => 1,
							"post_type"=>"home_slide",  
								

							));			
								if ( $query->have_posts() ) {
									?>
									
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
											$link_class = '';
											$link_content  = '';
											$promo_link = '';
											
											if(get_field('slide_link_internal') != '' || get_field('slide_link_external') != '') {
												$link_class = 'linked-div';
												if(get_field('slide_link_internal') != '') {
													$link_content  = '<a href="'.get_field('slide_link_internal').'"></a>';
													$promo_link = get_field('slide_link_internal');
												} else if(get_field('slide_link_external') != '') {
													$link_content  = '<a href="'.get_field('slide_link_external').'"></a>';
													$promo_link = get_field('slide_link_external');
												}
											}
											?>
											
											<div id="promo-box" class="<?php echo $link_class; ?>" style="background-color: #<?php echo get_field('slide_background_color');?>; background-position: center center; background-image:  url(<?php
										
												$thumb_id = get_post_thumbnail_id();
												$thumb_url = wp_get_attachment_image_src($thumb_id,'home-slide', true);
												echo $thumb_url[0];
											?>);">
												<?php echo $link_content; ?>
												<div id="home-quote"><?php echo get_field('promotional_quote'); ?></div>
												<div id="home-quote-author">- <?php echo get_field('quote_author'); ?></div>
												<?php if(current_user_can( 'manage_options' )) {
												?>
													<div id="home-slide-edit-link"> <?php
													edit_post_link('Edit slide');
													?>
													</div><!--end home-slide-edit-link -->
													<?php
												} ?>
											</div><!-- end #promo-box --> 
										<?php
										}
										?>
									
										
										<?php
									}  
							wp_reset_postdata();
							?>
						
						<div id="map-box">
							<?php get_template_part( 'home-map' ); ?>
							<div id="map-decoration-lines-top"></div>
							<div id="map-decoration-lines-left"></div>
							<div id="map-decoration-lines-right"></div>
							<div id="map-decoration-lines-bottom"></div>
							<div id="wood-bottom-left"></div>
							<div id="wood-bottom-right"></div>
							<div id="wood-top-left"></div>
							<div id="wood-top-right"></div>
							
						</div><!-- end #map-box --> 
						<br style="clear: both;" />
				</div><!-- end #top-home -->
				<div id="middle-home" class="gradient">
					<div id="home-middle-col-1" class="home-middle-col">
					<?php 
					
					$walker = new My_Walker;
					wp_nav_menu( array( 
							'theme_location' => 'main-home-menu', 
							'items_wrap' => '<ul><li id="item-id"></li></ul>',
							'container'       => 'div',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '<i></i>',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => $walker ) ); 
							
					?>
					
					
					</div> <!-- end #home-middle-col-1 -->
					<div id="home-middle-col-2" class="home-middle-col news-section">
					<h2>News</h2>


						<?php
							
								
							$query = new WP_Query(array(
							'posts_per_page' => 3,
							"post_type"=>"news", 
								

							));			
								if ( $query->have_posts() ) {
									?>
									<ul>
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
											?>
												<li class="home-news-outer" >
													 <a href="<?php the_permalink(); ?>" class="home-news-inner">
									   
														 <i></i> <?php the_title(); ?>
										 
													 </a>
												</li>	
											
										<?php
										}
										?>
										</ul>
										<?php
									}  
							wp_reset_postdata();
							?>
						
						<div id="home-more-news"><a href="./news">See More News >></a></div>
						<div id="home-middle-contact-social">
							<a id="home-contact-us" href="<?php echo get_site_url(); ?>/contact-us">Contact Us</a>
							<a id="home-facebook" href=""></a>
							<a id="home-twitter" href=""></a>
							<a id="home-youtube" href=""></a>
						</div><!-- end #home-middle-contact-social -->
					</div> <!-- end #home-middle-col-2 -->
					<div id="home-middle-col-3" class="home-middle-col">
					
				
										
											<img id="home-featured-image" src="
											<?php
										
												$thumb_id = get_post_thumbnail_id(29);
												$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
												echo $thumb_url[0];
											?>
											">
											<?php if(current_user_can( 'manage_options' )) { edit_post_link('Edit this image','','',29);} ?>

					<?php
							
								
							$query = new WP_Query(array(
							'posts_per_page' => 1,
							"post_type"=>"home_slide",  
								

							));			
								if ( $query->have_posts() ) {
									?>
									
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
											?> 
											<a href="<?php echo $promo_link; ?>">
												<img id="promo-box" src="<?php
										
												$thumb_id = get_post_thumbnail_id();
												$thumb_url = wp_get_attachment_image_src($thumb_id,'home-slide', true);
												echo $thumb_url[0];
												?>" />
											</a>
									
										
											
											<div id="promo-box-quote-narrow">
												<div id="home-quote"><?php echo get_field('promotional_quote'); ?></div>
												<div id="home-quote-author">- <?php echo get_field('quote_author'); ?></div>
												<?php if(current_user_can( 'manage_options' )) {
												?>
													<div id="home-slide-edit-link"> <?php
													edit_post_link('Edit slide');
													?>
													</div><!--end home-slide-edit-link -->
													<?php
												} ?>
												</div><!-- end #promo-box-quote-narrow -->
										<?php
										}
										?>
									
										
										<?php
									}  
							wp_reset_postdata();
							?>
					</div> <!-- end #home-middle-col-1 -->
					<br style="clear: both;" />
				</div><!-- end #middle-home -->
				<div id="home-bottom">
					<div id="home-desc">
					<?php $post = get_page_by_path('home-page-about',OBJECT,'post');  
						echo $post->post_content;
					?>
						<a id="home-desc-link" href="<?php echo get_site_url();?>/about">More about YARTS</a>  <a href="<?php echo get_edit_post_link( 127 ); ?>">Edit this</a> 
						<div id="wood-bottom-left"></div>
						<div id="wood-bottom-right"></div>
					</div><!-- end #home-desc-->
				</div><!-- end #home-bottom -->

						

				

				</div>

			</div>


<?php get_footer(); ?>
