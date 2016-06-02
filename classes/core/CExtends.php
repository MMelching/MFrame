<?php
/**
 * Created by PhpStorm.
 * User: Melching
 * Date: 02.06.2016
 * Time: 18:19
 */

namespace classes\core;



class CExtends extends CObject
{

	// Init Variable
	public $myDynObj;    // Main Object Handler for the Core - Class - System






	// Class Construct
	function __construct($boolUseGlobalCoreClassObj = true)
	{

		parent::__construct();


		// Use the unique Core Class Object?
		if ($boolUseGlobalCoreClassObj)
			$this->setCGlobalObject();


		// Read all config files (located in /configs directory)
		$this->initReadConfigFiles();


		// DB Connection already established? ... Bool via SESSION!!!
//		if ((!isset($_SESSION['Objects']['DBConnection'])) || (!is_object($_SESSION['Objects']['DBConnection'])))
//			$this->createDBConnection();
//		else
//			$this->getDBConnection();

	}   // END function __construct(...)






	// Method sets the Core Global Object
	private function setCGlobalObject()
	{

		// Load/use the Core Class Object only once
		$this->myDynObj = CObject::getSingleton();

		// Pointer to local cGlobal var
		$this->cGlobal = &$this->myDynObj->cGlobal;

		// Pointer to local cMessages var
		$this->cMessages = &$this->myDynObj->cGlobal;

	}   // END private function getGlobalCoreObject()






	private function initReadConfigFiles()
	{

		// Get Config Files
		$configFilesArray = $this->readConfigDir();

		if (count($configFilesArray) < 1)
			return false;

		// Load all config files
		$this->loadConfigs($configFilesArray);

		return true;

	}    // END private function initReadConfigFiles()






	private function loadConfigs($configFilesArray)
	{

		foreach($configFilesArray as $boolName => $configFile) {
			if ((!isset($this->cGlobal['Bool']['Loaded']['Config'][$boolName])) || ($this->cGlobal['Bool']['Loaded']['Config'][$boolName] != 'yes'))
				$this->initLoadConfig($boolName, $configFile, false);
		}

		return true;

	}    // END private function loadConfigs(...)






	private function getBoolNameFromConfigFile($configFile)
	{

		$search = '/(.+)(.ini)/';
		@preg_match($search, $configFile, $matches);

		// Todo strlen for $matches[1]

		return $matches[1];

	}    // END  private function getBoolNameFromConfigFile(...)






	private function readConfigDir()
	{

		$configFilesArray = array();

		$dirHandle = opendir(CConfig::PRECONFIGPATH);

		while (false !== ($file = readdir($dirHandle))) {

			if (($file != '.') && ($file != '..'))
				$configFilesArray[$this->getBoolNameFromConfigFile($file)] = $file;
		}

		return $configFilesArray;

	}    // END private function readConfigDir()


}   // END class CExtends extends CObject