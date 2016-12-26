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
			'title' => '用户管理',
			'en_title' => 'user_manage',
			'url' => ['user-manage/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
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
			'title' => '首页轮播图片',
			'en_title' => 'top_adv_position',
			'url' => ['top-advertisement/show-manage-top-adv'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '首页男女装图片',
			'en_title' => 'bg_adv_position',
			'url' => ['bg-advertisement/show-manage-bg-adv'],
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
			'title' => '订单管理',
			'en_title' => 'order_manage',
			'url' => ['order-manage/show-list'],
			'permission' => ['vender'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '搭配管理',
			'en_title' => 'manager_dress_match',
			'url' => ['manager-dress-match/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '搭配管理',
			'en_title' => 'vender_dress_match',
			'url' => ['vender-dress-match/show-list'],
			'permission' => ['vender'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '面料管理',
			'en_title' => 'manager_dress_material',
			'url' => ['manager-dress-material/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '饰件管理',
			'en_title' => 'manager_dress_decoration',
			'url' => ['manager-dress-decoration/show-list'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
		[
			'title' => '设置',
			'en_title' => 'manager_setting',
			'url' => ['setting/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	
			'child' => [],
		],
	],
];
