<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */

// Se calcula la miga de resultados
$current_page = 0;
if(isset($_GET['page'])){
	$current_page = $_GET['page'];
}
$items_per_page = 3;
$num_results = $view->total_rows;
if($items_per_page > $num_results){
	$items_per_page = $num_results;
}

$principio = ($current_page*$items_per_page) + 1;
$final = ($current_page*$items_per_page) + $items_per_page;

// Se calcula si se han de mostrar resultados.
$show_results = TRUE && 
	(isset($_GET['sector']) && $_GET['sector'] != 'All') || 
	(isset($_GET['servicios']) && $_GET['servicios'] != 'All') || 
	(isset($_GET['area_geografica']) && $_GET['area_geografica'] != 'All') || 
	(isset($_GET['pais']) && $_GET['pais'] != 'All');

$exposed = str_replace('<div class="views-exposed-widget views-submit-button">', '<div class="clear"></div><div class="views-exposed-widget views-submit-button">', $exposed);
drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/search_projects_ineco.js', 'file');
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  <?php if(!$show_results):?>
    <?php global $language;?>
  	<?php //No se han de mostrar resultados, se buscan los productos que coincidan con algún prefiltro (son aleatorios)?>
  	<?php $sql = "SELECT node.nid AS nid
					FROM 
					{node} node
					WHERE (( (node.status = '1') AND (node.type IN  ('project')) AND (node.language IN  ('".$language->language."')) ))
					ORDER BY RAND()
					LIMIT 3 OFFSET 0";?>
  	<?php if(isset($_GET['pre_sector']) && $_GET['pre_sector'] != 'All'):?>
  		<?php $sql = "SELECT node.nid AS nid
						FROM 
						{node} node
						LEFT JOIN {field_data_field_project_sector} field_data_field_project_sector_value_0 ON node.nid = field_data_field_project_sector_value_0.entity_id AND field_data_field_project_sector_value_0.field_project_sector_tid = '".$_GET['pre_sector']."'
						WHERE (( (node.status = '1') AND (node.type IN  ('project')) AND( (field_data_field_project_sector_value_0.field_project_sector_tid = '".$_GET['pre_sector']."') )AND (node.language IN  ('".$language->language."')) ))
						ORDER BY RAND()
						LIMIT 3 OFFSET 0";?>
  	<?php endif;?>
  	<?php if(isset($_GET['pre_servicios']) && $_GET['pre_servicios'] != 'All'):?>
  		<?php $sql = "SELECT node.nid AS nid
						FROM 
						{node} node
						LEFT JOIN {field_data_field_project_service} field_data_field_project_service_value_0 ON node.nid = field_data_field_project_service_value_0.entity_id AND field_data_field_project_service_value_0.field_project_service_tid = '".$_GET['pre_servicios']."'
						WHERE (( (node.status = '1') AND (node.type IN  ('project')) AND( (field_data_field_project_service_value_0.field_project_service_tid = '".$_GET['pre_servicios']."') )AND (node.language IN  ('".$language->language."')) ))
						ORDER BY RAND()
						LIMIT 3 OFFSET 0";?>
  	<?php endif;?>
  	<?php if(isset($_GET['pre_area_geografica']) && $_GET['pre_area_geografica'] != 'All'):?>
  		<?php $sql = "SELECT node.nid AS nid
						FROM 
						{node} node
						INNER JOIN {field_data_field_project_geographic_area} field_data_field_project_geographic_area ON node.nid = field_data_field_project_geographic_area.entity_id AND (field_data_field_project_geographic_area.entity_type = 'node' AND field_data_field_project_geographic_area.deleted = '0')
						WHERE (( (node.status = '1') AND (node.type IN  ('project')) AND (field_data_field_project_geographic_area.field_project_geographic_area_tid = '".$_GET['pre_area_geografica']."') AND (node.language IN  ('".$language->language."')) ))
						ORDER BY RAND()
						LIMIT 3 OFFSET 0";?>
  	<?php endif;?>
  	<?php if(isset($_GET['pre_pais']) && $_GET['pre_pais'] != 'All'):?>
  		<?php $sql = "SELECT node.nid AS nid
						FROM 
						{node} node
						LEFT JOIN {field_data_field_project_country} field_data_field_project_country_value_0 ON node.nid = field_data_field_project_country_value_0.entity_id AND field_data_field_project_country_value_0.field_project_country_tid = '".$_GET['pre_pais']."'
						WHERE (( (node.status = '1') AND (node.type IN  ('project')) AND( (field_data_field_project_country_value_0.field_project_country_tid = '".$_GET['pre_pais']."') )AND (node.language IN  ('".$language->language."')) ))
						ORDER BY RAND()
						LIMIT 3 OFFSET 0";?>
  	<?php endif;?>
  	<?php // $result = db_query($sql);?>
	<?php // $projects = array();?>
	<?php // $index = 0;?>
	<?php // drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/project_carousel_ineco_grey_box.js', 'file');?>
	<?php // <div class="project-list-wrapper">?>
		<?php // foreach ($result as $record):?>
			<?php // $node = node_view(node_load($record->nid), 'teaser');?>
			<?php // $aux = drupal_render($node);?>
			<?php // if($index % 3 == 1):?>
				<?php // $aux = str_replace('class="project-teaser"', 'class="project-teaser project-teaser-mid-col"', $aux);?>
			<?php // endif;?>
			<?php // print $aux;?>
			<?php // $index ++;?>
		<?php // endforeach;?>
	<?php // </div>?>
  <?php endif;?>
  
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if($show_results):?>
	  <?php if ($rows): ?>
	    <div class="view-content">
	      <div class="buscador-row-resultado">
	      	<?php print t('@principio of @final results from a total of @total results', array('@principio' => $principio, '@final' => $final, '@total' => $num_results));?>
	      </div>
	      <?php print $rows; ?>
	    </div>
	  <?php elseif ($empty): ?>
	    <div class="view-empty">
	      <?php print $empty; ?>
	    </div>
	  <?php endif; ?>
	
	  <?php if ($pager): ?>
	    <?php print $pager; ?>
	  <?php endif; ?>
  <?php else: ?>
	  <div class="buscador-proyectos-espacio-blanco">

	  </div>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
