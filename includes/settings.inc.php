<?php
defined('ABSPATH') or die("No script kiddies please!");

class WPASSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            __('WP Affiliate System','wp-affiliate-system'), 
            __('WP Affiliate System','wp-affiliate-system'), 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'wpsa_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2><?php _e('WP Affiliate System Settings','wp-affiliate-system');  ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wpsa_option_group' );   
                do_settings_sections( 'my-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'wpsa_option_group', // Option group
            'wpsa_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'imgur_section_id', // ID
            __('Imgur Settings','wp-affiliate-system'), // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'imgur_client_id', // ID
            __('Client ID','wp-affiliate-system'), // Title 
            array( $this, 'imgur_client_id_callback' ), // Callback
            'my-setting-admin', // Page
            'imgur_section_id' // Section           
        );

        add_settings_field(
            'imgur_client_secret', // ID
            __('Client Secret','wp-affiliate-system'), // Title 
            array( $this, 'imgur_client_secret_callback' ), // Callback
            'my-setting-admin', // Page
            'imgur_section_id' // Section           
        );              

        
        //
        
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            __('Amazon Settings','wp-affiliate-system'), // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'amazon_access_key_id', // ID
            __('Amazon Access Key ID','wp-affiliate-system'), // Title 
            array( $this, 'amazon_access_key_id_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'amazon_secret_accesss_key', // ID
            __('Amazon Secret Access Key','wp-affiliate-system'), // Title 
            array( $this, 'amazon_secret_accesss_key_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        ); 
        
        add_settings_field(
            'amazon_associate_id', // ID
            __('Amazon Associates ID','wp-affiliate-system'), // Title 
            array( $this, 'amazon_associate_id_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );              

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        
        if( isset( $input['imgur_client_id'] ) )
            $new_input['imgur_client_id'] = sanitize_text_field( $input['imgur_client_id'] );

		if( isset( $input['imgur_client_secret'] ) )
            $new_input['imgur_client_secret'] = sanitize_text_field( $input['imgur_client_secret'] );

		if( isset( $input['amazon_access_key_id'] ) )
            $new_input['amazon_access_key_id'] = sanitize_text_field( $input['amazon_access_key_id'] );

		if( isset( $input['amazon_secret_accesss_key'] ) )
            $new_input['amazon_secret_accesss_key'] = sanitize_text_field( $input['amazon_secret_accesss_key'] );

		if( isset( $input['amazon_associate_id'] ) )
            $new_input['amazon_associate_id'] = sanitize_text_field( $input['amazon_associate_id'] );


        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function imgur_client_id_callback()
    {
        printf(
            '<input type="text" id="imgur_client_id" name="wpsa_option_name[imgur_client_id]" value="%s" />',
            isset( $this->options['imgur_client_id'] ) ? esc_attr( $this->options['imgur_client_id']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function imgur_client_secret_callback()
    {
        printf(
            '<input type="text" id="imgur_client_secret" name="wpsa_option_name[imgur_client_secret]" value="%s" />',
            isset( $this->options['imgur_client_secret'] ) ? esc_attr( $this->options['imgur_client_secret']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function amazon_access_key_id_callback()
    {
        printf(
            '<input type="text" id="amazon_access_key_id" name="wpsa_option_name[amazon_access_key_id]" value="%s" />',
            isset( $this->options['amazon_access_key_id'] ) ? esc_attr( $this->options['amazon_access_key_id']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function amazon_secret_accesss_key_callback()
    {
        printf(
            '<input type="text" id="amazon_secret_accesss_key" name="wpsa_option_name[amazon_secret_accesss_key]" value="%s" />',
            isset( $this->options['amazon_secret_accesss_key'] ) ? esc_attr( $this->options['amazon_secret_accesss_key']) : ''
        );
    }  
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function amazon_associate_id_callback()
    {
        printf(
            '<input type="text" id="amazon_associate_id" name="wpsa_option_name[amazon_associate_id]" value="%s" />',
            isset( $this->options['amazon_associate_id'] ) ? esc_attr( $this->options['amazon_associate_id']) : ''
        );
    }        

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="wpsa_option_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}

if( is_admin() ){
	$wpas_settings_page = new WPASSettingsPage();
}
    