<?php $posts_updated = ( ! empty( $_GET['posts_updated'] ) ? absint( $_GET['posts_updated'] ) : 0 ); ?>

<div class="dpsp-page-wrapper dpsp-page-settings wrap">

	<h1><?php echo __( 'Migration Tool: Tasty Pins to Grow by Mediavine', 'social-pug' ); ?></h1>

	<br />

	<p><?php echo __( 'Migrating single post hidden Pinterest images and default Pinterest texts...', 'social-pug' ); ?></p>
	<p><?php echo sprintf( __( 'Posts migrated: %s', 'social-pug' ), $posts_updated ); ?></p>
	<div class="spinner" style="visibility: visible; float: none; margin: 0;"></div>

	<?php dpsp_migrator_migrate_hidden_images_tp(); ?>

</div>