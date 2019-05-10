<?php
/**
 * openg social networking package for waggo6
 * @copyright 2001-2012 openg project., 2019 CIEL, K.K.
 * @license MIT
 */

class OGCore
{
	const
		// カテゴリ制御
		CTGTYPE_CATEGORY = 0,			// 親カテゴリ
		CTGTYPE_LINK = 1,				// リンク

		// グループ制御
		GRPTYPE_SYSTEM = 0,
		GRPTYPE_GUEST = 1,				// INCLUDES guest users
		GRPTYPE_ALL = 2,				// INCLUDES all SNS users
		GRPTYPE_ALIEN = 3,				// INCLUDES forien aliens users
		GRPTYPE_MEMBER = 10,			// SOLO member group
		GRPTYPE_FRIENDS = 31,
		GRPTYPE_FRIENDSFRIENDS = 32,
		GRPTYPE_FRIENDSGROUPS = 39,
		GRPTYPE_CIRCLE = 40,

		// グループ制御・拡張
		GRPEXTMODE_PUBLIC = 1,			// 公開サークル
		GRPEXTMODE_SNSMEMBER = 2,		// 会員限定公開サークル
		GRPEXTMODE_GRPMEMBER = 3,		// 参加者限定公開サークル
		GRPEXTMODE_PRIVATE = 9,			// プライベートサークル

		GRPEXTTYPE_NORMAL = 1,			// 通常サークル
		GRPEXTTYPE_RECOGNIZED = 9;		// 公認サークル

	public $modules, $wiki;

	public function __construct()
	{
		$this->modules = new OGModulesCollection( OGModulesCollection::MT_PC );
		$this->modules->scan();
	}
}
