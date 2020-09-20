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
 * @package mun
 */

get_header();
?>

<main class="mun_main">
    <div class="mun_bg" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/backdrop.svg);">
        <div class="bg_abstract" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/bg-abstract.png);"></div>
        <div class="tabs_bg">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-mission" data-toggle="pill" href="#mission" role="tab"
                        aria-controls="mission" aria-selected="true"> <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/mission.png" alt="">
                        <label for="">Mission</label></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-ambassadors" data-toggle="pill" href="#ambassadorse" role="tab"
                        aria-controls="ambassadors" aria-selected="false"><img src="<?php echo get_template_directory_uri();?>/assets/img/icons/ambassadors.png"
                            alt=""> <label for="">Ambassadors</label></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-participate" data-toggle="pill" href="#participate" role="tab"
                        aria-controls="participate" aria-selected="false"><img src="<?php echo get_template_directory_uri();?>/assets/img/icons/participate.png"
                            alt=""> <label for="">Contestants</label></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="tab-avatar" data-toggle="pill" href="#avatar" role="tab"
                        aria-controls="avatar" aria-selected="false"><img src="<?php echo get_template_directory_uri();?>/assets/img/icons/avatar.png" alt="">
                        <label for="">Avatars</label></a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" id="tab-kpi" data-toggle="pill" href="#kpi" role="tab" aria-controls="kpi" aria-selected="false"><img src="<?php echo get_template_directory_uri();?>/assets/img/icons/kpi.png" alt=""> <label for="">KPI's</label></a>
                    </li> -->
            </ul>
        </div>
        <div class="bg_manadala">
            <img src="<?php echo get_template_directory_uri();?>/assets/img/half-mandala.png" alt="">
        </div>
    </div>

    <div class="bg_contents">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="logo_bg">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/mun-logo.svg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Mission -->
                        <div class="tab-pane fade show active" id="mission" role="tabpanel"
                            aria-labelledby="tab-mission">
                            <div class="main_heading mb-30">
                                <h2>Mission</h2>
                            </div>
                            <div uk-lightbox class="slider-ambassdor owl-carousel owl-theme">
                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image1.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video2.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image2.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video3.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image3.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video4.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image4.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Ambassadors -->
                        <div class="tab-pane fade" id="ambassadorse" role="tabpanel" aria-labelledby="tab-ambassadors">
                            <div class="main_heading mb-30">
                                <h2>Ambassadors</h2>
                            </div>
                            <div uk-lightbox class="slider-mission owl-carousel owl-theme">
                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image5.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video2.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image2.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video3.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image3.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video4.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image4.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Partcipate -->
                        <div class="tab-pane fade" id="participate" role="tabpanel" aria-labelledby="tab-participate">
                            <div class="main_heading mb-30">
                                <h2>Partcipate</h2>
                            </div>

                            <div uk-lightbox class="slider-partcipate owl-carousel owl-theme">
                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image5.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>

                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video2.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image4.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>

                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video3.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image3.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>

                                    </div>
                                </a>

                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video4.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image2.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Avtar0 -->
                        <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="tab-participate">
                            <div class="main_heading mb-30">
                                <h2>Avatar</h2>
                            </div>
                            <div uk-lightbox class="">
                                <a class="uk-button item-img item" href="<?php echo get_template_directory_uri();?>/assets/img/mun-video.mp4"
                                    style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/thum/image4.png);">
                                    <div class="">
                                        <div class="play_icon">
                                            <img class="pl1" src="<?php echo get_template_directory_uri();?>/assets/img/icons/play.svg" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
//get_sidebar();
get_footer();