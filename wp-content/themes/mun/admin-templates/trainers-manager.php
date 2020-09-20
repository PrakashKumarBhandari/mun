<?php
add_theme_support('post-thumbnails');

if (function_exists('add_image_size')) {
    add_image_size('trainer-thumb', 250, 250, true);
}

add_action('init', 'create_post_type_c');

function create_post_type_c() {
    register_post_type('trainer', array(
        'labels' => array(
            'name' => _x('Trainer', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Trainer', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Trainer', 'text_domain'),
            'parent_item_colon' => __('Parent Trainer:', 'text_domain'),
            'all_items' => __('All members', 'text_domain'),
            'view_item' => __('View trainers', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('New member', 'text_domain'),
            'edit_item' => __('Edit items', 'text_domain'),
            'update_item' => __('Update items', 'text_domain'),
            'search_items' => __('Search items', 'text_domain'),
            'not_found' => __('No item found', 'text_domain'),
            'not_found_in_trash' => __('No item found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'trainer'),
        'menu_position' => null,
        'menu_icon' =>'dashicons-sos', // 16px16
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'taxonomies' => array('trainer') //array('category','trainer')
            )
    );
}

// Register Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name' => _x('Team Group', 'Taxonomy General Name', 'text_domain'),
        'singular_name' => _x('Team', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name' => __('Team Group', 'text_domain'),
        'all_items' => __('All Items', 'text_domain'),
        'parent_item' => __('Parent Item', 'text_domain'),
        'parent_item_colon' => __('Parent Item:', 'text_domain'),
        'new_item_name' => __('New Item Name', 'text_domain'),
        'add_new_item' => __('Add New Item', 'text_domain'),
        'edit_item' => __('Edit Item', 'text_domain'),
        'update_item' => __('Update Item', 'text_domain'),
        'separate_items_with_commas' => __('Separate items with commas', 'text_domain'),
        'search_items' => __('Search Items', 'text_domain'),
        'add_or_remove_items' => __('Add or remove items', 'text_domain'),
        'choose_from_most_used' => __('Choose from the most used items', 'text_domain'),
        'not_found' => __('Not Found', 'text_domain'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('trainer_cat', array('trainer'), $args);
}

// Hook into the 'init' action
// disable the cateogy of trainer
//add_action('init', 'custom_taxonomy', 0);


add_action('add_meta_boxes', 'trainer_add_custom_box');
add_action('save_post', 'trainer_save_postdata');

function trainer_add_custom_box() {
    add_meta_box('course_id', 'Team Detail Informations', 'trainer_custom_box', 'trainer', 'normal', 'high');
}

function trainer_custom_box($post) {
    global $wpdb;

    $post_id = $post->ID;

    /* Add verification field */
    wp_nonce_field(plugin_basename(__FILE__), 'ego_noncename');
    /* Add verification field ends */
    $trainer_option1 = get_post_meta($post_id, 'trainer_option1', true);
    $trainer_option2 = get_post_meta($post_id, 'trainer_option2', true);
    $trainer_option3 = get_post_meta($post_id, 'trainer_option3', true);
    $trainer_option4 = get_post_meta($post_id, 'trainer_option4', true);
    $trainer_option5 = get_post_meta($post_id, 'trainer_option5', true);
    $trainer_option6 = get_post_meta($post_id, 'trainer_option6', true);
    ?>
    <div style="width:100%;">
        <table cellpadding="0" cellspacing="6" border="0" width="100%">
            <tr>
                <td width="20%">Designation</td>
                <td width="80%" align="left">
                    <input type="text" name="trainer_option1" style="width:250px!important" id="trainer_option1"   value="<?php echo $trainer_option1; ?>"> 
                    designation of member Eg: Managing Director</td>
            </tr>
            <!--            
                <tr>
                <td >Qualification</td>
                <td  align="left"> 
                    <input type="text" name="trainer_option2" style="width:250px" id="trainer_option2"   value="<?php echo $trainer_option2; ?>"> 
                    Eg: Masters in Computer Information System (MCIS) </td>
            </tr>  
            -->
            <!-- <tr>
                <td >Facebook link</td>
                <td  align="left"> 
                    <input type="text" name="trainer_option3" style="width:250px" id="trainer_option3"   value="<?php echo $trainer_option3; ?>"> 
                    Eg: http://www.facebook.com/prakashkumarbhandari</td>
            </tr>  
            <tr>
                <td >Twitter</td>
                <td  align="left"> 
                    <input type="text" name="trainer_option4" style="width:250px" id="trainer_option4"   value="<?php echo $trainer_option4; ?>"> 
                </td>
            </tr>  
            <tr>
                <td >Google Plus</td>
                <td  align="left"> 
                    <input type="text" name="trainer_option5" style="width:250px" id="trainer_option5"   value="<?php echo $trainer_option5; ?>"> 
                </td>
            </tr> 
            <tr>
                <td >Linked in</td>
                <td  align="left"> 
                    <input type="text" name="trainer_option6" style="width:250px" id="trainer_option6"   value="<?php echo $trainer_option6; ?>"> 
                </td>
            </tr>   -->
        </table>
    </div>
    <?php
    global $post;
    $post->ID = $post_id;
}

function trainer_save_postdata($post_id) {
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id))
        $post_id = $the_post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    if ('trainer' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    }
    else {
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }

    if (isset($_POST["trainer_option1"])) {
        $trainer_option1 = $_POST["trainer_option1"];
        update_post_meta($post_id, "trainer_option1", $trainer_option1);
    } else {
        delete_post_meta($post_id, "trainer_option1", '');
    }


    if (isset($_POST["trainer_option2"])) {
        $trainer_option2 = $_POST["trainer_option2"];
        update_post_meta($post_id, "trainer_option2", $trainer_option2);
    }

    if (isset($_POST["trainer_option3"])) {
        $trainer_option3 = $_POST["trainer_option3"];
        update_post_meta($post_id, "trainer_option3", $trainer_option3);
    }

    if (isset($_POST["trainer_option4"])) {
        $trainer_option4 = $_POST["trainer_option4"];
        update_post_meta($post_id, "trainer_option4", $trainer_option4);
    }

    if (isset($_POST["trainer_option5"])) {
        $trainer_option5 = $_POST["trainer_option5"];
        update_post_meta($post_id, "trainer_option5", $trainer_option5);
    }

    if (isset($_POST["trainer_option6"])) {
        $trainer_option6 = $_POST["trainer_option6"];
        update_post_meta($post_id, "trainer_option6", $trainer_option6);
    }

    /* checking verification ends */
}

/* :::::::::::::::;  Add Column on trainer grid ::::::::::  */

add_action('admin_head', 'my_admin_column_width');

function my_admin_column_width() {
    echo '<style type="text/css">
        .column-title { text-align: left; width:35% !important; }
        #trainer_option1{ text-align: left; width:12%!important; }
    </style>';
}

add_filter('manage_trainer_posts_columns', 'add_new_trainer_columns');

function add_new_trainer_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Team Members', 'column name');
    //$new_columns['trainer_category'] = __('Team Group');

    $new_columns['trainer_option1'] = _x('Designation', 'column name'); //__('Designation/Subject');
    $new_columns['thumb'] = __('Photo');
    $new_columns['date'] = _x('Date', 'column name');
    return $new_columns;
}

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN

add_action('manage_trainer_posts_custom_column', 'show_list_columns_content_only_courses', 10, 2);

function show_list_columns_content_only_courses($column_name, $post_ID) {

    if ($column_name == 'trainer_option1') {
        $trainer_option1 = get_post_meta($post_ID, 'trainer_option1', true);
        echo $trainer_option1;
    }

    if ($column_name == 'trainer_category') {
        $category = get_the_term_list($post_ID, 'trainer_cat', '', ',', '');
        echo $category;
    }
    
    if ($column_name == 'thumb') {
        echo the_post_thumbnail(array('50', '50')); //($post_ID, 'trainer_option1', true);
    }
}
?>