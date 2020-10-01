<?php

namespace Jay;

class QuickInsightCSV {

	private static $instance = null;

	protected function __construct(){
		add_shortcode('quick_insight_csv', array($this, 'shortcode_callback'));
		add_action('wp_ajax_quick_insight_csv', array($this, 'ajax_callback'));
	}

	public function shortcode_callback() {
		if(current_user_can('administrator')) {

			ob_start();
				$ajax_url = admin_url( 'admin-ajax.php' ). '?action=quick_insight_csv';
				include 'shortcode-template.php';
			return ob_get_clean();
		
		} else {
			
			echo '<div class="alert bg-warning text-center text-danger">UNAUTHORISED ACCESS</div>';
		}
	}

	public function ajax_callback(){
		$data = $this->getData();
		
		$outputPath = plugin_dir_path( __FILE__ ) . 'storage/qic-data.csv';
		$outputURL = plugin_dir_url( __FILE__ ) . 'storage/qic-data.csv';
		
		$output = fopen($outputPath, "w");
		
		$heading = array(
     		'name' => 'Author Name',
     		'email' => 'Author Email'
     	);

 		fputcsv($output, $heading);

		foreach ($data as $dto) {
			$row = array(
				'name' => $dto->display_name,
				'email' => $dto->user_email
			);
			fputcsv($output, $row);	
		}
		
		fclose($output);
		
		header('Content-Type: application/json');
		echo json_encode(
		    [
		        "url" 		=> $outputURL,
		    ]
		);
		wp_die();
	}


	public function getData() {
		global $wpdb;

		$query = "SELECT display_name, user_email FROM $wpdb->users u WHERE u.ID IN(SELECT DISTINCT post_author FROM $wpdb->posts p JOIN $wpdb->term_relationships tr ON tr.object_id = p.ID WHERE p.post_status = 'publish' AND p.post_type = 'post' AND p.post_date > '2020-03-01' AND tr.term_taxonomy_id = 7 )";

		
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

