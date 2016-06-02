<?php
/**
 * Created by PhpStorm.
 * User: Melching
 * Date: 02.06.2016
 * Time: 18:08
 */

namespace classes\core;


class CObject extends CMySQLi
{

	// Init protected object handler (variable)
	protected static $obj = null;






	// Class Construct
	function __construct()
	{

		parent::__construct();

	}   // END function __construct()






	// Protect this class against clone
	protected function __clone()
	{

	}    // END protected function __clone()






	// Method returns the Core Class Object (handle)
	public static function getSingleton()
	{

		// NOTE:
		// Method call via {classname}::getSingleton()
		// Returns the core class object

		if (null === self::$obj)
			self::$obj = new self;

		return self::$obj;

	}   // END public static function getSingleton()


}   // END class CObject extends CMySQLi