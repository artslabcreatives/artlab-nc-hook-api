<?php
/**
 * Plugin Name: Artslab Nanaska Hook API
 * Description: Hooks into the WP API to collect data to enable the job portal core functions
 * Plugin URI:  https://plugins.artslabcreatives.com
 * Version:     1.0.1
 * Author:      Artslab Creatives
 * Author URI:  https://plugins.artslabcreatives.com
 * Text Domain: artlab-nc-hook-api
 *
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add new form action after form submission.
 *
 * @since 1.0.0
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function add_new_ctp_save_action( $form_actions_registrar ) {

    include_once( __DIR__ .  '/form-actions/artcpt.php' );

    $form_actions_registrar->register( new \CPTSave_Action_After_Submit() );
}

add_action( 'elementor_pro/forms/actions/register', 'add_new_ctp_save_action' );

/**
 * Add new form action after form submission.
 *
 * @since 1.0.0
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function add_new_user_save_action( $form_actions_registrar ) {

    include_once( __DIR__ .  '/form-actions/artuser.php' );

    $form_actions_registrar->register( new \UserSave_Action_After_Submit() );
}

add_action( 'elementor_pro/forms/actions/register', 'add_new_user_save_action' );

require_once( __DIR__ . '/updater.php' );
new ALCES2Updater();