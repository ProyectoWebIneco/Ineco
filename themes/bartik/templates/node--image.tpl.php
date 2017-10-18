<div class="image-fullcontent">
	<div class="image-fullcontent-image">
		<?php print theme('image', array('path' => $node->field_image_image['und'][0]['uri'])); ?>
	</div>
	<?php if(isset($node->field_image_image['und'][0]['title']) && $node->field_image_image['und'][0]['title'] != ''):?>
		<div class="image-fullcontent-title">
			<?php print $node->field_image_image['und'][0]['title']; ?>
		</div>
	<?php endif;?>
</div>
