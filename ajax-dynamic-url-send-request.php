<?php
/*************************************
			  STEP - 1
**************************************/
// Add this code in theme functions.php
add_action( 'init', 'my_script_enqueuer' );
function my_script_enqueuer() {
   wp_register_script( "my_voter_script", WP_PLUGIN_URL.'/my_plugin/my_voter_script.js', array('jquery') );
   wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'my_voter_script' );
}


?>

<script>
/*************************************
			  STEP - 2
**************************************/
	jQuery('#eventapply').submit(eventapply);  //Form ID is '#eventapply'
	function eventapply(){    
	  var action = {'action' : 'event_apply'}; //Action Name 'event_apply'
	  var eventapply = jQuery(this).serialize() + '&' + $.param(action);
	  //console.log(eventapply);
	  jQuery.ajax({  
	    type:"POST",  
	    url : myAjax.ajaxurl, // For this need above 'my_script_enqueuer' wp theme funtion in functions.php
	    data : eventapply,
	    success:function(data){
			if(data != 5){
				jQuery('#signin-status').html("<div class='alert alert-success' role='alert'>You have successfully logged in.</div>");
				location.reload();
			}
			else {
				jQuery(".login-form-submit-status").hide();
				jQuery('#signin-status').html("<div class='alert alert-danger' role='alert'>Please enter correct email and password.</div>");
			} 
	    },
	  });    
	  return false;  
	}
</script>


<?php
/*************************************
			  STEP - 3
**************************************/
//Add this code in in functions.php

function event_apply(){ //'event_apply' action name called by funtion
  echo "HI I am Event_apply Funtion";
  global $wpdb;
	$event_id   = htmlspecialchars($_POST['event_id'],ENT_QUOTES);
	$user_id   = htmlspecialchars($_POST['user_id'],ENT_QUOTES);
	$event_aply     = htmlspecialchars($_POST['apply'],ENT_QUOTES);
      
    $table_name = $wpdb->prefix . 'edu_event_apply'; //Table prefix add 
    $select = $wpdb->get_results( "SELECT * FROM $table_name WHERE user_id = $user_id AND event_id = $event_id  " ); //Check duplicate insert
     if ($select) {
       echo " Already Inserted";
     }else{
      $sql = $wpdb->insert(
        $table_name, //table
        array(
        'event_id'    => $event_id,
        'user_id'     => $user_id ,
        'event_aply'   => $event_aply
        ) 
      );
      if ($sql) {
        echo 1;
      }
     }
  die();      
}
add_action( 'wp_ajax_event_apply', 'event_apply' );
add_action('wp_ajax_nopriv_event_apply', 'event_apply');