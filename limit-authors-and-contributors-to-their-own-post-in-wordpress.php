
<?php

//Source : https://stacktips.com/tutorials/wordpress/limit-authors-and-contributors-to-their-own-post-in-wordpress


if (current_user_can('contributor') || current_user_can('author')){ //Can change with 'contributor'/'editor'
	add_filter('parse_query', 'filter_my_own_posts_query' );
}

function filter_my_own_posts_query( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
      global $current_user;
      $wp_query->set( 'author', $current_user->id );
     }
}