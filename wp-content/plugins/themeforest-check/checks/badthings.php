<?php
class TF_Bad_Checks implements themecheck {
	protected $error = array();

	function check( $php_files, $css_files, $other_files ) {
		$ret = true;

		$checks = array(
			'/(?<![_|a-z0-9|\.])eval\s?\(/i' => __( 'eval() is not allowed.', 'themecheck' ),
			'/[^a-z0-9](?<!_)(popen|proc_open|[^_]exec|shell_exec|system|passthru)\(/' => __( 'PHP sytem calls should be disabled by server admins anyway!', 'themecheck' ),
			'/\s?ini_set\(/' => __( 'Themes should not change server PHP settings', 'themecheck' ),
			'/uudecode/ims' => __( 'uudecode() is not allowed', 'themecheck' ),
			'/str_rot13/ims' => __( 'str_rot13() is not allowed', 'themecheck' ),
			'/cx=[0-9]{21}:[a-z0-9]{10}/' => __( 'Google search code detected', 'themecheck' ),
			'/pub-[0-9]{16}/i' => __( 'Googe advertising code detected', 'themecheck' )
			);

		$grep = '';

		foreach ( $php_files as $php_key => $phpfile ) {
			foreach ( $checks as $key => $check ) {
			checkcount();
				if ( preg_match( $key, $phpfile, $matches ) ) {
					$filename = tc_filename( $php_key );
					$error = ltrim( trim( $matches[0], '(' ) );
					$grep = tc_grep( $error, $php_key );
					$this->error[] = sprintf(__('<span class="tc-lead tc-warning">WARNING</span>: Found <strong>%1$s</strong> in the file <strong>%2$s</strong>. %3$s. %4$s', 'themecheck'), $error, $filename, $check, $grep );
					$ret = false;
				}
			}
		}


		$checks = array(
			'/cx=[0-9]{21}:[a-z0-9]{10}/' => __( 'Google search code detected', 'themecheck' ),
			'/pub-[0-9]{16}/' => __( 'Google advertising code detected', 'themecheck' )
			);

		foreach ( $other_files as $php_key => $phpfile ) {
			foreach ( $checks as $key => $check ) {
				checkcount();
				if ( preg_match( $key, $phpfile, $matches ) ) {
					$filename = tc_filename( $php_key );
					$error = ltrim( rtrim( $matches[0],'(' ) );
					$grep = tc_grep( $error, $php_key );
					$this->error[] = sprintf(__('<span class="tc-lead tc-warning">WARNING</span>: Found <strong>%1$s</strong> in the file <strong>%2$s</strong>. %3$s.%4$s', 'themecheck'), $error, $filename, $check, $grep);
					$ret = false;
				}
			}
		}
		return $ret;
	}
	function getError() { return $this->error; }
}
$themechecks[] = new TF_Bad_Checks;
