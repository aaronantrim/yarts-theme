<img id="bg_clear" src="<?php echo get_template_directory_uri(); ?>/library/images/clear.png" usemap="#home-map-map" alt="" border="0" width="777" height="628">
<map name="home-map" id="home-map-map">
<area alt="sonora" title="" href="<?php echo get_permalink(63);?>" shape="poly" coords="20,176,98,215,169,211,231,200,289,201,370,202,415,199,434,191,448,183,467,181,468,175,452,177,441,181,425,191,418,191,407,187,366,163,327,146,273,113,183,107,157,103,161,69,155,20,77,11,18,38,7,76,5,135" style="outline:none;" >
<area alt="merced" title="" href="<?php echo get_permalink(56);?>" shape="poly" coords="61,553,174,539,220,494,281,465,311,443,309,391,329,339,319,300,327,268,390,255,412,221,417,207,429,199,447,190,457,186,471,185,471,180,451,182,435,191,415,200,391,201,328,202,249,208,187,233,141,273,139,348,97,399,52,431,31,463,39,509" style="outline:none;" >
<area alt="fresno" title="" href="<?php echo get_permalink(80);?>" shape="poly" coords="237,580,273,519,327,486,369,455,409,427,418,371,401,315,399,264,410,230,419,207,433,197,449,190,468,187,467,202,467,229,477,259,499,303,531,336,539,377,539,429,533,487,478,541.3333282470703,513,571.3333282470703,513,605.3333282470703,493,621.3333282470703,323,620.3333282470703,266,600.3333282470703" style="outline:none;" >
<area alt="mammoth" title="" href="<?php echo get_permalink(65);?>" shape="poly" coords="543,127,598,125,584,168,585,217,595,250,579,283,593,315,692,327,732,305,757,285,757,220,742,154,746,106,744,55,679,36,629,39,592,43,521,38,468,37,421,29,365,38,344,84,335,127,348,155,375,168,417,193,444,180,456,177,482,178,492,159,449,137,511,135" style="outline:none;" >
</map>
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
		
