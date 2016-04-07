<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_BW_Social_Icons' ) ) :
	/**
	 * Main BW_ReduxFramework_Social_Icons class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_bw_social_icons extends ReduxFramework {
		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value = '', $parent ) {
			//parent::__construct( $parent->sections, $parent->args );
			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;
			$this->enqueue();
		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {
			echo '<div class="redux-social_icons-accordion">';
			$x = 0;
			if ( isset( $this->value ) && is_array( $this->value ) ) :
				$social_iconss = $this->value;
				foreach ( $social_iconss as $social_icons ) {
					if ( empty( $social_icons ) ) : continue; endif;
					$defaults     = array(
						'title'     => '',
						'force_row' => 0,
						'sort'      => '',
						'url'       => '',
						'select'    => array(),
					);
					$social_icons = wp_parse_args( $social_icons, $defaults );
					echo '<div class="redux-social_icons-accordion-group"><fieldset class="redux-field" data-id="' . $this->field['id'] . '"><h3><span class="redux-social_icons-header">' . $social_icons['title'] . '</span></h3><div>';
					echo '<ul id="' . $this->field['id'] . '-ul" class="redux-social_icons-list">';
					echo '<li><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="' . esc_attr( $social_icons['title'] ) . '" placeholder="' . __( 'Label', 'brainwave' ) . '" class="full-text social_icons-title" /></li>';
					echo '<li><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="' . esc_attr( $social_icons['url'] ) . '" class="full-text" placeholder="' . __( 'Link', 'brainwave' ) . '" /></li>';
					echo '<li><input type="hidden" class="social_icons-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $social_icons['sort'] . '" /></li>';
					if ( isset( $this->field['options'] ) && ! empty( $this->field['options'] ) ) :
						$placeholder = ( isset( $this->field['placeholder']['options'] ) ) ? esc_attr( $this->field['placeholder']['options'] ) : __( 'Select an Icon', 'brainwave' );
						if ( isset( $this->field['select2'] ) ) :
							// if there are any let's pass them to js
							$select2_params = json_encode( esc_attr( $this->field['select2'] ) );
							$select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );
							echo '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
						endif;
						echo '<select id="' . $this->field['id'] . '-select" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] . '[' . $x . '][select]" class="font-awesome-icons redux-select-item ' . $this->field['class'] . '" rows="6">';
						echo '<option></option>';
						foreach ( $this->field['options'] as $k => $v ) {
							if ( is_array( $this->value ) ) :
								$selected = $social_icons['select'] == $k ? ' selected="selected"' : '';
							else :
								$selected = selected( $this->value['select'], $k, false );
							endif;
							echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
						}
						echo '</select>';
					endif;
					echo '<li><a href="javascript:void(0);" class="button deletion redux-social_icons-remove">' . __( 'Delete Link', 'brainwave' ) . '</a></li>';
					echo '</ul></div></fieldset></div>';
					$x ++;
				}
			endif;

			if ( $x == 0 ) :
				echo '<div class="redux-social_icons-accordion-group"><fieldset class="redux-field" data-id="' . $this->field['id'] . '"><h3><span class="redux-social_icons-header">New Link</span></h3><div>';
				echo '<ul id="' . $this->field['id'] . '-ul" class="redux-social_icons-list">';
				$placeholder = ( isset( $this->field['placeholder']['title'] ) ) ? esc_attr( $this->field['placeholder']['title'] ) : __( 'Label', 'brainwave' );
				echo '<li><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="" placeholder="' . $placeholder . '" class="full-text social_icons-title" /></li>';
				$placeholder = ( isset( $this->field['placeholder']['url'] ) ) ? esc_attr( $this->field['placeholder']['url'] ) : __( 'Link', 'brainwave' );
				echo '<li><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="" class="full-text" placeholder="' . $placeholder . '" /></li>';
				echo '<li><input type="hidden" class="social_icons-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $x . '" /></li>';
				if ( isset( $this->field['options'] ) && ! empty( $this->field['options'] ) ) :
					$placeholder = ( isset( $this->field['placeholder']['select'] ) ) ? esc_attr( $this->field['placeholder']['select'] ) : __( 'Select an Icon', 'brainwave' );
					if ( isset( $this->field['select2'] ) ) :
						// if there are any let's pass them to js
						$select2_params = json_encode( esc_attr( $this->field['select2'] ) );
						$select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );
						echo '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
					endif;
					echo '<select id="' . $this->field['id'] . '-select" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] . '[' . $x . '][select]" class="font-awesome-icons redux-select-item ' . $this->field['class'] . '" rows="6" style="width:93%;">';
					echo '<option></option>';
					foreach ( $this->field['options'] as $k => $v ) {
						if ( is_array( $this->value ) ) :
							$selected = ( is_array( $this->value ) && in_array( $k, $this->value ) ) ? ' selected="selected"' : '';
						else :
							$selected = selected( $this->value, $k, false );
						endif;
						echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
					}
					echo '</select>';
				endif;
				echo '<li><a href="javascript:void(0);" class="button deletion redux-social_icons-remove">' . __( 'Delete Link', 'brainwave' ) . '</a></li>';
				echo '</ul></div></fieldset></div>';
			endif;
			echo '</div><a href="javascript:void(0);" class="button redux-social_icons-add button-primary" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->field['name'] . '[title][]">' . __( 'Add Link', 'brainwave' ) . '</a><br/>';
		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */

		public function enqueue() {
			wp_enqueue_script( 'redux-field-social_icons-js', get_template_directory_uri() . '/inc/social_icons/social_icons.js',
				array(
					'jquery',
					'jquery-ui-core',
					'jquery-ui-accordion',
					'wp-color-picker'
				), time(), true );
			wp_enqueue_style( 'redux-field-social_icons-css', get_template_directory_uri() . '/inc/social_icons/social_icons.css', time(), true );
		}
	}
endif;
