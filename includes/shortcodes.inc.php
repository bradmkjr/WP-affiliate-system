<?php
defined('ABSPATH') or die("No script kiddies please!");

class WPASShortcodes{
	
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
	
	function wpas_amazon( $atts, $content = null ){
		$a = shortcode_atts( array( ), $atts );

		$amazon = new WPASAmazon();
		
		$return = $amazon->output();
		
		return $return;
	}
	
	function wpas_imgur( $atts, $content = null ){
		$a = shortcode_atts( array(), $atts );		

		$imgur = new WPASImgur();
		
		$return = $imgur->output();
		
		return $return;
	}
	
	
}

$wpas_shortcodes = new WPASShortcodes();