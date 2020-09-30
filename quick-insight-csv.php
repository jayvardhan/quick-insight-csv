<?php

/*
* Plugin Name: Quick Insight With Csv Download
* Plugin URI: https://github.com/jayvardhan/quick-insight-csv
* Description: Get quick insight by running a sql query with option to download data as csv
* Version: 1.0.0
* Author: Jay Vardhan
* Author URI: https://github.com/jayvardhan
*/


if( !defined('ABSPATH') ) {
	exit;
}


$inc_files = array(
	'QuickInsightCSV.php',
);

foreach( $inc_files as $file ){
	require_once( $file );
}