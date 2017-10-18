<div class="business-displays">
	<div class="business-displays-image">
		<?php print theme('image', array('path' => $node->field_bd_image_resume['und'][0]['uri'])); ?>
	</div>
	<div class="business-displays-download-link">
		<?php print render($content['field_bd_attachment']); ?>
	</div>
</div>