<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor form artuser action.
 *
 * Custom Elementor form action which will artuser an external server.
 *
 * @since 1.0.0
 */
class UserSave_Action_After_Submit extends \ElementorPro\Modules\Forms\Classes\Action_Base {

	/**
	 * Get action name.
	 *
	 * Retrieve artuser action name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'artuser';
	}

	/**
	 * Get action label.
	 *
	 * Retrieve artuser action label.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_label() {
		return esc_html__( 'SaveUser', 'elementor-forms-artuser-action' );
	}

	/**
	 * Run action.
	 *
	 * UserSave an external server after form submission.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param \ElementorPro\Modules\Forms\Classes\Form_Record  $record
	 * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
	 */
	public function run( $record, $ajax_handler ) {
		//$data = $record->get('fields');
		$settings = $record->get('form_settings');
		$request = $record->get('fields');

		$fields = array();
		foreach ($request as $key => $field) {
			// code...
			$fields[$field['id']] = $field['value'];
		}

	    $post = array();
	    $post['ID'] = '0';
	    $post['post_author'] = get_current_user_id();
	    $post['post_date'] = date('Y-m-d H:i:s');
	    $post['post_date_gmt'] = date('Y-m-d H:i:s');
	    $post['post_content'] = $request['post_content']['value'];
	    $post['post_title'] = $request['post_title']['value'];
	    $post['post_status'] = 'pending';
	    $post['post_type'] = '';
	    $post['comment_status'] = 'closed';
	    $post['ping_status'] = 'closed';
	    $post['post_name'] = '0';
	    $post['to_ping'] = '';
	    $post['pinged'] = '';
	    $post['post_name'] = '0';
	    $post['meta_input'] = $fields;

		//wp_insert_post($post);
	}

/**
	 * Register action controls.
	 *
	 * Add input fields to allow the user to customize the action settings.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param \Elementor\Widget_Base $widget
	 */
	public function register_settings_section( $widget ) {}

	/**
	 * On export.
	 *
	 * UserSave action has no fields to clear when exporting.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param array $element
	 */
	public function on_export( $element ) {}

}
