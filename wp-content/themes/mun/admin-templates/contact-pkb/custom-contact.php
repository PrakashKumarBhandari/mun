<?php
//require 'PHPMailer/src/Exception.php';
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

add_action('init', 'create_post_type_contact');

function create_post_type_contact() {
    register_post_type('contact-form', array(
        'labels' => array(
            'name' => _x('Contact', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Contact', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Contact', 'text_domain'),
            'parent_item_colon' => __('Parent Contact:', 'text_domain'),
            'all_items' => __('All Contact', 'text_domain'),
            'view_item' => __('View Contact', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('New Contact', 'text_domain'),
            'edit_item' => __('Edit items', 'text_domain'),
            'update_item' => __('Update items', 'text_domain'),
            'search_items' => __('Search items', 'text_domain'),
            'not_found' => __('No item found', 'text_domain'),
            'not_found_in_trash' => __('No item found in Trash', 'text_domain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'contact-form'),
        'menu_position' => null,
        'menu_icon' =>'dashicons-email', // 16px16
        'supports' => array('title'),
        'taxonomies' => array('contact-form') //array('category','contact-form')
            )
    );
}



add_action('add_meta_boxes', 'contact_add_custom_box');
add_action('save_post', 'contact_save_postdata');

function contact_add_custom_box() {
    add_meta_box('course_id', 'Contact Details', 'contact_custom_box', 'contact-form', 'normal', 'high');
}

function contact_custom_box($post) {
    global $wpdb;

    $post_id = $post->ID;

    /* Add verification field */
    wp_nonce_field(plugin_basename(__FILE__), 'ego_noncename');
    /* Add verification field ends */
    $email = get_post_meta($post_id, 'email', true);
    $subject = get_post_meta($post_id, 'subject', true);
    $message = get_post_meta($post_id, 'message', true);
    $phone = get_post_meta($post_id, 'phone', true);
    
    ?>
<div style="width:100%;">
    <table cellpadding="0" cellspacing="6" border="0" width="100%">
        <tr>
            <td width="20%">Email</td>
            <td width="80%" align="left">
                <input type="text" name="email" style="width:50%!important" id="email"
                    value="<?php echo $email; ?>">
            </td>
        </tr>
        <tr>
            <td>Subject</td>
            <td align="left">
                <input type="text" name="subject" style="width:250px" id="subject"
                    value="<?php echo $subject; ?>">
            </td>
        </tr>
       
        <tr>
            <td>Phone</td>
            <td align="left">
                <input type="text" name="phone" style="width:250px" id="phone"
                    value="<?php echo $phone; ?>">
            </td>
        </tr>
        <tr>
            <td>Message</td>
            <td align="left">
            <textarea cols="27" rows="4" name="message"><?php echo $message; ?></textarea>               
            </td>
        </tr>
    </table>
</div>
<?php
    global $post;
    $post->ID = $post_id;
}

function contact_save_postdata($post_id) {
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id))
        $post_id = $the_post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    if ('contact-form' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    }
    else {
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        update_post_meta($post_id, "email", $email);
    } else {
        delete_post_meta($post_id, "email", '');
    }

    if (isset($_POST["subject"])) {
        $subject = $_POST["subject"];
        update_post_meta($post_id, "subject", $subject);
    }

    
    if (isset($_POST["phone"])) {
        $phone = $_POST["phone"];
        update_post_meta($post_id, "phone", $phone);
    }

    if (isset($_POST["message"])) {
        $message = $_POST["message"];
        update_post_meta($post_id, "message", $message);
    }

    /* checking verification ends */
}

/* :::::::::::::::;  Add Column on contact-form grid ::::::::::  */

add_filter('manage_contact-form_posts_columns', 'add_new_contact_columns');

function add_new_contact_columns($new_columns) {
    //print_r($new_columns);
    //if ($new_columns->post_type == 'contact-form'){
    $new_columns['cb'] = '<input type="checkbox" />';
    
    //if ('contact-form' == get_post_type($new_columns) ){
        $new_columns['title'] = _x('Contact By', 'column name');

        $new_columns['email'] = __('Email');
        $new_columns['date'] = _x('Date', 'column name');
        return $new_columns;
    //}
}

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN

add_action('manage_contact-form_posts_custom_column', 'show_list_columns_content_only_contact', 10, 2);

function show_list_columns_content_only_contact($column_name, $post_id) {    
    if ($column_name == 'email') {
        echo $email = get_post_meta($post_id, 'email', true);
    }            
}



/**
 *  Save and Send Contact email to sender email and Admin notification 
 *  
 * 
 */

function save_ajax_contact_form(){
   
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
          $email = strtolower($_POST['email']);
          $subject = $_POST['subject'];
          $phone = $_POST['phone'];
          $frm_message = $_POST['message'];         
      
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
                'text' => 'Subject',
                'val' => $subject
              ),
              4 => array(                 
                  'text' => 'Message',
                  'val' => $frm_message
              )
          );
      
          $message_fields = '';
      
          foreach ($fields as $field) {
              $message_fields .= $field['text'] . ": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
          }
      
          $admin_message = 'Dear Admin <br/>';
          $admin_message .= 'New Contact Message sent from  <br/><br/>';
          $admin_message .= $message_fields;
          $admin_message .= '<br/><br/> Thanks <br/><br/> Website Forwared Contact Message';
		  $admin_message .= '<br/><a href="'.site_url('/').'" > Website Admin</a><br/>';
		  $admin_message .= $_SERVER['HTTP_HOST'] ;
		  $admin_sub = "Contact Form Submitted from ".$name;
      
          $client_message = 'Dear '.$name.'<br/>';
          $client_message .= 'Thank you for contacting with our website. We will contact you soon!<br/><br/>';
          $client_message .= '<br/> Your Contact Message <br/><br/> ***************************<br/><br/>';
          $client_message .= $message_fields;
           $client_message .= '<br/><br/> ***************************<br/><br/>';
          $client_message .= 'Thanks <br/><br/>';
		  $client_message .= '<a href="'.site_url('/').'" > Website Admin</a><br/>';
		  $client_message .= $_SERVER['HTTP_HOST'] ;
		  
		  $client_sub = "Contact Form Submtted ".$_SERVER['HTTP_HOST'];
      
      
          $msg = '';
	
         
      
      
        // Load Composer's autoloader
        //require 'vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        $client_mail = new PHPMailer(true);
       
        try {
            //Server settings
            
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            // $mail->isSMTP();                                            // Send using SMTP
            // $mail->Host       = 'smtp1.example.com';                    // Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // $mail->Username   = 'user@example.com';                     // SMTP username
            // $mail->Password   = 'secret';                               // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            // $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            

            //Recipients
            $mail->setFrom('contact@'.strtolower($_SERVER['HTTP_HOST']), 'Dynasty Contact');
            $mail->addAddress($admin, 'Website Admin');    
            $mail->addReplyTo($admin, 'Website Admin');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Contact From Website : '.$_SERVER['HTTP_HOST'];
            $mail->Body    =  $admin_message; //'Contact Message send from Adm';
            //$mail->AltBody = '';           

            $mail->send();
            
            
            
            /* Send Customer for auto respond message from website admin Automatically from code
            */
             $client_mail->setFrom('contact@'.strtolower($_SERVER['HTTP_HOST']), 'Dynasty Contact');
            $client_mail->addAddress($email, ucwords($name));     //
            
            $client_mail->isHTML(true);            // Set email format
            $client_mail->Subject = $client_sub;
            $client_mail->Body    = $client_message; //'Contact Message send from Adm';
            //$mail->AltBody = '';           

            $client_mail->send();
            
            
            //echo 'Message has been sent';
            $message = array('success' => '1','message' => 'Message has been sent');
           
        } catch (Exception $e) {
            $message = array('success' => '1','message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            
        }
       
            //To Save The Message In Custom Post Type
            $new_post = array(
            'post_title'    => $name,
            //'post_content'  => $message,
            'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
            'post_type' => 'contact-form'  //'post',page' or use a custom post type if you want to
            );
            
            // show the email in meta box
            $pid = wp_insert_post($new_post);
            
            if(!empty($pid)){
                  update_post_meta($pid, "email", $email);
                  update_post_meta($pid, "subject", $subject);
                  update_post_meta($pid, "message", $frm_message);
                  update_post_meta($pid, "phone", $phone);
                  
              $message = array('success' => '1','message' => ' Successfully contact sent');
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


function ajax_contact_form_scripts() {
	$translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );
    wp_enqueue_script( 'function-pkb', get_template_directory_uri() . '/admin-templates/contact-pkb/assets/functions.js', array(), '1.0.0', true );
    wp_enqueue_style('style-pkb-contact',get_template_directory_uri() . '/admin-templates/contact-pkb/assets/style.css', array(), '1.0.0', 'all');
    wp_localize_script( 'function-pkb', 'contact_object', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'ajax_contact_form_scripts' );

add_action( 'wp_ajax_save_ajax_contact_form', 'save_ajax_contact_form' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_save_ajax_contact_form', 'save_ajax_contact_form'); //execute when logged out

?>