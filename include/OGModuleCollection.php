<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2012 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

/**
 * モジュールコレクション
 */
class OPENGModulesCollection
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

	public function add( OPENGModule $instmodule )
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
			return new OPENGModuleDUMMYPLUG();
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
		_Q( "select moduledir from modules where scan=true and enable=true order by ordernum;" );
		while ( $f = _F() )
		{
			$modules[] = $f["moduledir"];
		}
		foreach ( $modules as $module )
		{
			switch ( $this->module_type )
			{
				case self::MT_PC:
					$modclass = WGCONF_DIR_PUB . "/{$modurl}/{$module}/_module.php";
					break;
				case self::MT_MOBILE:
					$modclass = WGCONF_DIR_PUB . "/{$modurl}/{$module}/_i_module.php";
					break;
			}
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

