<?php

add_filter( 'postmeta_form_limit', 'meta_limit_increase' );
function meta_limit_increase( $limit ) {
	return 50;
}

add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );

add_action( 'init', 'theme_menus' );
function theme_menus() {
	register_nav_menus(
		array(
			'menu-1'   => __( 'Main menu' ),
			'menu-2'   => __( 'Test menu' ),
			'footer-1' => __( 'Footer 1' ),
			'footer-2' => __( 'Footer 2' ),
			'footer-3' => __( 'Footer 3' ),
		)
	);
}

function register_navwalker() {
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

add_action( 'after_setup_theme', 'register_navwalker' );
/*ÖNE ÇIKARILMIŞ GÖRSEL BOYUTU*/
add_theme_support( 'post-thumbnails' );
add_image_size( 'onalti', 1600, 900, array( 'top' ) );
add_image_size( 'iki', 1500, 1000, array( 'top' ) );
add_image_size( 'yanmanset', 324, 182, array( 'top' ) );
add_image_size( 'kmanset', 377, 250, array( 'top' ) );
/*ÖNE ÇIKARILMIŞ GÖRSEL BOYUTU*/

/*İLGİLİ İÇERİKLERİ LİSTELER*/
function get_related_category_posts() {
	// Check if we are on a single page, if not, return false
	if ( ! is_single() ) {
		return false;
	}

	// Get the current post id
	$post_id = get_queried_object_id();

	// Get the post categories
	$categories = get_the_category( $post_id );

	// Lets build our array
	// If we don't have categories, bail
	if ( ! $categories ) {
		return false;
	}

	foreach ( $categories as $category ) {
		if ( $category->parent == 0 ) {
			$term_ids[] = $category->term_id;
		} else {
			$term_ids[] = $category->parent;
			$term_ids[] = $category->term_id;
		}
	}

	// Remove duplicate values from the array
	$unique_array = array_unique( $term_ids );

	// Lets build our query
	$args = [
		'post__not_in'        => [ $post_id ],
		'posts_per_page'      => 4, // Note: showposts is depreciated in favor of posts_per_page
		'ignore_sticky_posts' => 1, // Note: caller_get_posts is depreciated
		'orderby'             => 'date',
		'no_found_rows'       => true, // Skip pagination, makes the query faster
		'tax_query'           => [
			[
				'taxonomy'         => 'category',
				'terms'            => $unique_array,
				'include_children' => false,
			],
		],
	];
	$q    = new WP_Query( $args );

	return $q;
}

/*İLGİLİ İÇERİKLERİ LİSTELER*/


/*GÖRSEL*/


function gorsel( $postid, $size = 'full' ) {


	if ( empty( get_the_post_thumbnail_url( $postid, $size ) ) ) {


		$thumurl = '#';
	} else {

		$thumurl = get_the_post_thumbnail_url( $postid, $size );

	}

	return $thumurl;

}

/*GÖRSEL*/

// hooks your functions into the correct filters
function wdm_add_mce_button() {
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'wdm_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'wdm_register_mce_button' );
	}
}

add_action( 'admin_head', 'wdm_add_mce_button' );

// register new button in the editor
function wdm_register_mce_button( $buttons ) {
	array_push( $buttons, 'wdm_mce_dropbutton' );

	return $buttons;
}


// declare a script for the new button
// the script will insert the shortcode on the click event
function wdm_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['wdm_mce_dropbutton'] = get_stylesheet_directory_uri() . '/js/wdm-mce-button.js';

	return $plugin_array;
}


function kurulTitle( $atts, $content = null ) {


	$icerik = do_shortcode( $content );

	$out = '<h3 class="title">' . $icerik . '</h3><div class="row">';

	return $out;
}

add_shortcode( 'kurulTitle', 'kurulTitle' );

function kurulTasiyici( $atts, $content = null ) {


	$icerik = do_shortcode( $content );

	$out = ' <div class="kurul">' . $icerik . '</div></div>';

	return $out;
}

add_shortcode( 'kurulTasiyici', 'kurulTasiyici' );

function kurulUye( $atts, $content = null ) {

	global $post;


	$icerik = do_shortcode( $content );
	$a      = shortcode_atts( array(
		'ad'    => '',
		'gorev' => '',
		'url'   => '',
	), $atts );

	$ad    = str_replace( 'i', 'İ', $a['ad'] );
	$gorev = str_replace( 'i', 'İ', $a['gorev'] );
	$url   = $a['url'];


	if ( $post->ID == 3276 ) {

		$out = '<div class="kurul-uye">

			 
			<img style="max-height: 138px;" src="' . $icerik . '" class="img-fluid ' .$post_id . '">
			
			<div class="uye-unvan">  <span>' . esc_attr( $ad ) . '</span></div>
			<div class="uye-isim">' . esc_attr( $gorev ) . '</div>

			</div>';
	} else {

		$out = '<div class="kurul-uye">
<a href="' . $url . '">
			<img style="max-height: 138px;" src="' . $icerik . '" class="img-fluid ' . $post_id . '"></a>
			<div class="uye-unvan"> <a href="' . $url . '"><span>' . esc_attr( $gorev ) . '</span></a></div>
			<div class="uye-isim">' . esc_attr( $ad ) . '</div>

			</div>';
	}

	return $out;
}

add_shortcode( 'kurulUye', 'kurulUye' );

function songenelkurul( $atts, $content = null ) {


	$icerik = do_shortcode( $content );
	$a      = shortcode_atts( array(
		'ad'          => '',
		'gorev'       => '',
		'malbildirim' => '',
		'foto'        => ''

	), $atts );

	$ad    = str_replace( 'i', 'İ', $a['ad'] );
	$gorev = str_replace( 'i', 'İ', $a['gorev'] );

	$out = '<div class="genel-title">
		<div class="row">
		<div class="col-12 col-md-2">
		<img src="' . esc_attr( $a['foto'] ) . '" class="img-fluid">
		</div>
		<div class="col-12 col-md-10">
		<div class="isim">' . esc_attr( $ad ) . '</div>
		<div class="gorev">' . esc_attr( $gorev ) . '</div>
		</div>
		</div>
		</div>
		<div class="genel-oz">' . $icerik . '</div>';


	return $out;
}

add_shortcode( 'songenelkurul', 'songenelkurul' );


function tarih() {


	date_default_timezone_set( 'Europe/Istanbul' );

	$current_year = date( 'Y' );

	$current_ay  = date( 'm' );
	$current_gun = date( 'd' );;
	$out = $current_year - 1952;
	if ( $current_ay < 4 ) {

		$out --;

	} elseif ( $current_ay == 4 ) {

		if ( $current_gun < 13 ) {

			$out --;

		}

	}


	return $out;
}

add_shortcode( 'tarih', 'tarih' );


remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );


function wpbeginner_numeric_posts_nav() {

	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;

	}

	if ( ( $paged + 2 ) <= $max ) {

		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul style="padding-inline-start: 0;">' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( '<' ) );
	}

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) ) {
			echo '<li>…</li>';
		}
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li>…</li>' . "\n";
		}

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_next_posts_link( '>' ) );
	}

	echo '</ul></div>' . "\n";

}
/*
function mailat( $konu, $mesaj ) {
	$mail = new PHPMailer\PHPMailer\PHPMailer;

	$mail->IsSMTP();
	$mail->SMTPDebug  = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
	$mail->SMTPAuth   = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
	$mail->SMTPSecure = 'ssl'; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
	$mail->Host       = "smtp.gmail.com"; // Mail sunucusunun adresi (IP de olabilir)
	$mail->Port       = 465; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
	$mail->IsHTML( true );
	$mail->SetLanguage( "tr", "phpmailer/language" );
	$mail->CharSet  = "utf-8";
	$mail->Username = "smtp.tekgida@gmail.com"; // Gönderici adresiniz (e-posta adresiniz)
	$mail->Password = "zxdsl831C.."; // Mail adresimizin sifresi
	$mail->SetFrom( "smtp.tekgida@gmail.com", "TEKGIDA İLETİŞİM FORMU" ); // Mail atıldığında gorulecek isim ve email
	$mail->AddAddress( "ozancrk@gmail.com" ); // Mailin gönderileceği alıcı adres
	$mail->Subject = $konu; // Email konu başlığı
	$mail->Body    = $mesaj; // Mailin içeriği
	if ( ! $mail->Send() ) {
		return "Mailer Error: " . $mail->ErrorInfo;
	} else {
		return 1;
	}
}*/


add_action( 'wp_ajax_mycustom_action', 'mycustom_action' );
add_action( 'wp_ajax_nopriv_mycustom_action', 'mycustom_action' );


function mycustom_action() {

	$isim  = $_POST['name'];
	$mail  = $_POST['mail'];
	$konu  = $_POST['konu'];
	$mesaj = $_POST['mesaj'];


	$mesaj2 = '

		İSİM: ' . $isim . '<br>KONU: ' . $konu . '<br>MAİL: ' . $mail . '<br><br>MESAJ: <br>' . $mesaj . '

		';

	return mailat( $konu, $mesaj2 );
	//return 0;


}


// Our custom post type function
function create_posttype() {

	register_post_type( 'isyeri',
		// CPT Options
		array(
			'labels'              => array(
				'name'          => __( 'İşyerleri' ),
				'singular_name' => __( 'İşyeri' )
			),
			'public'              => true,
			'has_archive'         => true,
			'rewrite'             => array( 'slug' => 'isyeri' ),
			'show_in_rest'        => true,
			'exclude_from_search' => true,
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )

		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

add_action( 'init', 'update_my_custom_type', 99 );

/**
 * update_my_custom_type
 *
 * @author  Joe Sexton <joe@webtipblog.com>
 */
function update_my_custom_type() {
	global $wp_post_types;

	if ( post_type_exists( 'isyeri' ) ) {

		// exclude from search results
		$wp_post_types['isyeri']->exclude_from_search = true;
	}
}

function gt_get_post_view() {
	$count = get_post_meta( get_the_ID(), 'post_views_count', true );

	return "$count";
}

function gt_set_post_view() {
	$key     = 'post_views_count';
	$post_id = get_the_ID();
	$count   = (int) get_post_meta( $post_id, $key, true );
	$count ++;
	update_post_meta( $post_id, $key, $count );
}

function gt_posts_column_views( $columns ) {
	$columns['post_views'] = 'Okuma Sayısı';

	return $columns;
}

function gt_posts_custom_column_views( $column ) {
	if ( $column === 'post_views' ) {
		echo gt_get_post_view();
	}
}

add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );

function mb_strtoupper_tr( $metin ) {
	//diğer karakterler de bu şekilde eklenebilir.
	$metin = str_replace( 'i', 'İ', $metin );

	//kalan karakteleri büyütüp geri çeviriyoruz.
	return mb_strtoupper( $metin, 'UTF8' );
}


function wpb_search_filter( $query ) {
	if ( $query->is_search && ! is_admin() ) {
		$query->set( 'cat', '-19' );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'wpb_search_filter' );


add_action( 'wp_ajax_shorturl', 'shorturl' );
add_action( 'wp_ajax_nopriv_shorturl', 'shorturl' );

function shorturl() {

	$ID = $_POST['text'];

	$return        = array();
	$return['url'] = get_permalink( $ID );
	$url           = urlencode( $return['url'] );
	$json          = wp_remote_get( 'https://cutt.ly/api/api.php?key=2279e55537030eeb139deb84b0b5450be83af&short=' . $url . '&userDomain=1' );

	$array = json_decode( $json['body'], true );

	update_post_meta( $ID, 'shorturl', $array['url']['shortLink'] );


	wp_send_json( $array );
}


add_action( 'wp_ajax_like', 'like' );
add_action( 'wp_ajax_nopriv_like', 'like' );
function like() {


	$ID    = $_POST['text'];
	$likes = get_post_meta( $ID, 'like' );
	$like  = $likes[0];

	if ( isset( $like ) and ! empty( $like ) ) {
		$like ++;
	} else {
		$like = 1;
	}


	update_post_meta( $ID, 'like', $like );


	$return = array( 'like' => $like );

	wp_send_json( $return );
}






function case_converter( $keyword, $transform = 'lowercase' ) {

	$low = array(
		'a',
		'b',
		'c',
		'ç',
		'd',
		'e',
		'f',
		'g',
		'ğ',
		'h',
		'ı',
		'i',
		'j',
		'k',
		'l',
		'm',
		'n',
		'o',
		'ö',
		'p',
		'r',
		's',
		'ş',
		't',
		'u',
		'ü',
		'v',
		'y',
		'z',
		'q',
		'w',
		'x'
	);
	$upp = array(
		'A',
		'B',
		'C',
		'Ç',
		'D',
		'E',
		'F',
		'G',
		'Ğ',
		'H',
		'I',
		'İ',
		'J',
		'K',
		'L',
		'M',
		'N',
		'O',
		'Ö',
		'P',
		'R',
		'S',
		'Ş',
		'T',
		'U',
		'Ü',
		'V',
		'Y',
		'Z',
		'Q',
		'W',
		'X'
	);

	if ( $transform == 'uppercase' or $transform == 'u' ) {
		$keyword = str_replace( $low, $upp, $keyword );
		$keyword = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $keyword ) : $keyword;

	} elseif ( $transform == 'lowercase' or $transform == 'l' ) {

		$keyword = str_replace( $upp, $low, $keyword );
		$keyword = function_exists( 'mb_strtolower' ) ? mb_strtolower( $keyword ) : $keyword;

	}

	return $keyword;

}


function urledit($url){

	$url = str_replace('https://','',$url);
	$url = str_replace('http://','',$url);
	return 'https://'.$url;


}


/* Yazarlar Taxonomy */

add_action( 'init', 'create_my_taxonomies_uckan', 0 );
function create_my_taxonomies_uckan() {
	register_taxonomy( 'yazarlar', 'post', array( 'hierarchical' => true, 'label' => 'Yazarlar', 'show_in_rest' => true,) );

}

/* Yazarlar Taxonom*/
/* Çevirmen Taxonomy */

add_action( 'init', 'create_my_taxonomies_uckan2', 0 );
function create_my_taxonomies_uckan2() {
	register_taxonomy( 'cevirmen', 'post', array( 'hierarchical' => true, 'label' => 'Çevirmen', 'show_in_rest' => true,) );

}

/* Çevirmen Taxonom*/

/* İçerik Türü Taxonomy */

add_action( 'init', 'create_my_taxonomies_uckan1', 0 );
function create_my_taxonomies_uckan1() {
	register_taxonomy( 'icerik-turu', 'post', array( 'hierarchical' => true, 'label' => 'İçerik Türü') );

}

/* İçerik Türü Taxonom*/

/* İçerik Türü Taxonomy */

add_action( 'init', 'create_my_taxonomies_uckan3', 0 );
function create_my_taxonomies_uckan3() {
	register_taxonomy( 'icerik-aciklama', 'post', array( 'hierarchical' => false, 'label' => 'İçerik Açıklaması', 'show_in_rest' => true,) );

}

/* İçerik Türü Taxonom*/

function yazarlist( $args = '' ) {
	$defaults = array(
		'child_of'            => 0,
		'current_category'    => 0,
		'depth'               => 0,
		'echo'                => 1,
		'exclude'             => '',
		'exclude_tree'        => '',
		'feed'                => '',
		'feed_image'          => '',
		'feed_type'           => '',
		'hide_empty'          => 1,
		'hide_title_if_empty' => false,
		'hierarchical'        => true,
		'order'               => 'ASC',
		'orderby'             => 'name',
		'separator'           => '|',
		'show_count'          => 0,
		'show_option_all'     => '',
		'show_option_none'    => __( 'No categories' ),
		'style'               => 'list',
		'taxonomy'            => 'category',
		'title_li'            => __( 'Categories' ),
		'use_desc_for_title'  => 1,
	);

	$r = wp_parse_args( $args, $defaults );

	if ( ! isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
		$r['pad_counts'] = true;
	}

	// Descendants of exclusions should be excluded too.
	if ( true == $r['hierarchical'] ) {
		$exclude_tree = array();

		if ( $r['exclude_tree'] ) {
			$exclude_tree = array_merge( $exclude_tree, wp_parse_id_list( $r['exclude_tree'] ) );
		}

		if ( $r['exclude'] ) {
			$exclude_tree = array_merge( $exclude_tree, wp_parse_id_list( $r['exclude'] ) );
		}

		$r['exclude_tree'] = $exclude_tree;
		$r['exclude']      = '';
	}

	if ( ! isset( $r['class'] ) ) {
		$r['class'] = ( 'category' == $r['taxonomy'] ) ? 'categories' : $r['taxonomy'];
	}

	if ( ! taxonomy_exists( $r['taxonomy'] ) ) {
		return false;
	}

	$show_option_all  = $r['show_option_all'];
	$show_option_none = $r['show_option_none'];

	$categories = get_categories( $r );

	$output = '';
	if ( $r['title_li'] && 'list' == $r['style'] && ( ! empty( $categories ) || ! $r['hide_title_if_empty'] ) ) {
		$output = '<li class="' . esc_attr( $r['class'] ) . '">' . $r['title_li'] . '<ul>';
	}
	if ( empty( $categories ) ) {
		if ( ! empty( $show_option_none ) ) {
			if ( 'list' == $r['style'] ) {
				$output .= '<li class="cat-item-none">' . $show_option_none . '</li>';
			} else {
				$output .= $show_option_none;
			}
		}
	} else {
		if ( ! empty( $show_option_all ) ) {

			$posts_page = '';

			// For taxonomies that belong only to custom post types, point to a valid archive.
			$taxonomy_object = get_taxonomy( $r['taxonomy'] );
			if ( ! in_array( 'post', $taxonomy_object->object_type ) && ! in_array( 'page', $taxonomy_object->object_type ) ) {
				foreach ( $taxonomy_object->object_type as $object_type ) {
					$_object_type = get_post_type_object( $object_type );

					// Grab the first one.
					if ( ! empty( $_object_type->has_archive ) ) {
						$posts_page = get_post_type_archive_link( $object_type );
						break;
					}
				}
			}

			// Fallback for the 'All' link is the posts page.
			if ( ! $posts_page ) {
				if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
					$posts_page = get_permalink( get_option( 'page_for_posts' ) );
				} else {
					$posts_page = home_url( '/' );
				}
			}

			$posts_page = esc_url( $posts_page );

			if ( 'list' == $r['style'] ) {
				$output .= "<li class='cat-item-all'><a href='$posts_page'>$show_option_all</a></li>";
			} else {
				$output .= "<a href='$posts_page'>$show_option_all</a>";
			}
		}

		if ( empty( $r['current_category'] ) && ( is_category() || is_tax() || is_tag() ) ) {
			$current_term_object = get_queried_object();
			if ( $current_term_object && $r['taxonomy'] === $current_term_object->taxonomy ) {
				$r['current_category'] = get_queried_object_id();
			}
		}

		if ( $r['hierarchical'] ) {
			$depth = $r['depth'];
		} else {
			$depth = -1; // Flat.
		}
		$output .= walk_category_tree( $categories, $depth, $r );
	}

	if ( $r['title_li'] && 'list' == $r['style'] && ( ! empty( $categories ) || ! $r['hide_title_if_empty'] ) ) {
		$output .= '</ul></li>';
	}

	/**
	 * Filters the HTML output of a taxonomy list.
	 *
	 * @since 2.1.0
	 *
	 * @param string $output HTML output.
	 * @param array  $args   An array of taxonomy-listing arguments.
	 */
	$html = apply_filters( 'wp_list_categories', $output, $args );


	$yazarlar1 = explode("|", $html);

	foreach($yazarlar1 as $yazar){


		$yazar1 = explode('r/', $yazar);



		if(empty($harf)){


			$harf = mb_substr($yazar1[1], 0, 1);

			$out .= '<div class="yazarblock"><h3>'. strtoupper($harf) .'</h3> ';
			$out .= $yazar;

		}else{


			$harf1 = mb_substr($yazar1[1], 0, 1);

			if($harf1 == $harf){

				$out .= $yazar;

			}else{



				$harf = $harf1;
				$out .= ' </div><div class="yazarblock"><h3>'. strtoupper($harf) .'</h3> ';


				$out .= $yazar;


			}



		}





	}

	$out .= ' </div>';
	echo $out;


}

function _dosya_versiyon_gizle( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_dosya_versiyon_gizle', 15, 1 );
add_filter( 'style_loader_src', '_dosya_versiyon_gizle', 15, 1 );

function neolmustuenerjisen() {

	return '<h3>Ne olmuştu?</h3>
<p>Sabancı’ya bağlı EnerjiSA’nın işlettiği Başkent Elektrik’te çalışan 20’nin üzerinde işçi kasım ayından beri aralıklarla işten çıkarıldı. Şirketin 10 yılın üzerinde çalışan işçilerine işten çıkarma gerekçesi olarak sunduğu gerekçe, yeniden yapılanma sürecinde kendilerine uygun pozisyon olmamasıydı. Ama işçiler işten çıkarılmadan hemen önce fazla mesaiye bırakılmış, afet bölgelerinde görevlendirmeyle çalışmaya gönderilmişti.</p>

<p>İşten çıkarılan işçiler arasında DİSK/Enerji-Sen’in işyeri temsilcileri de yer aldı. Bu işçiler geçtiğimiz temmuz ayında toplu sözleşme sürecinde kendi taleplerini işveren karşısında savunmayan sarı sendika TES-İŞ’e karşı tepkiyi örgütleyen ve sonrasında da DİSK/Enerji-Sen’in EnerjiSA’da örgütlenmesinde öncü rol oynayan işçilerdi. İşyerlerinde ise hâlâ DİSK/Enerji-Sen’e yönelik karalama, DİSK/Enerji-Sen’e üyeliğin işten atma gerekçesi olabileceği yönünde tehditler işveren ve sarı sendika TES-İŞ işbirliğiyle yürütülüyor.</p>

<p>İşten çıkarılan işçilerin 7’si DİSK/Enerji-Sen, geri kalanı ise TES-İŞ üyesi olmasına rağmen TES-İŞ, kendi üyesi işçiler için herhangi bir girişimde bulunmadı.,</p>
<h3>Direnen işçiler ne talep ediyor?</h3>
<p>DİSK/Enerji-Sen işten çıkarılan işçilerle birlikte 28 Mart’ta Başkent Elektrik Genel Müdürlüğü önünde yaptığı eylemde, EnerjiSA’ya 24 saat süre vererek atılan işçilerin geri alınmasını ve işten çıkarmaların durdurulduğuna dair resmi açıklama yapılmasını istedi. EnerjiSA’nın sessiz kalması üzerine işçiler ve sendika yöneticileri Başkent Elektrik Genel Müdürlüğü önünde direnişe başladı.</p>

<p><strong>İletişim ve dayanışma için: +90 531 379 71 50</strong></p>
<h3>Sosyal Medya</h3>
<ul>
 	<li>twitter.com/enerjisen</li>
 	<li>facebook.com/diskenerjisen</li>
 	<li>instagram.com/enerjisendisk</li>
</ul>';

}
add_shortcode( 'neolmustuenerjisen', 'neolmustuenerjisen' );



/* YENİ TEMAYA TAŞI UNUTMA!!!!! */

function cates( $cate_class = 'cate-item' ) {

	global $post;
	if ( $terms = get_the_terms( $post->ID, 'yazarlar' ) ) {

		foreach ( $terms as $term ) {

			$ret = '<div class="bg item-labels"><a href="' . get_term_link( $term ) . '">  ' . $term->name . '</a></div>';


		}

		return $ret;
	} else if ( $terms = get_the_terms( $post->ID, 'icerik-aciklama' ) ) {

		foreach ( $terms as $term ) {

			$ret = '<div class="bg item-labels"><a href="' . get_term_link( $term ) . '">  ' . $term->name . '</a></div>';


		}

		return $ret;
	}


}

add_action( 'rest_api_init', function () {
    // Registers a REST field for the /wp/v2/search endpoint.
    register_rest_field( 'search-result', 'mediaURL', array(
        'get_callback' => function ( $post_arr ) {
            return get_the_post_thumbnail_url( $post_arr['id'],'full' );
        },
    ) );
} );

add_action( 'rest_api_init', function () {
    // Registers a REST field for the /wp/v2/search endpoint.
    register_rest_field( 'search-result', 'postURL', array(
        'get_callback' => function ( $post_arr ) {
            return str_replace('https://panel.sendika.org','',get_the_permalink($post_arr['id']));
        },
    ) );
} );


add_action( 'rest_api_init', function () {
    // Registers a REST field for the /wp/v2/search endpoint.
    register_rest_field( 'search-result', 'date', array(
        'get_callback' => function ( $post_arr ) {
            return get_the_date('Y-m-d H:i:s',$post_arr['id']);
        },
    ) );
} );

add_action( 'rest_api_init', 'mediaURLFN' );
function mediaURLFN() {
	register_rest_field( 'post', 'mediaURL', //New Field Name in JSON RESPONSEs
		array(
			'get_callback'    => 'mediaURLCallbackFN', // custom function name
			'update_callback' => null,
			'schema'          => null,
		) );
}

function mediaURLCallbackFN( $object ) {

	$birincil = get_the_post_thumbnail_url( $object['id'],'full' );

	return $birincil;
}


add_action( 'rest_api_init', 'mediaURLFNFULL' );
function mediaURLFNFULL() {
	register_rest_field( 'post', 'mediaURLFULL', //New Field Name in JSON RESPONSEs
		array(
			'get_callback'    => 'mediaURLCallbackFNFULL', // custom function name
			'update_callback' => null,
			'schema'          => null,
		) );
}

function mediaURLCallbackFNFULL( $object ) {

	$birincil = get_the_post_thumbnail_url( $object['id'],'full' );

	return $birincil;
}


add_action( 'rest_api_init', 'postURLFN' );
function postURLFN() {
	register_rest_field( 'post', 'postURL', //New Field Name in JSON RESPONSEs
		array(
			'get_callback'    => 'postURLFNCallbackFN', // custom function name
			'update_callback' => null,
			'schema'          => null,
		) );
}

function postURLFNCallbackFN( $object ) {

	$birincil = str_replace('https://panel.sendika.org','',get_the_permalink());

	return $birincil;
}


add_action( 'rest_api_init', 'customMetaFN' );
function customMetaFN() {
	register_rest_field( 'post', 'customMeta', //New Field Name in JSON RESPONSEs
		array(
			'get_callback'    => 'customMetaFNCallbackFN', // custom function name
			'update_callback' => null,
			'schema'          => null,
		) );
}

function customMetaFNCallbackFN( $object ) {
	global $post;

	if ( $terms = get_the_terms( $post->ID, 'yazarlar' ) ) {
		return ['id'=>$terms[0]->term_id,'name'=>$terms[0]->name,'slug'=>$terms[0]->slug, 'type'=>'yazarlar'];
	}if ( $terms = get_the_terms( $post->ID, 'cevirmen' ) ) {
		return ['id'=>$terms[0]->term_id,'name'=> 'Çeviri: '.$terms[0]->name,'slug'=>$terms[0]->slug, 'type'=>'cevirmen'];
	} else if ( $terms = get_the_terms( $post->ID, 'icerik-aciklama' ) ) {
		return ['id'=>$terms[0]->term_id,'slug'=>$terms[0]->slug,'name'=>$terms[0]->name,'type'=>'etiket'];
	}
	return false;
}


/*get_the_post_thumbnail_url( $post->ID, 'large' )*/
add_action( 'send_headers', function() {
	if ( ! did_action('rest_api_init') && $_SERVER['REQUEST_METHOD'] == 'HEAD' ) {
		header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Expose-Headers: Link' );
		header( 'Access-Control-Allow-Methods: HEAD' );
	}
} );
