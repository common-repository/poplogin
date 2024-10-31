<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Add option page - add settings - display settings
 * @package    Poplogin
 * @subpackage poplogin/admin
 * @author     tradesouthwest <tradesouthwest@gmail.com>
 */
   
add_action( 'admin_menu', 'poplogin_add_options_page' );
add_action( 'admin_init', 'poplogin_register_settings' );

/**
 * Add an options page under the Settings submenu
 * $page_title, $menu_title, $capability, $menu_slug, $function-to-render, $icon_url, $position
 * @since  1.0.0
 */
function poplogin_add_options_page() 
{
    add_options_page(
        __( 'Poplogin Settings', 'poplogin' ),
        __( 'Poplogin ', 'poplogin' ),
        'manage_options',
        'poplogin',
        'poplogin_options_page' 
    );
}

/**
 * Register all related settings of this plugin
 *
 * @since  0.0.1
 */
function poplogin_register_settings() 
{ 
    //$option_group, $option_name, $sanitize_callback
    register_setting( 'pluginPage', 'poplogin_settings' );
    
    // $section_name, $title, $callback, $page
    add_settings_section(
        'poplogin_pluginPage_section',
        __( 'Poplogin General Settings', 'poplogin' ),
        'poplogin_options_cb',
        'pluginPage'
    );
    //$id, $title, $callback, $page, $section = 'default', $args = array()
    //page or popup
    add_settings_field(
        'poplogin_select_field_1', 
		__( 'Use PopUp or Page', 'poplogin' ), 
		'poplogin_select_field_1_cb', 
		'pluginPage', 
		'poplogin_pluginPage_section' 
    ); 
    //title
    add_settings_field(
        'poplogin_text_field_2',
        __( 'Title or Company Name', 'poplogin'),
        'poplogin_text_field_2_cb',
        'pluginPage',
        'poplogin_pluginPage_section'
    );
     
    //font family
    add_settings_field(
        'poplogin_text_field_3',
        __( 'Font Family', 'poplogin' ),
        'poplogin_text_field_3_cb',
        'pluginPage',
        'poplogin_pluginPage_section'
    );
    
    //logo
    add_settings_field(
        'poplogin_text_field_4',
         __( 'Add Logo', 'poplogin' ),
        'poplogin_text_field_4_cb',
        'pluginPage',
        'poplogin_pluginPage_section'
    );
    
    //get menus
    add_settings_field(
        'poplogin_select_field_2',
         __( 'Add Link to This Menu', 'poplogin' ),
        'poplogin_select_field_2_cb',
        'pluginPage',
        'poplogin_pluginPage_section'
    );
}

/**
 * Render the usage option
 *
 * @since  1.0.0
 *
 * @string $def allows default value without storing 
 * that value in database.
 */
function poplogin_select_field_1_cb() 
{   
    
    $def = (int)1;
    $options = get_option( 'poplogin_settings' );
    $options_1 = $options['poplogin_select_field_1'];
	?>
	<select name='poplogin_settings[poplogin_select_field_1]'>
		<option value='1' <?php selected( $options_1, 1 ); ?>>Use Pop Up Please</option>
		<option value='0' <?php selected( $options_1, 0 ); ?>>Create a Login Page</option>
	</select><br>
    <label><?php esc_html_e( 'If using Page, place short-code [poplogin_form] in a page.', 
    'poplogin' ); ?></label>   
    
<?php
}
  
/**
 * Render the title option
 * @string $def = default title
 * @since  1.0.0
 */
function poplogin_text_field_2_cb() 
{ 
    
    $def = esc_attr__( 'Login', 'poplogin' );
    $options = get_option( 'poplogin_settings' );
    $options_2 = $options['poplogin_text_field_2'];
    ?>
    <input type="text" 
           id="poplog_title" 
           name="poplogin_settings[poplogin_text_field_2]"
           value="<?php echo $options_2; ?>"><br>
    <label><?php esc_html_e( 'Company Name or Title', 'poplogin'  ); ?></label>
       
<?php     
}

/**
 * Render the font family name option
 * @string $def = default image url
 * @since  1.0.0
 */
function poplogin_text_field_3_cb() 
{
    $def = esc_attr( 'inherit' );
    $options = get_option( 'poplogin_settings' );
    $options_3 = $options['poplogin_text_field_3'];
    if( $options_3 == '' ) $options_3 = $def;
    ?>
    <input type="text" 
           id="poplog_title" 
           name="poplogin_settings[poplogin_text_field_3]"
           value="<?php echo $options_3; ?>"><br>
    <label><?php esc_html_e( 'Enter Font Family Name', 'poplogin'  ); ?></label>
<?php   
} 

/**
 * Render the upload option
 *
 * @since  1.0.0
 */
function poplogin_text_field_4_cb() 
{ 
    $def = esc_url( plugin_dir_url(dirname(__FILE__)) . 'lib/poplogin-default-logo.png' );
    $options = get_option( 'poplogin_settings' );
    $options_4 = $options['poplogin_text_field_4'];
    if( $options_4 == '' ) $options_4 = $def;
    ?>
    <input type="text" 
           id="poplog_title" 
           name="poplogin_settings[poplogin_text_field_4]"
           value="<?php echo $options_4; ?>" size="42"><br>
           <label><?php esc_html_e( 'Enter URL of Logo', 'poplogin'  ); ?></label>
           <div class='image-preview-wrapper'>
               <img id='image-preview' src="<?php echo esc_url( $options_4 ); ?>" height='80'>
           </div>
   
<?php   
}

/**
 * Render the navigation link
 *
 * @since  1.0.0
 * @params $location values are the menu locations
 */
function poplogin_select_field_2_cb() 
{ 
    $def = esc_attr( 'primary' );
    $options_5 = get_option( 'poplogin_settings["poplogin_select_field_2"]' );
    //$options_5 = $options['poplogin_select_field_2'];
    if( $options_5 == '' ) $options_5 = $def;
    
        /**
         * @get_registered_nav_menus retrieves registered 
         * navigation menu locations in a theme.
         * Does not accept any parameters. 
         */
        $menus = get_registered_nav_menus();
        
        /**
         * Alternatively yo ucan use get_terms() 
         * $term, $taxonomy, $output, $filter 
         * Will accept params
         */
        //$actv_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
        ?> 
        
    <select name="poplogin_settings[poplogin_select_field_2]">
        
    <?php foreach ( $menus as $location => $description ) 
    { ?>

	    <option value="<?php echo esc_attr( $location ); ?>" 
	    <?php selected( $options_5, $location ) ?>>
	    <?php echo esc_html( $description ); ?></option> 
	        
    <?php 
    } ?>
	</select><br>
    <label><?php esc_html_e( 'Select your menu that you would like to add this link to.', 
    'poplogin' ); ?></label>   
    
<?php
}

/**
 * Provide a admin data view for the plugin
 *
 * @since      1.0.0
 *
 * @string $admHTML
 * @returns HTML
 */

function poplogin_display_admin_instructions() {
$poplog_time = get_option( 'poplogin_settings_plugin_activated' );
$admHtml = '';
$admHtml .= '<h2>';
$admHtml .= __( 'Pop up login page Information', 'mixmat' );
$admHtml .= '</h2>';
$admHtml .= '<table class="widefat">';
$admHtml .= '<thead><tr><th width="50%">Shortcode</th><th width="50%">Notes</th></tr></thead>';
$admHtml .= '<tbody><tr><td>'; 
$admHtml .= esc_html__( 'If using Page instead of the Pop Up, place this short-code', 'poplogin' );
$admHtml .= '<br><span style="margin: 5px;font-weight: 500;font-size:16px"> [poplogin_form] </span><br>';
$admHtml .= esc_html__( 'in the page. Then you will make a Menu Link for that page - maybe title the page Login.', 'poplogin' );
$admHtml .= '</td><td style="border-left:1px solid #ddd"><p>';
$admHtml .= esc_html__( 'Themes and plugins by Tradesouthwest ', 'poplogin' );
$admHtml .= ' <a href="https://paypal.me/tradesouthwest" class="button button-primary" title="paypal.me/tradesouthwest Opens in new window" target="_blank">';
$admHtml .= esc_html__( 'Donate if you like.', 'appeal' );
$admHtml .= '</a> <span style="border:1px solid #eee;border-radius:4px;text-align:center;background: #fdfdfd;width: 30px;height:50px;display:block;padding: 5px;"><a href="https://twitter.com/tradesouthwest" title="Twitter" target="_blank"> <img src="';
$admHtml .= esc_url( POPLOGIN_URL . 'lib/alpha-twitter.png');
$admHtml .= '" alt="tweet" height="24" style="margin-bottom: -7px;" /></a></span></p><p>';
$admHtml .= esc_html__( 'This plugin last installed date was: ', 'poplogin' );
$admHtml .= $poplog_time . '</p></td></tr>';
$admHtml .= '</tbody></table>';   
 return $admHtml;

} 
/**
 * Render the text for the general section
 *
 * @since  0.0.1
 */
function poplogin_options_cb() 
{
    echo '<p><hr></p><p><span class="dashicons dashicons-admin-settings" style="font-size: 24px"></span>';
    echo __( ' Please change the settings accordingly.', 'poplogin' ) . '</p>';
}

/**
 * Render the options page for plugin
 *
 * @since  0.0.1
 */
function poplogin_options_page() 
{
    /* if ( ! did_action( 'wp_enqueue_media' ) ) { 
	        wp_enqueue_media(); 
	} */
	?>
    <div id="PopAdmin" class="wrap">
    <style type="text/css">.form-table tr {border-bottom: 1px solid #ffffff;} </style>
      <form action="options.php" method="post">
        <fieldset>
        <?php 
          settings_fields( 'pluginPage' );
          do_settings_sections( 'pluginPage' );
          submit_button();
        ?>
        </fieldset>
      </form>
      <?php echo wp_kses_post( poplogin_display_admin_instructions() ); ?>
      
    </div>
<?php 
}

      
/**
 * Sanitize any integer before being saved to database
 *
 * @param  string $input = $_POST value
 * @since  1.0.0
 * @return string = Sanitized value
 */
function poplogin_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
            return intval( $input );
        }
    }

