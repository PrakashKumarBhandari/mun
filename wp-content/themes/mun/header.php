<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mun
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/assets/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri();?>/assets/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri();?>/assets/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri();?>/assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri();?>/assets/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="d-lg-block">
        <header class="mun-header mun-header--fullscreen">
            <div class="mun-navbar mun-navbar--main mun-navbar--transparent mun-navbar--sticky mun-navbar--white-text-on-top">
                <div class="container">
                    <div class="mun-navbar-inner">
                        <div class="mun-navbar-inner--left">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <a class="mun-navbar-logo" href="<?php echo site_url();?>"><img class="black" src="<?php echo get_template_directory_uri();?>/assets/img/mun-logo.svg" alt="" loading="lazy"></a>
                            </div>
                        </div>
                        <div class="mid_brave align-center justify-content-center h-100">
                            <img src="<?php echo get_template_directory_uri();?>/assets/img/brave.svg" alt="">
                        </div>
                        <div class="mun-navbar-inner--right">
                            <div class="shop_head">
                                <div class="d-flex align-items-center justify-content-center h-100 shop_headMenu">
                                    <div class="d-flex align-items-center justify-content-center h-100 shop_headMenu">
                                        <div class="shop_head">
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <a class="mun-navbar-logo" href="<?php echo site_url('/shop'); ?>"><img class="black" src="<?php echo get_template_directory_uri();?>/assets/img/shop-icon.png" alt="" loading="lazy"></a> 
                                                <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                                                $count = WC()->cart->cart_contents_count;
                                                ?>
                                                <?php 
                                                if ( $count > 0 ) {
                                                ?>
                                                <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                                                <span class="item_count"><?php echo esc_html( $count ); ?></span>
                                                </a>
                                                <?php
                                                }
                                                } ?>                           
                                            </div>
                                        </div>                          
                                    </div>                          
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center h-100 mt-menu">
                                <div class="mun-navbar-buttons d-flex align-items-center"><a class="mun-menu-burger js-fullscreen-menu-toggle" href="#"><span class="line-one"></span><span class="line-two"></span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="mun-nav mun-nav--fullscreen mun-nav--fullscreen-dark" data-submenu-effect="style-1">
            <div class="mun-nav-table">
                <div class="mun-nav-row">
                    <div class="mun-nav--fullscreen__header">
                        <div class="container">
                            <div class="d-flex align-items-center justify-content-between">
                                <a class="mun-navbar-logo" href=""><img src="<?php echo get_template_directory_uri();?>/assets/img/mun-logo.svg" alt="" loading="lazy"></a>
                                <a class="sn-menu mun-menu-burger js-fullscreen-menu-toggle" href="#">
                                    <span class="line-one"></span><span class="line-two"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mun-nav-row mun-nav-row--full mun-nav-row--center">
                    <div class="container">
                        <div class="mun-nav--fullscreen__navigation">
                            <?php 
                            $args_main = array(
                                'container'       => 'ul',
                                'menu_class' => 'sf-menu',
                                'menu' =>'Menu 1',
                                // 'menu_id'         => '2',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            );
                            wp_nav_menu( $args_main );
                            ?>
                            <!-- <ul class="sf-menu" data-back-text="Back">
                                <li class=""><a href="index.php"><span>Home</span></a></li>
                                <li class=""><a href="about.php"><span>About</span></a></li>
                                <li class=""><a href=""><span>Sponsors</span></a></li>
                                <li class=""><a href="shop.php"><span>Shop</span></a></li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="menu-rightMandala">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/full-mandala.svg" alt="">
                    </div>
                </div>
                <div class="mun-nav-row">
                    <div class="mun-nav--fullscreen__footer">
                        <div class="container">
                            <div class="d-flex justify-content-between align-items-end">

                                <div class="mun-widget mun-widget--socials">
                                    <?php 
                                    $args_footer = array(
                                    'container'       => 'a',
                                    'menu_class' => 'footer-menu',
                                    'menu_id'         => '3',
                                    //'items_wrap'      => '<a id="%1$s" class="%2$s">%3$s</a>',
                                    );
                                    wp_nav_menu( $args_footer );
                                    ?>
                                    <!-- <a class="mun-social-icon mun-social-icon--style-1" href="faqs.php">FAQs</a>
                                    <a class="mun-social-icon mun-social-icon--style-1" href="#">Privacy Policy</a>
                                    <a class="mun-social-icon mun-social-icon--style-1" href="#">Terms</a>
                                    <a class="mun-social-icon mun-social-icon--style-1" href="#">Contact</a> -->
                                </div>

                                <div class="mun-widget mun-widget--html">
                                    <div class="text-right cpright">
                                        Copyright ©2020 MUN. All rights reserved.
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
