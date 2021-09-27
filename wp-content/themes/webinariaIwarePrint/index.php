<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>
    <section class="bg-violet-dark text-white py-10">
        <div class="pageContainer">
            <header class="page-header text-center">
                <span class="text-cyan-dark text-2xl font-bold">Webinaria</span>
                <h1 class="page-title text-white my-4 md:text-6xl text-4xl font-black"><?php the_title(); ?></h1>
            </header><!-- .page-header -->
            <article class="-mx-6 clearfix">
                <?php
                    $query = new WP_Query(
                            array(
                                'showposts' => 2,
                                'post_type' => 'webinars',
                                'orderby' => 'meta_value',
                                'meta_key' => 'data_i_godzina',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'active',
                                        'value'   => 'NIE',
                                    ),
                                ),

                            )
                    );
                    $ids = [];
                    $arrLocales = array('pl_PL', 'pl','Polish_Poland.28592');
                    $date = '';
                    $dateFormatted = '';
                    $dateWorkaround = '';
                    $dateHour = '';
                    setlocale( LC_ALL, $arrLocales );
                    if ($query->post_count == 0): ?>
                        <p class="text-center text-xl text-white">Nie ma webinarów. Dodaj je z panelu administracyjnego</p>
                    <?php else:
                    foreach ($query->posts as $post): ?>
                        <div class="p-6 md:w-6/12 w-full inline-block align-top" style="margin-right: -4px">
                            <div class="bg-violet-darker rounded-lg p-10">
                                <div class="mb-8 clearfix">
                                    <?php
                                        $date = date_create(get_field('data_i_godzina'));
                                        $dateFormatted = date_format($date, "j M Y H:i");
                                        $dateMonth = date_format($date, "M");
                                        $dateMonth = monthTranslate($dateMonth);
                                        $now = time();
                                        $your_date = strtotime($dateFormatted);
                                        $dateDiff = $your_date - $now;
                                        $calculateDaysLeft = ($dateDiff / 86400);
                                        $toHours = $dateDiff / 3600;
                                        $dateWorkaround = date_format($date, 'j') . ' ' . $dateMonth . ' ' . date_format($date, 'Y') ;
                                        $dateHour = date_format($date, 'H:i');
                                    ?>
                                    <div class="float-left text-cyan-dark font-black text-2xl">
                                        <?php
                                            if ($calculateDaysLeft >= 1):
                                                echo round($calculateDaysLeft) . ' dni do webinaru';
                                            elseif ($calculateDaysLeft >= 0):
                                                echo round($toHours) . ' godziny do webinaru';
                                            else:
                                                echo 'Zakończone';
                                            endif;
                                        ?>
                                    </div>
                                    <?php
                                        $fieldPayment = '';
                                        if(get_field('bezplatne') == 'TAK'):
                                            $fieldPayment = 'Bezpłatne';
                                        else:
                                            $price = get_field('koszt');
                                            $fieldPayment = "Cena: $price PLN";
                                        endif;
                                    ?>
                                    <div class="float-right text-gray-200 font-black text-md"><?= $fieldPayment ?></div>
                                </div>
                                <h2 class="text-white font-black md:text-4xl text-2xl md:mb-8 mb-4"><?= $post->post_title; ?></h2>
                                <div class="clearfix">
                                    <div class="text-gray-100 float-left pr-4 font-light text-2xl md:w-6/12 w-full">
                                        <i class="fas fa-calendar-alt text-cyan-dark fill-current text-4xl align-middle mr-2"></i> <span class="align-middle"><?= $dateWorkaround ?></span>
                                    </div>
                                    <div class="text-gray-100 float-left pr-4 font-light text-2xl md:w-6/12 w-full">
                                        <i class="fas fa-stopwatch text-cyan-dark fill-current text-4xl align-middle mr-2"></i> <span class="align-middle">Start: <?= $dateHour ?></span>
                                    </div>
                                </div>
                                <div class="wrapper">
                                <?php if ( !empty(get_field('link_do_clickmeeting')) ): ?>
                                    <a href="<?= get_field('link_do_clickmeeting') ?>" data-url="<?= get_field('link_do_clickmeeting') ?>" target="_blank" class="button mt-8 joinMeeting">Dołącz</a>
<!--                                    <script>-->
<!--                                        $('.joinMeeting').on('click', function(e) {-->
<!--                                            e.stopImmediatePropagation();-->
<!--                                            e.preventDefault();-->
<!--                                            let my_awesome_script = document.createElement('script');-->
<!--                                            my_awesome_script.setAttribute('src', $(this).attr('data-url'));-->
<!--                                            $('body').css('overflow', 'hidden');-->
<!--                                            $('.wrapper').css({-->
<!--                                                "position": "fixed",-->
<!--                                                "top": "0",-->
<!--                                                "right": "0",-->
<!--                                                "bottom": "0",-->
<!--                                                "left": "0",-->
<!--                                                "background": "rgba(0,0,0,.3)",-->
<!--                                                "z-index": "11",-->
<!--                                                "padding": "10vh 10vw"-->
<!--                                            })-->
<!--                                            $(this).parent().html('<div id="meetModal" style="max-height:640px" class="w-full h-full max-w-screen-sm bg-white m-auto overflow-hidden"></div>');-->
<!--                                            setTimeout(function() {-->
<!--                                                $('#meetModal').append(my_awesome_script);-->
<!--                                            }, 100)-->
<!--                                        })-->
<!--                                        $('.wrapper').on('click', function () {-->
<!--                                            location.reload();-->
<!--                                        })-->
<!--                                    </script>-->
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php
                        $ids[] = get_the_ID();
                        endforeach;
                        endif;
                    ?>
            </article>
        </div>
    </section>
    <section class="bg-gray-100 dark:bg-gray-400 py-10">
        <div class="pageContainer">
            <header class="page-header text-center"><span class="text-cyan text-2xl font-bold">Lista Webinarów</span>
                <h2 class="page-title text-violet py-4 md:text-4xl text-3xl font-black dark:text-white">Wybierz inne webinary spośród listy</h2>
            </header>
            <article class="box-wrap my-8 clearfix">
                <?php
                $queryMore = new WP_Query(
                    array(
                        'post_type' => 'webinars',
                        'orderby' => 'meta_value',
                        'meta_key' => 'data_i_godzina',
                        'order' => 'ASC',
                        'post__not_in' => $ids,
                        'meta_query' => array(
                            array(
                                'key'     => 'active',
                                'value'   => 'NIE',
                            ),
                        ),
                    )
                );
                if ($queryMore->post_count == 0): ?>
                    <p class="text-center text-md text-gray-800">Nie ma więcej webinarów</p>
                <?php
                    else:
                        foreach ($queryMore->posts as $post): ?>
                        <div class="box relative bg-white dark:bg-gray-300 p-4 sm:pl-16 my-2 shadow-md rounded-md w-full">
                            <div class="relative clearfix md:table w-full">
                                <div class="postTitle align-left md:w-6/12 md:border-r md:border-solid md:border-gray-100 md:table-cell md:align-middle py-4">
                                    <h3 class="text-cyan dark:text-gray-100 font-black md:text-3xl text-xl inline-block"><?= $post->post_title; ?></h3>
                                </div>
                                <div class="md:w-2/12 sm:w-6/12 sm:border-r sm:border-solid sm:border-gray-100
                                             md:table-cell md:align-middle md:inset-y-4 align-left p-4">
                                    <i class="fas fa-calendar-alt text-cyan dark:text-gray-100 fill-current text-2xl align-middle mr-2"></i>
                                    <span class="text-black dark:text-white text-md align-middle"><?= $dateWorkaround ?></span>
                                </div>
                                <div class="md:w-4/12 sm:w-6/12 md:inset-y-4 md:table-cell md:align-middle align-center py-4 px-6">
                                    <i class="fas fa-stopwatch text-cyan dark:text-gray-100 fill-current text-2xl align-middle mr-2"></i>
                                    <span class="text-black dark:text-white text-md align-middle"><?= $dateHour ?></span>
                                    <?php if ( !empty(get_field('link_do_clickmeeting')) ): ?>
                                        <a href="<?= get_field('link_do_clickmeeting') ?>" target="_blank" class="button reverse float-right -mt-4">Rejestracja</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
            </article>
        </div>
    </section>
    <section class="bg-violet-light py-10">
        <div class="pageContainer">
            <header class="page-header text-center mb-8"><span class="text-cyan-dark text-2xl font-bold">Archiwalne webinary</span>
                <h2 class="page-title text-white py-4 md:text-4xl text-3xl font-black">Zobacz co Cię ominęło, lub obejrzyj ponownie</h2>
            </header>
            <article class="text-center">
                <?php $queryVideos = new WP_Query(
                        array(
                            'post_type' => 'webinars',
                            'meta_key' => 'id_youtube_video',
                            'meta_value' => '',
                            'meta_compare' => '!=',
                            'order' => 'ASC'
                        )
                    );
                if ($queryVideos->post_count == 0): ?>
                    <p class="text-center text-md text-white">Nie ma więcej webinarów</p>
                <?php else:
                foreach ($queryVideos->posts as $post): ?>
                    <div class="lg:w-4/12 md:w-6/12 w-full max-w-xs bg-violet-darker rounded-md inline-block" style="margin-right: -4px">
                        <div class="thumbnail">
                            <div class="youtube-player" data-id="<?php the_field('id_youtube_video'); ?>"></div>
                        </div>
                        <h5 class="p-8 text-white font-black font-xl"><?php the_title();?></h5>
                        <?php if (is_null(get_field('id_youtube_video'))): ?>
                            Tutaj nie ma żadnego filmu
                        <?php endif; ?>
                    </div>
                <?php endforeach;
                    endif;?>
            </article>
            <script src="<?= get_template_directory_uri(); ?>/assets/js/youtubeHandler.js"></script>
        </div>
    </section>
    <section class="bg-white py-10 dark:bg-gray-400">
        <div class="pageContainer py-20 clearfix">
            <div class="md:w-6/12 w-full md:float-right text-center">
                <img class="inline" src="<?= get_template_directory_uri(); ?>/assets/images/calendar.png" alt="IwarePrint klient oglądający webinar">
            </div>
            <div class="md:w-6/12 w-full md:float-left md:pt-20 pt-10">
                <h2 class="text-violet-dark font-black py-4 md:text-4xl text-3xl dark:text-white">Umów wygodną datę dla siebie</h2>
                <h4 class="text-violet-dark font-light pb-4 md:text-2xl text-xl dark:text-gray-100">Rezerwuj indywidualne spotkania on-line</h4>
                <img src="<?= get_template_directory_uri(); ?>/assets/images/calendly.png" alt="Calendly">
                <a href="https://calendly.com/iware-print-sprzedaz" target="_blank" class="button mt-4">Rezerwuj termin</a>
            </div>
        </div>
    </section>

    <?php
    wp_reset_query(); //resetting the page query



get_footer();
