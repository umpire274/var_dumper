<?php

namespace var_dumper\Command;


class VarDumper {
	private static function varexport( $expression, $return = false ): mixed {
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

	public static function udump( $object, $exit = true, $titolo = '', $print = false ): mixed {

		if ( !empty( $titolo ) ) {
			echo '<h1>' . $titolo . '</h1>';
		}
		if ( !$print ) {
			echo '<pre>';
			print_r( $object );
		}
		else {
			return self ::varexport( $object, $print );
		}
		echo '</pre>';
		if ( $exit ) {
			exit();
		}

		return false;
	}

}