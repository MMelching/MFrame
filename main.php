<?php
/**
 * Created by PhpStorm.
 * User: Melching
 * Date: 02.06.2016
 * Time: 19:03
 */

// Start Session
session_start();


// Load Class - Autoloader - File
require_once 'system/classAutoLoad.inc.php';



// Init Core - Class - System Object
$hCore = new classes\core\CExtends();




if ($_SESSION['Cfg']['systemConfig']['Debug']['enableDebug'] == 'yes'){
	// IDEBUG pre - tag
	echo "<pre><hr>";
	print_r($hCore->cGlobal);
	echo "<hr></pre><br>";

	// IDEBUG pre - tag
	echo "<pre><hr>";
	print_r($_SESSION);
	echo "<hr></pre><br>";
}



echo "DONE";
