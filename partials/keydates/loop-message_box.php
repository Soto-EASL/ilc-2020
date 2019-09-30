<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$url        = get_field( 'keydate_url' );
$start_date = get_field( 'keydate_start_date' );
$start_time = get_field( 'keydate_start_time' );
$end_date   = get_field( 'keydate_expiry_date' );
$end_time   = get_field( 'keydate_end_time' );
$alt_title  = get_field( 'keydate_alt_title' );
$alt_title  = trim( $alt_title );


$now_time = time();

$status = 'upcoming';

if ( ( $start_date <= $now_time ) && ( $end_date > $now_time ) ) {
	$status = 'running';
}
if ( ( $start_date < $now_time ) && ( $end_date <= $now_time ) ) {
	$status = 'expired';
}

if ( $start_date ) {
	$start_date = date( 'd.m.Y', $start_date );
}
if ( $end_date ) {
	$end_date = date( 'd.m.Y', $end_date );
}


$title = $formatted_date = '';
if ( $start_date ) {
	$formatted_date = '<span class="ilc-kd-date">' . $start_date . ':</span> ';
}
$alt_title = wp_kses( $alt_title, array(
	'a'      => array(
		'href'   => array(),
		'title'  => array(),
		'target' => array(),
		'style'  => array(),
		'class'  => array(),
		'rel'    => array()
	),
	'span'   => array( 'style' => array(), 'class' => array() ),
	'strong' => array( 'style' => array(), 'class' => array() ),
	'em'     => array( 'style' => array(), 'class' => array() ),
) );
if ( $alt_title ) {
	$title = $formatted_date . $alt_title;
} elseif ( $url ) {
	$title = '<a href="' . esc_url( $url ) . '">' . $title . get_the_title() . '</a>';
} else {
	$title = $formatted_date . get_the_title();
}
if ( $title ):
	?>
    <h4 class="vc_custom_heading mb-key-date-title ilc-key-date-<?php echo $status; ?>"><?php echo $title; ?></h4>
<?php endif; ?>