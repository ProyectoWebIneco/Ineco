<div class="rrss-all">
	<?php if(!empty($rrss)): ?>
		<?php foreach($rrss as $name => $rs): ?>
			<?php if($rs['status']): ?>
				<a href="<?php print $rs['link']?>" target="_blank">
						<?php print theme('image', array('path' => drupal_get_path('module', 'social_networks_block_link') . "/images/i-$name.png"))?>
				</a>
			<?php endif; ?>
		<?php endforeach;?>
	<?php endif; ?>
</div>

