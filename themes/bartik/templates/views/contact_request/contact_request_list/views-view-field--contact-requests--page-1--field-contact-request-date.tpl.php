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
$aux = $_GET;
$fecha = explode(' ', $row->field_field_contact_request_date[0]['raw']['value']);
$aux['date']['min']['date'] = $fecha[0];
$aux['date']['max']['date'] = $fecha[0];
$filters = drupal_get_query_parameters($aux);
?>
<?php print l(strip_tags($row->field_field_contact_request_date[0]['rendered']['#markup']), url($aux['q'], array('absolute' => TRUE, 'query' => $filters))); ?>