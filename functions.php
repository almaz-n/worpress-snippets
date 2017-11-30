<!-- сниппеты, которые должны находится в файле functions.php  -->

<!-- 1. кастомная обрезка текста, если не устраивает стадартная excerpt -->
<?php
function custom_field_excerpt($field = '') {
	global $post;
	if ($field != '') { //передаем название поля acf
		$text = get_field($field);
	} else {
		$text = $post->post_content;  //если поле пустое, то текст контент поста
	}
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]&gt;', ']]&gt;', $text);
		$excerpt_length = 48;

		$text = wp_trim_words( $text, $excerpt_length, '<a href="'. get_permalink($post->ID) . '">читать далее</a>' );
	}
	return apply_filters('the_excerpt', $text);
}
?>

<!--
	2. добавление кастомных размеров шрифтов
	в стандартный редактор вордпресс,
	только при использовании плагина tiny_mce
	-->
<?php
add_filter( 'tiny_mce_before_init', 'wpex_mce_google_fonts_array' );
function wpex_mce_google_fonts_array( $initArray ) {
    $initArray['fontsize_formats'] = '8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px';
    return $initArray;
}
?>
