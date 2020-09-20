<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mun
 */

?>
<div class="breadcrumbs_area">
<div class="container container-flute">   
<div class="row">
	<div class="col-12">
	<div class="breadcrumb_content">
		<h3><?php the_title();?></h3>
		<ul>
			<li><a href="<?php echo site_url(); ?>">HOME</a></li>
			<li><a href="<?php echo site_url('/shop'); ?>">Shop</a></li>
			<li>
			<?php the_title();?>
		</li>
		
		</ul>
	</div>
	</div>
</div>
</div>         
</div>

<div class="product_details mt-100 mb-100">
	<div class="container container-flute">
		<div class="row">
		<?php mun_post_thumbnail(); ?>	
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mun' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mun' ),
				'after'  => '</div>',
			)
		);
		?>
		<footer class="entry-footer">
			<?php mun_entry_footer(); ?>
		</footer>
</div>
</div>
</div>	
