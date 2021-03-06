<?php //Opening PHP tag

add_filter('wp_feed_cache_transient_lifetime',create_function('$a', 'return 1200;')); // Speed upp retrieval of rss feed to widget 20 mins.


add_action( 'init', 'create_post_types' );

function create_post_types() {
	register_post_type( 'kryss_race',
		array(
			'labels' => array(
				'name' => __( 'Seglingar' ),
				'singular_name' => __( 'Segling' ),
				'add_new' => __( 'Lägg upp ny'),
				'add_new_item' => __( 'Lägg upp ny segling'),
				'edit_item' => __( 'Redigera segling'),
				'new_item' => __( 'Ny segling'),
				'view_item' => __( 'Visa segling'),
				'search_items' => __( 'Sök seglingar'),
				'not_found' => __( 'Hittar inga seglingar'),
				'not_found_in_trash' => __( 'Hittar inga seglingar i papperskorgen'),
				'parent_item_colon' => __( ''),
			),
		'taxonomies' => array('kryss_organizer_tax'), 
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'seglingar'),
		)
	);

	register_post_type( 'kryss_result',
		array(
			'labels' => array(
				'name' => __( 'Resultat' ),
				'singular_name' => __( 'Resultat' ),
				'add_new' => __( 'Lägg upp nytt'),
				'add_new_item' => __( 'Lägg upp nytt resultat'),
				'edit_item' => __( 'Redigera resultat'),
				'new_item' => __( 'Nytt resultat'),
				'view_item' => __( 'Visa resultat'),
				'search_items' => __( 'Sök resultat'),
				'not_found' => __( 'Hittar inga resultat'),
				'not_found_in_trash' => __( 'Hittar inga resultat i papperskorgen'),
				'parent_item_colon' => __( ''),
			),
		'taxonomies' => array('kryss_organizer_tax'), 
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'resultat'),
		)
	);
}


add_action( 'init', 'create_kryss_race_tax' );

function create_kryss_race_tax() {
	register_taxonomy(
		'kryss_organizer_tax',
		array( 'kryss_race', 'post', 'page', 'kryss_result' ),
		array(
			'labels' => 
			  array(
      		'name'                       => _x( 'Arrangörer', 'taxonomy general name' ),
      		'singular_name'              => _x( 'Arrangör', 'taxonomy singular name' ),
      		'search_items'               => __( 'Sök arrangörer' ),
      		'popular_items'              => __( 'Mest aktiva arrangörer' ),
      		'all_items'                  => __( 'Alla arrangörer' ),
      		'parent_item'                => null,
      		'parent_item_colon'          => null,
      		'edit_item'                  => __( 'Redigera arrangör' ),
      		'update_item'                => __( 'Redigera arrangör' ),
      		'add_new_item'               => __( 'Lägg till en ny arrangör' ),
      		'new_item_name'              => __( 'Namet på en ny arrangör' ),
      		'separate_items_with_commas' => __( 'Räkna upp arrangörer med kommatecken emellan' ),
      		'add_or_remove_items'        => __( 'Lägg till eller ta bort arrangörer' ),
      		'choose_from_most_used'      => __( 'Välj från de aktivaste arrangörerna' ),
      		'not_found'                  => __( 'Hittar inga arrangörer.' ),
      		'menu_name'                  => __( 'Arrangörer' ),
      		),
			'rewrite' => array( 'slug' => 'arrangorer' ),
			'hierarchical' => true,
		)
	);
}

function kryss_widgets_init() {

	register_sidebar( array(
		'name' => 'Högst till höger',
		'id' => 'kryss_top_right',		
		'before_widget' => '<div class="widget-wrapper">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'kryss_widgets_init' );

function m_explode(array $array,$key = ''){     
        if( !is_array($array) or $key == '')
             return;        
        $output = array();

        foreach( $array as $v ){        
            if( !is_object($v) ){
                return;
            }
            $output[] = $v->$key;

        }

        return $output;

      }
      
function remove_some_widgets(){

	// Unregister some of the TwentyTen sidebars
	unregister_sidebar( 'right-sidebar-half' );
	unregister_sidebar( 'left-sidebar' );
	unregister_sidebar( 'left-sidebar-half' );
	unregister_sidebar( 'right-left' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );      



?>