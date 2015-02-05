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
				<?php 
				
				wp_reset_query(); 
?>
				</div><!-- end #main-subpage-top-menu -->
				<div id="top-title-area">
					<?php //the_breadcrumb(); ?>

					<div id="route-title-holder">
						<div id="page-title-text">
							<?php if (get_post_type_object( $post_type )->rewrite['slug'] == 'alerts') {echo 'Alerts';}
							else if (get_post_type_object( $post_type )->rewrite['slug'] == 'news') {echo 'News';}  ?>
						</div>
						
					</div><!-- end #route-title-holder -->
						<br style="clear:both;" />
				</div> <!-- end #top-title-area -->
				

				<div id="route-main">
					<div id="subpage-left-col" class="subpage-col">
						<div id="subpage-main-content-panel" class="route-box route-box-shadow">
							<?php
															  if(!empty($post->post_parent )) {
								 ?>
								 	<div id="subpage-top-parent-link">
								 		<a href="<?php echo get_the_permalink($post->post_parent);?>">Return to <?php echo get_the_title($post->post_parent); ?></a>
								 	</div>
								 <?php
								  }
								 $children = get_pages('child_of='.$post->ID.'&parent='.$post->ID);
								 if(sizeof($children)> 0) {
								 ?>
								 	<div id="subpage-top-links">
								 		<!--<div id="subpage-link-title">Subpages:</div>--!>
										<ul>
											 <?php
								
											 foreach($children as &$child) {
												echo '<li><a href="'.get_the_permalink($child->ID).'">'.$child->post_title.'</a></li>';
											 }
											 ?>
											 <br style="clear: both;" />
										 </ul>
										 											 <br style="clear: both;" />
								 </div><!-- end #subpage-top-links -->
								 <?php
								  }

								 ?>
								 
							
							
										<div class="interior">
										<?php
										
										// if is fares page
										//PUT LOOP HERE
										
									if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="entry-header article-header">

									<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline entry-meta vcard">
										<?php printf( __( 'Posted %1$s by %2$s', 'bonestheme' ),
                  							     /* the time the post was published */
                  							     '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							); ?>
									</p>

								</header>

								<section class="entry-content cf">

									<?php the_post_thumbnail( 'bones-thumb-300' ); ?>

									<?php the_excerpt(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>


							

							<?php endif; ?>

										
										
										
										</div><!-- inerior? -->
						</div><!-- end #subpage-main-content-panel -->
						<br style="clear: both;" />
					</div><!-- #subpage-left-col -->
					<div id="subpage-right-col" class="subpage-col">
					
					</div><!-- edn #subpage-right-col --> 
					<br style="clear: both;" />
				</div><!-- end #route-main -->
				
			</div>

<?php get_footer(); ?>