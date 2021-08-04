<?php

namespace var_dumper\Command;


/**
 * Class VarDumper
 *
 * @package var_dumper\Command
 */
class VarDumper {
	/**
	 * @param       $expression
	 *
	 * @return array|false|string|string[]|null
	 */
	private static function varexport( $expression ) {
		$export = var_export( $expression, true );
		$patterns = [
			"/array \(/" => '[',
			"/\(object\) array\(/" => '(Obj#) [',
			"/^([ ]*)\)(,?)$/m" => '$1]$2',
			"/=>[ ]?\n[ ]+\[/" => '=> [',
			"/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
		];
		$export = preg_replace( array_keys( $patterns ), array_values( $patterns ), $export );

		return $export;
	}

	/**
	 * @param mixed $object
	 * @param false $print
	 * @param bool  $exit
	 *
	 * @return array|false|string|string[]|null
	 */
	public static function udump( $object, bool $print = false, bool $exit = true ) {

		if ( !$print ) {
			echo '<pre>';
		}

		self ::varexport( $object );

		if ( !$print ) {
			echo '</pre>';
		}

		if ( $exit ) {
			exit();
		}

		return false;
	}

}