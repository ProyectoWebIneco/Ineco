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
?>
<?php if(isset($row->nid)):?>
	<?php $node = node_load($row->nid);?>
	<div class="buscador-row">
		<div class="buscador-row-area">
			<?php if(isset($node->field_project_sector['und'][0])):?>
				<?php print t('Market: @area. ', array('@area' => taxonomy_term_load($node->field_project_sector['und'][0]['tid'])->name));?>
			<?php endif;?>

			<?php if(isset($node->field_project_service['und'][0])):?>
				<?php print t('Solution: @categoria. ', array('@categoria' => taxonomy_term_load($node->field_project_service['und'][0]['tid'])->name));?>
			<?php endif;?>

			<?php if(isset($node->field_project_geographic_area['und'][0])):?>
				<?php print t('Geographical area: @area_geografica ', array('@area_geografica' => taxonomy_term_load($node->field_project_geographic_area['und'][0]['tid'])->name));?>
			<?php endif;?>

			<?php if(isset($node->field_project_execution_period['und'][0])):?>
				<?php print t('(Execution: @periodo)', array('@periodo' => $node->field_project_execution_period['und'][0]['value']));?>
			<?php endif;?>
		</div>
		<div class="buscador-row-titulo">
			<?php print l($node->title, 'project/'.$node->nid, array('query' => array('source' => $_GET['q']))); ?>
		</div>
		<div class="buscador-row-cuerpo">
			<?php print $node->field_project_claim['und'][0]['value']?>
		</div>
	</div>
<?php endif;?>
