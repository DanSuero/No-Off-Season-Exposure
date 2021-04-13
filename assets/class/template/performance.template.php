<?php
	$cur_player_meta = get_post_meta($cur_player->ID);

	// echo "<pre>";
	// print_r($cur_player_meta);
	// echo "</pre>";
?>
<style>
.elementor-element-9398f91 .elementor-heading-title {
	font-size: 48px;
	font-family: "Teko", Sans-serif;
	font-weight: 500;
	text-align: center;
}
.elementor-1228 .elementor-element.elementor-element-435e86a > .elementor-column-wrap > .elementor-widget-wrap > .elementor-widget:not(.elementor-widget__width-auto):not(.elementor-widget__width-initial):not(:last-child):not(.elementor-absolute) {
	margin-bottom: 40px;
}

.elementor-widget:not(:last-child) {
	margin-bottom: 20px;
}
.elementor-1228 .elementor-element.elementor-element-f9e22bb .elementor-heading-title {
	color: #1B2752;
	font-size: 31px;
}
section[data-id="7ef4235"]{
	margin-bottom: 40px;
}

div[data-id="99f3bc1"]{
	margin-bottom: 40px;
}
</style>
<div class="elementor-widget-wrap">
	<div class="elementor-element elementor-element-9398f91 elementor-widget elementor-widget-heading" data-id="9398f91" data-element_type="widget" data-widget_type="heading.default">
		<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Player Performance</h2>
		</div>
	</div>
	<section class="elementor-section elementor-inner-section elementor-element elementor-element-7ef4235 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7ef4235" data-element_type="section">
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-row">
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-39b1b55" data-id="39b1b55" data-element_type="column">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-element-f9e22bb elementor-widget elementor-widget-heading" data-id="f9e22bb" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<h2 class="elementor-heading-title elementor-size-default">Position</h2>
								</div>
							</div>
							<div class="elementor-element elementor-element-5fba353 elementor-widget elementor-widget-heading" data-id="5fba353" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>60-yard</strong> <?php echo $cur_player_meta["60-yard"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-c01a1ec elementor-widget elementor-widget-heading" data-id="c01a1ec" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>INF Velo</strong> <?php echo $cur_player_meta["inf_velo"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-4af23ba elementor-widget elementor-widget-heading" data-id="4af23ba" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Exit Velo</strong> <?php echo $cur_player_meta["exit_velo"][0]; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-dfddfc6" data-id="dfddfc6" data-element_type="column">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-element-fc3932b elementor-widget elementor-widget-heading" data-id="fc3932b" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<h2 class="elementor-heading-title elementor-size-default">Pitching<br></h2>
								</div>
							</div>
							<div class="elementor-element elementor-element-10a8106 elementor-widget elementor-widget-heading" data-id="10a8106" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>FB</strong> <?php echo $cur_player_meta["fb"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-8fa7c0c elementor-widget elementor-widget-heading" data-id="8fa7c0c" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>CB</strong> <?php echo $cur_player_meta["cb"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-1a2fbd0 elementor-widget elementor-widget-heading" data-id="1a2fbd0" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Max FB</strong> <?php echo $cur_player_meta["max_fb"][0]; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-4756ab9" data-id="4756ab9" data-element_type="column">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-element-94c4eb3 elementor-widget elementor-widget-heading" data-id="94c4eb3" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<h2 class="elementor-heading-title elementor-size-default">Hitting</h2>
								</div>
							</div>
							<div class="elementor-element elementor-element-5cc7d31 elementor-widget elementor-widget-heading" data-id="5cc7d31" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Exit Speed (avg)</strong> <?php echo $cur_player_meta["exit_speed_avg"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-77d56f7 elementor-widget elementor-widget-heading" data-id="77d56f7" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Exit Speed (max)</strong> <?php echo $cur_player_meta["exit_speed_max"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-1dc8f06 elementor-widget elementor-widget-heading" data-id="1dc8f06" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Distance (avg)</strong> <?php echo $cur_player_meta["distance_avg"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-7840982 elementor-widget elementor-widget-heading" data-id="7840982" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Distance (max)</strong> <?php echo $cur_player_meta["distance_max"][0]; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-1ba686f" data-id="1ba686f" data-element_type="column">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-element-11a79ae elementor-widget elementor-widget-heading" data-id="11a79ae" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<h2 class="elementor-heading-title elementor-size-default">Hitting</h2>
								</div>
							</div>
							<div class="elementor-element elementor-element-7e59c4e elementor-widget elementor-widget-heading" data-id="7e59c4e" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Hand Speed (avg)</strong> <?php echo $cur_player_meta["hand_speed_avg"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-5bbfc26 elementor-widget elementor-widget-heading" data-id="5bbfc26" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Hand Speed (max)</strong> <?php echo $cur_player_meta["hand_speed_max"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-b32cc32 elementor-widget elementor-widget-heading" data-id="b32cc32" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Bat Speed (avg)</strong> <?php echo $cur_player_meta["bat_speed_avg"][0]; ?></p>
								</div>
							</div>
							<div class="elementor-element elementor-element-20ba599 elementor-widget elementor-widget-heading" data-id="20ba599" data-element_type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<p class="elementor-heading-title elementor-size-default"><strong>Bat Speed (max)</strong> <?php echo $cur_player_meta["bat_speed_max"][0]; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="elementor-element elementor-element-99f3bc1 elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="99f3bc1" data-element_type="widget" data-widget_type="image-box.default">
		<div class="elementor-widget-container">
			<div class="elementor-image-box-wrapper">
				<figure class="elementor-image-box-img"><img src="https://nooffseasonexposure.com/wp-content/uploads/2020/11/TM-Logo-225.png" class="attachment-full size-full" alt="" loading="lazy"
						srcset="https://nooffseasonexposure.com/wp-content/uploads/2020/11/TM-Logo-225.png 223w, https://nooffseasonexposure.com/wp-content/uploads/2020/11/TM-Logo-225-128x21.png 128w, https://nooffseasonexposure.com/wp-content/uploads/2020/11/TM-Logo-225-32x5.png 32w"
						sizes="(max-width: 223px) 100vw, 223px" width="223" height="36"></figure>
				<div class="elementor-image-box-content">
					<p class="elementor-image-box-description">Stats powered by Trackman</p>
				</div>
			</div>
		</div>
	</div>
</div>
