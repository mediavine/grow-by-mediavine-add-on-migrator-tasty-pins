<div class="dpsp-page-wrapper dpsp-page-settings wrap">

	<h1><?php echo __( 'Migration Tool: Tasty Pins to Grow by Mediavine', 'social-pug' ); ?></h1>

	<br />

	<!-- Single Post Hidden Images and Pinterest description -->
	<div class="dpsp-tool-wrapper">

		<h4 style="text-align: left; padding: 15px;"><span class="dashicons dashicons-format-image" style="margin-right: 10px;"></span><?php echo __( "Single Post Pinterest Hidden Images and Default Pinterest Text", 'social-pug' ); ?></h4>

		<div style="padding: 0 15px;">

			<p style="border-bottom: 1px solid #f1f1f1; padding-bottom: 5px;"><strong><?php echo __( 'Description', 'social-pug' ); ?></strong></p>
			<p><?php echo __( "This tool will migrate the Pinterest hidden images and the default Pinterest text you may have set for your posts.", 'social-pug' ); ?></p>

			<p style="border-bottom: 1px solid #f1f1f1; padding-bottom: 5px; margin-top: 25px;"><strong><?php echo __( 'Important notes', 'social-pug' ); ?></strong></p>
			<p><?php echo __( "This migration IS NOT destructive. The saved data from Tasty Pins will not be removed from your database. It will only be copied into the format Grow by Mediavine uses.", 'social-pug' ); ?></p>

		</div>

		<div class="dpsp-tool-actions" style="border-top: 1px solid #f1f1f1; padding: 15px;">

			<a onclick="return confirm( '<?php echo __( 'Are you sure you want to migrate all individual Pinterest hidden images and the default Pinterest text set for your posts from Tasty Pins to Grow by Mediavine?', 'social-pug' ); ?>' );" href="<?php echo wp_nonce_url( remove_query_arg( array( 'message' ), add_query_arg( array( 'dpsp_action' => 'migrate_hidden_images_tp' ) ) ), 'dpsp_migrate_hidden_images_tp', 'dpsp_token' ); ?>" class="dpsp-button-primary"><?php echo __( 'Migrate Single Post Data', 'social-pug' ); ?></a>

		</div>

	</div>

	<br />

	<!-- Single Post Hidden Images and Pinterest description -->
	<div class="dpsp-tool-wrapper">

		<h4 style="text-align: left; padding: 15px;"><span class="dashicons dashicons-format-status" style="margin-right: 10px;"></span><?php echo __( "Images Pin title, descriptions, and repin ID data", 'social-pug' ); ?></h4>

		<div style="padding: 0 15px;">

			<p style="border-bottom: 1px solid #f1f1f1; padding-bottom: 5px;"><strong><?php echo __( 'Description', 'social-pug' ); ?></strong></p>
			<p><?php echo __( "This tool will migrate the Pin title, description, and repin ID data you may have set for your images.", 'social-pug' ); ?></p>

			<p style="border-bottom: 1px solid #f1f1f1; padding-bottom: 5px; margin-top: 25px;"><strong><?php echo __( 'Important notes', 'social-pug' ); ?></strong></p>
			<p><?php echo __( "This migration IS NOT destructive. The saved data from Tasty Pins will not be removed from your database. It will only be copied into the format Grow by Mediavine uses.", 'social-pug' ); ?></p>

		</div>

		<div class="dpsp-tool-actions" style="border-top: 1px solid #f1f1f1; padding: 15px;">

			<a onclick="return confirm( '<?php echo __( 'Are you sure you want to migrate all Pin information set for your images from Tasty Pins to Grow by Mediavine?', 'social-pug' ); ?>' );" href="<?php echo wp_nonce_url( remove_query_arg( array( 'message' ), add_query_arg( array( 'dpsp_action' => 'migrate_images_pin_data_tp' ) ) ), 'dpsp_migrate_images_pin_data_tp', 'dpsp_token' ); ?>" class="dpsp-button-primary"><?php echo __( 'Migrate Image Pin Data', 'social-pug' ); ?></a>

		</div>

	</div>

</div>