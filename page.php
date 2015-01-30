<?php get_header(); ?>

			<div id="home-wood-top" class="wrap cf">
					<div id="center-wood-base"></div>
					<div id="left-wood-base">  </div>
					<div id="right-wood-base"> </div>
					
					<?php 
					
					$subpage_walker = new My_Subpage_Walker;
					wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'main-subpage-top-menu cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Main subpage top menu', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'main-subpage-top-menu',    // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,   
    					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s<br style="clear:both;" />	</span></span></ul>',
    					                                // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback',  // fallback function
    					'walker' => $subpage_walker
						)); ?>
				</div><!-- end #home-wood-top -->
			<div id="subpage-holder" class="wrap cf subpage" >
			
			<div id="main-subpage-top-menu" >
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				</div><!-- end #main-subpage-top-menu -->
				<div id="top-title-area">
					<?php the_breadcrumb(); ?>

					<div id="route-title-holder">
						<div id="page-title-text"><?php echo str_replace('>','<span class="route-triangle">&#9654;</span>',get_the_title()); ?></div>
						
					</div><!-- end #route-title-holder -->
						<br style="clear:both;" />
				</div> <!-- end #top-title-area -->
				

				<div id="route-main">
					<div id="subpage-left-col" class="subpage-col">
						<div id="subpage-main-content-panel" class="route-box route-box-shadow">
							<div id="subpage-top-links">
							</div><!-- end #subpage-top-links -->
							<?php if( has_post_thumbnail()) { ?>
										<div id="featured-image-container">
											<img class="featured-image" src="
											<?php
										
												$thumb_id = get_post_thumbnail_id();
												$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
												echo $thumb_url_array[0];
										
											?>
											">
										</div><!-- end featured image -->
										<div id="page-anchor-links"><ul></ul></div>
										<div class="interior">
										<?php
										};
										
									 the_content(); ?>
									 </div>
						</div><!-- end #subpage-main-content-panel -->
					</div><!-- #subpage-left-col -->
					<div id="subpage-right-col" class="subpage-col">
					<?php if(get_alertCount() != 0) { ?>
					<div id="subpage-alerts-holder" class="route-box route-box-shadow">
							<h2>Alerts</h2>
							<?php
							
								
							$query = new WP_Query(array(
							'posts_per_page' => 3,
							"post_type"=>"alert", 
								

							));			
								if ( $query->have_posts() ) {
									?>
									<ul>
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
											?>
												<li class="home-alerts-outer" >
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
					</div><!-- #subpage-alerts-holder --> <?php } ?>
					
						<div id="subpage-news-holder" class="route-box route-box-shadow">
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
												<li class="home-news-outer linked-div"  >
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
							<a href="<?php echo get_site_url(); ?>/news">See all >></a>
						</div><!-- end #subpage-news-holder -->
						<a id="home-contact-us" href="<?php echo get_site_url(); ?>/contact-us">Contact Us</a>
					</div><!-- edn #subpage-right-col --> 
					<br style="clear: both;" />
				</div><!-- end #route-main -->
				<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

				<?php endif; ?>
			</div>

<?php get_footer(); ?>
