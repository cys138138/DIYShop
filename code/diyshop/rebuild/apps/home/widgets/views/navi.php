<?php 
use umeworld\lib\Url;
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<a class="navbar-brand">
			<?php if($role == 'manager'){ ?>
				DiyShop后台管理
			<?php }elseif($role == 'vender'){ ?>
				DiyShop商家管理
			<?php } ?>
		</a>
	</div>
	<!-- Top Menu Items -->
	<ul class="nav navbar-right top-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $aUser['name']; ?> <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li>
					<a href="<?php echo $role == 'manager' ? Url::to(['manager/logout']) : Url::to(['vender/logout']); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
				</li>
			</ul>
		</li>
	</ul>
	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav side-nav">
		<?php 
			$controllerId = Yii::$app->controller->id;
			$actionId = Yii::$app->controller->action->id;
			foreach($aMenuConfig as $key => $aValue){
				if(!in_array($role, $aValue['permission'])){
					continue;
				}
				$hasChild = false;
				$isCurrent = false;
				$isChildCurrent = false;
				if($aValue['child']){
					$hasChild = true;
					foreach($aValue['child'] as $k => $aChild){
						if(isset($aChild['url']) && $controllerId . '/' . $actionId == $aChild['url'][0]){
							$isChildCurrent = true;
							break;
						}
					}
				}
				if(isset($aValue['url']) && $controllerId . '/' . $actionId == $aValue['url'][0]){
					$isCurrent = true;
				}
				$cls = '';
				if($isChildCurrent){
					$cls = 'collapsed in';
				}
		?>
			<li class="<?php echo $isCurrent ? 'active' : ''; ?>">
				<a <?php echo !$hasChild ? 'href="' . Url::to($aValue['url']) . '"' : 'href="javascript:;" data-toggle="collapse" data-target="#' . $aValue['en_title'] . '"'; ?>><i class="fa fa-fw fa-<?php echo $aValue['icon_class']; ?>"></i> <?php echo $aValue['title']; ?></a>
				<?php if($hasChild){ ?>
					<ul id="<?php echo $aValue['en_title']; ?>" class="collapse <?php echo $cls; ?>">
					<?php 
						foreach($aValue['child'] as $k => $aChild){ 
							$activeCls = '';
							if(isset($aChild['url']) && $controllerId . '/' . $actionId == $aChild['url'][0]){
								$activeCls = 'active';
							}
					?>
						<li>
							<a class="<?php echo $activeCls; ?>" href="<?php echo Url::to($aChild['url']); ?>"><i class="fa fa-fw fa-<?php echo $aChild['icon_class']; ?>"></i> <?php echo $aChild['title']; ?></a>
						</li>
					<?php } ?>
					</ul>
				<?php } ?>
			</li>
		<?php } ?>
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</nav>
<script type="text/javascript">

</script>