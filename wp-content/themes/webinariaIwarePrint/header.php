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
    <link rel="icon" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/favicon.png" type="image/png"/>
	<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white min-h-screen overflow-hidden">
    <header id="mainHeader" class="p-4 bg-white text-gray-800 absolute inset-x-0 top-0 dark:bg-gray-600 dark:text-white clearfix transition-all z-10 shadow-lg">
        <div class="pageContainer mx-auto px-4">
            <a id="mainLogo" href="<?= esc_url(home_url('/')); ?>" class="inline-block transition-all dark:grayscale"><img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="logo IwarePrint"></a>
            <nav class="float-right">
                <?php wp_nav_menu([
                'menu'            => 'top',
                'theme_location'  => 'top',
                'menu_id'         => false,
                'menu_class'      => 'menu',
                'depth'           => 0,
                ]); ?>
                <ul>
                    <li class="inline-block"><a class="px-4 py-4 block text-violet-dark transition-all hover:text-cyan" href="tel:533025708"><i class="fas fa-phone-volume text-cyan fill-current -rotate-45"></i> 533 025 708</a></li>
                    <li class="inline-block"><a class="px-4 py-4 block text-violet-dark transition-all hover:text-cyan" href="mailto:bok@iwareprint.pl"><i class="fas fa-envelope text-cyan fill-current"></i> bok@iwareprint.pl</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <script>
        window.onload = load;
        function load()
        {
            const mainHeader = $('#mainHeader');
            let headerHeight = mainHeader.height();
            const adminBar = $('#wpadminbar');
            if (adminBar.length) {
                adminBar.css('top', 'calc(100% - 32px)');
                $('html').attr('style', 'margin-top: 0!important');
            }
            if (mainHeader.length) {
                $('#page').css('padding-top', headerHeight + 'px');
            }
            let lastKnownScrollPosition = headerHeight;
            let ticking = false;

            function doSomething(scrollPos) {
                if (scrollPos >= headerHeight / 2) {
                    mainHeader.addClass('fixed').removeClass('absolute');
                } else {
                    mainHeader.addClass('absolute').removeClass('fixed');
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
