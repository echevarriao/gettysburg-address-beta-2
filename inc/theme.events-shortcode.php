<?php

add_shortcode('display_dept_events', 'display_depts_events_sc');

function display_depts_events_sc($atts, $content = ''){

	$defaults = array('post_type' => 'bme-events', 'order' => 'ASC', 'posts_per_page' => 5);
	$inf = array();
	$depts = null;
	$data = "";
	$obj = array();
	$argv = array();

	$inf = shortcode_atts($defaults, $atts);

	$argv = array(
		'post_type' => $inf['post_type'], 
		'post_status' => array('publish'),
		'posts_per_page' => $inf['posts_per_page'],
		'meta_key' => 'biomedical_engineering_events_date-of-event',
		'orderby' => 'meta_value',
		'order' => $inf['order'],
		'meta_value' => date('Y-m-d'),
		'meta_compare' => '>=',
		);

	$depts = new WP_Query($argv);

	if($depts->have_posts()) {

	$data .= "<div class=\"grid-container\">\n
  <div class=\"grid-x grid-margin-x small-up-2 medium-up-3 large-up-5\">\n";

	while($depts->have_posts()) {

	$depts->the_post();

	$obj['start-time'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_start-time', true);
	$obj['end-time'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_end-time', true);
	$obj['excerpt'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-excerpt', true);
	$obj['desc'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-description', true);
	$obj['location'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_location', true);
	$obj['flyer'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-flyer', true);
	$obj['icon'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-icon', true);
	$obj['date'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_date-of-event', true);

	$data .= "<div class = \"cell\">
	<div class=\"card\">\n
	  <div class=\"card-divider\">\n
    		<h4>" . date("M d", strtotime($obj['date'])) . "</h4>\n
	  </div>\n
	  <div class=\"card-section\">\n
    		<p><strong><a href = \"" . get_the_permalink() . "\">" . get_the_title() . "</a></strong></p>\n
	  </div>\n
	</div>\n
<hr />\n
<p><span class = \"start-time\">" . date("h:i A", strtotime($obj['start-time'])) . "</span></p>\n
</div>\n";

	}

	$data .= "</div>\n
</div>\n";

	} else {

	$data = "<p><b>There are no events available.</b></p>";

	}

	wp_reset_postdata();

	return $data;

}

/**
 * Generated by the WordPress Meta Box Generator
 * https://jeremyhixon.com/tool/wordpress-meta-box-generator/
 * 
 * Retrieving the values:
 * Date of Event = get_post_meta( get_the_ID(), 'biomedical_engineering_events_date-of-event', true )
 * Start Time = get_post_meta( get_the_ID(), 'biomedical_engineering_events_start-time', true )
 * End Time = get_post_meta( get_the_ID(), 'biomedical_engineering_events_end-time', true )
 * Event Excerpt = get_post_meta( get_the_ID(), 'biomedical_engineering_events_event-excerpt', true )
 * Event Description = get_post_meta( get_the_ID(), 'biomedical_engineering_events_event-description', true )
 * Location = get_post_meta( get_the_ID(), 'biomedical_engineering_events_location', true )
 * Event Icon = get_post_meta( get_the_ID(), 'biomedical_engineering_events_event-icon', true )
 * Event Flyer = get_post_meta( get_the_ID(), 'biomedical_engineering_events_event-flyer', true )
 */
class Rational_Meta_Box {
	private $config = '{"title":"Advanced Options","prefix":"biomedical_engineering_events_","domain":"engr_bme","class_name":"Rational_Meta_Box","post-type":["post"],"context":"normal","priority":"default","cpt":"bme-events","fields":[{"type":"date","label":"Date of Event","id":"biomedical_engineering_events_date-of-event"},{"type":"time","label":"Start Time","default":"12:00","id":"biomedical_engineering_events_start-time"},{"type":"time","label":"End Time","default":"12:30","id":"biomedical_engineering_events_end-time"},{"type":"textarea","label":"Event Excerpt","id":"biomedical_engineering_events_event-excerpt"},{"type":"editor","label":"Event Description","wpautop":"1","media-buttons":"1","id":"biomedical_engineering_events_event-description"},{"type":"text","label":"Location","id":"biomedical_engineering_events_location"},{"type":"media","label":"Event Icon","return":"url","id":"biomedical_engineering_events_event-icon"},{"type":"media","label":"Event Flyer","return":"url","id":"biomedical_engineering_events_event-flyer"}]}';

	public function __construct() {
		$this->config = json_decode( $this->config, true );
		$this->process_cpts();
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action( 'admin_head', [ $this, 'admin_head' ] );
		add_action( 'save_post', [ $this, 'save_post' ] );
	}

	public function process_cpts() {
		if ( !empty( $this->config['cpt'] ) ) {
			if ( empty( $this->config['post-type'] ) ) {
				$this->config['post-type'] = [];
			}
			$parts = explode( ',', $this->config['cpt'] );
			$parts = array_map( 'trim', $parts );
			$this->config['post-type'] = array_merge( $this->config['post-type'], $parts );
		}
	}

	public function add_meta_boxes() {
		foreach ( $this->config['post-type'] as $screen ) {
			add_meta_box(
				sanitize_title( $this->config['title'] ),
				$this->config['title'],
				[ $this, 'add_meta_box_callback' ],
				$screen,
				$this->config['context'],
				$this->config['priority']
			);
		}
	}

	public function admin_enqueue_scripts() {
		global $typenow;
		if ( in_array( $typenow, $this->config['post-type'] ) ) {
			wp_enqueue_media();
		}
	}

	public function admin_head() {
		global $typenow;
		if ( in_array( $typenow, $this->config['post-type'] ) ) {
			?><script>
				jQuery.noConflict();
				(function($) {
					$(function() {
						$('body').on('click', '.rwp-media-toggle', function(e) {
							e.preventDefault();
							let button = $(this);
							let rwpMediaUploader = null;
							rwpMediaUploader = wp.media({
								title: button.data('modal-title'),
								button: {
									text: button.data('modal-button')
								},
								multiple: true
							}).on('select', function() {
								let attachment = rwpMediaUploader.state().get('selection').first().toJSON();
								button.prev().val(attachment[button.data('return')]);
							}).open();
						});
					});
				})(jQuery);
			</script><?php
		}
	}

	public function save_post( $post_id ) {
		foreach ( $this->config['fields'] as $field ) {
			switch ( $field['type'] ) {
				case 'editor':
					if ( isset( $_POST[ $field['id'] ] ) ) {
						$sanitized = wp_filter_post_kses( $_POST[ $field['id'] ] );
						update_post_meta( $post_id, $field['id'], $sanitized );
					}
					break;
				default:
					if ( isset( $_POST[ $field['id'] ] ) ) {
						$sanitized = sanitize_text_field( $_POST[ $field['id'] ] );
						update_post_meta( $post_id, $field['id'], $sanitized );
					}
			}
		}
	}

	public function add_meta_box_callback() {
		$this->fields_table();
	}

	private function fields_table() {
		?><table class="form-table" role="presentation">
			<tbody><?php
				foreach ( $this->config['fields'] as $field ) {
					?><tr>
						<th scope="row"><?php $this->label( $field ); ?></th>
						<td><?php $this->field( $field ); ?></td>
					</tr><?php
				}
			?></tbody>
		</table><?php
	}

	private function label( $field ) {
		switch ( $field['type'] ) {
			case 'editor':
				echo '<div class="">' . $field['label'] . '</div>';
				break;
			case 'media':
				printf(
					'<label class="" for="%s_button">%s</label>',
					$field['id'], $field['label']
				);
				break;
			default:
				printf(
					'<label class="" for="%s">%s</label>',
					$field['id'], $field['label']
				);
		}
	}

	private function field( $field ) {
		switch ( $field['type'] ) {
			case 'date':
			case 'time':
				$this->input_minmax( $field );
				break;
			case 'editor':
				$this->editor( $field );
				break;
			case 'media':
				$this->input( $field );
				$this->media_button( $field );
				break;
			case 'textarea':
				$this->textarea( $field );
				break;
			default:
				$this->input( $field );
		}
	}

	private function editor( $field ) {
		wp_editor( $this->value( $field ), $field['id'], [
			'wpautop' => isset( $field['wpautop'] ) ? true : false,
			'media_buttons' => isset( $field['media-buttons'] ) ? true : false,
			'textarea_name' => $field['id'],
			'textarea_rows' => isset( $field['rows'] ) ? isset( $field['rows'] ) : 20,
			'teeny' => isset( $field['teeny'] ) ? true : false
		] );
	}

	private function input( $field ) {
		if ( $field['type'] === 'media' ) {
			$field['type'] = 'text';
		}
		printf(
			'<input class="regular-text %s" id="%s" name="%s" %s type="%s" value="%s">',
			isset( $field['class'] ) ? $field['class'] : '',
			$field['id'], $field['id'],
			isset( $field['pattern'] ) ? "pattern='{$field['pattern']}'" : '',
			$field['type'],
			$this->value( $field )
		);
	}

	private function input_minmax( $field ) {
		printf(
			'<input class="regular-text" id="%s" %s %s name="%s" %s type="%s" value="%s">',
			$field['id'],
			isset( $field['max'] ) ? "max='{$field['max']}'" : '',
			isset( $field['min'] ) ? "min='{$field['min']}'" : '',
			$field['id'],
			isset( $field['step'] ) ? "step='{$field['step']}'" : '',
			$field['type'],
			$this->value( $field )
		);
	}

	private function media_button( $field ) {
		printf(
			' <button class="button rwp-media-toggle" data-modal-button="%s" data-modal-title="%s" data-return="%s" id="%s_button" name="%s_button" type="button">%s</button>',
			isset( $field['modal-button'] ) ? $field['modal-button'] : __( 'Select this file', 'engr_bme' ),
			isset( $field['modal-title'] ) ? $field['modal-title'] : __( 'Choose a file', 'engr_bme' ),
			$field['return'],
			$field['id'], $field['id'],
			isset( $field['button-text'] ) ? $field['button-text'] : __( 'Upload', 'engr_bme' )
		);
	}

	private function textarea( $field ) {
		printf(
			'<textarea class="regular-text" id="%s" name="%s" rows="%d">%s</textarea>',
			$field['id'], $field['id'],
			isset( $field['rows'] ) ? $field['rows'] : 5,
			$this->value( $field )
		);
	}

	private function value( $field ) {
		global $post;
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$value = get_post_meta( $post->ID, $field['id'], true );
		} else if ( isset( $field['default'] ) ) {
			$value = $field['default'];
		} else {
			return '';
		}
		return str_replace( '\u0027', "'", $value );
	}

}
new Rational_Meta_Box;
