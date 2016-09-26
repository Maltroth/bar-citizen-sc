<?php
/**
 * Plugin Name: Bar Citizen Events
 * Description: Create a custom post type for events
 * Version: 0.1
 * Author: Facerafter, Maltroth
 */

// Get the shortcode
require 'events-shortcode.php';

add_action('init', 'create_event_posttype');
add_filter('rwmb_meta_boxes', 'event_meta_boxes');

// Display the meta date field differently on front-end
add_filter('rwmb_eventdate_meta', function($value)
{
    return $value ? date('j F, Y', strtotime($value)) : '';
} );

function create_event_posttype()
{
	register_post_type('event',
		array(
			'labels' => array(
				'name'               => __('Events'),
				'singular_name'      => __('Event'),
				'add_new'            => __('Add New'),
				'add_new_item'       => __('Add New Event'),
				'edit'               => __('Edit'),
				'edit_item'          => __('Edit Event'),
				'new_item'           => __('New Event'),
				'view'               => __('View Event'),
				'view_item'          => __('View Event'),
				'search_items'       => __('Search Events'),
				'not_found'          => __('No events found'),
				'not_found_in_trash' => __('No events found in Trash'),
				'parent'             => __('Parent Event'),
			),
			'public' => true,
			'supports' => array('title','thumbnail','revisions'),
			'menu_icon' => 'dashicons-location',
		)
	);
}

function event_meta_boxes($meta_boxes)
{
	$meta_boxes[] = array(
		'title' => __('Event Description', 'event'),
		'post_types' => 'event',
		'fields' => array(
			array( // Event Excerpt
				'id' => 'eventexcerpt',
				'name' => __('Event Excerpt ', 'event'),
				'type' => 'textarea',
				'limit' => 35,
				'limit_type' => 'word',
			),
			array(
					'type' => 'divider',
			),
			array( // Own Event page
				'id'   => 'eventpage',
				'name' => __('Do you want your own event page?', 'event'),
				'type' => 'checkbox',
				'std'  => 0,
			),
			array(
				'id' => 'eventdescription',
				'name' => __('Event Description - Only if you want your own page'),
				'type' => 'wysiwyg',
				'raw' => false,
				'media_buttons' => false,
			),
		),
	);

	$meta_boxes[] = array(
		'title' => __('Event Details', 'event'),
		'post_types' => 'event',
		'fields' => array(
			array( // Event Date
				'id'         => 'eventdate',
				'name'       => __('Date','event'),
				'type'       => 'date',
				'js_options' => array(
					'showButtonPanel' => false,
					'appendText'      => __('(yyyy-mm-dd)', 'event'),
					'dateFormat'      => __('yy-mm-dd', 'event'),
					'minDate'         => __('+2d'),
					'maxDate'         => __('+6m'),
				),
			),
			array( // Event Start Time
				'id'         => 'eventstarttime',
				'name'       => __('Event Start Time', 'event'),
				'type'       => 'time',
				'js_options' => array(
						'showSecond'   => false,
						'stepMinute'   => 10,
						'timeOnly'     => true,
				),
			),
			array( // Event End Time
				'id'         => 'eventendtime',
				'name'       => __('Event End Time', 'event'),
				'type'       => 'time',
				'js_options' => array(
					'showSecond'   => false,
					'stepMinute'   => 10,
					'timeOnly'     => true,
				),
			),
      array( // Event short location
        'id'   => 'eventlocationshort',
        'name' => __('Short Event Location - City, Country', 'event'),
        'type' => 'text',
        'size' => '50',
      ),
			array( // Event location
				'id'   => 'eventlocation',
				'name' => __('Full Event Location', 'event'),
				'type' => 'text',
				'size' => '50',
			),
			array( // Google Maps
				'id'            => 'eventmap',
				'name'          => __('Event Map', 'event'),
				'type'          => 'map',
				'address_field' => 'eventlocation',
				'api_key'       => 'AIzaSyCRUNyR8JFndC1ZwhgIGdFSDYOqn44xqHA',
			),
		)
	);

	$meta_boxes[] =  array(
		'title'      => __('Event Contact Details', 'event'),
		'post_types' => 'event',
		'fields'     => array(
			array( // Event Site URL
				'id'   => 'eventurl',
				'name' => __('Event URL', 'event'),
				'type' => 'url',
				'desc' => __('The link to your event site/facebook group.')
			),
			array( // Contact email
				'id' => 'eventemail',
				'name' => __('Contact Email - Will not be shown to public', 'event'),
				'type'  => 'email',
			)
		)
	);
	return $meta_boxes;
}
