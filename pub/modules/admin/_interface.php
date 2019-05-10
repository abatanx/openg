<?php
/**
 *  $Id: _module.php 312 2010-08-30 08:18:01Z svn $
 *  Copyright (C) 2004-2008 open-gorotto project., all rights reserved.
 *  @abstract 管理メニュー用IMC
 */

class OPENGIMCAdmin extends OPENGIMCInterface
{
	public $usercd, $serviceid, $id;
	public function add($title,$url)
	{
		$this->results[] = array("title"=>$title, "url"=>$url);
	}
}
