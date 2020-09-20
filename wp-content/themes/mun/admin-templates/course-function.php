<?php
add_theme_support('post-thumbnails');

if (function_exists('add_image_size')) {
    add_image_size('course-thumb', 100, 100, true);
}

add_action('init', 'create_post_type_course');

function create_post_type_course() {
    register_post_type('course', array(
        'labels' => array(
            'name' => _x('Course', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Course', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Course', 'text_domain'),
            'parent_item_colon' => __('Parent Course:', 'text_domain'),
            'all_items' => __('All Course', 'text_domain'),
            'view_item' => __('View Course', 'text_domain'),
            'add_new_item' => __('Add New Course', 'text_domain'),
            'add_new' => __('New Course', 'text_domain'),
            'edit_item' => __('Edit Course', 'text_domain'),
            'update_item' => __('Update Course', 'text_domain'),
            'search_items' => __('Search Course', 'text_domain'),
            'not_found' => __('No Course found', 'text_domain'),
            'not_found_in_trash' => __('No Course found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'course'),
        'menu_position' => null,
        'menu_icon' =>'dashicons-book-alt', // 16px16
        'supports' => array('title', 'editor', 'excerpts', 'thumbnail')
            )
    );
}

add_action('admin_init', 'my_course_option_meta');

function my_course_option_meta() {
    add_meta_box('course_meta_box', 'Course Options', 'display_course_option_meta_box', 'course', 'normal', 'high');
}

function display_course_option_meta_box($option_post_edit) {
    $option_1 = esc_html(get_post_meta($option_post_edit->ID, 'option_1', true));
    $option_2 = esc_html(get_post_meta($option_post_edit->ID, 'option_2', true));
    $option_3 = esc_html(get_post_meta($option_post_edit->ID, 'option_3', true));
    ?>
    <div class="tiepanel-item">
        <div id="pub-item" class="option-item">
            <span class="label"><strong>Course Duration</strong></span>
            <input type="text" name="option_1" id="option_1" style="width:300px;"   value="<?php echo $option_1; ?>">
        </div>
    </div>
    </br>
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

add_action('save_post', 'add_course_option_fields', 10, 2);

function add_course_option_fields($option_post_id, $video) {
// Check post type for movie reviews
    if ($video->post_type == 'course') {
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