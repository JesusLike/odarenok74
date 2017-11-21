<div class="nav full-width">
	<ul>
		<? foreach ($menu as $item): ?>
			<li class="nav-item">
				<?
					echo '<a href="' . $item['adress'] . '">' . $item['name'] . '</a>';
				?>
			</li>
		<? endforeach ?>
	</ul>
</div>