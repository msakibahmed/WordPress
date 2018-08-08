<?php

//Custom Texonomy
function edu_toolkit_custom_post_taxonomy() {
    register_taxonomy(
        'course-category',
        'course', //This is CPT name
        array(
            'label' => __( 'Course Category' ),
            'rewrite' => array( 'slug' => 'course-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'edu_toolkit_custom_post_taxonomy' );





/*************************************************************/
/* 					FRONTEND CALL 							*/
/***********************************************************/


/*  METHODE 1: Show Name */
$terms = get_the_terms( $post->ID , 'course-category' );
foreach ( $terms as $term ) {
	echo $term->name;
}



/*  METHODE 2 :   With link and comma separator */
$i = 1;
foreach ( $terms as $term ) {
    $term_link = get_term_link( $term, array( 'commitments', 'type' ) );
        if( is_wp_error( $term_link ) )
        continue;
        echo '<a href="' . $term_link . '">' . $term->name . '</a>';
        //  Add comma (except after the last theme)
        echo ($i < count($terms))? ", " : "";
        // Increment counter
        $i++;
}
