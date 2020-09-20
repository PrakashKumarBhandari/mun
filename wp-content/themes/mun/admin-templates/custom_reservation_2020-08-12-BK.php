<?php
add_action('init', 'create_post_type_reserve');

function create_post_type_reserve() {
    register_post_type('reserve', array(
        'labels' => array(
            'name' => _x('Reservation', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Reservation', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Reservation', 'text_domain'),
            'parent_item_colon' => __('Parent Reservation:', 'text_domain'),
            'all_items' => __('All Reservation', 'text_domain'),
            'view_item' => __('View Reservation', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('New Reservation', 'text_domain'),
            'edit_item' => __('Edit items', 'text_domain'),
            'update_item' => __('Update items', 'text_domain'),
            'search_items' => __('Search items', 'text_domain'),
            'not_found' => __('No item found', 'text_domain'),
            'not_found_in_trash' => __('No item found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'reserve'),
        'menu_position' => null,
        'menu_icon' =>'dashicons-clipboard', // 16px16
        'supports' => array('title'),
        'taxonomies' => array('reserve') //array('category','reserve')
            )
    );
}



add_action('add_meta_boxes', 'reserve_add_custom_box');
add_action('save_post', 'reserve_save_postdata');

function reserve_add_custom_box() {
    add_meta_box('course_id', 'Reservation Details', 'reserve_custom_box', 'reserve', 'normal', 'high');
}

function reserve_custom_box($post) {
    global $wpdb;

    $post_id = $post->ID;

    /* Add verification field */
    wp_nonce_field(plugin_basename(__FILE__), 'ego_noncename');
    /* Add verification field ends */
    $reserve_option1 = get_post_meta($post_id, 'reserve_option1', true);
    $reserve_option2 = get_post_meta($post_id, 'reserve_option2', true);
    $reserve_option3 = get_post_meta($post_id, 'reserve_option3', true);
    $reserve_option4 = get_post_meta($post_id, 'reserve_option4', true);
    $reserve_option5 = get_post_meta($post_id, 'reserve_option5', true);
    $reserve_option6 = get_post_meta($post_id, 'reserve_option6', true);
    
    ?>
<div style="width:100%;">
    <table cellpadding="0" cellspacing="6" border="0" width="100%">
        <tr>
            <td width="20%">Email</td>
            <td width="80%" align="left">
                <input type="text" name="reserve_option1" style="width:50%!important" id="reserve_option1"
                    value="<?php echo $reserve_option1; ?>">
            </td>
        </tr>
        <tr>
            <td>Phone Text</td>
            <td align="left">
                <input type="text" name="reserve_option2" style="width:250px" id="reserve_option2"
                    value="<?php echo $reserve_option2; ?>">
            </td>
        </tr>
        <tr>
            <td>Date</td>
            <td align="left">
                <input type="text" name="reserve_option3" style="width:250px" id="reserve_option3"
                    value="<?php echo $reserve_option3; ?>">
            </td>
        </tr>
        <tr>
            <td>Time</td>
            <td align="left">
                <input type="text" name="reserve_option4" style="width:250px" id="reserve_option4"
                    value="<?php echo $reserve_option4; ?>">
            </td>
        </tr>
        <tr>
            <td>Persons</td>
            <td align="left">
                <input type="text" name="reserve_option5" style="width:250px" id="reserve_option5"
                    value="<?php echo $reserve_option5; ?>">
            </td>
        </tr>
        <tr>
            <td>Notes</td>
            <td align="left">
                <textarea cols="27" rows="4" name="reserve_option6"><?php echo $reserve_option6; ?></textarea>
                <!-- <input type="text" name="reserve_option6" style="width:250px" id="reserve_option6"
                    value="<?php echo $reserve_option6; ?>"> -->
            </td>
        </tr>


    </table>
</div>
<?php
    global $post;
    $post->ID = $post_id;
}

function reserve_save_postdata($post_id) {
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id))
        $post_id = $the_post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    // if ('reserve' == $_POST['post_type']) {
    //     if (!current_user_can('edit_page', $post_id))
    //         return $post_id;
    // }
    // else {
    //     if (!current_user_can('edit_post', $post_id))
    //         return $post_id;
    // }

    if (isset($_POST["reserve_option1"])) {
        $reserve_option1 = $_POST["reserve_option1"];
        update_post_meta($post_id, "reserve_option1", $reserve_option1);
    } else {
        delete_post_meta($post_id, "reserve_option1", '');
    }


    if (isset($_POST["reserve_option2"])) {
        $reserve_option2 = $_POST["reserve_option2"];
        update_post_meta($post_id, "reserve_option2", $reserve_option2);
    }

    if (isset($_POST["reserve_option3"])) {
        $reserve_option3 = $_POST["reserve_option3"];
        update_post_meta($post_id, "reserve_option3", $reserve_option3);
    }

    if (isset($_POST["reserve_option4"])) {
        $reserve_option4 = $_POST["reserve_option4"];
        update_post_meta($post_id, "reserve_option4", $reserve_option4);
    }

    if (isset($_POST["reserve_option5"])) {
        $reserve_option5 = $_POST["reserve_option5"];
        update_post_meta($post_id, "reserve_option5", $reserve_option5);
    }

    if (isset($_POST["reserve_option6"])) {
        $reserve_option6 = $_POST["reserve_option6"];
        update_post_meta($post_id, "reserve_option6", $reserve_option6);
    }

    /* checking verification ends */
}

/* :::::::::::::::;  Add Column on reserve grid ::::::::::  */

add_action('admin_head', 'my_admin_reserve_column_width');

function my_admin_reserve_column_width() {
    echo '<style type="text/css">
        .column-title { text-align: left; width:25% !important; }
        #reserve_option1{ text-align: left; width:12%!important; }
    </style>';
}

add_filter('manage_reserve_posts_columns', 'add_new_reserve_columns');

function add_new_reserve_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Reserved By', 'column name');

     $new_columns['reserve_option1'] = __('Email');
     $new_columns['reserve_option2'] = __('Phone');
     $new_columns['reserve_option3'] = __('Booking for Date');
     //$new_columns['reserve_option4'] = __('Time');
     $new_columns['reserve_option5'] = __('Persons');
    $new_columns['date'] = _x('Send Date', 'column name');
    return $new_columns;
}

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN

add_action('manage_reserve_posts_custom_column', 'show_list_columns_content_only_reserve', 10, 2);

function show_list_columns_content_only_reserve($column_name, $post_id) {

    if ($column_name == 'reserve_option1') {
        echo $reserve_option1 = get_post_meta($post_id, 'reserve_option1', true);
    }
    if ($column_name == 'reserve_option2') {
        echo get_post_meta($post_id, 'reserve_option2', true);       
    }
    if ($column_name == 'reserve_option3') {
        echo get_post_meta($post_id, 'reserve_option3', true); 
        echo "&nbsp;&nbsp;&nbsp;".get_post_meta($post_id, 'reserve_option4', true); 
    }

    if ($column_name == 'reserve_option5') {
        echo get_post_meta($post_id, 'reserve_option5', true); 
    }

}

/**
 *  Custom Post Status
 * 
 * 
 */
function custom_post_status(){
	register_post_status( 'unread', array(
		'label'                     => _x( 'Unread', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Unread (%s)', 'Unread (%s)' ),
	) );
}
add_action( 'init', 'custom_post_status' );



/**
 * 
 *  
 * 
 */

function set_form(){
   
      // Build POST request:
      $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
      $recaptcha_secret = GOOGLE_SECRET_KEY;
      $recaptchaResponse = $_POST['recaptchaResponse'];
  
      // Make and decode POST request:
      $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptchaResponse);
      $recaptcha = json_decode($recaptcha);
  
      // Take action based on the score returned:
      if ($recaptcha->score >= 0.5) {
          // Verified - send email
          $name = $_POST['name'];
          $email = $_POST['email'];
          $date = $_POST['date'];
          $time = $_POST['time'];
          $phone = $_POST['phone'];
          $person = $_POST['person'];         
      
          $admin = get_option('admin_email');          
      
          $fields = array(
              0 => array(
                  'text' => 'Name',
                  'val' => $name
              ),
              1 => array(
                  'text' => 'Email',
                  'val' => $email
              ),
              2 => array(
                  'text' => 'Phone',
                  'val' => $phone
              ),
              3 => array(
                  'text' => 'Number of Persons',
                  'val' => $person
              ),
              4 => array(
                  'text' => 'Date',
                  'val' => $date
              ),
              5 => array(
                  'text' => 'Time',
                  'val' => $time
              )
          );
      
          $message = '';
      
          foreach ($fields as $field) {
              $message .= $field['text'] . ": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
          }
      
          $admin_message = 'Dear Admin <br/>';
          $admin_message .= 'New Booking request <br/><br/>';
          $admin_message .= $message;
          $admin_message .= 'Thanks <br/><br/> Website Forwared Booking Email';
		  $admin_message .= '<a href="'.site_url('/')."' > Website Admin</a>";
		  $admin_sub = "Booking Request ".$name;
      
          $client_message = 'Dear '.$name.'<br/>';
          $client_message .= 'Your Booking request received. We will contact you soon!<br/><br/><br/><br/>';
          $client_message .= 'Thanks <br/><br/>';
		  $client_message .= '<a href="'.site_url('/')."' > Website Admin</a>";
		  $client_sub = "Gurkhas restaurant table booking request received ";
      
      
          $msg = '';
		  
          $headers = array('Content-Type: text/html; charset=UTF-8');
          if(wp_mail($email, $client_sub, $client_message,$headers)  &&  wp_mail($admin, $admin_sub, $admin_message,$headers) )
          {
             $msg = 'Email send ';
             
          } 
          else {
              $message = array('success' => '0','message' => 'Fail to send email ');
              echo json_encode($message);
              die();
          }
          
          //To Save The Message In Custom Post Type
          $new_post = array(
              'post_title'    => $name,
              // 'post_content'  => $message,
              'post_status'   => 'pending',           // Choose: publish, preview, future, draft, etc.
              'post_type' => 'reserve'  //'post',page' or use a custom post type if you want to
          );
      
          // show the email in meta box
              $pid = wp_insert_post($new_post);
             
              if(!empty($pid)){
                      update_post_meta($pid, "reserve_option1", $email);
                      update_post_meta($pid, "reserve_option2", $phone);
                      update_post_meta($pid, "reserve_option3", $date);
                      update_post_meta($pid, "reserve_option4", $time);
                      update_post_meta($pid, "reserve_option5", $person);
                      
                  $message = array('success' => '1','message' => $msg.' Successfully resercation sent'.$msg);
              }
              
          echo json_encode($message);
          die();

      } else {
          // Not verified - show form error
          $message = array('success' => '0','message' => 'Captcha validation error');
          echo json_encode($message);
          die();
      } 
      die();
}


function ajax_form_scripts() {
	$translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script( 'functions', 'cpm_object', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );

add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_set_form', 'set_form'); //execute when logged out

?>