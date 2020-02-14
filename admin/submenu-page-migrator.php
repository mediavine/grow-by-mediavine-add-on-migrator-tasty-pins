<?php


/**
 * Function that creates the sub-menu item and page for the migrator
 *
 * @return void
 *
 */
function dpsp_register_migrator_subpage_tasty_pins() {

	add_submenu_page( 'dpsp-social-pug', __( 'Migration Tool', 'social-pug' ), __( 'Migration Tool', 'social-pug' ), 'manage_options', 'dpsp-migrator', 'dpsp_migrator_subpage_tasty_pins' );

}
add_action( 'admin_menu', 'dpsp_register_migrator_subpage_tasty_pins', 120 );


/**
 * Function that adds content to the migrator subpage
 *
 * @return string
 *
 */
function dpsp_migrator_subpage_tasty_pins() {

	if( ! empty( $_GET['dpsp_action'] ) && $_GET['dpsp_action'] == 'migrate_hidden_images_tp' )
		include_once 'views/view-submenu-page-migrator-migrate-hidden-images-tp.php';

	elseif( ! empty( $_GET['dpsp_action'] ) && $_GET['dpsp_action'] == 'migrate_images_pin_data_tp' )
		include_once 'views/view-submenu-page-migrator-migrate-images-pin-data-tp.php';

	else
		include_once 'views/view-submenu-page-migrator.php';

}