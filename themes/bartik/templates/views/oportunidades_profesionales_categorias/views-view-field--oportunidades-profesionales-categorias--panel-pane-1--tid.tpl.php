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

$term = taxonomy_term_load($output);
?>
<div class="sector">
	<div id="sector-off-<?php print $term->tid;?>" class="sector-off">
		<div class="sector-off-image">
			<a href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
				<?php print theme('image', array('path' => $term->field_categ_image_off['und'][0]['uri'])); ?>
			</a>
		</div>
		<div class="sector-off-title">
			<a href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
				<?php print $term->name; ?>
			</a>
		</div>
	</div>
	<div id="sector-on-<?php print $term->tid;?>" class="sector-on" style="display:none" title="<?php print $term->field_descripcion_corta['und'][0]['value'];?>">
		<div class="sector-on-image">
			<a href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
				<?php print theme('image', array('path' => $term->field_categ_image_on['und'][0]['uri'])); ?>
			</a>
		</div>
		<div class="sector-on-title">
			<a href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>" style="bottom: 13px; font-size:15px;">
				<?php print $term->name; ?>
			</a>
		</div>
	</div>
</div>
