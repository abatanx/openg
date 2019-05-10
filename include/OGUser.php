<?php

class OGUser
{
	const
		U_PLAIN=0, U_SAN=1, U_SAN_FORCE=2 ,		// さん付け
		UCD_GUEST      = 0  ,
		UCD_SYSTEM     = 1  ,
		UCD_WITHDRAWAL = 9  ,
		UCD_ADMIN      = 10 ;

	protected $usercd;
	private $cache;

	public function __construct($usercd=null)
	{
		if(!is_null($usercd)) $this->setUsercd($usercd);
	}

	public function getUsercd(){ return $this->usercd; }

	public function setUsercd($usercd)
	{
		$this->usercd = $usercd;
		$this->cache  = _QQ("SELECT * FROM base_normal WHERE usercd=%s;", _N($this->usercd));
	}

	public function isExists()
	{
		return ($this->cache!=false);
	}

	public function getHandle($u_san=self::U_SAN)
	{
		if(!$this->cache) return "(退会)";
		switch($u_san)
		{
			case self::U_PLAIN:		return $this->cache["handle"];
			case self::U_SAN:		return OGTools::handle($this->usercd, $this->cache["handle"]);
			case self::U_SAN_FORCE:	return $this->cache["handle"]."さん";
		}
	}

	public function getName()  { return (!$this->cache) ? false : $this->cache["name"];  }
	public function getBirth() { return (!$this->cache) ? false : $this->cache["birth"]; }
	public function getSex()   { return (!$this->cache) ? false : $this->cache["sex"];   }
	public function getEmail() { return (!$this->cache) ? false : $this->cache["email"]; }
	public function getImail() { return (!$this->cache) ? false : $this->cache["imail"]; }
	public function getURL()   { return "/member/?u=".$this->getUsercd(); }
	public function getSecurityLevel() { return (!$this->cache) ? 0 : $this->cache["security"]; }
	public function getPassword() { return (!$this->cache) ? false : $this->cache["password"]; }
	public function isAdmin()  { return ($this->getSecurityLevel()>=50); }
	public function isMember() { return ($this->getSecurityLevel()>=10); }
	public function isGuest()  { return ($this->getSecurityLevel()==0);  }
	public function isMyself() { return ($this->getUsercd()==wg_get_usercd()); }

	public function getGrpcdFriends()
	{
		list($grpcd) = _QQ("SELECT grpcd FROM grpbase WHERE grptype=%d AND usercd=%s;",
			OGCore::GRPTYPE_FRIENDS, $this->usercd);
		if(is_null($grpcd)) wg_errorlog("OGUser->getGrpcdFriends, {$this->usercd} has no friends group.");
		return $grpcd;
	}

	public function getFriends()
	{
		$u = array();
		_Q("SELECT membercd FROM grpmember_friends WHERE usercd=%s;", $this->usercd);
		while($f=_F()) $u[]=$f["membercd"];
		return $u;
	}

	public function isFriend(OGUser $rel)
	{
		$f = _Q("SELECT true FROM grpmember WHERE grpcd=%s AND usercd=%s AND enable=true;",
			_N($this->getGrpcdFriends()), $rel->usercd);
		return ($f!=0);
	}

	public function isFriendFriend(OGUser $rel)
	{
		$f = _Q("SELECT true FROM grpmember_friends2hop WHERE grpcd=%s AND membercd=%s;",
			_N($this->getGrpcdFriends()), $rel->usercd);
		return ($f!=0);
	}

	public function image($size="face",$style="",$class="face")
	{
		$im = new OGResourceFace($this->usercd,array("size"=>$size));
		$iu = $im->getImageLocation();
		$hh = sprintf(
			'<img class="%s" src="%s" alt="%s" border="0" style="%s">',
			htmlspecialchars($class),
			htmlspecialchars($iu), htmlspecialchars($this->getHandle(self::U_SAN)), $style);
		return $hh;
	}

	public function imageMarkFriend(OGUser $rel,$style="")
	{
		if($this->isFriend($rel))
			return sprintf('<img src="/icons/mark_f.png" border="0" alt="友達" style="%s">', $style);
		else if($this->isFriendFriend($rel))
			return sprintf('<img src="/icons/mark_ff.png" border="0" alt="友達の友達" style="%s">', $style);
		else return "";
	}

	public function href() { return "/member/?u=".$this->usercd; }

	public function getJoinCircles()
	{
		_Q("SELECT grpcd FROM grpbase_circles ".
			"WHERE grpcd IN (SELECT grpcd FROM grpmember WHERE usercd=%s AND enable=true);",
			_N($this->usercd));
		return _FARRAY("grpcd");
	}
}
