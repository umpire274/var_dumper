<?php


namespace Command;

use Hamcrest\Util;
use stdClass;
use var_dumper\Command\VarDumper;
use PHPUnit\Framework\TestCase;

class VarDumperTest extends TestCase {

	private $vdump;

	public function setUp(): void {
		parent ::setUp();
		$this -> vdump = new VarDumper();
		Util ::registerGlobalFunctions();
	}

	public function testDump() {

		$myobject = new stdClass();
		$myobject -> myvalue = 'Hello World';
		$myobject -> ar = [
			"ab" => [
				"ab-1" => [
					"ab-1-a" => "a",
					"ab-1-b" => "b",
				],
				"ab-2" => 2,
			],
			"cd" => 'ciao broccoletto fritto',
		];

		$dbg = $this -> vdump -> udump( $myobject );

		print ( $dbg );

		self ::assertNotNull( $dbg );
	}

}