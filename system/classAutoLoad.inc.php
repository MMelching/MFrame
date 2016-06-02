<?php
/**
 * Created by PhpStorm.
 * User: Melching
 * Date: 02.06.2016
 * Time: 19:05
 */


/**
 * Local file "Message - Handling" outside the message - class
 *
 * @param $getCaseNum
 * @param string $addArg
 */
function mySimpleoutAndExit($getCaseNum, $addArg = '')
{

	header('Content-Type: text/html; charset=Utf-8');
	print ("<pre>");

	$message = "CORE SYSTEM ERROR!<br>Type: Crititcal<br>Instant exit: yes<br>Details:<br>";

	switch ($getCaseNum) {
		case 1:
			$message .= "Unable to load the requested file (file not exists)! File/Class: '" . $addArg . "'!";
			break;
		default:
			$message .= "Unknown error for file/class: " . $addArg . "'!";
	}

	print($message);
	print ("</pre>");
	exit;

}   // END function mySimpleout(...)



/**
 * Function replaces slash with backslash
 *
 * @param $param
 *
 * @return mixed
 */
function revertSlashes($param)
{

	return str_replace("\\", '/', $param);

}   // END function revertSlashes($getContent)



/**
 * Check if a class-path includes "classes" ... returns true/false
 *
 * @param $class
 *
 * @return bool
 */
function checkDirForClasses($class)
{

	if (!preg_match('/classes\/(.+)/', $class, $matches))
		return false;

	return true;

}    // END function checkForClassesDir(...)



/**
 *
 * PHP libary function: "Auto-Loader"
 *
 */
spl_autoload_register(

	function ($class) {

		$class = revertSlashes($class);
		$class .= '.php';

		if (!checkDirForClasses($class))
			$fullPath = 'classes/' . $class;
		else
			$fullPath = '' . $class;


		// Class - File exists? ... load/include the class file
		if (file_exists($fullPath))
			include ("$fullPath");
		else {
			mySimpleoutAndExit(1, $fullPath);
		}

	}

);
