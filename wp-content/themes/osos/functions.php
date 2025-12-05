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


		$thumurl = '/wp-content/themes/tekgidais/img/resimyok.jpg';
	} else {

		$thumurl = get_the_post_thumbnail_url( $postid, $size );

	}

	return $thumurl;

}

/*GÖRSEL*/

// hooks your functions into the correct filters
/*function wdm_add_mce_button() {
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'wdm_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'wdm_register_mce_button' );
	}
}*/

//add_action( 'admin_head', 'wdm_add_mce_button' );

// register new button in the editor
//function wdm_register_mce_button( $buttons ) {
//	array_push( $buttons, 'wdm_mce_dropbutton' );
//
//	return $buttons;
//}


// declare a script for the new button
// the script will insert the shortcode on the click event
//function wdm_add_tinymce_plugin( $plugin_array ) {
//	$plugin_array['wdm_mce_dropbutton'] = get_stylesheet_directory_uri() . '/js/wdm-mce-button.js';
//
//	return $plugin_array;
//}


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

			 
			<img style="max-height: 138px;" src="' . $icerik . '" class="img-fluid ' . $post_id . '">
			
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
}


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

/*
add_action( 'wp_nav_menu_item_custom_fields', 'my_menu_item_field' );

function menu_item_desc( $item_id, $item ) {
	$menu_item_desc = get_post_meta( $item_id, '_menu_item_desc', true );
	?>
    <div style="clear: both;">
        <span class="description"><?php _e( "Şube ise 1, İrtibat Bürosu ya da Temsilcilik ise 2 yazınız", 'menu-item-desc' ); ?></span><br/>
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id; ?>"/>
        <div class="logged-input-holder">
            <input type="text" name="menu_item_desc[<?php echo $item_id; ?>]"
                   id="menu-item-desc-<?php echo $item_id; ?>" value="<?php echo esc_attr( $menu_item_desc ); ?>"/>
        </div>
    </div>
	<?php
}

add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_desc', 10, 2 );

function save_menu_item_desc( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST['menu_item_desc'][ $menu_item_db_id ] ) ) {
		$sanitized_data = sanitize_text_field( $_POST['menu_item_desc'][ $menu_item_db_id ] );
		update_post_meta( $menu_item_db_id, '_menu_item_desc', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_desc' );
	}
}

add_action( 'wp_update_nav_menu_item', 'save_menu_item_desc', 10, 2 );
*/
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

function buildTree( array &$elements, $parentId = 0 ) {
    $branch = array();
    foreach ( $elements as &$element ) {
        if ( $element->menu_item_parent == $parentId ) {
            $children = buildTree( $elements, $element->ID );
            if ( $children ) {
                $element->children = $children;
            }

            $branch[ $element->ID ] = $element;
            unset( $element );
        }
    }

    return $branch;
}
