<?php
return [
	'menu_config' => [
		[
			'title' => '商家管理',
			'en_title' => 'vender_manage',
			'url' => ['vender-manage/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	//菜单的图标,参照 http://fontawesome.io/icons/ 图标右边的名字写到这里即可,大部分可用
			'child' => [
				/*[
					'title' => '二级菜单',
					'en_title' => 'dddd',
					'url' => ['site/index'],
					'permission' => ['manager', 'verder'],
					'icon_class' => 'star-o',
				],
				[
					'title' => '二级菜单',
					'en_title' => 'cccc',
					'url' => ['site/index'],
					'permission' => ['manager'],
					'icon_class' => 'star-o',
				],*/
			],
		],
		[
			'title' => '服饰分类',
			'en_title' => 'dress_catalog',
			'url' => ['dress-catalog/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '广告位',
			'en_title' => 'adv_position',
			'url' => ['advertisement/show-manage-advertisement'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '猜你喜欢',
			'en_title' => 'guess_like',
			'url' => ['guess-like/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '优惠活动',
			'en_title' => 'discount_activity',
			'url' => ['discount-activity/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '投票',
			'en_title' => 'vote',
			'url' => ['vote/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '商店设置',
			'en_title' => 'vender_shop_setting',
			'url' => ['vender-shop/show-setting'],
			'permission' => ['vender'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '服饰管理',
			'en_title' => 'dress_manage',
			'url' => ['dress-manage/show-list'],
			'permission' => ['vender'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '搭配',
			'en_title' => 'dress_match',
			'url' => ['site/index'],
			'permission' => ['manager', 'vender'],
			'icon_class' => 'star',	
			'child' => [],
		],
	],
];
