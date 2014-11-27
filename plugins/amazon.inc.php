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
        add_shortcode( 'wpas_amazon', array($this, 'wpas_amazon') );
        add_shortcode( 'wpas_imgur', array($this, 'wpas_imgur') );
    }
}