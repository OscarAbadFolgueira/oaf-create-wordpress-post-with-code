<?php
/**     
 * Plugin Name: Create a post with code
 * Plugin URI: https://www.oscarabadfolgueira.com/crear-un-post-de-wordpress-con-codigo/
 * Version: 1.0
 * Description: This plugin creates a WordPress post with code.
 * Author: oabadfol
 * Tested up to: 4.9
 * Author URI: https://www.oscarabadfolgueira.com
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

// Uuuusaaa!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ***************  Creating a post with code ************** 

function oaf_create_wordpress_post_with_code() {
    
        // Set the post ID to -1. This sets to no action at moment
        $post_id = -1;
    
        // Set the Author, Slug, title and content of the new post
        $author_id = 1;
        $slug = 'wordpress-post-created-with-code';
        $title = 'WordPress post created whith code';
        $content = 'This is the content of the post that we are creating right now with code. 
                    More text: I motsetning til hva mange tror, er ikke Lorem Ipsum bare tilfeldig tekst. 
                    Dets røtter springer helt tilbake til et stykke klassisk latinsk litteratur fra 45 år f.kr., 
                    hvilket gjør det over 2000 år gammelt. Richard McClintock - professor i latin ved Hampden-Sydney 
                    College i Virginia, USA - slo opp flere av de mer obskure latinske ordene, consectetur, 
                    fra en del av Lorem Ipsum, og fant dets utvilsomme opprinnelse gjennom å studere bruken 
                    av disse ordene i klassisk litteratur. Lorem Ipsum kommer fra seksjon 1.10.32 og 1.10.33 i 
                    "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) av Cicero, skrevet i år 45 f.kr. 
                    Boken er en avhandling om teorier rundt etikk, og var veldig populær under renessansen. Den første 
                    linjen av Lorem Ipsum, "Lorem Ipsum dolor sit amet...", er hentet fra en linje i seksjon 1.10.32.';

        // Cheks if doen't exists a post whith slug "wordpress-post-created-with-code".
        if( !oaf_post_exists_by_slug( $slug ) ) {

            // Set the post ID
            $post_id = wp_insert_post(
                array(
                    'comment_status'	=>	'closed',
                    'ping_status'		=>	'closed',
                    'post_author'		=>	$author_id,
                    'post_name'		    =>	$slug,
                    'post_title'		=>	$title,
                    'post_content'      =>  $content,
                    'post_status'		=>	'publish',
                    'post_type'		    =>	'post'
                )
            );

        } else {
    
                // Set pos_id to -2 becouse there is a post with this slug.
                $post_id = -2;
        
        } // end if
    
    } // end oaf_create_post_with_code

 add_filter( 'after_setup_theme', 'oaf_create_wordpress_post_with_code' );


 /**
 * post_exists_by_slug.
 *
 * @return mixed boolean false if no post exists; post ID otherwise.
 */
function oaf_post_exists_by_slug( $post_slug ) {
    $args_posts = array(
        'post_type'      => 'post',
        'post_status'    => 'any',
        'name'           => $post_slug,
        'posts_per_page' => 1,
    );
    $loop_posts = new WP_Query( $args_posts );

    if ( ! $loop_posts->have_posts() ) {
        return false;

    } else {
        $loop_posts->the_post();
        return $loop_posts->post->ID;
    }
}