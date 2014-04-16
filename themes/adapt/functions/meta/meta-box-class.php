<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author Rilwis <rilwis@gmail.com>
 * @link http://www.deluxeblogtips.com/p/meta-box-script-for-wordpress.html
 * @example meta-box-usage.php Sample declaration and usage of meta boxes
 * @version: 3.2
 * @license GNU General Public License v3.0
 *
 *
 * HIGHLY Modified by WPExplorer.com
 *
 */
 
/*--------------------------------------*/
/* Begin Meta Class
/*--------------------------------------*/
class adapt_meta_box {

	protected $_meta_box;
	protected $_fields;

	// Create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;

		// Assign meta box values to local variables and add it's missed values
		$this->_meta_box = $meta_box;
		$this->_fields = &$this->_meta_box['fields'];
		$this->add_missed_values();

		add_action('add_meta_boxes', array(&$this, 'add'));	// add meta box, using 'add_meta_boxes' for WP 3.0+
		add_action('save_post', array(&$this, 'save')); // save meta box's data

	}



	/*--------------------------------------*/
	/* Meta Box Page
	/*--------------------------------------*/

	// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}
	
	
	// Callback function to show fields in meta box
	function show() {
		global $post;
	
		wp_nonce_field(basename(__FILE__), 'adapt_meta_box_nonce');
		echo '<table class="form-table">';
	
		foreach ($this->_fields as $field) {
			$meta = get_post_meta($post->ID, $field['id'], !$field['multiple']);
			$meta = ($meta !== '') ? $meta : $field['std'];
	
			$meta = is_array($meta) ? $this->array_map_r('esc_attr', $meta) : esc_attr($meta);
	
			echo '<tr>';
			// call separated methods for displaying each type of field
			call_user_func(array(&$this, 'show_field_' . $field['type']), $field, $meta);
			echo '</tr>';
		}
		echo '</table>';
	}
	

	/*--------------------------------------*/
	/* Meta Box Fields
	/*--------------------------------------*/

	// Code above field
	function show_field_begin($field, $meta) {
		echo "<th class='wpex-label-td'><label class='wpex-label' for='{$field['id']}'>{$field['name']}</label><br /><small>{$field['desc']}</small></th><td class='wpex-field' style='position: relative;'>";
	}

	// Code below field
	function show_field_end($field, $meta) {
		echo "</td>";
	}
	
	// Text
	function show_field_text($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<input type='text' class='wpex-text' name='{$field['id']}' id='{$field['id']}' value='$meta' size='30' /><br />";
		$this->show_field_end($field, $meta);
	}
	
	// Textarea
	function show_field_textarea($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<textarea class='wpex-textarea large-text' name='{$field['id']}' id='{$field['id']}' cols='60' rows='5'>$meta</textarea>";
		$this->show_field_end($field, $meta);
	}
	
	// Select
	function show_field_select($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		$this->show_field_begin($field, $meta);
		echo "<select class='wpex-select' name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
		foreach ($field['options'] as $key => $value) {
			echo "<option value='$value'" . selected(in_array($value, $meta), true, false) . ">$value</option>";
		}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
	}
	
	// Plaintext
	function show_field_plaintext($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "$meta";
		$this->show_field_end($field, $meta);
	}
	
	// Taxonomy
	function show_field_taxonomy($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		echo '<div class="adapt_tax_meta_wrap">';
		$this->show_field_begin($field, $meta);
		
			echo "<select class='wpex-select'name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
			echo "<option value='select_".$field['taxonomy']."_parent'>". __('All','wpex') ."</option>";
					
				//get terms
				$cat_args = array( 'hide_empty' => '1' );
				$cat_terms = get_terms($field['taxonomy'], $cat_args);
		
				foreach ( $cat_terms as $cat_term) {
					echo "<option value='$cat_term->term_id'" . selected(in_array($cat_term->term_id, $meta), true, false) . ">".$cat_term->name."</option>";
				}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
		echo '</div>';
	}

	/*--------------------------------------*/
	/* Save Meta Box
	/*--------------------------------------*/

	// Save data from meta box
	function save($post_id) {
		global $post_type;
		$post_type_object = get_post_type_object($post_type);

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) // check autosave
			|| (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID']) // check revision
			|| (!in_array($post_type, $this->_meta_box['pages'])) // check if current post type is supported
			|| (!check_admin_referer(basename(__FILE__), 'adapt_meta_box_nonce')) // verify nonce
			|| (!current_user_can($post_type_object->cap->edit_post, $post_id))) {	// check permission
				return $post_id;
		}

		// Loop through fields
		foreach ($this->_fields as $field) {
			$name = $field['id'];
			$type = $field['type'];
			$old = get_post_meta($post_id, $name, !$field['multiple']);
			$new = isset($_POST[$name]) ? $_POST[$name] : ($field['multiple'] ? array() : '');

			// Validate meta value
			if (class_exists('adapt_meta_box_Validate') && method_exists('adapt_meta_box_Validate', $field['validate_func'])) {
				$new = call_user_func(array('adapt_meta_box_Validate', $field['validate_func']), $new);
			}

			// Call defined method to save meta value, if there's no methods, call common one
			$save_func = 'save_field_' . $type;
			if (method_exists($this, $save_func)) {
				call_user_func(array(&$this, 'save_field_' . $type), $post_id, $field, $old, $new);
			} else {
				$this->save_field($post_id, $field, $old, $new);
			}
		}
	}

	// Common functions for saving
	function save_field($post_id, $field, $old, $new) {
		$name = $field['id'];
		delete_post_meta($post_id, $name);
		
		if ($new === '' || $new === array()) return;
		
		update_post_meta($post_id, $name, $new);

	}	
	
	
	/*--------------------------------------*/
	/* Helper Functions
	/*--------------------------------------*/

	// Add missed values for meta box
	function add_missed_values() {
		
		// Default values for meta box
		$this->_meta_box = array_merge(array(
			'context' => 'normal',
			'priority' => 'high',
			'pages' => array('post')
		), $this->_meta_box);

		// Default values for fields
		foreach ($this->_fields as &$field) {
			$multiple = in_array($field['type'], array('checkbox_list', 'file', 'image'));
			$std = $multiple ? array() : '';
			$field = array_merge(array(
				'multiple' => $multiple,
				'std' => $std,
				'desc' => '',
				'validate_func' => ''
			), $field);
		}
	}
	
	
} // End class
?>