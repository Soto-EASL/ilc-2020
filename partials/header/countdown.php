<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$start_date = get_field( 'countdown_start_date', 'options' );
$time_zone  = get_field( 'countdown_timezone', 'options' );

if ( $time_zone && strlen( $time_zone ) < 6 ) {
    $time_zone = '';
}
$time_string_with_tz = '';
$format              = '';
if ( $start_date ) {
    $time_string_with_tz = $start_date . ' 00:00:00';
    $format              = 'Y-m-d H:i:s';
}
if ( $time_string_with_tz && $time_zone ) {
    $time_string_with_tz .= $time_zone;
    $format              .= 'P';
}
$count_down_date = false;
if ( $time_string_with_tz ) {
    //$count_down_date = new DateTime( "@$time_string_with_tz" );
    $count_down_date = DateTime::createFromFormat( 'Y-m-d H:i:sP', $time_string_with_tz );
}
$nowDate = new DateTime( 'now' );
$days    = 0;
if ( false !== $count_down_date ) {
    $interval = $count_down_date->diff( $nowDate );
    if ( false !== $interval ) {
        $days = $interval->days + 1;
    }
}

if ( $days && ( $count_down_date > $nowDate ) ):
    ?>
    <div class="ilc-header-countdown-wrap">
        <div class="ilc-header-countdown">
            <strong><?php echo $days ?></strong>
            <span><?php echo _n( 'Day left', 'Days left', $days, 'total-child' ); ?></span>
        </div>
    </div>
<?php endif; ?>