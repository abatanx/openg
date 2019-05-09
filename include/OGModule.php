<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2012 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

/**
 * モジュール抽象クラス
 */
abstract class OGModule
{
	public $dir, $url;

	abstract function initialize();

	abstract function finalize();

	abstract function getName();

	abstract function getVersion();

	abstract function getDescription();

	public function __call( $name, $args )
	{
	}

	public static function __callStatic( $name, $args )
	{
	}

	public function __construct()
	{
		$this->dir = "";
		$this->url = "";
	}

	public function useIMCInterface()
	{
		require_once( $this->dir . '/_interface.php' );
	}
}

