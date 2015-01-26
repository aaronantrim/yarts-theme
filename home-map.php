<div id="map-instructions">&#x25BC; Click a route for the schedule and fares.</div>
<?php 
							$alert_count = get_alertCount();
							if($alert_count > 0) {
							?>
								<div id="desktop-map-alerts" class="linked-div" rel="<?php echo get_site_url(); ?>/alerts" ><a href="<?php echo get_site_url(); ?>/alerts"><i id="alert-icon-lrg"></i>Alerts (<?php echo $alert_count; ?>)</a></div>
							<?php } else { ?>
							
							
							<div id="desktop-map-alerts">No Current Alerts</div>
							
							<?php
							
							}
							
		?>