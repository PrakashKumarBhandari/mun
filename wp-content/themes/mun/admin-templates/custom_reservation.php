<?php

//require 'contact-pkb/PHPMailer/src/PHPMailer.php';
use PHPMailer\PHPMailer\PHPMailer;

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
            <td>Phone</td>
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

add_action('admin_head', 'reserve_extra_html');

function reserve_extra_html() {
    $options = get_option( 'theme_settings' );

?>
<style>

.email_message {
    display: none;
}
.column-title{
    width:26%;
}
.column-reserve_option1{
    width:20%;
}
.column-reserve_option2{
    width:15%;
}
.column-reserve_option3{
    width:15%;
}
.column-reserve_option5{
    width:7%;
}
.column-date{
   width:10%; 
}
</style>
<div class="modal fade" id="sendReservationModal" style="display:none;" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="sendReservation" class="sendReservation">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Confirm / Reject Reservation Email
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h3>
                </div>
                <div class="modal-body">
                    <div id="success_msg" class="alert alert-success" style="display:none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-cutlery"></i><strong> Success!</strong> <span id="s_msg_disp"> Reservation Email Send.</span>
                    </div>
                    <div id="error_msg" class="alert alert-danger" style="display:none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i
                            class="fa fa-coffee"></i>
                        <span id="e_msg_disp"> <strong>Sorry!</strong> Message Not Sent, Please try again.</span>
                    </div>
                    <div class="form-group">
                        <label for="confirmReject">Confrim / Reject</label>
                        <select class="form-control" name="confirmReject" id="confirmReject">
                            <option selected="selected" value=''>Choose ...</option>
                            <option value='confirm'>Confirm Booking</option>
                            <option value='reject'>Reject Booking</option>
                        </select>
                    </div>
                    <div id="confirm" class="email_message">
                        <div class="form-group">
                            <label for="confirm_booking">Subject</label>
                            <input type="input" name='confirm_booking'
                                value="<?php esc_attr_e ($options['confirm_booking'] ); ?>" id='confirm_booking'
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_booking_email">Email Message</label>
                            <textarea class="form-control" name="confirm_booking_email" id="confirm_booking_email" rows="7"
                                rows="30"><?php esc_attr_e ($options['confirm_booking_email'] ); ?></textarea>
                        </div>
                    </div>
                    <div id="reject" class="email_message">
                        <div class="form-group">
                            <label for="reject_booking">Subject</label>
                            <input type="input" name='reject_booking' id='reject_booking'
                                value="<?php esc_attr_e ($options['reject_booking'] ); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="reject_booking_email">Email Message</label>
                            <textarea class="form-control" name="reject_booking_email" id="reject_booking_email"
                                rows="3"><?php esc_attr_e ($options['reject_booking_email'] ); ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input name="reservation_post_id" id="reservation_post_id"  type="hidden">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_reserve" class="btn btn-primary"><i class="dashicons dashicons-email-alt2"></i> Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
}

add_filter('manage_reserve_posts_columns', 'add_new_reserve_columns');

function add_new_reserve_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Reserved By', 'column name');

     $new_columns['reserve_option1'] = __('Email');
     $new_columns['reserve_option2'] = __('Phone');
     $new_columns['reserve_option3'] = __('Booking for Date');
     $new_columns['reserve_option5'] = __('Persons');
    $new_columns['date'] = _x('Send Date', 'column name');
    return $new_columns;
}

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN

add_action('manage_reserve_posts_custom_column', 'show_list_columns_content_only_reserve', 10, 2);

function show_list_columns_content_only_reserve($column_name, $post_id) {
    $is_email_resend =  get_post_meta($post_id, 'email_response_date', true); 
    if ($column_name == 'reserve_option1') {
        echo $reserve_option1 = get_post_meta($post_id, 'reserve_option1', true);
        if(!empty($is_email_resend)){
        echo'<br/><button class="btn btn-disabled btn-sm" onclick="openFormModal('.$post_id.')" title="Already Send in '.$is_email_resend.'" type="button" >
        <i class="dashicons dashicons-share-alt2" aria-hidden="true"></i>Re Send
        </button>';
        }else{
        echo'<br/><button class="btn btn-success btn-sm" onclick="openFormModal('.$post_id.')" type="button" >
        <i class="dashicons dashicons-share-alt2" aria-hidden="true"></i>Send Email
        </button>';
            
        }
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
 *  Send Ajax Booking Request 
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
          $name = trim($_POST['name']);
          $email = trim($_POST['email']);
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
      
          $admin_message = "Dear Admin,<br/>";
          $admin_message .= 'New Booking request received with following information.<br/>';
          $admin_message .= '<br/>**************************************<br/>';
          $admin_message .= $message;
          $admin_message .= '**************************************<br/>';
          $admin_message .= '<br/>Thank You!<br/>Best Regards <br/>';
		  $admin_message .= '<a href="'.site_url('/').'" > Website Admin</a><br/>';
		  $admin_message .= strtolower($_SERVER['HTTP_HOST']);
		  $admin_message .= '<br/>Website Forwared Booking Email<br/>';
		   
		  $admin_sub = "Booking Request Dynasty Camberley || ".$name." ||";
      
          $client_message = "Dear ".$name.",<br/>";
          $client_message .= '<br/>Your Booking request received. We will contact you soon!<br/>';
          $client_message .= '<br/>Your Request List <br/>';
          $client_message .= '<br/>**************************************<br/>';
          $client_message .= $message;
          $client_message .= '**************************************<br/>';
          $client_message .= 'Thank You!<br/>Best Regards <br/>';
		  $client_message .= '<a href="'.site_url('/').'" > Website Admin</a><br/>';
		  $client_message .= strtolower($_SERVER['HTTP_HOST']);
		  
		  $client_sub = "Dynasty Camberley Restaurant Table Booking Request Received";
      
      
          $msg = '';
          

            $new_post = array(
                'post_title'    => $name,
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
          }


          $mail = new PHPMailer(true);

          $client_mail = new PHPMailer(true);

          
          
          try {
            //Recipients
            $mail->setFrom('booking@'.strtolower($_SERVER['HTTP_HOST']), 'Dynasty Booking');
            $mail->addReplyTo($email,$name);    
            $mail->addAddress($admin,'Website Admin');
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $admin_sub;
            $mail->Body    =  $admin_message; //'Contact Message send from Adm';

            $name = ucfirst($name);

            $client_mail->setFrom('booking@'.strtolower($_SERVER['HTTP_HOST']), 'Dynasty Booking');
            $client_mail->addReplyTo($admin,'Website Admin');
            $client_mail->addAddress($email,$name);    
            
            $client_mail->isHTML(true); // Set email format to HTML
            $client_mail->Subject = $client_sub;
            $client_mail->Body    =  $client_message; //'Contact Message send from Adm';

            $mail->send();
            $client_mail->send();

            $message = array('success' => '1','message' =>  'Booking request successfully send ');
            echo json_encode($message);
            die();
        } catch (Exception $e) {
            $message = array('success' => '0','message' => "Message could not be sent. Mailer Error:");
            echo json_encode($message);
            die();
        }

        //  $headers = array('Content-Type: text/html; charset=UTF-8');
        //   if(wp_mail($email, $client_sub, $client_message,$headers)  &&  wp_mail($admin, $admin_sub, $admin_message,$headers) )
        //   {
        //      $msg = 'Email send ';
             
        //   } 
        //   else {
        //       $message = array('success' => '0','message' => 'Fail to send email ');
        //       echo json_encode($message);
        //       die();
        //   }
          
          //To Save The Message In Custom Post Type

      } else {
          // Not verified - show form error
          $message = array('success' => '0','message' => 'Captcha validation error');
          echo json_encode($message);
          die();
      } 
      die();
}




function sendBookingResponse(){
   
        // Build POST request:
        $reservation_post_id = $_POST['reservation_post_id'];

        $confirmReject = $_POST['confirmReject'];
        $confirm_booking = $_POST['confirm_booking'];
        $confirm_booking_email = $_POST['confirm_booking_email'];

        $reject_booking = $_POST['reject_booking'];
        $reject_booking_email = $_POST['reject_booking_email'];
        

        $admin = get_option('admin_email'); 

        
        $current_post = get_post($reservation_post_id, 'ARRAY_A' );      
        $pid  = $current_post['ID'];

       
                        
             /**
              * Check if post is valid  */           
            if(!empty($pid)){                
     
                 // Update post meta with response_date
                update_post_meta($pid, "email_response_date",date("Y-m-d h:i:s"));
                


                $status = 'trash';  
                $con_rej = '';  
                if($confirmReject  == 'confirm'){            
                    $status = 'publish';
                    $con_rej = 'Confirmtion ';
                    $email_subject = $confirm_booking;   
                    $body_email_message = $confirm_booking_email;      
                }
                else{
                    $con_rej = 'Rejection  ';
                    $email_subject = $reject_booking;   
                    $body_email_message = $reject_booking_email; 
                }
                /**
                 * Update post status trash or publish 
                 */
                $current_post['post_status'] = $status;
                $title = $current_post['post_title'];
                wp_update_post($current_post);

                
                /** Get Previous post meta to send emails 
                 *  to the Requester or Sender
                 */
                $client_name = ucfirst($title); 
                $client_email =  trim(get_post_meta($pid, 'reserve_option1', true)); 
                $client_phone =  get_post_meta($pid, 'reserve_option2', true); 
                $client_date =  get_post_meta($pid, 'reserve_option3', true); 
                $client_time =  get_post_meta($pid, 'reserve_option4', true); 
                $client_persons =  get_post_meta($pid, 'reserve_option5', true); 
                $is_email_resend =  get_post_meta($pid, 'email_response_date', true); 

               
                
                $fields = array(
                    0 => array(
                        'text' => 'Name',
                        'val' => $client_name
                    ),
                    1 => array(
                        'text' => 'Email',
                        'val' => $client_email
                    ),
                    2 => array(
                        'text' => 'Phone',
                        'val' => $client_phone
                    ),
                    3 => array(
                        'text' => 'Number of Persons',
                        'val' => $client_persons
                    ),
                    4 => array(
                        'text' => 'Date',
                        'val' => $client_date
                    ),
                    5 => array(
                        'text' => 'Time',
                        'val' => $client_time
                    )
                );

          $req_message = '';
      
          foreach ($fields as $field) {
              $req_message .= $field['text'] . ": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
          }
          
          
                    $mail = new PHPMailer(true);
                    try {
                        //Recipients
                        $mail->setFrom('booking@'.strtolower($_SERVER['HTTP_HOST']), 'Dynasty Booking');
                        $mail->addAddress($client_email,$client_name);    
                        $mail->addReplyTo($admin, 'Website Admin');
                        
                        $email_header ='Dear '.$client_name.',<br/><br/>';
                        $email_footer ='<br/>Thank You!<br/> Best Regards <br/><a href="'.site_url('/').'" > Website Admin</a><br/>';
                        $email_footer .= strtolower($_SERVER['HTTP_HOST']);
                        //$email_footer .='<br/>This email is send from dynasty camberley website booking system.'.$client_name.',<br/>';
                            
                            
                          
		  
                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Subject = $email_subject;
                        $email_message = $email_header;
                        
                        $email_message .= $body_email_message;
                        $email_message .= '<br/><br/>**************************************<br/>';
                        $email_message .= $req_message;
                        $email_message .= '**************************************<br/>';
                        $email_message .= $email_footer;
          
                        $mail->Body    =  $email_message; //'Contact Message send from Adm';


                        $mail->send();
                        $message = array('success' => '1','message' =>  $con_rej.' message send to '.$client_email);
                        echo json_encode($message);
                        die();
                    } catch (Exception $e) {
                        $message = array('success' => '0','message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                        echo json_encode($message);
                        die();
                    }
               
            }else{
                $message = array('success' => '0','message' => 'Sorry! We could not able to do your request');
                echo json_encode($message);
                die();
            }
}



function ajax_form_scripts() {
	$translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script( 'functions', 'cpm_object', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );
//add_action( 'admin_enqueue_scripts', 'ajax_form_scripts' );

function wpdocs_selectively_enqueue_admin_script( $hook ) {
    global $post_type;
   
    if('reserve' != $post_type)
    {
        return;
    }
    // if ( 'edit.php' != $hook ) {
    //     return;
    // }

    $translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );

    if('reserve' == $post_type ){
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.css');	
        wp_enqueue_script('reservaton-custom', get_template_directory_uri() . '/admin-templates/contact-pkb/assets/reservation.js', array(), '1.0', true );
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.js', array(), '1.0', true );
    }
    wp_localize_script( 'reservaton-custom', 'pkb_object', $translation_array );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );



add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_set_form', 'set_form'); //execute when logged out

add_action( 'wp_ajax_sendBookingResponse', 'sendBookingResponse' ); 

?>