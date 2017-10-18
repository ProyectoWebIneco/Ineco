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

$node = node_load($row->nid);

?>
<div class="project-teaser">
	<div id="project-teaser-off-<?php print $node->nid;?>" class="project-teaser-off">
		<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
			<?php print  theme('image', array('path' => $node->field_project_image_off['und'][0]['uri'])); ?>
		</a>
	</div>
	<div id="project-teaser-on-<?php print $node->nid;?>" class="project-teaser-on" style="display:none">
		<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
			<?php print  theme('image', array('path' => $node->field_project_image_on['und'][0]['uri'])); ?>
		</a>
	</div>
	<div class="project-teaser-title">
		<?php print $node->title; ?>
	</div>
</div>