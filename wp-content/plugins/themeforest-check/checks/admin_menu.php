<?php
class TF_AdminMenu implements themecheck {
	protected $error = array();

	function check( $php_files, $css_files, $other_files) {

		$ret = true;


//check for levels deprecated in 2.0 in creating menus.

		$checks = array(
			'/([^_](add_(admin|submenu|menu|dashboard|posts|media|links|pages|comments|theme|plugins|users|management|options)_page)\s?\([^,]*,[^,]*,\s[\'|"]?(level_[0-9]|[0-9])[^;|\r|\r\n]*)/' => __( 'User levels were deprecated in <strong>2.0</strong>. Please see <a href="http://codex.wordpress.org/Roles_and_Capabilities">Roles_and_Capabilities</a>', 'themecheck' ),
			'/[^a-z0-9](current_user_can\s?\(\s?[\'\"]level_[0-9][\'\"]\s?\))[^\r|\r\n]*/' => __( 'User levels were deprecated in <strong>2.0</strong>. Please see <a href="http://codex.wordpress.org/Roles_and_Capabilities">Roles_and_Capabilities</a>', 'themecheck' )
			);

		foreach ( $php_files as $php_key => $phpfile ) {
			foreach ( $checks as $key => $check ) {
				checkcount();
				if ( preg_match( $key, $phpfile, $matches ) ) {
					$filename = tc_filename( $php_key );
					$grep = ( isset( $matches[2] ) ) ? tc_grep( $matches[2], $php_key ) : tc_grep( $matches[1], $php_key );
					$this->error[] = sprintf(__('<span class="tc-lead tc-warning">WARNING</span>: <strong>%1$s</strong>. %2$s%3$s', 'themecheck'), $filename, $check, $grep );
					$ret = false;
				}
			}
		}

		return $ret;
	}

	function getError() { return $this->error; }
}

$themechecks[] = new TF_AdminMenu;