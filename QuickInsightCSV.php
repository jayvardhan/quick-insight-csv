<?php

namespace Jay;

class QuickInsightCSV {

	private static $instance = null;

	protected function __construct(){
		add_shortcode('quick_insight_csv', array($this, 'shortcode_callback'));
		add_action('wp_ajax_quick_insight_csv', array($this, 'ajax_callback'));

	}

	public function shortcode_callback() {
		ob_start();
			$ajax_url = admin_url( 'admin-ajax.php' ). '?action=quick_insight_csv';
			include 'shortcode-template.php';
		return ob_get_clean();
	}

	public function ajax_callback(){
		print_r($this->getData());
		wp_die();
	}


	public function getData() {
		global $wpdb;

		$query = "SELECT display_name, user_email FROM $wpdb->users u WHERE u.ID IN(SELECT DISTINCT post_author FROM $wpdb->posts p JOIN $wpdb->term_relationships tr ON tr.object_id = p.ID WHERE p.post_status = 'publish' AND p.post_type = 'post' AND p.post_date > '2020-02-01' AND tr.term_taxonomy_id = 7 )";

		
		$rst = $wpdb->get_results( $query );

		return $rst;
	}


	public static function getInstance(){
		
		if( self::$instance == null ){
			self::$instance = array();
		}
		
		$class = get_called_class();
		
		if( !isset( self::$instance[ $class ] ) ){
            self::$instance[ $class ] = new static();
        }
		
        return self::$instance[ $class ];
	}

}
 

QuickInsightCSV::getInstance();

