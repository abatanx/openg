<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2012 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

/**
 * ダミーモジュール
 */
class OGModuleDummyPlug extends OGModule
{
	public function initialize()
	{
	}

	public function finalize()
	{
	}

	public function getName()
	{
		return 'DUMMYPLUG';
	}

	public function getVersion()
	{
		return [1,0,0,0];
	}

	public function getDescription()
	{
		return 'なにも処理を実施しないダミーモジュールです。';
	}
}
