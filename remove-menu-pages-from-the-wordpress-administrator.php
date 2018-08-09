
<?php

// Source : https://www.youtube.com/watch?v=9gUCVWjI6OA


define( 'DISALLOW_FILE_EDIT', true);

function remove_menus(){

  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack*
  // remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
	remove_menu_page( 'wpcf7' );        //contact form


}
if(current_user_can( 'administrator' )){ // can add 'administrator'/'editor'/'contributor'
add_action( 'admin_menu', 'remove_menus' );
}

