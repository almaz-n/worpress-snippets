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
