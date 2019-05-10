<?php
/**
 * JSON Controller for application.
 */

require_once(WGCONF_DIR_FRAMEWORK_CONTROLLER."/WGFJSONController.php");

class OGJSONController extends WGFJSONController
{
	use OGCoreController;

	public function __construct()
	{
		parent::__construct();
		$this->initOG();
	}
}
