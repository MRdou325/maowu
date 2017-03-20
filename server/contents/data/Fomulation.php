<?php
/**
 * 游戏配置信息 lizhien 20130603
 */
$Fomulation = array(
	// 新手引导
	"Tutorial" => array(
		"Leader" => array(
			10001 => array(
				"UnitId" => 10001, 
				"Sex" => 0, 
				"Tutorial" => 1,
			),
			10002 => array(
				"UnitId" => 10002, 
				"Sex" => 1, 
				"Tutorial" => 1,
			),
			10003 => array(
				"UnitId" => 10003, 
				"Sex" => 0, 
				"Tutorial" => 0,
			),
			10004 => array(
				"UnitId" => 10004, 
				"Sex" => 1, 
				"Tutorial" => 0,
			),
			10005 => array(
				"UnitId" => 10005, 
				"Sex" => 0, 
				"Tutorial" => 0,
			),
			10006 => array(
				"UnitId" => 10006, 
				"Sex" => 1, 
				"Tutorial" => 0,
			)
		), 
		"LeaderUnit" => array(		//默认武将卡片ID
			array(
				"UnitId" => 31002, 
				"SkillLevel" => "1,1,1,1",
			),
		)
	), 
	
	// 注册奖励
	"Register" => array(
		"Move" => 200, 
		"Brave" => 0, 			// 友情值
		"Wish" => 0,			// 祈愿值
		"Money" => 250000, 		// 银币
		"Stone" => 0, 			// Vip等级计算
		"Energy" => 100, 		// 体力
		"Vigor" => 20, 			// 精力
		"Cost" => 13, 			// 领导力
		"FriendMax" => 20, 		// 最大好友数量
		"UnitMax" => 10, 		// 最大卡片数量
		"UnitPieceMax" => 100,	// 最大卡片碎片数量
		"EquipMax" => 30,		// 最大装备数量
		"UsedEquipMax" => 50, 	// 最大已穿戴装备数量
		"EquipPieceMax" => 100, 	// 最大装备碎片数量
		"ItemMax" => 100, 		// 最大道具数量
		"GachaTicket" => 1, 	// 免费抽卡次数
		"BreakItem" => 40, 		//
		"Bond" => 5, 			//
		"Score" => 0, 			// 声望
		"Honor" => 0, 			// 荣誉
		"Medal" => 0, 			// 威信
		"Savvy" => 0, 			// 悟性
		"Consecrate" => 0, 		// 功勋
		"Exploits" => 0, 		// 战功
		"LegionLevel" => 1, 	// 军团等级
		"LegionExp" => 0, 		// 军团经验
		
		"FirstTitle" => 1000, 	
		"SecondTitle" => 2000, 
		
		"GetFirstExp" => 100, 
		"GetSecondExp" => 200, 
		"GetThirdExp" => 300, 
		"Gift" => array(		// 注册赠送礼包
			array(											// 可以设置多个礼包对应不同平台
				"StartTime" => '2015-12-29 00:00:00',		// 开始日期
				"EndTime" => '2016-01-05 00:00:00',			// 结束日期
				"RewardType" => 6,							// 奖励类型	6：注册奖励		41：跳票补偿
				"Platform" => array(16, 20),				// 平台ID
				"Item" => array(
					array(
						"Type" => "Card", 
						"ItemId" => 31001, //吕布
						"Amount" => 1
					),
				),
			),
			array(											
				"RewardType" => 41,
				"Platform" => array(16, 20),
				"Item" => array(
					array(
						"Type" => "Item", 
						"ItemId" => 1000, //元宝
						"Amount" => 2000
					),
				),
			),
		),
		
		"Item" => array(		// 奖励道具，卡片和装备
			array(
				"Type" => "Item", 
				"ItemId" => 4001, //将魂
				"Amount" => 100 
			), 
			array(
				"Type" => "Item", 
				"ItemId" => 1000, //金币
				"Amount" => 100 
			),
			array(
				"Type" => "Item", 
				"ItemId" => 5018, //武将碎片
				"Amount" => 15
			),  
			array(
				"Type" => "Item", 
				"ItemId" => 9003, //初级经验卡
				"Amount" => 1 
			), 
			array(
				"Type" => "Item", 
				"ItemId" => 4015, //初级宗师秘笈
				"Amount" => 5 
			), 
			array(
				"Type" => "Item", 
				"ItemId" => 3001, //招募令
				"Amount" => 3 
			), 
			array(
				"Type" => "Item", 
				"ItemId" => 4103, //
				"Amount" => 5 
			), 
			array(
				"Type" => "Item", 
				"ItemId" => 4106, 
				"Amount" => 10 
			), 
			array(
				"Type" => "Equip", 
				"ItemId" => 6211, 
				"Amount" => 1 
			), 
			array(
				"Type" => "Equip", 
				"ItemId" => 6110, 
				"Amount" => 1 
			), 
			array(
				"Type" => "Equip", 
				"ItemId" => 6110, 
				"Amount" => 1 
			), 
			array(
				"Type" => "Equip", 
				"ItemId" => 6117, 
				"Amount" => 1 
			), 
			array(
				"Type" => "Equip", 
				"ItemId" => 6117, 
				"Amount" => 1 
			), 
			array(
				"Type" => "Equip", 
				"ItemId" => 6214, 
				"Amount" => 1 
			), 
		) 
	), 
	
	// 对战配置
	"Battle" => array(
		"WinScore" => 1000, 
		"WinMoney" => 1000, 
		"WinBrave" => 100, 
		"LoseScore" => 10, 
		"LoseMoney" => 100, 
		"LoseBrave" => 20, 
		"Exploits" => 50,
		"WinScoreMaxBattleLevel" => 2000, 
		"WinMoneyMaxBattleLevel" => 10000, 
		"WinBraveMaxBattleLevel" => 100, 
		"WinRewards" => array(
			array(
				"ItemId" => "8001", 
				"Type" => "Item", 
				"Amount" => "1000" 
			), 
			array(
				"ItemId" => "7001", 
				"Type" => "Item", 
				"Amount" => "100" 
			) 
		), 
		"CreateBattleTeam5V5Stone" => 200,
		"MaxBattleTeam5V5Limit" => 5, 
		"MaxBattleLevel" => 1000, 
		"BattleFreeLimit" => 5, 
		"BattleVipFreeLimit" => 5, 
		"BattlePVPFreeLimit" => 5, 
		"BattlePVPVipFreeLimit" => 5, 
		"BattleFightLimit" => 10, 
		"BattlePieceLimit" => 3, 
		"BattlePieceAllLimit" => 10, 
		"BattleFriendFightLimit" => 12, 
		"BattlePVPLimit" => 50, 
		"BattlePVPTime" => "22:00:00", 
		"BattleTeam5V5Time" => "10:00:00", 
		"BattleFightReward" => "4,7,10" 
	), 
	
	// 友情扭蛋
	"FreeGacha" => array(
		"UsePoint" => 280, 
		"UsePointRate" => 0.92857,  // 十连扭折扣
		"GoldWaitHours" => 72, // 金币扭蛋免费时间间隔，单位小时
		"WaitHours" => 5, // 友情扭蛋免费时间间隔，单位分钟
		"FreeGachaNum" => 3, // 每天免费招募令次数
		"GodUnit" => 460, // 神将抽卡元宝
		"GodUnitHours" => 72, // 神将免费抽卡时间间隔，单位小时
		"GodUnitLevel" => 25, // 25级后开启神将
		"GodUnitVip" => 4, // Vip4直接开启神将
	),
	
	// 鼓励
	"Brave" => array(
		"NewComer" => 60 * 60 * 24 * 14, 
		"PostWait" => "23:59:59", 
		"PostMax" => 200, 
		"AddEnergy" => 1, 
		"AddVigor" => 1, 
		"Point" => array(
			"Other" => 5, 
			"Friend" => 10, 
			"Newcomer" => 5 
		) 
	), 
	
	// 上限设定
	"Limit" => array(
		"EnergyMax" => 100,  //体力上限
		"VigorMax" => 20,	//精力恢复上限
		"FriendVigorMax" => 20,	//每天接受好友赠送精力上限
		"LevelMax" => 200,  // 等级上限
		"FriendMax" => 25,  // 好友上限
		"CostMax" => 400,  // 召唤值上限
		"CardRareMax" => 6,  // 卡片稀有度上限
		"EquipLevelMax" => 200,  // 装备等级上限
		"EquipRareMax" => 6,  // 装备稀有度上限
		"EquipBreak" => 20,  // 装备进阶上限
		"EquipMax" => 400,  // 装备上限
		"FriendMaxRate" => 1,  // 升级好友上限增加数
		"UnitMaxRate" => 1,  // 升级卡片上线增加数
		"CostRate" => 1,  // 升级召唤值增加数
		"MoneyMax" => 1000000000,  // 金币上限
		"BraveMax" => 10000000,  // 友情点上限
		"BondMax" => 1000000,  // 协作值上限
		"ItemMax" => 10000000,  // 默认道具上限
		"UnitMax" => 400,  // 卡包上限
		"LevelBreak" => 25,  // 进阶上限
		"TutorialFirst" => 9,  // 新手引导初步完成
		"TutorialMax" => 15 // 新手引导全部完成
	), 
	
	// 每日重置时间
	"Reset" => array(
		"Time" => "00:00:00", 
		"Stime" => "00:00:00", 
		"Ltime" => "23:59:59" 
	), 
	
	// 声望排行榜第一期开始时间
	"Ranking" => array(
		"Time" => "2014-11-10 00:00:00", 
		"WeekTime" => "604800", 
		"StarYear" => "2014", 
		"StarMonth" => "11" 
	), 
	
	// 交易设定
	"Trade" => array(
		"LimitTime" => 24 * 3 * 60 * 60 
	), 
	
	// 卡片扩充
	"BuyBag" => array(
		"UnitStone" => 50,
		"UnitAddNum" => 5,
		"EquipStone" => 50,
		"EquipAddNum" => 5,
	),
	
	// VIP设定
	"Vip" => array(
		1 => 60, 
		2 => 300, 
		3 => 1000, 
		4 => 2000, 
		5 => 5000, 
		6 => 10000, 
		7 => 20000, 
		8 => 50000, 
		9 => 100000, 
		10 => 200000, 
		11 => 500000,
		12 => 800000,
		13 => 1200000,
		14 => 2000000,
	), 
	"SkipLv" => 30,	//跳过战斗等级
	"SkipStar" => 3,	//跳过战斗需要星星数
	"RaidBoss" => array(
		"StartTime" => "2014-11-03 12:00:00", 
		"SpaceTime" => 60 * 60 * 24 * 7, 
		"DiscoverCountMax" => 10, 
		"BattleFreeTimes" => 100, 
		"BossLevelLimit" => 200, 
		"BattleLosePoint" => 10 
	), 
	
	"Legion" => array(
		"CreateLevel" => 16, 		// 创建军团等级
		"CreateStone" => 500, 		// 创建军团所需元宝
		"CreateMaxNum" => 10,		// 军团初始人员上限
		"ImpeachRate" => 50,		// 弹劾人数百分比
		"KickOutMaxNum" => 5,		// 每天踢人上线
	),
	
	// 金币抽卡100%中
	"Gacha" => array(
		0 => 23006,			// 第一次抽卡 => 卡片ID
	), 
	
	// 挑战次数购买配置
	"BuyNum" => array(
		0 => 50,
		1 => 100, 
		2 => 200,
		3 => 300,
		4 => 400,
		5 => 500,
		6 => 600,
		7 => 700,
		8 => 800,
		9 => 900,
		10 => 1000,
	),
	
	"ChangeName" => 100,		// 更改名字
);

?>