<?php
defined('ABSPATH') or die("No script kiddies please!");

class WPASAmazon{
	
	/**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
	
	/**
     * Start up
     */
    public function __construct()
    {
    	$this->options = get_option( 'wpsa_option_name' );

    }
    
    public function output(){
	    return "Amazon Class";
    }
}