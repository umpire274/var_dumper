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
	 * @param false $return
	 *
	 * @return array|false|string|string[]|null
	 */
	private static function varexport( $expression, $return = false ) {
		$export = var_export( $expression, true );
		$patterns = [
			"/array \(/" => '[',
			"/\(object\) array\(/" => '(Obj#) [',
			"/^([ ]*)\)(,?)$/m" => '$1]$2',
			"/=>[ ]?\n[ ]+\[/" => '=> [',
			"/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
		];
		$export = preg_replace( array_keys( $patterns ), array_values( $patterns ), $export );
		if ( (bool) $return ) {
			return $export;
		}
		else {
			echo $export;
		}

		return false;
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

		self ::varexport( $object, $print );

		if ( !$print ) {
			echo '</pre>';
		}

		if ( $exit ) {
			exit();
		}

		return false;
	}

}