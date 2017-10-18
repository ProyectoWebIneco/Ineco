<div class="project-teaser" id="up">
	<?php print render($title_prefix); ?>
	<div id="project-teaser-off-<?php print $node->nid;?>" class="project-teaser-off">
		<?php if(isset($node->field_advertising_message_link['und'][0]['url'])):?>
			<a href="<?php print $node->field_advertising_message_link['und'][0]['url'];?>" alt="<?php print $node->title;?>">
				<?php print render($content['field_advertising_message_image']); ?>
			</a>
		<?php else:?>
				<?php print render($content['field_advertising_message_image']); ?>
		<?php endif;?>
	</div>
	<div id="project-teaser-on-<?php print $node->nid;?>" class="project-teaser-on" style="display:none">
		<?php if(isset($node->field_advertising_message_link['und'][0]['url'])):?>
			<a href="<?php print $node->field_advertising_message_link['und'][0]['url'];?>" alt="<?php print $node->title;?>">
				<?php print render($content['field_advertising_message_image']); ?>
			</a>
		<?php else:?>
				<?php print render($content['field_advertising_message_image']); ?>
		<?php endif;?>
	</div>
	<?php print render($title_suffix); ?>
</div>
