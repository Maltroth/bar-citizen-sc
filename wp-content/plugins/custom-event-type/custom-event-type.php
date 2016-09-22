<?php
/**
 * Plugin Name: Custom Event Type
 * Description: Create a custom post type for events
 * Version: 0.0.1
 * Author: Facerafter, Maltroth
 */
add_action('init', 'create_event_posttype');

function create_event_posttype() {
  register_post_type('event',
    array(
        'labels' => array(
            'name' => __('Events'),
            'singular_name' => __('Event'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Event'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Event'),
            'new_item' => __('New Event'),
            'view' => __('View Event'),
            'view_item' => __('View Event'),
            'search_items' => __('Search Events'),
            'not_found' => __('No events found'),
            'not_found_in_trash' => __('No events found in Trash'),
            'parent' => __('Parent Event'),
          ),
          'public' => true,
          'supports' => array('title','editor','excerpt','revisions','custom-fields'),
          'taxonomies' =>
        )
    )
}
