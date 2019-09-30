<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$url        = get_field( 'keydate_url' );
$start_date = get_field( 'keydate_start_date', false, false );
$start_time = get_field( 'keydate_start_time' );
$end_date   = get_field( 'keydate_expiry_date', false, false );
$end_time   = get_field( 'keydate_end_time' );
$alt_title  = get_field( 'keydate_alt_title' );
$alt_title  = trim( $alt_title );

$alt_title = trim( $alt_title );

$today = date('Ymd');

$status = 'upcoming';

if ( ( $start_date <= $today ) && ( $end_date > $today ) ) {
	$status = 'running';
}
if ( ( $start_date < $today ) && ( $end_date <= $today ) ) {
	$status = 'expired';
}

$dates = array();
if ( $start_date ) {
	$start_date = new DateTime($start_date);
	if($start_date){
		$dates[] = $start_date->format('j M Y');
    }
}
if ( $end_date ) {
	$end_date = new DateTime($end_date);
	if($end_date){
		$dates[] = $end_date->format('j M Y');
	}
}

$title = $formatted_date = '';
if ( $dates ) {
	$formatted_date = '<span class="ilc-kd-date">' . implode( ' - ', $dates ) . '</span> ';
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
	$title = '<a href="' . esc_url( $url ) . '">' . $formatted_date . get_the_title() . '</a>';
} else {
	$title = $formatted_date . get_the_title();
}

if ( $title ):
	?>
    <li class="ilc-key-date-<?php echo $status; ?>"><?php echo $title; ?></li>
<?php endif; ?>