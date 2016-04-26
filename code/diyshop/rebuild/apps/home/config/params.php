<?php
return [
	'menu_config' => [
		[
			'title' => '一级菜单',
			'en_title' => 'aaaa',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	//菜单的图标,参照 http://fontawesome.io/icons/ 图标右边的名字写到这里即可,大部分可用
			'child' => [
				[
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
				],
			],
		],
		[
			'title' => '一级菜单',
			'en_title' => 'bbbb',
			'url' => ['site/index'],
			'permission' => ['manager'],
			'icon_class' => 'star',	//菜单的图标,参照 http://fontawesome.io/icons/ 图标右边的名字写到这里即可,大部分可用
			'child' => [
				[
					'title' => '二级菜单',
					'en_title' => 'eeee',
					'url' => ['site/index'],
					'permission' => ['manager', 'verder'],
					'icon_class' => 'star-o',
				],
				[
					'title' => '二级菜单',
					'en_title' => 'ffff',
					'url' => ['manager/index'],
					'permission' => ['manager'],
					'icon_class' => 'star-o',
				],
			],
		],
	]
];
