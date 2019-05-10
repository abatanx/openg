<?php

class OGTools
{
	static public function handle($usercd,$handle)
	{
		if( $usercd == wg_get_usercd() ) return $handle;
		return $handle."さん";
	}
}
