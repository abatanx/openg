<?php

trait OGCoreController
{
	/**
	 * @var OGCore
	 */
	protected $core;
	protected $user;

	protected function initOG()
	{
		$this->core = new OGCore();
		$this->user = new OGUser( $this->usercd );
	}
}
