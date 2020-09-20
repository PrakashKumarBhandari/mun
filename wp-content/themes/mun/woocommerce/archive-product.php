<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
   <section class="slider_section mb-30" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/backdrop.svg); height: 100vh;">
        <div class="bg_abstractshop" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/bg-abstract.png);">
        </div>
        <div class="slider_area owl-carousel">
		    <?php 
			global $post;
			$args = array('posts_per_page' =>5, 
			'post_type' => 'product',
			'meta_query' => array(
				array(
					'key'   => 'slider',
					'value' => '1',
				)
			)
			);
			$myposts = get_posts($args);     
			$counter = 1;   
			foreach ($myposts as $key => $post) :
			setup_postdata($post);
			//$op_1 = get_post_meta(get_the_ID(), 'team_option1', true);
			?>
            <div class="single_slider d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider_content main_sliderHead">
								<p><?php 								
								$terms = get_the_terms( get_the_ID() , array( 'product_cat') );
								foreach ( $terms as $term ) {
								$term_link = get_term_link( $term, array( 'product_cat') );
								echo"<a href='".$term_link."'>".$term->name."</a>"; }?>
								</p>
                                <h1><?php echo limit_text(get_the_title(),50);?></h1>
                                <p><?php //echo limit_text(get_the_content(),20);?></p>
                                <a class="btn_slider" href="<?php the_permalink();?>">Shop Now <span> &nbsp;&nbsp; <i class="fa fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                        <div class="right_ph">
                            <div class="bg_back">
                                <img src="<?php echo get_template_directory_uri();?>/assets/img/ab-bg.svg" alt="">
                            </div>
                            <div class="thum_img">
								<?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('slider_shop_image',array('class'=>'img-responsive'));									
								} 
								?>
                                <!-- <img src="<?php echo get_template_directory_uri();?>/assets/img/slide-1.png" alt=""> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			$counter++;
			endforeach;
			wp_reset_postdata();
			?>

            <!-- <div class="single_slider d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider_content main_sliderHead">
                                <p>New Arrivals</p>
                                <h1>A collection made for you</h1>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                <a class="btn_slider" href="">Shop Now <span><img src="<?php echo get_template_directory_uri();?>/assets/img/icons/arrow-right.svg" alt=""></span></a>
                            </div>
                        </div>
                        <div class="right_ph">
                            <div class="bg_back">
                                <img src="<?php echo get_template_directory_uri();?>/assets/img/ab-bg.svg" alt="">
                            </div>
                            <div class="thum_img">
                                <img src="<?php echo get_template_directory_uri();?>/assets/img/slide-1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

      
    </section>



	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	//do_action( 'woocommerce_archive_description' );
	?>
<div class="shop_area shop_reverse mt-100 mb-100">
    <div class="container container-flute">
        <div class="row">
			<div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
				<?php
				do_action( 'woocommerce_sidebar' );
				?>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9 col-md-12">
				<?php
				if ( woocommerce_product_loop() ) {

				/**
				* Hook: woocommerce_before_shop_loop.
				*
				* @hooked woocommerce_output_all_notices - 10
				* @hooked woocommerce_result_count - 20
				* @hooked woocommerce_catalog_ordering - 30
				*/
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
				the_post();

				/**
				* Hook: woocommerce_shop_loop.
				*/
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
				}
				}

				woocommerce_product_loop_end();

				/**
				* Hook: woocommerce_after_shop_loop.
				*
				* @hooked woocommerce_pagination - 10
				*/
				do_action( 'woocommerce_after_shop_loop' );
				} else {
				/**
				* Hook: woocommerce_no_products_found.
				*
				* @hooked wc_no_products_found - 10
				*/
				do_action( 'woocommerce_no_products_found' );
				}

				/**
				* Hook: woocommerce_after_main_content.
				*
				* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				*/
				do_action( 'woocommerce_after_main_content' );

				/**
				* Hook: woocommerce_sidebar.
				*
				* @hooked woocommerce_get_sidebar - 10
				*/
				?>
			</div>
		</div>
	</div>
</div>



<?php

get_footer( 'shop' );
