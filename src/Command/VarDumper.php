<?php

namespace var_dumper\Command;


/**
 * Class VarDumper
 *
 * @package var_dumper\Command
 */
class VarDumper {

	/**
	 * @param       $object
	 *
	 * @return array|string|string[]|null
	 */
	public static function udump( $object ) {

		$export = var_export( $object, true );

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

}