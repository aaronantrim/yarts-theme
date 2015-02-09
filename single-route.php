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
					<!--<div id="service-days"><?php the_field('route_service_days'); ?></div>-->
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
									<option value="#">Change Route</option>
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
$file_url = wp_get_attachment_url( $file );
$bytesize = number_format($bytesize/1000000,1).' MB';

?>
 
<div id="route-pdf-link"><a href="<?php echo $file_url; ?>"><i></i>Download Printable Guide [PDF]</a></div>	
					<br style="clear:both;" />
				</div> <!-- end #top-title-area -->
				

				<div id="route-main">
					<div id="route-main-col-left">
					<?php if (get_field('route_info_box')!='') { ?>
						<div id="route-info-box" class="route-box route-box-shadow">
						<h2>Route Info</h2>
						<div class="interior">
							<?php the_field('route_info_box'); ?>
							</div><!-- end .interior -->
						</div><!-- #route-info-box -->
					<?php } ?>
						<div id="route-detail-map" class="route-box route-box-shadow">
							<h2><?php echo get_field('route_short_name'); ?> Detail Map <span class="click-message">(Click to enlarge)</span></h2>
							<a href="<?php
							$thumb_id = get_post_thumbnail_id();
							$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
							echo $thumb_url[0]; ?>" data-lightbox="image-1" ><img src="<?php echo $thumb_url[0]; ?>" /></a>
						</div><!-- end #route-detail-map-->
						<div id="route-connections" class="route-box route-box-shadow">
							<h2>Connections</h2>
							<div id="route-connections-interior">
								<div id="route-connections-blurb">
									YARTS connects with other local and intercity transit services to give you easy access to everything the Yosemite Region has to offer.
								</div><!-- end #route-connections-blurb -->
								<?php $connections_raw = get_field('route_connections'); 
								$connections_lines = explode(';', $connections_raw); 
								// splits apart the description field into good html.
								foreach($connections_lines as &$line) {
									
									$starter = '';
									$ender = '';
									if (strpos($line, '*') !== FALSE) {
										$starter = '<h3>';
										$ender = '</h3>';
									} else {
										if (strpos($line, '@') !== FALSE) { 
											$connection_and_link = explode('@',	$line);
											$line = '&#9632; <a id="connection-link" href="'.$connection_and_link[1].'">'.ltrim($connection_and_link[0]).'</a>';
											
										
										}
										if(sizeof($connection_and_link) >2) {
											$line .= '<div class="connection-description">'.$connection_and_link[2].'</div><!-- end .connection-description -->';
											}
										$starter = '<div class="connection-line">';
										$ender = '</div><!-- end class="connection-line" -->';
									}
									$line = str_replace('*','',$line);
									
									echo $starter;
									echo $line;
									echo $ender;
								}
								
								
								
								?>
							</div><!-- #route-connections-interior -->
						</div><!-- #route-connections -->

					</div><!-- end #route-main-col-left -->
					<div id="route-main-col-right">
						<?php
								
								$route_post_id = $post->ID;
								wp_reset_query(); 
								
								$alertCount = 0;
								$alert_query = new WP_Query(array(

							"post_type"=>array("alert", 'news'), 
							'tax_query' => 
								array(
									array(
										'taxonomy' => 'alert-zone',
										'field' => 'slug',
										'terms' => array(get_field('route_internal_short_name', $route_post_id ), 'all', 'all-routes', 'all-dial')
										
									)
								),
								

							));

						
								if ( $alert_query->have_posts() ) { ?>
								<div id="route-alerts"> <?php
										
										while ( $alert_query->have_posts() ) {
											$alert_query->the_post();
											?>
												<div id="route-alert-holder" class="route-box-shadow">
													<div id="alert-title">
														<i></i>
														<strong>Service Alert:</strong> <?php the_title(); ?>
													</div><!-- alert-title -->
													<div id="route-alert-content">
															
															<?php the_excerpt() ; ?>
								 
													<?php if(0){ ?>	 <div id="route-alert-read-more"><a href="<?php the_permalink(); ?>">Read More >></a></div>  <?php } ?>
													</div><!-- #route-alert-content -->
													<div id="route-alert-expander">
														<span class="alert-expand-line left"></span> <span class="expand-triangle">&#9660;</span> <span id="alert-expand-text">Click to Expand</span> <span class="expand-triangle">&#9660;</span> <span class="alert-expand-line right"></span>
													</div><!-- #route-alert-expander -->
												</div>
												<?php
												$alertCount ++;
										}
?> </div><!-- end #route-alerts --> <?php
									}  
							wp_reset_postdata();
							
							?>
						
						<div id="schedule-box" class="route-box route-box-shadow">
					
								<h2>Schedules <span class="click-message">(Click to pop-up a schedule for each route)</span></h2>
								<div class="interior">
								<div id="route-schedule-info">
									<ul>
										<li>&#9632; <?php the_field('route_service_days'); ?></li>
									<!--	<li>&#9632; <?php the_field('route_effective_dates'); ?></li> -->
									</ul>
									<?php if($post->post_name  == "merced-hwy-140") { ?>
									<div id="holiday-link"><a href="<?php echo get_permalink(14); ?>">(Check Holidays)</a></div>
									<?php } ?>
								</div><!-- end #route-schedule-info -->
								<div id="route-timetable-links-holder">
									<ul>
										<?php if(get_field('route_timetable1')) { 
											$timetable1 = get_field('route_timetable1');	
											?>
										<li class="linked-div" rel="<?php echo get_permalink($timetable1->ID); ?>">
											<a href="<?php echo get_permalink($timetable1->ID); ?>"></a>
											
											<div class="route-timetable-title"><?php the_field('timetable_name', $timetable1->ID);?></div>
											<div class="route-timetable-trips"><?php echo str_replace(',','<br />',get_field('timetable_trips', $timetable1->ID));?></div>
										</li>
										<?php } ?>
										<?php if(get_field('route_timetable2')) { 
											$timetable2 = get_field('route_timetable2');	
											?>
										<li class="linked-div" rel="<?php echo get_permalink($timetable2->ID); ?>">
											<a href="<?php echo get_permalink($timetable2->ID); ?>"></a>
											
											<div class="route-timetable-title"><?php the_field('timetable_name', $timetable2->ID);?></div>
											<div class="route-timetable-trips"><?php echo str_replace(',','<br />',get_field('timetable_trips', $timetable2->ID));?></div>
										</li>
										<?php } ?>
										<?php if(get_field('route_timetable3')) { 
											$timetable3 = get_field('route_timetable3');	
											?>
										<li class="linked-div" rel="<?php echo get_permalink($timetable3->ID); ?>">
											<a href="<?php echo get_permalink($timetable3->ID); ?>"></a>
											
											<div class="route-timetable-title"><?php the_field('timetable_name', $timetable3->ID);?></div>
											<div class="route-timetable-trips"><?php echo str_replace(',','<br />',get_field('timetable_trips', $timetable3->ID));?></div>
										</li>
										<?php } ?>
										<br style="clear: both;" />
									</ul>
									
								</div> <!-- end #route-timetable-links-holder -->
						</div><!-- end .interior -->
						</div><!-- end schedule box"-->
						<div id="fares-box" class="route-box route-box-shadow">
						<h2>Fares</h2>
							<div class="interior">
								All YARTS tickets include the entrance fee to Yosemite
								<hr />
								<strong>For Complete fare information, see <a href="<?php echo get_permalink(8); ?>#<?php echo slugify(get_field('route_short_name'));?>"><?php echo get_the_title(8); ?></a></strong>
							</div>
						</div><!-- end fares box" -->
					</div>
					
					<br style="clear: both;" />
				</div><!-- end #route-main -->
			</div>

<?php get_footer(); ?>
