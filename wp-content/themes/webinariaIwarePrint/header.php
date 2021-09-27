<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php the_title(); ?> - <?php bloginfo('title'); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5f80982985.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= get_template_directory_uri(); ?>/assets/images/favicon.png" type="image/png"/>
	<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white min-h-screen overflow-hidden">
    <header id="mainHeader" class="p-4 bg-white text-gray-800 md:absolute inset-x-0 top-0 dark:bg-gray-800 dark:text-white clearfix transition-all z-10 shadow-lg">
        <div class="pageContainer mx-auto px-4">
            <a id="mainLogo" href="<?= esc_url(home_url('/')); ?>" class="md:inline-block block text-center transition-all dark:grayscale"><img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="logo IwarePrint" class="inline"></a>
            <nav class="md:float-right clearfix">
<!--                --><?php //wp_nav_menu([
//                'menu'            => 'top',
//                'theme_location'  => 'top',
//                'menu_id'         => false,
//                'menu_class'      => 'menu',
//                'depth'           => 0,
//                ]); ?>
                <ul>
                    <li class="md:inline-block md:float-none float-left md:w-auto w-full transition-all dark:grayscale"><a class="md:p-4 py-4 px-0 block text-violet-dark transition-all hover:text-cyan dark:text-white" href="tel:533025708"><i class="fas fa-phone-volume text-cyan fill-current -rotate-45"></i> 533 025 708</a></li>
                    <li class="md:inline-block md:float-none float-left md:w-auto w-full transition-all dark:grayscale"><a class="md:p-4 py-4 px-0 block text-violet-dark transition-all hover:text-cyan dark:text-white" href="mailto:bok@iwareprint.pl"><i class="fas fa-envelope text-cyan fill-current"></i> bok@iwareprint.pl</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <script>
        window.onload = load;
        function load()
        {
            const mainHeader = $('#mainHeader');
            const mainHeaderContainer = $('#mainHeader .pageContainer');
            let headerHeight = mainHeader.height();
            const adminBar = $('#wpadminbar');
            let windowWidth = $(window).innerWidth;
            if (adminBar.length && windowWidth > 768) {
                adminBar.css('top', 'calc(100% - 32px)');
                $('html').attr('style', 'margin-top: 0!important');
            }
            if (mainHeader.length) {
                if(windowWidth > 768) {
                    $('#page').css('padding-top', headerHeight + 'px');
                } else {
                    $('#page').css('padding-top', 0);
                }
                // $(window).on('resize', function() {
                //     if(windowWidth > 768) {
                //         $('#page').css('padding-top', headerHeight + 'px');
                //     } else {
                //         $('#page').css('padding-top', 0);
                //     }
                // })
            }
            let lastKnownScrollPosition = headerHeight;
            let ticking = false;

            function doSomething(scrollPos) {
                if(windowWidth > 768) {
                    if (scrollPos >= headerHeight / 2) {
                        mainHeader.addClass('md:fixed p-1').removeClass('md:absolute p-4');
                        mainHeaderContainer.addClass('py-1');
                    } else {
                        mainHeader.addClass('md:absolute p-4').removeClass('md:fixed p-1');
                        if (mainHeaderContainer.hasClass('py-1')) {
                            mainHeaderContainer.removeClass('py-1');
                        }
                    }
                }
            }

            document.addEventListener('scroll', function(e) {
                lastKnownScrollPosition = window.scrollY;

                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        doSomething(lastKnownScrollPosition);
                        ticking = false;
                    });

                    ticking = true;
                }
            });
        }
    </script>
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
