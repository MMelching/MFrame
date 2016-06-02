<?php
/**
 * Created by PhpStorm.
 * User: Melching
 * Date: 02.06.2016
 * Time: 17:51
 */

namespace classes\core;

use mysqli;

abstract class CMySQLi extends CQuery
{

	// Init Class Variable
	private $lastResult = '';       // MySQLi last query result
	private $lastInsertID = 0;      // MySQLi last db insert id

	// Init Default DB - Varibble
	private $DBHOST = '';        // Database Host (Default: localhost ?)
	private $DBNAME = '';        // Database Name (Default:  ?)
	private $DBUSER = '';        // Database User (Default: root ?)
	private $DBPASSWORD = '';    // Database Password (Default:  ?)






	// Class Construct
	function __construct()
	{

		parent::__construct();

	}   // END function __construct()

}   // abstract class CMySQLi extends CQuery