<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor form artcpt action.
 *
 * Custom Elementor form action which will artcpt an external server.
 *
 * @since 1.0.0
 */
class CPTSave_Action_After_Submit extends \ElementorPro\Modules\Forms\Classes\Action_Base {

	/**
	 * Get action name.
	 *
	 * Retrieve artcpt action name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'artcpt';
	}

	/**
	 * Get action label.
	 *
	 * Retrieve artcpt action label.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_label() {
		return esc_html__( 'SaveCPT', 'elementor-forms-artcpt-action' );
	}

	/**
	 * Run action.
	 *
	 * CPTSave an external server after form submission.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param \ElementorPro\Modules\Forms\Classes\Form_Record  $record
	 * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
	 */
	public function run( $record, $ajax_handler ) {
		//$data = $record->get('fields');
		$settings = $record->get( 'form_settings' );
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
	    $post['post_type'] = $settings['cpt_name'];
	    $post['comment_status'] = 'closed';
	    $post['ping_status'] = 'closed';
	    $post['post_name'] = '0';
	    $post['to_ping'] = '';
	    $post['pinged'] = '';
	    $post['post_name'] = '0';
	    $post['meta_input'] = $fields;

		wp_insert_post($post);
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
	public function register_settings_section( $widget ) {

		$widget->start_controls_section(
			'section_sendy',
			[
				'label' => esc_html__( 'Custom Post Type Save', 'elementor-forms-ctpsave-action' ),
				'condition' => [
					'submit_actions' => $this->get_name(),
				],
			]
		);
		$taxonomies = get_post_types();

		$widget->add_control(
			'cpt_name',
			[
				'label' => esc_html__( 'CPT Name', 'elementor-forms-ctpsave-action' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'placeholder' => '',
				'options' => $taxonomies,
				'description' => esc_html__( 'Enter the CPT which you want this to be saved under', 'elementor-forms-ctpsave-action' ),
			]
		);

		$widget->end_controls_section();
	}

	/**
	 * On export.
	 *
	 * CPTSave action has no fields to clear when exporting.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param array $element
	 */
	public function on_export( $element ) {}

}
