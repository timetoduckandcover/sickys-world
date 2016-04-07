<div class="wrap">
	<h1 class="facewp-page-title"><?php echo esc_html( sprintf( __( '%s - Demo Importer', 'thememove' ), $theme ) ); ?></h1>
	<div class="facewp-import-about-text">
		<strong>*NOTE:</strong> If you import demo content, it will overwrite the existing data and settings.<br />
		The import will take time needed to download all images.
		If it has any problem, please contact to us via email <a href="mailto:<?php echo esc_attr( FaceWP_Abbey_EMAIL ); ?>"><?php echo esc_html( FaceWP_Abbey_EMAIL ); ?></a><br />
	</div>
	<hr>
	<div class="facewp-demo-source-container">
		<?php foreach ( $demos as $demo_id => $demo ) : ?>
			<div class="facewp-demo-source">
				<div class="facewp-demo-source-screenshot">
					<img src="<?php echo esc_url( $demo['screenshot'] ); ?>" alt="<?php echo esc_attr( $demo['name'] ); ?>">
				</div>
				<div class="facewp-demo-source-heading">
					<h3 class="facewp-demo-source-title"><?php echo esc_html( $demo['name'] ); ?></h3>
					<button class="button button-primary facewp-demo-source-install" data-demo="<?php echo esc_attr( $demo_id ); ?>">Install</button>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div id="facewp-import-result-container">
		<div id="facewp-import-result">
			<div id="facewp-import-progress-importing" class="facewp-import-progress">
				<h3>Importing...</h3>
			</div>
		</div>
	</div>
</div>
<script type="text/html" id="facewp-import-progress">
	<div id="facewp-import-progress-<%= data %>" class="facewp-import-progress">
		<h3><%= title %></h3>
		<div class="facewp-import-progressbar">
			<div class="facewp-import-progressbar-inner"></div>
		</div>
	</div>
</script>
<script type="text/html" id="facewp-import-done-template">
	<a href="<?php echo esc_url( get_site_url() ); ?>" class="facewp-import-button" target="_blank">View site</a>
	|
	<a href="#" class="facewp-import-button facewp-import-button-close">Close</a>
</script>