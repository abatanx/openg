<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2011 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

global $WGCONF_AUTOLOAD;

$WGCONF_AUTOLOAD[] = __DIR__ . '/include';
$WGCONF_AUTOLOAD[] = __DIR__ . '/imc';

define( 'OGCONF_DIR_TPL', realpath( __DIR__ . '/tpl') );
