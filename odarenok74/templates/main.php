<div class="main row full-width">
	<div class="left-aside col-md-2 col-xs-2">
		<ul>
			<? foreach ($aside_menu as $item): ?>
				<li class="aside-menu-item">
					<?
						echo '<a href="' . $item['adress'] . '">' . $item['name'] . '</a>';
					?>
				</li>
			<? endforeach ?>
		</ul>
	</div>
	<div class="content col-md-8 col-xs-8">
		{{VAR_MAIN_CONTENT}}
	</div>
	<div class="right-aside col-md-2 col-xs-2">
		
	</div>
</div>