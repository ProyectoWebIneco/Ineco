<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
$node = $row->_field_data['nid']['entity'];

?>
<h3 class="logotipo-titulo"><?php print $node->title;?></h3>
<div class="logo">
	<div class="logo-image">
		<?php print  theme('image', array('path' => $node->field_logo_image_resume['und'][0]['uri'])); ?>
	</div>
	<div class="logo-link">
		<?php foreach($node->field_logo_attachment['und'] as $logo):?>
			<?php $type = strtoupper(str_replace('image/', '', $logo['filemime']));?>
			<?php $type = strtoupper(str_replace('application/', '', $logo['filemime']));?>
			<?php $size = formatBytes($logo['filesize'], 0);?>
			<div class="logo-link-element">
				<div class="logo-link-element-type">
					<?php print $type.' ('.$size.')';?>
				</div>
				<div class="logo-link-element-link">
					<?php print l($logo['description'], 
						file_create_url($logo['uri']),
						array('attributes' => array('target' => '_blank')));?>
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach;?>
	</div>
</div>
