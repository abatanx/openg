<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2012 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

/**
 * モジュール間通信インターフェース
 */
abstract class OGModuleIMC
{
	protected $results;
	protected $module;

	/**
	 * @var OGPCController
	 */
	public $controller;

	public function __construct( $module, $controller = null )
	{
		$this->controller = $controller;
		$this->setSourceModule( $module );
		$this->results = array();
	}

	public function getSourceModule()
	{
		return $this->module;
	}

	public function setSourceModule( $module )
	{
		$this->module = $module;
	}

	public function getResults()
	{
		return $this->results;
	}

	public function communicate( $methodname = null )
	{
		if ( empty( $methodname ) )
		{
			return false;
		}

		return $this->controller->core->modules->call( $methodname, $this );
	}
}
