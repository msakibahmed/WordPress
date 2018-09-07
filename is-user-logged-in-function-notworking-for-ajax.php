<?php

//Add this code in theme function.php :)

function edubright_ajax_check_user_logged_in() {
    echo is_user_logged_in()?'yes':'no';
    die();
}
add_action('wp_ajax_is_user_logged_in', 'edubright_ajax_check_user_logged_in');
add_action('wp_ajax_nopriv_is_user_logged_in', 'edubright_ajax_check_user_logged_in');