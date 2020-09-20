<?php
add_action('init', 'create_post_type_c');

function create_post_type_c() {
    register_post_type('slider', array(
        'labels' => array(
            'name' => _x('Slider', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Slider', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Slider', 'text_domain'),
            'parent_item_colon' => __('Parent Slider:', 'text_domain'),
            'all_items' => __('All Slider', 'text_domain'),
            'view_item' => __('View Slider', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('New Slider', 'text_domain'),
            'edit_item' => __('Edit items', 'text_domain'),
            'update_item' => __('Update items', 'text_domain'),
            'search_items' => __('Search items', 'text_domain'),
            'not_found' => __('No item found', 'text_domain'),
            'not_found_in_trash' => __('No item found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'slider'),
        'menu_position' => null,
        'menu_icon' =>'dashicons-sos', // 16px16
        'supports' => array('title', 'thumbnail'), // 'editor',
        'taxonomies' => array('slider') //array('category','slider')
            )
    );
}

// Register Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name' => _x('Slider Group', 'Taxonomy General Name', 'text_domain'),
        'singular_name' => _x('Slider', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name' => __('Slider Group', 'text_domain'),
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
    register_taxonomy('slider_cat', array('slider'), $args);
}

// Hook into the 'init' action
// disable the cateogy of slider
//add_action('init', 'custom_taxonomy', 0);


add_action('add_meta_boxes', 'slider_add_custom_box');
add_action('save_post', 'slider_save_postdata');

function slider_add_custom_box() {
    add_meta_box('course_id', 'Slider Detail Informations', 'slider_custom_box', 'slider', 'normal', 'high');
}

function slider_custom_box($post) {
    global $wpdb;

    $post_id = $post->ID;

    /* Add verification field */
    wp_nonce_field(plugin_basename(__FILE__), 'ego_noncename');
    /* Add verification field ends */
    $slider_option1 = get_post_meta($post_id, 'slider_option1', true);
    $slider_option2 = get_post_meta($post_id, 'slider_option2', true);
    $slider_option3 = get_post_meta($post_id, 'slider_option3', true);
    $slider_option4 = get_post_meta($post_id, 'slider_option4', true);
    $slider_option5 = get_post_meta($post_id, 'slider_option5', true);
    $slider_option6 = get_post_meta($post_id, 'slider_option6', true);
    ?>
    <div style="width:100%;">
        <table cellpadding="0" cellspacing="6" border="0" width="100%">
            <tr>
                <td width="20%">Top Title</td>
                <td width="80%" align="left">
                    <input type="text" name="slider_option1" style="width:100%!important" id="slider_option1"   value="<?php echo $slider_option1; ?>"> 
                    <br/>option shown on top of slider item Eg: Welcome to our resturant</td>
            </tr>
                       
                <tr>
                <td>Button Text</td>
                <td  align="left"> 
                    <input type="text" name="slider_option2" style="width:250px" id="slider_option2"   value="<?php echo $slider_option2; ?>"> 
                    <br/>Eg: Order Now </td>
            </tr>  
           
             <tr>
                <td >Button link</td>
                <td  align="left"> 
                    <input type="text" name="slider_option3" style="width:250px" id="slider_option3"   value="<?php echo $slider_option3; ?>"> 
                    <br/>Eg: <?php echo site_url();?>/order-now</td>
            </tr>  
            <!-- <tr>
                <td >Custom Color Value</td>
                <td  align="left"> 
                    <input type="text" name="slider_option4" style="width:250px" id="slider_option4"   value="< ?php echo $slider_option4; ?>"> 
                    <br/>Eg: FF0000, 0404c7 (color code without hash tag) </td>
            </tr>   -->
            

            
            <!--
            <tr>
                <td >Google Plus</td>
                <td  align="left"> 
                    <input type="text" name="slider_option5" style="width:250px" id="slider_option5"   value="<?php echo $slider_option5; ?>"> 
                </td>
            </tr> 
            <tr>
                <td >Linked in</td>
                <td  align="left"> 
                    <input type="text" name="slider_option6" style="width:250px" id="slider_option6"   value="<?php echo $slider_option6; ?>"> 
                </td>
            </tr>   -->
        </table>
    </div>
    <?php
    global $post;
    $post->ID = $post_id;
}

function slider_save_postdata($post_id) {
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id))
        $post_id = $the_post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    // if ('slider' == $_POST['post_type']) {
    //     if (!current_user_can('edit_page', $post_id))
    //         return $post_id;
    // }
    // else {
    //     if (!current_user_can('edit_post', $post_id))
    //         return $post_id;
    // }

    if (isset($_POST["slider_option1"])) {
        $slider_option1 = $_POST["slider_option1"];
        update_post_meta($post_id, "slider_option1", $slider_option1);
    } else {
        delete_post_meta($post_id, "slider_option1", '');
    }


    if (isset($_POST["slider_option2"])) {
        $slider_option2 = $_POST["slider_option2"];
        update_post_meta($post_id, "slider_option2", $slider_option2);
    }

    if (isset($_POST["slider_option3"])) {
        $slider_option3 = $_POST["slider_option3"];
        update_post_meta($post_id, "slider_option3", $slider_option3);
    }

    if (isset($_POST["slider_option4"])) {
        $slider_option4 = $_POST["slider_option4"];
        update_post_meta($post_id, "slider_option4", $slider_option4);
    }

    if (isset($_POST["slider_option5"])) {
        $slider_option5 = $_POST["slider_option5"];
        update_post_meta($post_id, "slider_option5", $slider_option5);
    }

    if (isset($_POST["slider_option6"])) {
        $slider_option6 = $_POST["slider_option6"];
        update_post_meta($post_id, "slider_option6", $slider_option6);
    }

    /* checking verification ends */
}

/* :::::::::::::::;  Add Column on slider grid ::::::::::  */

add_action('admin_head', 'my_admin_column_width');

function my_admin_column_width() {
    echo '<style type="text/css">
        .column-title { text-align: left; width:35% !important; }
        #slider_option1{ text-align: left; width:12%!important; }
    </style>';
}

add_filter('manage_slider_posts_columns', 'add_new_slider_columns');

function add_new_slider_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Slider Title', 'column name');
    //$new_columns['slider_category'] = __('Slider Group');

    //$new_columns['slider_option1'] = _x('Designation', 'column name'); //__('Designation/Subject');
    $new_columns['thumb'] = __('Photo');
    $new_columns['date'] = _x('Date', 'column name');
    return $new_columns;
}

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN

add_action('manage_slider_posts_custom_column', 'show_list_columns_content_only_courses', 10, 2);

function show_list_columns_content_only_courses($column_name, $post_ID) {

    // if ($column_name == 'slider_option1') {
    //     $slider_option1 = get_post_meta($post_ID, 'slider_option1', true);
    //     echo $slider_option1;
    // }

    if ($column_name == 'slider_category') {
        $category = get_the_term_list($post_ID, 'slider_cat', '', ',', '');
        echo $category;
    }
    
    if ($column_name == 'thumb') {
        echo the_post_thumbnail(array('250', '50')); //($post_ID, 'slider_option1', true);
    }
}

/*
 * Change the featured image metabox title text
 */
function pkb_change_featured_image_metabox_title() {
    remove_meta_box( 'postimagediv', 'slider', 'side' );
    add_meta_box( 'postimagediv', __( 'New Slider[W:2000px X H:1300px]', 'pkb' ), 'post_thumbnail_meta_box', 'slider', 'side' );
}
add_action('do_meta_boxes', 'pkb_change_featured_image_metabox_title' );

function pkb_change_featured_image_text( $content ) {
    if ( 'slider' === get_post_type() ) {
        $content = str_replace( 'Set featured image', __( 'New Slider <br/> [Width:2000px X Height:1300px]', 'pkb' ), $content );
        $content = str_replace( 'Remove featured image', __( 'Remove Slider Image <br/> [Width:2000px X Height:1300px]', 'pkb' ), $content );
    }
    return $content;
}
add_filter( 'admin_post_thumbnail_html', 'pkb_change_featured_image_text' );

?>