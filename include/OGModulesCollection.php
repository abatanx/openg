<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2012 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

/**
 * モジュールコレクション
 */
class OGModulesCollection
{
	const
		MT_PC = 0,
		MT_MOBILE = 1;

	private $loaded, $module_type;

	function __construct( $module_type = self::MT_PC )
	{
		$this->loaded      = array();
		$this->module_type = $module_type;
	}

	public function isExists( $modname )
	{
		return ( $this->loaded[ $modname ] instanceof OPENGModule );
	}

	public function add( OGModule $instmodule )
	{
		$modname                  = $instmodule->getName();
		$this->loaded[ $modname ] = $instmodule;
		$instmodule->initialize();
	}

	public function delete( $modname )
	{
		if ( ! $this->isExists( $modname ) )
		{
			return;
		}
		$this->loaded[ $modname ]->finalize();
		unset( $this->loaded[ $modname ] );
	}

	public function get( $modname )
	{
		if ( ! $this->isExists( $modname ) )
		{
			return new OGModuleDummyPlug();
		}

		return $this->loaded[ $modname ];
	}

	public function call()
	{
		$r = array();
		$a = func_get_args();
		$m = array_shift( $a );
		$l = $this->loaded;
		foreach ( $l as $k => $i )
		{
			if ( method_exists( $i, $m ) )
			{
				$r[ $k ] = call_user_func_array( array( $i, $m ), $a );
			}
		}

		return $r;
	}

	public function scan()
	{
		$modules = array();
		$modurl  = "modules";
		_Q( "SELECT moduledir FROM modules WHERE scan=true AND enable=true ORDER BY ordernum;" );
		while ( $f = _F() )
		{
			$modules[] = $f["moduledir"];
		}
		foreach ( $modules as $module )
		{
			$modclass = WGCONF_DIR_PUB . "/{$modurl}/{$module}/_module.php";

			if ( file_exists( $modclass ) )
			{
				$modinst      = require_once( $modclass );
				$modinst->dir = WGCONF_DIR_PUB . "/{$modurl}/{$module}";
				$modinst->url = "/{$modurl}/{$module}";
				$this->add( $modinst );
			}
		}
	}
}

