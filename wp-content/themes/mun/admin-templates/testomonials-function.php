<?php


add_action('init', 'create_post_type_testimonial');

function create_post_type_testimonial() {
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => _x('Testimonials', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Testimonials', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Testimonials', 'text_domain'),
            'parent_item_colon' => __('Parent Testimonials:', 'text_domain'),
            'all_items' => __('All Testimonials', 'text_domain'),
            'view_item' => __('View Testimonials', 'text_domain'),
            'add_new_item' => __('Add New Testimonials', 'text_domain'),
            'add_new' => __('New Testimonials', 'text_domain'),
            'edit_item' => __('Edit Testimonials', 'text_domain'),
            'update_item' => __('Update Testimonials', 'text_domain'),
            'search_items' => __('Search Testimonials', 'text_domain'),
            'not_found' => __('No Testimonials found', 'text_domain'),
            'not_found_in_trash' => __('No Testimonials found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'testimonial'),
        'menu_position' => null,
        
        'menu_icon' => 'dashicons-megaphone', // 16px16
        'supports' => array('title', 'editor', 'excerpts', 'thumbnail')
            )
    );
}

add_action('admin_init', 'my_admin_option_meta');

function my_admin_option_meta() {
    add_meta_box('testemonial_meta_box', 'Testmonials Options', 'display_option_meta_box', 'testimonial', 'normal', 'high');
}

function display_option_meta_box($option_post_edit) {
    $option_1 = esc_html(get_post_meta($option_post_edit->ID, 'option_1', true));
    $option_2 = esc_html(get_post_meta($option_post_edit->ID, 'option_2', true));
    $option_3 = esc_html(get_post_meta($option_post_edit->ID, 'option_3', true));
    ?>
    <!-- <div class="tiepanel-item">
        <div id="pub-item" class="option-item">
            <span class="label"><strong>Designation </strong></span>
            <input type="text" name="option_1" id="option_1" style="width:300px;"   value="<?php echo $option_1; ?>">
        </div>
    </div> -->
    <div class="tiepanel-item">
        <div id="pub-item" class="option-item">
            <span class="label"><strong>Option</strong></span>
            <input type="text" name="option_2" id="option_2"  style="width:400px;"  value="<?php echo $option_2; ?>">
        </div>
    </div>
    <!--    
    <div class="tiepanel-item">
        <div id="pub-item" class="option-item">
            <span class="label"><strong>Link of Package</strong></span>
            <input type="text" name="option_3" id="option_3" style="width:500px;"   value="<?php echo $option_3; ?>">
        </div>
    </div>
    -->

    <?php
}

add_action('save_post', 'add_option_fields', 10, 2);

function add_option_fields($option_post_id, $video) {
// Check post type for movie reviews
    if ($video->post_type == 'testimonial') {
        if (isset($_POST['option_1']) && $_POST['option_1'] != '') {
            update_post_meta($option_post_id, 'option_1', $_POST['option_1']);
        }else{
            update_post_meta($option_post_id, 'option_1','');
        }

        if (isset($_POST['option_2']) && $_POST['option_2'] != '') {
            update_post_meta($option_post_id, 'option_2', $_POST['option_2']);
        }else{
            update_post_meta($option_post_id, 'option_2','');
        }
        
        if (isset($_POST['option_3']) && $_POST['option_3'] != '') {
            update_post_meta($option_post_id, 'option_3', $_POST['option_3']);
        }else{
            update_post_meta($option_post_id, 'option_3','');
        }
    }
}
?>