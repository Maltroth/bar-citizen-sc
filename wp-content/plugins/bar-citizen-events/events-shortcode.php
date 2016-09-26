<?php

function events_shortcode( $atts )
{
	$content = '<link rel="stylesheet" type="text/css" href="wp-content/plugins/bar-citizen-events/css/events-shortcode.css" />';

	// Get the upcoming events
	$query = new WP_Query( array(
		'post_type' => 'event',
		'orderby'   => 'meta_value',
		'meta_key'  => 'eventdate',
		'order'     => 'ASC'
	));

	if ( $query->have_posts() ) 
	{
		$content .= '<ul class="events-list row">';

		while ( $query->have_posts() ) : 

			$query->the_post();
			$post = get_post();

			$date         = date('j F, Y', strtotime( get_post_meta($post->ID, 'eventdate', true) ) );
			$starttime    = get_post_meta($post->ID, 'eventstarttime', true);
			$endtime      = get_post_meta($post->ID, 'eventendtime', true);
			$location     = get_post_meta($post->ID, 'eventlocationshort', true);
			$external_url = get_post_meta($post->ID, 'eventurl', true);
		

		$content .=	'<li class="event col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="row">
					<div class="event-thumb col-md-3 col-sm-3"><img src="'. get_the_post_thumbnail_url() .'" /></div>
					<div class="col-md-9 col-sm-9">
						<div class="event-name"><h3>'. $post->post_title .'</h3></div>
						<div class="event-location">'. $location .'</div>
						<div class="event-date">'. $date .'</div>';

		if( ! empty($external_url) ) $content .= '<div class="event-link pull-right"><a target="_blank" href="'. $external_url .'">Visit website <span class="glyphicon glyphicon-new-window"></span></a></div>';

		$content .=	'</div>
				</div>
			</li>';

	
		endwhile;

		$content .= '</ul>';

		/* Restore original Post Data */
		wp_reset_postdata();
	}

	return $content;
}
add_shortcode( 'bar-citizen-events', 'events_shortcode' );