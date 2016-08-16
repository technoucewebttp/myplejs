<?php

/**
 * @param mixed $default
 * @param int   $rid
 *
 * @return mixed
 */
function wpml_filter_rid_to_untranslated_job_id( $default, $rid ) {
	require_once WPML_TM_PATH . '/inc/translation-jobs/helpers/wpml-update-post-translation-data-action.class.php';

	$save_data_action = new WPML_TM_Update_Post_Translation_Data_Action();
	list( $job_id, $translated ) = $save_data_action->get_prev_job_data( $rid );

	return $job_id && ! $translated ? $job_id : $default;
}

add_filter( 'wpml_rid_to_untranslated_job_id', 'wpml_filter_rid_to_untranslated_job_id', 10, 2 );

/**
 * Creates a translation package for the given input element
 *
 * @param mixed       $default
 * @param WP_Post|int $post
 *
 * @return array
 */
function wpml_filter_post_to_translation_package( $default, $post ) {
	$package_helper = new WPML_Element_Translation_Package();

	return $post ? $package_helper->create_translation_package( $post ) : $default;
}

add_filter( 'wpml_post_to_translation_package', 'wpml_filter_post_to_translation_package', 10, 2 );

/**
 * @param int|object $element
 *
 * @return string
 */
function wpml_tm_element_md5( $element ) {
	$helper = new WPML_TM_Action_Helper();

	return $helper->post_md5( $element );
}

add_filter( 'wpml_tm_element_md5', 'wpml_tm_element_md5', 10, 1 );