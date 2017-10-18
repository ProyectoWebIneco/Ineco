<?php if($view_mode == 'teaser'):?>
	<div class="corporate-magazine">
		<div class="corporate-magazine-image">
			<?php print theme('image', array('path' => $node->field_document_image_resume['und'][0]['uri'])); ?>
		</div>
		<div class="corporate-magazine-title">
			<?php print $node->title; ?>
		</div>
		<div class="corporate-magazine-description">
			<?php print $node->field_document_attachment['und'][0]['description']; ?>
		</div>
		<div class="corporate-link-all">
			<div class="corporate-magazine-link">
				<img class="file-icon" alt="" title="application/pdf" src="<?php print $base_url;?>/modules/file/icons/application-pdf.png">
				<?php $url = url(variable_get('file_public_path', conf_path() . '/files')."/".$node->field_document_attachment['und'][0]['filename'], array('absolute' => TRUE));?>
				<?php if($language->language != language_default()->language):?>
					<?php $url = str_replace('/'.$language->prefix.'/', '/', $url);?>
				<?php endif;?>
				<a href="<?php print $url;?>" target="_blank">
					<?php print t('Download this issue');?>
				</a>
			</div>
		</div>
	</div>
	<div class="corporate-magazine itransporte">
		<?php print t('You can consult previous issues of the magazine on the <a href="http://www.revistaitransporte.es/" target="_blank">itransporte</a> corporate web ');?>
	</div>
<?php else:?>
	<?php 
	global $language;
	$url = url(variable_get('file_public_path', conf_path() . '/files')."/".$node->field_document_attachment['und'][0]['filename'], array('absolute' => TRUE));
	if($language->language != language_default()->language){
		$url = str_replace('/'.$language->prefix, '', $url);
	}
	drupal_goto($url);
	?>
<?php endif;?>
