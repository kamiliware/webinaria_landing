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

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_6149d2efd4968',
        'title' => 'Webinary',
        'fields' => array(
            array(
                'key' => 'field_6149d35f29d55',
                'label' => 'Data i godzina',
                'name' => 'data_i_godzina',
                'type' => 'date_time_picker',
                'instructions' => 'Po klinknięciu pojawi się kalendarz wyboru dnia i godziny.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'Y-m-d H:i',
                'return_format' => 'd-m-Y H:i',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_6149db3f0dd59',
                'label' => 'Bezpłatne',
                'name' => 'bezplatne',
                'type' => 'select',
                'instructions' => 'Czy webinar jest bezpłatny?',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '20',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'TAK' => 'TAK',
                    'NIE' => 'NIE',
                ),
                'default_value' => 'TAK',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_6149dbaf0dd5a',
                'label' => 'Koszt',
                'name' => 'koszt',
                'type' => 'number',
                'instructions' => 'Ile wynosi opłata za wzięcie udziału.',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6149db3f0dd59',
                            'operator' => '==',
                            'value' => 'NIE',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => 'PLN',
                'min' => 0,
                'max' => 999,
                'step' => '',
            ),
            array(
                'key' => 'field_614c7cbdd4191',
                'label' => 'Link do ClickMeeting',
                'name' => 'link_do_clickmeeting',
                'type' => 'text',
                'instructions' => 'Z ClickMeeting należy wejść na szczegóły wydarzenia i wkleić tutaj "Adres URL wydarzenia"',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'Przykład: https://iwareprint.clickmeeting.com/przyklad',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_1632740879',
                'label' => 'Zakończony',
                'name' => 'active',
                'type' => 'select',
                'instructions' => 'Jeśli zakończyłeś webinar wybierz TAK',
                'required' => 1,
                'conditional_logic' => 0,
                'choices' => array(
                    'TAK' => 'TAK',
                    'NIE' => 'NIE',
                ),
                'default_value' => 'NIE',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'wrapper' => array(
                    'width' => '25',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'field_614c804816162',
                'label' => 'ID YouTube Video',
                'name' => 'id_youtube_video',
                'type' => 'text',
                'instructions' => 'ID zapisanego na YouTube webinaru',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_1632740879',
                            'operator' => '==',
                            'value' => 'TAK',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '25',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => 'https://www.youtube.com/watch?v=',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'webinars',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'permalink',
            1 => 'the_content',
            2 => 'discussion',
            3 => 'comments',
            4 => 'author',
            5 => 'featured_image',
            6 => 'tags',
        ),
        'active' => true,
        'description' => '',
    ));

endif;


add_action( 'init', function () {
    webinars_post_type();
} );

add_filter('use_block_editor_for_post', '__return_false');

//Prevents the <p> tag from getting automatically insterted
remove_filter('the_content', 'wpautop');

add_action( 'init', 'create_post_type' );