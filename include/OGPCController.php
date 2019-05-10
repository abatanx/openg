<?php
/**
 * PC Controller for application.
 */

require_once(WGCONF_DIR_FRAMEWORK_CONTROLLER."/WGFPCController.php");

class OGPCController extends WGFPCController
{
	use OGCoreController;

	public function __construct()
	{
		parent::__construct();
		$this->appCanvas->setTemplate(OGCONF_DIR_TPL . '/pcroot.html');

		$this->initOG();
	}
}
