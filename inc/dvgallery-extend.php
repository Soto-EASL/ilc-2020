<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// DVgallery
function ilc_dv_gallery_overrides() {
	if ( ! function_exists( 'dvgalleries' ) ) {
		return false;
	}
	remove_shortcode( 'dvgalleries' );
	remove_shortcode( 'dvgallery' );
	add_shortcode( 'dvgalleries', 'ilc_sco_dvgalleries' );
	add_shortcode( 'dvgallery', 'ilc_sco_dvgallery' );
}

add_action( 'after_setup_theme', 'ilc_dv_gallery_overrides', 100 );
/**
 * Gallery shortcodes handle
 *
 * @param type $atts
 *
 * @return type
 */
function ilc_sco_dvgalleries( $atts ) {
	extract( shortcode_atts( array(
		"max"        => 'max',
		"categoryid" => 'categoryid',
		"vertical"   => 'vertical'
	), $atts ) );
	ob_start();
	include( get_stylesheet_directory() . '/dvgallery/gallery.php' );

	return ob_get_clean();;
}

function ilc_sco_dvgallery( $atts ) {
	extract( shortcode_atts( array(
		"id"       => 'id',
		"vertical" => 'vertical'
	), $atts ) );
	ob_start();
	include( get_stylesheet_directory() . '/dvgallery/singlegallery.php' );

	return ob_get_clean();;
}

// Handle gallery download request
if ( isset( $_REQUEST['_ilcdv_gallery_id'] ) ) {
	add_action( 'init', 'ilc_dv_handle_gallery_download' );
}
function ilc_dv_handle_gallery_download() {
	if ( empty( $_REQUEST['_ilcdv_gallery_id'] ) || empty( $_REQUEST['_ilcdv_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_ilcdv_nonce'], 'ilc_download_gallery' . $_REQUEST['_ilcdv_gallery_id'] ) ) {
		return;
	}
	$galleryimages = get_post_meta( $_REQUEST['_ilcdv_gallery_id'], 'dvgalleryimages', true );
	$images_path   = array();
	foreach ( $galleryimages as $img_id => $img_url ) {
		$full_path = get_attached_file( $img_id );
		if ( $full_path ) {
			$images_path[] = $full_path;
		}
	}
	if ( count( $images_path ) < 1 ) {
		return;
	}
	unset( $galleryimages );
	unset( $full_path );
	unset( $img_id );
	unset( $img_url );
	// allow a long script run for pulling together lots of images
	@set_time_limit( HOUR_IN_SECONDS );

	// stop/clear any output buffering
	while ( ob_get_level() ) {
		ob_end_clean();
	}

	// turn off compression on the server
	if ( function_exists( 'apache_setenv' ) ) {
		@apache_setenv( 'no-gzip', 1 );
	}
	@ini_set( 'zlib.output_compression', 'Off' );

	if ( ! class_exists( 'PclZip' ) ) {
		require ABSPATH . 'wp-admin/includes/class-pclzip.php';
	}

	$filename       = tempnam( get_temp_dir(), 'zip' );
	$zip            = new PclZip( $filename );
	$preAddCallback = '__return_true';
	// create the Zip archive, without paths or compression (images are generally already compressed)
	$properties = $zip->create( $images_path, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_NO_COMPRESSION, PCLZIP_CB_PRE_ADD, $preAddCallback );
	if ( ! is_array( $properties ) ) {
		wp_die( $zip->errorInfo( true ) );
	}
	unset( $zip );

	// send the Zip archive to the browser
	$zipName = sanitize_file_name( strtr( get_the_title( $_REQUEST['_ilcdv_gallery_id'] ), ',', '-' ) ) . '.zip';

	header( 'Content-Description: File Transfer' );
	header( 'Content-Type: application/zip' );
	header( 'Content-Disposition: attachment; filename=' . $zipName );
	header( 'Content-Transfer-Encoding: binary' );
	header( 'Expires: 0' );
	header( 'Cache-Control: must-revalidate' );
	header( 'Pragma: public' );
	header( 'Content-Length: ' . filesize( $filename ) );

	$chunksize = 512 * 1024;
	$file      = @fopen( $filename, 'rb' );
	while ( ! feof( $file ) ) {
		echo @fread( $file, $chunksize );
		flush();
	}
	fclose( $file );

	// check for bug in some old PHP versions, close a second time!
	if ( is_resource( $file ) ) {
		@fclose( $file );
	}

	// delete the temporary file
	@unlink( $filename );

	exit;
}
