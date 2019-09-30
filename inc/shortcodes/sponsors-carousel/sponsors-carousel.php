<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ILC_VC_Sponsors_Carousel extends ILC_Shortcode {
	public function get_sponsors() {
		global $wpdb;
		$sql = "";
		$sql .= "SELECT {$wpdb->posts}.ID, {$wpdb->posts}.post_title AS title, terms.name AS sponsorship_level";
		$sql .= " FROM {$wpdb->posts}";
		$sql .= " INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id";
		$sql .= " INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )";
		$sql .= " INNER JOIN {$wpdb->terms} AS terms USING( term_id )";
		$sql .= " WHERE {$wpdb->posts}.post_type IN ( 'ilc_sponsor' )";
		$sql .= " AND {$wpdb->posts}.post_status = 'publish'";
		$sql .= " AND term_taxonomy.taxonomy = 'ilc_sponsor_category'";
		$sql .= " ORDER BY terms.slug ASC, {$wpdb->posts}.post_title ASC";
		$sql .= " LIMIT 0, 9999";

		$results = $wpdb->get_results( $sql );
		$data    = array();
		if ( ! $results ) {
			return array();
		}
		foreach ( $results as $item ) {
			$logo    = get_field( 'logo', $item->ID );
			$website = get_field( 'website_address', $item->ID );
			if ( ! $logo ) {
				continue;
			}
			$data[] = array(
				'ID'                => $item->ID,
				'title'             => $item->title,
				'logo'              => $logo,
				'website'           => $website,
				'sponsorship_level' => $item->sponsorship_level
			);
		}

		return $data;
	}
}