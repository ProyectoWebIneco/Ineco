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
<?php if(isset($term->field_service_es_enlazable_['und'][0]['value']) && $term->field_service_es_enlazable_['und'][0]['value'] == 1):?>
	<div class="service">
		<div id="service-off-<?php print $term->tid;?>" class="service-off">
			<div class="service-off-image">
				<a class="<?php print 'solucion-'.$term->tid;?>" href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
					<?php print theme('image', array('path' => $term->field_service_image_off['und'][0]['uri'])); ?>
				</a>
			</div>
			<div class="service-off-title">
				<a class="<?php print 'solucion-'.$term->tid;?>" href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
					<?php print $term->name; ?>
				</a>
			</div>
		</div>
		<div id="service-on-<?php print $term->tid;?>" class="service-on" style="display:none">
			<div class="sector-on-image">
				<a class="<?php print 'solucion-'.$term->tid;?>" href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
					<?php print theme('image', array('path' => $term->field_service_image_on['und'][0]['uri'])); ?>
				</a>
			</div>
			<div class="service-on-title">
				<a class="<?php print 'solucion-'.$term->tid;?>" href="<?php print url('taxonomy/term/'.$term->tid);?>" alt="<?php print t($term->name);?>">
					<?php print $term->name; ?>
				</a>
			</div>
		</div>
	</div>
<?php else:?>
	<div class="service-not-link">
		<div id="service-off-<?php print $term->tid;?>" class="service-off">
			<div class="service-off-image">
					<?php print theme('image', array('path' => $term->field_service_image_off['und'][0]['uri'])); ?>
			</div>
			<div class="service-off-title">
					<?php print $term->name; ?>
			</div>
		</div>
		<div id="service-on-<?php print $term->tid;?>" class="service-on" style="display:none">
			<div class="sector-on-image">
					<?php print theme('image', array('path' => $term->field_service_image_on['und'][0]['uri'])); ?>
			</div>
			<div class="service-on-title">
					<?php print $term->name; ?>
			</div>
		</div>
	</div>
<?php endif;?>
