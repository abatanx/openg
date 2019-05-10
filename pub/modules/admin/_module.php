<?php
/**
 * $Id: _module.php 476 2012-06-22 02:02:48Z svn $
 * $HeadURL: svn+ssh://rc3.gorotto.com/home/svn/repository/openg4/open-gorotto/pub/modules/admin/_module.php $
 * @abstract 管理者モジュール
 */

class OGModuleAdmin extends OGModule
{
	public function initialize()
	{
	}

	public function finalize()
	{
	}

	public function getName()
	{
		return "admin";
	}

	public function getDescription()
	{
		return "管理者モジュール";
	}

	public function getVersion()
	{
		return [1,0,0,0];
	}
}

return new OGModuleAdmin();
