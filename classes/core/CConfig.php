<?php
/**
 * Created by PhpStorm.
 * User: Melching
 * Date: 02.06.2016
 * Time: 17:41
 */

namespace classes\core;


abstract class CConfig extends CBase
{

	// Class - Config
	const PRECONFIGPATH = 'configs/';        // Pre-Path to the config files






	// Class Construct
	function __construct()
	{

		parent::__construct();

	}   // END function __construct()






	function initLoadConfig($getBoolName, $getConfigFilename, $boolToSession = false)
	{

		// Read Config File
		if ($this->readConfigFile($getBoolName, $getConfigFilename)) {
			if ($boolToSession)
				$_SESSION['Bool']['Loaded']['Config'][$getBoolName] = 'yes';    // Set Bool - Var via Session load config file = yes
			else
				$this->cGlobal['Bool']['Loaded']['Config'][$getBoolName] = 'yes';    // Set Bool - Var via Class Var load config file = yes
		} else
			exit; // Unknown error

	}






	private function readConfigFile($getBoolName, $getConfigFilename)
	{

		$fullConfigFile = self::PRECONFIGPATH . $getConfigFilename;

		// File exists?
		if (!file_exists($fullConfigFile))
			$this->mySimpleout(1, $fullConfigFile);

		// ini syntax ok?
		if (!$iniArray = @parse_ini_file($fullConfigFile, true))
			$this->mySimpleout(2, $fullConfigFile);

		// Save config - Value in Session
		$this->setConfigValuesToSession($getBoolName, $iniArray);

		return true;

	}






	private function setConfigValuesToSession($getBoolName, $getConfigArray)
	{

		if (isset($_SESSION['Cfg'][$getBoolName]))
			$_SESSION['Cfg'][$getBoolName] = array_merge($_SESSION['Cfg'][$getBoolName], $getConfigArray);
		else
			$_SESSION['Cfg'][$getBoolName] = $getConfigArray;

	}   // END private function setSystemConfig(...)






	// Error Message Handling
	private function mySimpleout($getCaseNum, $addArg = '')
	{

		header('Content-Type: text/html; charset=Utf-8');
		print ("<pre>");

		$message = "CORE SYSTEM ERROR!<br>Type: Crititcal<br>Instant exit: yes<br>Details:<br>";

		switch ($getCaseNum) {
			case 1:
				$message .= "Unable to load the requested config file (file not exists)! File: '" . $addArg . "'!";
				break;
			case 2:
				$message .= "Syntax error in file: '" . $addArg . "'!";
				break;
			default:
				$message .= "Unknown error in config file: " . $addArg;
		}

		print($message);
		print ("</pre>");
		exit;

	}    // END private function mySimpleout(...)


}   // END abstract class CConfig extends CBase
