<?php
class MySettingsPage
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
            'Settings Admin', 
            'Navigation menu settings', 
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
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h1>Side Navigation Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
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
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Side menu settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  
        add_settings_field(
	        'title',
	        'Menu Title',
	        array($this, 'title_callback'),
	        'my-setting-admin',
	        'setting_section_id'
        );
        add_settings_field(
            'facebook', // ID
            'Facebook Link', // Title 
            array( $this, 'facebook_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'twitter', 
            'Twitter Link', 
            array( $this, 'twitter_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );   
       add_settings_field(
            'linkedin', // ID
            'LinkedIn Link', // Title 
            array( $this, 'linkedin_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );        
         add_settings_field(
            'youtube', // ID
            'YouTube Link', // Title 
            array( $this, 'youtube_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );                
        add_settings_field(
	        'bg-color',
	        'Menu background color',
	        array($this, 'bgcolor_callback'),
	        'my-setting-admin',
	        'setting_section_id'
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
        if( isset( $input['facebook'] ) )
            $new_input['facebook'] =  $input['facebook'] ;

        if( isset( $input['twitter'] ) )
            $new_input['twitter'] = sanitize_text_field( $input['twitter'] );
        if( isset( $input['bg-color'] ) )
            $new_input['bg-color'] = sanitize_text_field( $input['bg-color'] );
		if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );
		if( isset( $input['linkedin'] ) )
            $new_input['linkedin'] = sanitize_text_field( $input['linkedin'] );
		if( isset( $input['youtube'] ) )
            $new_input['youtube'] = sanitize_text_field( $input['youtube'] );
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your side menu settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function facebook_callback()
    {
        printf(
            '<input type="text" id="facbook" name="my_option_name[facebook]" value="%s" />',
            isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_callback()
    {
        printf(
            '<input type="text" id="twitter" name="my_option_name[twitter]" value="%s" />',
            isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
        );
    }
    public function bgcolor_callback()
    {
	    printf(
            '<input type="text" class="color-picker" name="my_option_name[bg-color]" id="color-picker" value="%s" />',
            isset( $this->options['bg-color'] ) ? esc_attr( $this->options['bg-color']) : ''
        );

    }
        public function title_callback()
    {
	    printf(
            '<input type="text" id="title" name="my_option_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );

    }
     public function linkedin_callback()
    {
	    printf(
            '<input type="text" id="linkedin" name="my_option_name[linkedin]" value="%s" />',
            isset( $this->options['linkedin'] ) ? esc_attr( $this->options['linkedin']) : ''
        );

    }
     public function youtube_callback()
    {
	    printf(
            '<input type="text" id="youtube" name="my_option_name[youtube]" value="%s" />',
            isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
        );

    }


}
add_action('admin_head', 'my_custom_styling');

function my_custom_styling() {
  echo '<style>
   
    .settings_page_my-setting-admin input
    {
	    width:90%;
	}
	input[type="submit"]
	{
		width:initial;
		}
  </style>';
}
if( is_admin() )
    $my_settings_page = new MySettingsPage();