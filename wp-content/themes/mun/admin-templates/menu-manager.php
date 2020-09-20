<?php
add_image_size( 'menu-item-thumb', 106, 66, true );

add_action('init', 'create_post_type_menu');

function create_post_type_menu() {
    register_post_type('post-menu', array(
        'labels' => array(
            'name' => _x('Menu', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Menu', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Menu', 'text_domain'),
            'parent_item_colon' => __('Parent Menu:', 'text_domain'),
            'all_items' => __('Food Menu', 'text_domain'),
            'view_item' => __('View Menu', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('Add Menu', 'text_domain'),
            'edit_item' => __('Edit items', 'text_domain'),
            'update_item' => __('Update items', 'text_domain'),
            'search_items' => __('Search items', 'text_domain'),
            'not_found' => __('No item found', 'text_domain'),
            'not_found_in_trash' => __('No item found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'post-menu'),
        'menu_position' => null,
        'menu_icon' =>'dashicons-image-filter', // 16px16
        'supports' => array('title'),
        'taxonomies' => array('menu') //array('category','menu')
            )
    );
}

// Register Custom Taxonomy
function custom_taxonomy_menu() {

    $labels = array(
        'name' => _x('Menu Category', 'Taxonomy General Name', 'text_domain'),
        'singular_name' => _x('Menu', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name' => __('Menu Category', 'text_domain'),
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
    register_taxonomy('menu-category', array('menu'), $args);
}

// Hook into the 'init' action
// disable the cateogy of menu
/*
add_action('init', 'custom_taxonomy_menu', 0);


add_action('add_meta_boxes', 'menu_add_custom_box_menu');
add_action('save_post', 'menu_save_postdata_menu');

function menu_add_custom_box_menu() {
    add_meta_box('course_id', 'Menu Detail Informations', 'menu_custom_box', 'menu', 'normal', 'high');
}

function menu_custom_box($post) {
    global $wpdb;

    $post_id = $post->ID;

    wp_nonce_field(plugin_basename(__FILE__), 'ego_noncename');
    
    $short = get_post_meta($post_id, 'short', true);
    $price = get_post_meta($post_id, 'price', true);
    $calories = get_post_meta($post_id, 'calories', true);    
    $vegetarian = get_post_meta($post_id, 'vegetarian', true);
    $spiciness = get_post_meta($post_id, 'spiciness', true); 
    $popular = get_post_meta($post_id, 'popular', true);
    ?>
<div style="width:100%;">
    <table cellpadding="0" cellspacing="6" border="0" width="100%">
    <tr>
            <td width="20%">Short</td>
            <td width="80%" align="left">
                <input type="text" name="short" style="width:50%" id="short" value="<?php echo $short; ?>">
                <br />Short detail (i.e.: Mushroom / Garlic / Veggies)</td>
        </tr>    
    <tr>
            <td width="20%">Price</td>
            <td width="80%" align="left">
                <input type="text" name="price" style="width:50%" id="price" value="<?php echo $price; ?>">
                <br />Don't include the currency symbol, just the price in numbers. (i.e.: 4.00)</td>
        </tr>
     
        <tr>
            <td>Vegetarian</td>
            <td align="left">
                <?php
                $status = "";
                $vegetarian_check = '';
                 if(isset($vegetarian) && $vegetarian ==true){
                    $vegetarian_check = "checked='checked'";
                }
                ?>
                <input type="checkbox" name="vegetarian" <?php echo $vegetarian_check;?> id="vegetarian" value="true">
        </tr>
      
        <tr>
            <td>Spiciness scale</td>
            <td align="left">
            <select name="spiciness">
            <option value="0" <?php if($spiciness == 0){ echo"selected='selected'"; }?>>Select the number from this list</option>
            <option value="1"  <?php if($spiciness == 1){ echo"selected='selected'"; }?>>1</option>
            <option value="2" <?php if($spiciness == 2){ echo"selected='selected'"; }?>>2</option>
            <option value="3" <?php if($spiciness == 3){ echo"selected='selected'"; }?>>3</option>
           
            </select>
            <br/>From 1 to 5. Pick a value for spicy foods.
            </td>
        </tr>
    
            <td>Popular</td>
            <td align="left">
                <?php
                $status = "";
                 if(isset($popular) && $popular ==true){
                    $status = "checked='checked'";
                }
                ?>
                <input type="checkbox" name="popular" <?php echo $status;?> id="popular" value="true">
            </td>
        </tr>
    </table>
</div>
<?php
    global $post;
    $post->ID = $post_id;
}

function menu_save_postdata_menu($post_id) {
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id))
        $post_id = $the_post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    if (isset($_POST["short"])) {
        $short = $_POST["short"];
        update_post_meta($post_id, "short", $short);
    } else {
        delete_post_meta($post_id, "short", '');
    }
    if (isset($_POST["price"])) {
        $price = $_POST["price"];
        update_post_meta($post_id, "price", $price);
    } else {
        delete_post_meta($post_id, "price", '');
    }
    if (isset($_POST["calories"])) {
        $calories = $_POST["calories"];
        update_post_meta($post_id, "calories", $calories);
    }

    if (isset($_POST["spiciness"])) {
        $spiciness = $_POST["spiciness"];
        update_post_meta($post_id, "spiciness", $spiciness);
    }
    delete_post_meta($post_id, "vegetarian", '');
    delete_post_meta($post_id, "popular", '');

    if (isset($_POST["vegetarian"])) {
        $vegetarian = $_POST["vegetarian"];
        update_post_meta($post_id, "vegetarian", $vegetarian);
    }
    if (isset($_POST["popular"])) {
        $popular = $_POST["popular"];
        update_post_meta($post_id, "popular", $popular);
    }

      
}



add_action('admin_head', 'my_admin_column_width_menu');

function my_admin_column_width_menu() {
    echo '<style type="text/css">
        .column-title { text-align: left; width:35% !important; }
        #price{ text-align: left; width:12%!important; }
    </style>';
}

add_filter('manage_menu_posts_columns', 'add_new_menu_columns_menu');

function add_new_menu_columns_menu($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Menu Title', 'column name');
    $new_columns['category'] = __('Category');

    
    $new_columns['thumb'] = __('Photo');

    $new_columns['popular'] = __('Popular');
    
    $new_columns['date'] = _x('Date', 'column name');
    return $new_columns;
}



add_action('manage_menu_posts_custom_column', 'show_list_columns_content_only_menu', 10, 2);

function show_list_columns_content_only_menu($column_name, $post_ID) {

    if ($column_name == 'category') {
        $category = get_the_term_list($post_ID, 'menu-category', '', ',', '');
        echo $category;
    }

    if ($column_name == 'popular') {
        $popular = get_post_meta($post_ID, 'popular', true);
        if($popular == true){
            echo "<i class='dashicons dashicons-yes-alt good'></i>";
      }
        
    }
   
    if ($column_name == 'thumb') {
        echo the_post_thumbnail(array('250', '50')); 
    }
}
*/
?>