<?php
return [
	'menu_config' => [
		[
			'title' => '广告位',
			'en_title' => 'adv_position',
			'url' => ['advertisement/show-manage-advertisement'],
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
			'title' => '猜你喜欢',
			'en_title' => 'guess_like',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '优惠活动',
			'en_title' => 'discount_activity',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '投票',
			'en_title' => 'vote',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '服饰数量',
			'en_title' => 'dress_num',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '搭配',
			'en_title' => 'dress_match',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
	],
	
	'advertisement_catalog_config' => [
		[
			'id' => 1,
			'name' => '主界面',
		],
		[
			'id' => 2,
			'name' => '品牌',
		],
		[
			'id' => 3,
			'name' => '自营',
		],
	],
];
