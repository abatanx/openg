<?php
/**
 * XML Controller for application.
 */

require_once(WGCONF_DIR_FRAMEWORK_CONTROLLER."/WGFXMLController.php");

class OGXMLController extends WGFXMLController
{
	use OGCoreController;

	public function __construct()
	{
		parent::__construct();
		$this->initOG();
	}
}
