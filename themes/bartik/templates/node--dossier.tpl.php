<?php print render($title_prefix); ?>
	<div class="dossier">
		<div class="dossier-image">
			<?php print theme('image', array('path' => $node->field_dossier_resume_image['und'][0]['uri'])); ?>
		</div>
		<div class="dossier-download-link">
			<?php print str_replace('<a href', '<a target="_blank" href', render($content['field_dossier_attachment'])); ?>
		</div>
	</div>
<?php print render($title_suffix); ?>
