<?php get_header(); 


$parent_route_id = -1;
// args
$args = array(
	'numberposts' => 1,
	'post_type' => 'route',
	'meta_key' => 'route_internal_short_name',
	'meta_value' => get_field('timetable_internal_short_name')
);

// get results
$the_query = new WP_Query( $args );

// The Loop
?>
<?php if( $the_query->have_posts() ): ?>
	
	<?php while ( $the_query->have_posts() ) : $the_query->the_post();
		$parent_route_id = $post->ID;
	 endwhile; ?>
	
<?php endif; ?>

<?php wp_reset_query(); 
	
?>


			<div id="home-wood-top" class="wood-back subpage">
					
				</div><!-- end #home-wood-top -->
			<div id="subpage-holder" class="" >
			<div id="main-subpage-top-menu">
				
				</div><!-- end #main-subpage-top-menu -->
				<div id="top-title-area">
					<?php the_breadcrumb(); ?>
					<i id="route-icon" style="background-color: #<?php the_field('route_color',$parent_route_id); ?>;"></i>
					<div id="route-title-holder" class="timetable">
						<div id="page-title-text" class="timetable"><?php echo str_replace('>','<span class="route-triangle">&#9654;</span>',get_the_title($parent_route_id)); ?> : <?php the_field('route_subtitle', $parent_route_id); ?></div>
						<div id="page-subtitle-text" class="timetable">Timetable : <?php the_title(); ?></div>
					</div><!-- end #route-title-holder -->
					<div id="page-title-text"><?php the_field(''); ?></div>
					
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
$file_url = get_attached_file( $file );
$bytesize = number_format($bytesize/1000000,1).' MB';

?>

<!--<div id="route-pdf-link"><a href="<?php echo $file_url; ?>"><i></i>Download Printable Guide [PDF]</a></div>	-->
					<br style="clear:both;" />
				</div> <!-- end #top-title-area -->
				<div id="home-wood-top" class="wood-back subpage">
					
				</div><!-- end #home-wood-top -->
				
<div id="timetable-close-back-link-holder"><a href="<?php echo get_permalink($parent_route_id); ?>"><i></i> Close timetable and return to the <?php the_field('route_internal_short_name', $parent_route_id); ?> route page</a></div>
				<div id="timetable-main">
				
				
					<?php
								
								
								wp_reset_query(); 
								
								$alertCount = 0;
								$alert_query = new WP_Query(array(

							"post_type"=>array("alert", 'news'), 
							'tax_query' => 
								array(
									array(
										'taxonomy' => 'alert-zone',
										'field' => 'slug',
										'terms' => array(get_field('route_internal_short_name', $parent_route_id ), 'all', 'all-routes', 'all-dial')
										
									)
								),
								

							));

						
								if ( $alert_query->have_posts() ) { ?>
								<div id="route-alerts" class="timetable-main-width"> <?php
										
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
							
							
							if (get_field('timetable_info_box_content_upper') != '') {
							
							?>
								<div id="timetable-info-box-content-upper" class="timetable-info-box timetable-main-width route-box-shadow">
								<?php echo get_field('timetable_info_box_content_upper');  ?>
								</div><!-- #timetable-info-box-content-upper -->
							<?php
							}
							
							$timetable_dir = getcwd().'/wp-content/transit-data/timetables/';
							$timetable_file = file_get_contents($timetable_dir.get_field('timetable_file_name'));
							echo $timetable_file;
							
							if (get_field('timetable_info_box_content_lower') != '') {
							
							?>
								<div id="timetable-info-box-content-lower" class="timetable-info-box timetable-main-width route-box-shadow">
									<?php echo get_field('timetable_info_box_content_lower');  ?>
								</div><!-- #timetable-info-box-content-upper -->
							<?php
							}
							
				
						
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
						
						
				</div><!-- end #route-main -->
			</div>

			

		</div>
			<nav role="navigation"  class="" >
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
						<p class="source-org copyright" >&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
						<div id="attributions"><a href="<?php echo get_permalink(54); ?>">Design Attributions</a></div>
					</nav>
					
					<div id="home-wood-top" class="wood-back subpage">
					
				</div><!-- end #home-wood-top -->


		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
