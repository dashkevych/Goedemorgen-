<?php
/**
 * This class adds extra CSS to the theme.
 *
 * @package Goedemorgen
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Goedemorgen_Settings Class.
 *
 * @since 1.0.0
 */
class Goedemorgen_Extra_CSS {
	/**
	 * Class instance.
	 */
	protected static $instance = null;

	/**
	 * Array of custom css.
	 */
	public static $extra_css = array();

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Magic method to keep the object from being cloned.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Magic method to keep the object from being unserialized.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
   	private function __wakeup() {}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Goedemorgen_Extra_CSS ) ) {
			self::$instance = new Goedemorgen_Extra_CSS;
			self::$instance->init();
		}
		return self::$instance;
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected static function init() {
		add_filter( 'goedemorgen_set_extra_css', array( self::instance(), 'set_custom_accent_color' ) );
		add_filter( 'goedemorgen_set_extra_css', array( self::instance(), 'set_body_font_style' ) );
		add_filter( 'goedemorgen_set_extra_css', array( self::instance(), 'set_headings_font_style' ) );
	}

	/**
  	 * Clean extra CSS styles by removing extra spaces and tabs.
  	 *
  	 * @since  1.0.0
  	 * @access protected
  	 * @return string
  	 */
	public function clean_extra_css( $css ) {
		return trim( preg_replace( '/\s+/', ' ', $css ) );
	}

	/**
	 * Change accent color.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function set_custom_accent_color() {
		$theme_colors = goedemorgen_get_setting( 'color' );

		if ( isset( $theme_colors['accent'] ) && '#0161bd' != $theme_colors['accent'] ) {
			$accent_color = "
							a,
							a:visited,
							#masthead .main-navigation ul:not(.sub-menu):not(.children) > li > a:hover,
							.content-area blockquote:not(.pull-left):not(.pull-right):before { color: " . $theme_colors['accent'] . "; }
							";

			$accent_color .= "
							button,
							a.button:not(.secondary-button),
							input[type='button'],
							input[type='reset'],
							input[type='submit'] { background: " . $theme_colors['accent'] . "; }
							";

			$accent_color .= "
							input[type='text']:focus,
							input[type='email']:focus,
							input[type='url']:focus,
							input[type='password']:focus,
							input[type='search']:focus,
							input[type='number']:focus,
							input[type='tel']:focus,
							input[type='range']:focus,
							input[type='date']:focus,
							input[type='month']:focus,
							input[type='week']:focus,
							input[type='time']:focus,
							input[type='datetime']:focus,
							input[type='datetime-local']:focus,
							input[type='color']:focus,
							textarea:focus { border-color: " . $theme_colors['accent'] . "; }
			                ";

			self::$extra_css[] = $accent_color;
		}

		return self::$extra_css;
	}

	/**
	 * Add a custom body font style.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function set_body_font_style() {
 		$custom_font = goedemorgen_get_font_family( 'body' );

 		if ( $custom_font && goedemorgen_get_default_font_family( 'body' ) != $custom_font ) {
 			self::$extra_css[] = "body, button, input, select, textarea { font-family: " . esc_attr( $custom_font ) . "; }";
 		}

 		return self::$extra_css;
 	}

	 /**
 	 * Add a custom headings font style.
 	 *
 	 * @since  1.0.0
 	 * @access public
 	 * @return array
 	 */
	public function set_headings_font_style() {
		$custom_font = goedemorgen_get_font_family( 'headings' );

		if ( $custom_font && goedemorgen_get_default_font_family( 'headings' ) != $custom_font ) {
			self::$extra_css[] = "h1, h2, h3, h4, h5, h6 { font-family: " . esc_attr( $custom_font ) . "; }";
		}

		return self::$extra_css;
	}
}

/**
 * The main function that returns Goedemorgen_Extra_CSS instance.
 *
 * @return object|Goedemorgen_Extra_CSS.
 */
function goedemorgen_extra_css() {
	return Goedemorgen_Extra_CSS::instance();
}

// Get goedemorgen_extra_css running.
goedemorgen_extra_css();
