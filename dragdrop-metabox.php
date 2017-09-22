<?php
/*
|-------------------------------------------------
| Create Drag and Drop custom metabox
|-------------------------------------------------
*/

/**
 * Add a metabox in page
 */
add_action('add_meta_boxes', function(){
    add_meta_box('dragdrop-metabox', 'Drag Drop Meta Box', 'dragdrop_metabox_display_callback', 'page', 'normal', 'low');
});

/**
 * HTML Output of metabox
 */
function dragdrop_metabox_display_callback(){
	include __DIR__ . '/inc/metabox-content.php';
}

/**
 * Sctipt and style
 */
add_action('admin_enqueue_scripts', function($pagename){
	global $typenow;
	if('post.php' == $pagename && $typenow == 'page'){
		wp_enqueue_style('dragdrop-style', get_template_directory_uri() . '/inc/dragdrop/css/style.css', [], null);
		
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('dragdrop-script', get_template_directory_uri() . '/inc/dragdrop/js/scripts.js', [], null, true);
	}
});

/**
 * Fix the order of items
 */
function fixdragdrop_item_order($post_array){
	$makearray = [];
	foreach($post_array as $item_array){
		$key = $item_array['order'];
		$makearray[$key] = $item_array;
	}
	ksort($makearray, SORT_NUMERIC);
	return $makearray;
}// End of fixdragdrop_item_order

/**
 * Save the data
 */
add_action('save_post_page', function($post_id, $post){
	if($post->post_status != 'auto-draft' && $post->post_status != 'trash'){
		if(isset($_POST['test_dragdrop']) && !empty($_POST['test_dragdrop'])){
			$metavalue = fixdragdrop_item_order($_POST['test_dragdrop']);
			update_post_meta($post_id, 'test_dragdrop', $metavalue);
		}else{
			update_post_meta($post_id, 'test_dragdrop', []);
		}
	}
});