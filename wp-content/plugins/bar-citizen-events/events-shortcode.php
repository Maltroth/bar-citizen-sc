<?php

function events_shortcode( $atts )
{
	echo '<link rel="stylesheet" type="text/css" href="wp-content/plugins/bar-citizen-events/css/events-shortcode.css" />';

	// Get the upcoming events
	$query = new WP_Query( array(
		'post_type' => 'event',
		'orderby'   => 'meta_value',
		'meta_key'  => 'eventdate',
		'order'     => 'DESC'
	));

	if ( $query->have_posts() ) 
	{
		echo '<ul class="events-list row">';

		while ( $query->have_posts() ) : 

			$query->the_post();
			$post = get_post();

			$date      = date('j F, Y', strtotime( get_post_meta($post->ID, 'eventdate', true) ) );
			$starttime = get_post_meta($post->ID, 'eventstarttime', true);
			$endtime   = get_post_meta($post->ID, 'eventendtime', true);
			$location  = get_post_meta($post->ID, 'eventlocationshort', true);
		?>

			<li class="col-md-3">
				<div class="row">
					<div class="col-md-3"><img src="<?php the_post_thumbnail_url(); ?>" /></div>
					<div class="col-md-9">
						<div class="event-name"><?php echo $post->post_title; ?></div>
						<div class="event-location"><?php echo $location; ?></div>
						<div class="event-date"><?php echo $date; ?> from <?php echo $starttime; ?> to <?php echo $endtime; ?> (local time)</div>
					</div>
				</div>
			</li>

		<?php
		endwhile;

		echo '</ul>';

		/* Restore original Post Data */
		wp_reset_postdata();
	}
}
add_shortcode( 'bar-citizen-events', 'events_shortcode' );