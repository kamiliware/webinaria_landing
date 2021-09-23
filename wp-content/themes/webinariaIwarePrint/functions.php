<?php

//adds the viewport meta tag to the header.php file
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}
add_action( 'wp_enqueue_scripts', 'enqueue_function', 10 );
function enqueue_function() {
    $cssVersion = ( wp_get_environment_type() === 'development' ) ? time() : '1.1';
    $cashVersion = ( wp_get_environment_type() === 'development' ) ? time() : '1.1';
    $velocityVersion = ( wp_get_environment_type() === 'development' ) ? time() : '1.1';
    wp_enqueue_style( 'tailwind', get_template_directory_uri() . '/assets/css/main.css', $cssVersion, true );
    wp_enqueue_script('cash', get_template_directory_uri() . '/assets/js/cash.min.js', $cashVersion, true );
    wp_enqueue_script('velocity', get_template_directory_uri() . '/assets/js/velocity.min.js', $velocityVersion, true );
}

// Register WordPress nav menu
register_nav_menu('top', 'Top menu');

add_theme_support( "menus" );

//This is to activate the featured image in Posts
if(function_exists("add_theme_support")){
    add_theme_support( 'post-thumbnails' );
}

if(function_exists('add_image_size')){
    add_image_size( 'featured', 400, 250, true );
    add_image_size( 'post-thumb', 125, 75, true );
}

function create_post_type(){
    register_post_type( 'post-type-slug-name',
        array()
    );

}

function webinars_post_type() {
    register_post_type( 'webinars', [
            'rewrite'      => [
                'with_front' => false,
                'has-archive' => false,
                'slug'       => 'webinaria',
            ],
            'has-archive' => false,
            'hierarchical' => true,
            'public'       => true,
            'supports'     => [ 'title', 'editor', 'page-attributes', 'custom-fields' ],
            'labels'       => [
                'name' => 'Webinary',
                'all_items' => 'Lista webinarów',
                'singular_name' => 'Webinar',
                'add_new' => 'Dodaj webinar'
            ],
            'show_in_rest' => true,
        ]
    );
}

function monthTranslate($dateMonth): string
{
    switch($dateMonth):
        case 'Jan':
            $dateMonth = 'Sty';
            break;
        case 'Feb':
            $dateMonth = 'Lut';
            break;
        case 'Mar':
            $dateMonth = 'Mar';
            break;
        case 'Apr':
            $dateMonth = 'Kwi';
            break;
        case 'May':
            $dateMonth = 'Maj';
            break;
        case 'Jun':
            $dateMonth = 'Cze';
            break;
        case 'Jul':
            $dateMonth = 'Lip';
            break;
        case 'Aug':
            $dateMonth = 'Sie';
            break;
        case 'Sep':
            $dateMonth = 'Wrz';
            break;
        case 'Oct':
            $dateMonth = 'Paź';
            break;
        case 'Nov':
            $dateMonth = 'Lis';
            break;
        case 'Dec':
            $dateMonth = 'Gru';
            break;
        default:
            $dateMonth = '';
    endswitch;
    return $dateMonth;
}

add_action( 'init', function () {
    webinars_post_type();
} );

add_filter('use_block_editor_for_post', '__return_false');

//Prevents the <p> tag from getting automatically insterted
remove_filter('the_content', 'wpautop');

add_action( 'init', 'create_post_type' );