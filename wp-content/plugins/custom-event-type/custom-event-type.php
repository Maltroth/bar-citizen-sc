<?php
/**
 * Plugin Name: Custom Event Type
 * Description: Create a custom post type for events
 * Version: 0.1
 * Author: Facerafter, Maltroth
 */
add_action('init', 'create_event_posttype');
add_filter('rwmb_meta_boxes', 'event_meta_boxes');

function create_event_posttype()
{
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
        )
    )
}

function event_meta_boxes($meta_boxes)
{
  $meta_boxes[] = array(
    'title' => __('Event Details', 'event'),
    'post_types' => 'event',
    'fields' => array(
      array( // Event Date
        'id' => 'eventdate',
        'name' => __('Date','event'),
        'type' => 'date',
        'js_options' => array(
          'appendText' => __('(mm-dd-yyyy)', 'event'),
          'dateFormat' => __('mm-dd-yyyy', 'event'),
          'showMonth' => true,
          'showYear' => true,
          'showButtonPanel' => true,
          'minDate' => __('+2d'),
          'maxDate' => __('+6m'),
        ),
      ),
      array( // Event Start Time
        'id' => 'eventstarttime',
        'name' => __('Event Start Time', 'event'),
        'type' => 'time',
        'js_options' => array(
          'showSecond' => false,
          'stepMinute', => 10,
          'showTimezone' => true,
          'timeOnly' => true,
        ),
      ),
      array( // Event End Time
        'id' => 'eventendtime',
        'name' => __('Event End Time', 'event'),
        'type' => 'time',
        'js_options' => array(
          'showSecond' => false,
          'stepMinute', => 10,
          'showTimezone' => true,
          'timeOnly' => true,
        ),
      ),
      array( // Event location
        'id' => 'eventlocation',
        'name' => __('Event Address', 'event'),
        'type' => 'text',
        'size' => '50',
      )
      array( // Google Maps
        'id' => 'eventmap',
        'name' => __('Event Map', 'event'),
        'type' => 'map',
        'address_field' => 'eventlocation',
        'api_key' => 'AIzaSyCRUNyR8JFndC1ZwhgIGdFSDYOqn44xqHA',
      ),
    )
  )
  $meta_boxes[] =  array(
    'title' => __('Event Contact Details', 'event'),
    'post_types' => 'event',
    'fields' => array(
      array( // Event Site URL
        'id' => 'eventurl',
        'name'=> __('Event URL', 'event'),
        'type' => 'url',
        'std' => 'http://www.austinbarcitizens.com',
        'desc' => __('The link to your event site/facebook group.')
      ),
      array( // Own Event page
        'id' => 'eventpage',
        'name' => __('Event Page', 'event'),
        'type' => 'checkbox',
        'std'=> 0,
      )
    )      
  )
}
