<?php
/* Template Name: FAQs 
 */

get_header();
?>
<div class="breadcrumbs_area">
    <div class="container container-flute">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
				    <h3>Friquently Asked Questions</h3>
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
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="tab_contentswrapper">
                    <div class="tab_heading">
                        <h3>FAQ’S</h3>
                        <hr>
                    </div>
                    <div class="tab_paragraph">
                        <div id="accordion">

                        


                            <?php 
                            global $post;
                            $args = array('posts_per_page' => -1, 'post_type' => 'faqs');
                            $myposts = get_posts($args);     
                            $counter = 1;   
                            foreach ($myposts as $key => $post) :
                            setup_postdata($post);
                            //$op_1 = get_post_meta(get_the_ID(), 'team_option1', true);
                            ?>
                            <div class="card">
                                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse-<?php echo get_the_ID();?>" aria-expanded="true" aria-controls="collapseOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                    <?php echo get_the_title(); ?>
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>
                                <div id="collapse-<?php echo get_the_ID();?>" class="collapse <?php if($counter==1){ echo"show"; }?>" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php
                                        if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium_large', array('class' => 'img-responsive','300'=> '200'));
                                        } 
                                        the_content();
                                        ?>                                       
                                    </div>
                                </div>
                            </div>
                            <?php
                            $counter++;
                            endforeach;
                            wp_reset_postdata();
                            ?>

                            <!-- <div class="card">
                                <div class="card-header" id="headingtwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link ">
                                            HOW CAN I ENTER? 
                                        </button>
                                    </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul class="store-link">
                                            <li><a href=""><img src="assets/img/icons/playstore.png" alt=""></a></li>
                                            <li><a href=""><img src="assets/img/icons/appstore.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading3" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        IS THERE AN AGE REQUIREMENT?
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
                                    <div class="card-body">
                                        You must be 18-28 years old at the time of entering the Miss Universe Nepal Pageant.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading4" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        CAN I COMPETE MORE THAN ONCE?
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
                                    <div class="card-body">
                                        Yes, but the First Runner Up has wait till her “reign” is up to go again
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading5" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        CAN MY SISTER COMPETE?
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
                                    <div class="card-body">
                                        There are no restrictions on multiple family members competing – the more the merrier in fact
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading6" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                    HOW DO I PREPARE (TO WIN)
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
                                    <div class="card-body">
                                        In three words we are looking for a Brave, Bold and Beautiful champion to best represent Nepal.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading7" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        CAN I BE MARRIED?
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
                                    <div class="card-body">
                                        Contestants cannot be (or have been) married. Nor can they be pregnant or given birth to, or be parent to a child. Titleholders are also required to remain unmarried throughout their reign.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading8" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        WHAT DO I NEED TO COMPETE
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
                                    <div class="card-body">
                                    You will need to do your own make-up in the preliminary stages (though we provide a bunch of in-app tips) and have clothes/looks that express your Brave, Bold, Beautiful self. You will also need a smartphone and connectivity to the internet.  Oh, and 600 Rs. to enter!
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading9" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        WHAT HAPPENS IF I WIN?  
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
                                    <div class="card-body">
                                        You will be relocated to Kathmandu and trained to compete in the Miss Universe International pageant, and we aim to win!
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading10" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                    DO I GET A CONTRACT?   
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
                                    <div class="card-body">
                                    All of the (15) finalists get a contact which mandates your availability to compete in the pageant, renumeration and rules of behavior.  
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading11" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                    HOW ARE MISS UNIVERSE NEPAL AND MISS NEPAL DIFFERENT?  
                                    </button>
                                </h5>
                                    <div class="carret_down">
                                        <img src="assets/img/icons/plus.svg" alt="">
                                    </div>
                                </div>

                                <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion">
                                    <div class="card-body">
                                    Only the winners of Miss Universe Nepal get to compete in the Miss Universe International pageant, which is the most prestigious pageant in the world 
                                    </div>
                                </div>
                            </div> -->
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();