<?php
/*
 * Set up the content width value based on the theme's design.
 */
if (!function_exists('PetShopSetup')) :
    function PetShopSetup() {
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 870;
        }
        // Make petshop theme available for translation.
        load_theme_textdomain('petshop', get_template_directory() . '/languages');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // register menu 
        register_nav_menus(array(
            'primary' => __('Top Menu', 'petshop'),
            'footer' => __('Footer Menu', 'petshop'),
        ));

        // Featured image support
        add_theme_support('post-thumbnails');
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 510,
            'flex-height' => true,
            'header-text' => array( 'img-responsive', 'site-description' ), 
        ) );
        add_image_size('petShopThumbnailImage', 800, 450, true);
        add_image_size('petShopBlogThumbnailImage', 1540, 390, true);
        // Switch default core markup for search form, comment form, and commen, to output valid HTML5.
        add_theme_support('html5', array('comment-list'));
        add_theme_support( "custom-header");
        // Add support for featured content.
        add_theme_support('featured-content', array(
            'featured_content_filter' => 'petShopGetFeaturedPosts',
            'max_posts' => 6,
        ));
        /* slug setup */
        add_theme_support('title-tag');
    }
endif;
add_action('after_setup_theme', 'PetShopSetup');

function PetShopSpecialNavClass($classes, $item){
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}
function PetShopExcerptMore($more) {
    global $post;
    return '<a class="readmore" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'PetShopExcerptMore');

function petshopMenuSettings() {
    $petshopMenu = array(
        'page_title' => __('Petshop Pro Features', 'petshop'),
        'menu_title' => __('Petshop Pro Features', 'petshop'),
        'capability' => 'edit_theme_options',
        'menu_slug' => 'petshop',
        'callback' => 'petshopProPage'
    );
    return apply_filters('petshopProMenu', $petshopMenu);
}

add_action('admin_menu', 'petshopOptionsAddPage');

//Documentation Menu Link
add_action('admin_menu', 'petshopOptionsAddPage');
function petshopOptionsAddPage() {
  $petshopMenu = petshopMenuSettings();
  add_theme_page($petshopMenu['page_title'], $petshopMenu['menu_title'], $petshopMenu['capability'], $petshopMenu['menu_slug'], $petshopMenu['callback']);
  add_theme_page( 'Petshop Documentation', 'Petshop Documentation', 'manage_options', 'petshop-documentation', 'petshopDocumentation', 400 );
}

function petshopProPage(){?>
<div class="petshopProVersion">
  <a href="<?php echo esc_url('https://indigothemes.com/products/petshop-pro-wordpress-theme/'); ?>" target="_blank">
    <img src ="<?php echo esc_url('https://indigothemes.com/wp-content/uploads/petshop/features.jpg') ?>" width="100%" height="auto" />
  </a>
</div>
<?php 
}
function petshopDocumentation(){ ?>
  <script>
    window.location = "https://indigothemes.com/documentation/petshop";
  </script>
<?php }

/** Enqueue css and js files **/
require get_template_directory() . '/functions/theme-default-setup.php';
require get_template_directory() . '/functions/widget.php';
require get_template_directory() . '/functions/enqueue-files.php';
require get_template_directory() . '/functions/theme-customization.php';
require get_template_directory() . '/functions/breadcrumbs.php'; 
require_once get_template_directory() . '/functions/class-tgm-plugin-activation.php';
/*
* TGM plugin activation register hook 
*/
add_action( 'tgmpa_register', 'petShopActionTgmPluginActiveRegisterRequiredPlugins' );
function petShopActionTgmPluginActiveRegisterRequiredPlugins() {
    if(class_exists('TGM_Plugin_Activation')){
      $plugins = array(
        array(
           'name'      => __('Page Builder by SiteOrigin','petshop'),
           'slug'      => 'siteorigin-panels',
           'required'  => true,
        ),
        array(
           'name'      => __('SiteOrigin Widgets Bundle','petshop'),
           'slug'      => 'so-widgets-bundle',
           'required'  => true,
        ),        
      );
      $config = array(
        'default_path' => '',
        'menu'         => 'petshop-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
           'page_title'                      => __( 'Install Required Plugins', 'petshop' ),
           'menu_title'                      => __( 'Install Plugins', 'petshop' ),
           'installing'                      => __( 'Installing Plugin: %s', 'petshop' ), 
           'oops'                            => __( 'Something went wrong with the plugin API.', 'petshop' ),
           'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','petshop' ), 
           'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','petshop' ), 
           'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','petshop' ), 
           'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','petshop' ), 
           'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','petshop' ), 
           'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','petshop' ), 
           'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','petshop' ), 
           'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','petshop' ), 
           'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins','petshop' ),
           'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins','petshop' ),
           'return'                          => __( 'Return to Required Plugins Installer', 'petshop' ),
           'plugin_activated'                => __( 'Plugin activated successfully.', 'petshop' ),
           'complete'                        => __( 'All plugins installed and activated successfully. %s', 'petshop' ), 
           'nag_type'                        => 'updated'
        )
      );
      petshop( $plugins, $config );
    }
}
?>