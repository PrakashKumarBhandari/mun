<?php
/* Template Name: About Us 
 */

get_header();
?>
<div class="breadcrumbs_area">
    <div class="container container-flute">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
				    <h3>ABOUT MISS UNIVERSE NEPAL</h3>
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
            <div class="col-md-4">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php
                    // check if the repeater field has rows of data
                    if( have_rows('inners')):
                    $counter = 1;
                    while ( have_rows('inners') ) : the_row();
                    ?>
                    <a class="nav-link <?php if($counter == 1){ echo"active"; }?>" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-<?php echo $counter;?>" role="tab" aria-controls="v-pills-home" aria-selected="true"><?php  the_sub_field('title');?></a>
                    <?php
                    $counter++;                    
                    endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <?php
                    if( have_rows('inners') ):
                    $c = 1;
                    while ( have_rows('inners') ) : the_row();
                    ?>
                    <div class="tab-pane fade show <?php if($c == 1){ echo"active"; }?>" id="v-pills-<?php echo $c;?>" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="tab_contentswrapper">
                            <div class="tab_heading">
                                <h3><?php the_sub_field('title');?></h3>
                                <hr>
                            </div>
                            <div class="tab_paragraph">                           
                                <p><?php the_sub_field('content'); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $c++;
                    endwhile;
                    else :
                        the_content();
                    endif;
                    ?>
                </div>
            </div>
        </div>   
    </div>
</div>
<?php
get_footer();