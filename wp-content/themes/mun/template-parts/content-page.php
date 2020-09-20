<?php
/**
 * Template part for displaying page content in page.php
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
				    <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
                    <ul>
                        <li><a href="<?php echo site_url(); ?>">HOME</a></li>
                        <li><?php the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>


<div class="munAbout-contents">
    <div class="container container-flute">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
					<div class="tab_contentswrapper">
						<!-- <div class="tab_heading">
						<?php // the_title( '<h3 class="entry-title">', '</h3>' ); ?>
						<hr>
						</div> -->
						<div class="tab_paragraph">
						    <?php mun_post_thumbnail(); ?>
							<?php
							the_content();

							wp_link_pages(
								array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mun' ),
								'after'  => '</div>',
								)
							);
							?>
						</div>
					</div>        
                </div>
            </div>
        </div>   
    </div>
</div>

<!-- 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
	</header>

	

	<div class="entry-content">
		
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
					
						__( 'Edit <span class="screen-reader-text">%s</span>', 'mun' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article> -->
