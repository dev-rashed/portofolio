<?php

define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
add_filter( 'attachments_default_instance', '__return_false' );
function philosophy_attachments( $attachments )
{
	$fields         = array(
		array(
			'name'      => 'title',                         // unique field name
			'type'      => 'text',                          // registered field type
			'label'     => __( 'Title', 'philosophy' ),    // label to display
			'default'   => 'title',                         // default value upon selection
		),
	);

	$args = array(
		'label'         => 'Gallery',
		'post_type'     => array( 'post' ),
		'note'          => 'Add gallery image here',
		'button_text'   => __( 'Add new gallery', 'philosophy' ),
		'modal_text'    => __( 'Post Gallery', 'philosophy' ),
		'fields'        => $fields,
	);

	$attachments->register( 'gallery', $args );
}

add_action( 'attachments_register', 'philosophy_attachments' );