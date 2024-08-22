<?php
/**
 * Class File_Contents_Replacer
 *
 * @package boilerplate
 */

/**
 * Handles replacements of strings in files.
 */
class File_String_Replacer {
	/**
	 * Replaces the strings in files.
	 *
	 * @param array  $strings_to_search_for Array of strings to search for.
	 * @param array  $replacement_strings Array of strings to replace the search strings with.
	 * @param array $base_folder_paths Paths to the folder containing the files to replace.
	 */
	public function replace( $strings_to_search_for, $replacement_strings, $base_folder_paths = array( './*' ) ) {
		$file_paths = $this->get_files_to_replace( $strings_to_search_for, $base_folder_paths );

		foreach ( $file_paths as $file_path ) {
			$this->replace_file_contents( $strings_to_search_for, $replacement_strings, $file_path );
		}
	}

	/**
	 * Array of files which contain the strings to search for.
	 *
	 * @param array  $strings_to_search_for Array of strings to search for.
	 * @param string $base_folder_path Path to the folder containing the files to search.
	 * @return array
	 */
	protected function get_files_to_replace( $strings_to_search_for, $base_folder_paths ) {
		return explode(
			PHP_EOL,
			$this->run_command(
				'grep -E -r -l -i "' . implode( '|', $strings_to_search_for ) . '" --exclude-dir=vendor --exclude-dir=core --exclude-dir=node_modules ' . implode( ' ', $base_folder_paths ) . ' | grep -v ' . basename( __FILE__ )
			)
		);
	}

	/**
	 * Replaces the contents of a single file.
	 *
	 * @param array  $strings_to_search_for Array of strings to search for.
	 * @param array  $replacement_strings Array of strings to replace the search strings with.
	 * @param string $file_path Path to the file to replace the contents of.
	 */
	protected function replace_file_contents( $strings_to_search_for, $replacement_strings, $file_path ) {
		$file_contents = file_get_contents( $file_path );

		$new_contents = str_replace( $strings_to_search_for, $replacement_strings, $file_contents );

		file_put_contents( $file_path, $new_contents );
	}

	/**
	 * Runs a command in terminal.
	 *
	 * @param string $command The command to run.
	 * @return string
	 */
	private function run_command( $command ) {
		return trim( (string) shell_exec( $command ) );
	}
}
