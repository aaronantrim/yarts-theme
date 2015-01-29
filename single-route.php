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
			<div id="subpage-holder" class="wrap cf" >
			<div id="main-subpage-top-menu">
				
				</div><!-- end #main-subpage-top-menu -->
				<div id="top-title-area">
					<?php the_breadcrumb(); ?>
					<i id="route-icon" style="background-color: #<?php the_field('route_color'); ?>;"></i>
					<div id="route-title-holder">
						<div id="page-title-text"><?php echo str_replace('>','<span class="route-triangle">&#9654;</span>',get_the_title()); ?></div>
						<div id="page-subtitle-text"><?php the_field('route_subtitle'); ?></div>
					</div><!-- end #route-title-holder -->
					<div id="page-title-text"><?php the_field(''); ?></div>
					<div id="destinations-served">Service Connecting <?php the_field('route_destinations_served'); ?></div>
					<hr id="route-title-info-separator" />
					<div id="service-days"><?php the_field('route_service_days'); ?></div>
					<div id="effective_dates"><?php the_field('route_effective_dates'); ?></div>
					<div id="route-selector">
					<?php 
								
							$query = new WP_Query(array(
							'posts_per_page' => -1,
							"post_type"=>"route", 
							//'meta_key'		=> 'display_order',
							//'orderby'		=> 'meta_value',
							//'order'			=> 'ASC'
								

							));

						
						
								if ( $query->have_posts() ) {
									?>
									<select id="routes-dropdown" onchange="location = this.options[this.selectedIndex].value;">
									<option value="#">View a different route</option>
									<?php
										while ( $query->have_posts() ) {
											$query->the_post();
											
										
											?>
											
												
												<option value="<?php echo get_site_url().'/routes-and-schedules/'.$post->post_name; ?>"><?php the_field('route_short_name'); ?></option>
													
											
										<?php
										}
										?>
										</select>
										<?php
									}  
							wp_reset_postdata();
							?>
						
					</div><!--end #route-selector -->
					
					
				<?php	$file = get_field('route_guide_pdf');

// view array of data

$bytesize = filesize( get_attached_file( $file ) );
$file_url = get_attached_file( $file );
$bytesize = number_format($bytesize/1000000,1).' MB';

?>

<div id="route-pdf-link"><a href="<?php echo $file_url; ?>"><i></i>Download <?php the_field('route_short_name'); ?> <br />Service Guide [PDF, <?php echo $bytesize; ?>]</a></div>	
					<br style="clear:both;" />
				</div> <!-- end #top-title-area -->
				

				<div id="route-main">
					<div id="route-main-col-left">
					
						<div id="route-detail-map" class="route-box route-box-shadow">
							<h2><?php echo get_field('route_short_name'); ?> Detail Map <span class="click-message">(Click to enlarge)</span></h2>
							<?php echo get_the_post_thumbnail( $post->ID, 'full' );  ?>
						</div><!-- end #route-main-col-left -->
					</div>
					<div id="route-main-col-right">
						<div id="route-alert-holder" class="route-box-shadow">
							<div id="alert-title">
								<i></i>
								<strong>Service Alert:</strong> Many Bears Blocking Many Roads
							</div><!-- alert-title -->
							<div id="route-alert-content">
								<p>slkfjalsd fa</p>
							<p>	sdf asldkjfasdfa lsdkfjalsdkfjalsdkfjalsdkfjasldfkjasdfaslñjkfañlkds fa</p>
								 
								<div id="route-alert-read-more">Read More >></div>
							</div><!-- #route-alert-content -->
							<div id="route-alert-expander">
								<span class="alert-expand-line left"></span> <span class="expand-triangle">&#9660;</span> <span id="alert-expand-text">Click to Expand</span> <span class="expand-triangle">&#9660;</span> <span class="alert-expand-line right"></span>
							</div><!-- #route-alert-expander -->
						</div>
						<div id="schedule-box" class="route-box route-box-shadow">
					
								<h2>Schedule <span class="click-message">(Click to pop-up a schedule for each route)</span></h2>
								<div class="interior">
								<div id="route-schedule-info">
								</div><!-- end #route-schedule-info -->
								<div id="route-timetable-links-holder">
									<ul>
										<li>
											<div class="route-timetable-title"></div>
											<div class="route-timetable-trips"></div>
										</li>
										<li>
											<div class="route-timetable-title"></div>
											<div class="route-timetable-trips"></div>
										</li>
									</ul>
									<br style="clear: both;" />
								</div> <!-- end #route-timetable-links-holder -->
						</div><!-- end .interior -->
						</div><!-- end schedule box"-->
						<div id="fares-box" class="route-box route-box-shadow">
						<h2>Fares</h2>
						</div><!-- end fares box" -->
					</div>
					
					<br style="clear: both;" />
				</div><!-- end #route-main -->
			</div>

<?php get_footer(); ?>
