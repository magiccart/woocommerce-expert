<?php

class TF_CustomCheck implements themecheck {
	protected $error = array();

	function check( $php_files, $css_files, $other_files) {

		$ret = true;
		$php = implode( ' ', $php_files );

		checkcount();

		if ( ! preg_match( '#add_theme_support\s?\(\s?[\'|"]custom-header#', $php ) ) {
			$this->error[] = __( "<span class='tc-lead tc-recommended'>RECOMMENDED</span>: No reference to <strong>add_theme_support( 'custom-header', \$args )</strong> was found in the theme. It is recommended that the theme implement this functionality if using an image for the header.", "themecheck" );
		}

		if ( ! preg_match( '#add_theme_support\s?\(\s?[\'|"]custom-background#', $php ) ) {
			$this->error[] = __( "<span class='tc-lead tc-recommended'>RECOMMENDED</span>: No reference to <strong>add_theme_support( 'custom-background', \$args )</strong> was found in the theme. If the theme uses background images or solid colors for the background, then it is recommended that the theme implement this functionality.", "themecheck" );
		}

		return $ret;
	}

	function getError() { return $this->error; }
}
$themechecks[] = new TF_CustomCheck;