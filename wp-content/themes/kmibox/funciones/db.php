<?php

	if(!function_exists('query')){
	    function query($sql, $utf8_decode = 0){
	        global $wpdb;
	        /*
	        * 1 = utf8_encode
	        * 2 = utf8_decode
	        */
	        if( $utf8_decode == 1 ){ $sql = utf8_encode($sql); }
	        if( $utf8_decode == 2 ){ $sql = utf8_decode($sql); }
	        return $wpdb->query( $sql );
	    }
	}

	if(!function_exists('get_var')){
	    function get_var($sql){
	        global $wpdb;
	        return $wpdb->get_var( $sql );
	    }
	}

	if(!function_exists('get_row')){
	    function get_row($sql){
	        global $wpdb;
	        return $wpdb->get_row( $sql );
	    }
	}

	if(!function_exists('get_results')){
	    function get_results($sql){
	        global $wpdb;
	        return $wpdb->get_results( $sql );
	    }
	}

	if(!function_exists('insert_id')){
	    function insert_id(){
	        global $wpdb;
	        return $wpdb->insert_id;
	    }
	}

?>