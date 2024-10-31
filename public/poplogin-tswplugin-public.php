<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    Poplogin
 * @subpackage poplogin/public
 * @author     tradesouthwest <tradesouthwest@gmail.com>
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

//do not run this set of statments outside of the plugin
if (!defined('POPLOGIN_VER')) {
    return; 
    } else { 
    /**
     * decide if popup is used or if page is used in plugin
     * A 1 = popup, a 0 = page
     */
    $def_1 = (int)1;
    $options = get_option( 'poplogin_settings' );
    $options_1 = $options['poplogin_select_field_1'];
    if( $options_1 == '' ) $options_1 = $def_1;

    //menu add link
    $def = esc_attr( 'primary' );
    $options_5 = get_option( 'poplogin_settings["poplogin_select_field_2"]' );
    //$options_5 = $options['poplogin_select_field_2'];
    if( $options_5 == '' ) $options_5 = $def;

    //A 1 =put popup modal in footer 
    if( $options_1 == "1" ) : 
        
        add_action( 'wp_footer', 'poplogin_login_form_render', 10, 2 );
        add_filter( 'wp_nav_menu_items', 'poplogin_add_popup_link', 10, 2);
        
        else : 
    /**
     * Remove action $tag, $function_to_remove, $priority order!
     * https://developer.wordpress.org/reference/functions/remove_action/
    */
        remove_action( 'wp_footer', 'poplogin_login_form_render', 9 );
        remove_filter( 'wp_nav_menu_items', 'poplogin_add_popup_link', 9);
        
    endif; 
}
/**
 * The plugin form rendering function
 *
 * @since             1.0.0
 */
     
function poplogin_login_form_render() 
{          
    $def_1 = (int)1;
    $options = get_option( 'poplogin_settings' );
    $options_1 = $options['poplogin_select_field_1'];
    if( $options_1 == '' ) $options_1 = $def_1;
    //Title
    $def_2 = esc_attr__( 'Login', 'poplogin' );
    $options = get_option( 'poplogin_settings' );
    $options_2 = $options['poplogin_text_field_2'];
     if( $options_2 == '' ) $options_2 = $def_2;
    //font family
    $def_3 = esc_attr( 'inherit' );
    $options = get_option( 'poplogin_settings' );
    $options_3 = $options['poplogin_text_field_3'];
    if( $options_3 == '' ) $options_3 = $def_3;
    //image
    $def_4 = esc_url( plugin_dir_url(dirname(__FILE__)) . 'lib/poplogin-default-logo.png' );
    $options = get_option( 'poplogin_settings' );
    $options_4 = $options['poplogin_text_field_4'];
    if( $options_4 == '' ) $options_4 = $def_4;

//hide the modal part of login div
if( $options_1 == "1" ) : 
?>
<div class="blackout"> 
<div id="poplogModal" class="poplog-modal">
    <div class="poplog-modal-content">
        <span class="poplog-close">&times;</span>
<?php endif; 
?>
    
        <div class="poploginWrap">
    
            <div id="poploginDiv">
                <header class="poplog-logo"> 
                    <img src="<?php echo esc_url( $options_4 ); ?>" 
                         alt="<?php esc_html( $options_2 ); ?>" />
                    <h1 class="poplog-title" style="font-family:<?php echo esc_attr( $options_3 ); ?>;">
                    <?php echo esc_html( $options_2 ); ?></h1>
                </header>
            
                <div class="poplogin-login">
                
                    <?php wp_login_form(); ?>
                
                <hr>
                <?php /* if( get_option( 'poplogin_settings["poplog_showreg"]' )) { */ 
                ?>
                <a href="<?php echo wp_registration_url(); ?>">
                    <?php esc_html_e( 'Register', 'poplogin' ); ?></a>
                <?php //} 
                ?>
                
            </div>
        </div>
    </div>
    
<?php 
if( $options_1 == "1" ) : 
?> 

    </div>
</div>
</div>

<?php endif; 
?>
<?php 
}
add_shortcode( 'poplogin_form', 'poplogin_login_form_render' );


/**
 * Add a login link to the members navigation
 * @id #poplogBtn opens modal
 * @wp_logout Retrieves the logout URL.
 */
function poplogin_add_popup_link( $items, $args )
{
    $def = esc_attr( 'primary' );
    $location = get_option( 'poplogin_settings["poplogin_select_field_2"]' );
    //$options_5 = $options['poplogin_select_field_2'];
    if( $location == '' ) $location = $def;
    
    if($args->theme_location == $location)
    {
        if(is_user_logged_in())
        {
            $items .= '<li class="poplog-show"><a id="poplogCls" href="' . wp_logout_url() . '">' 
                      . esc_html__( 'Log Out', 'poplogin' ) . '</a></li>';
        } else {
            $items .= '<li class="poplog-show"><a id="poplogBtn" href="#">' 
                      . esc_html__( 'Log In', 'poplogin' ) . '</a></li>';
        }
    }

    return $items;
}

