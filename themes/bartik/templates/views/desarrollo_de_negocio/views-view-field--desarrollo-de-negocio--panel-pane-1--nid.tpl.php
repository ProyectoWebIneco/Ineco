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

global $language;
global $base_url;

// Se obtiene la zona geografica a la que se encuentra asignada la persona
$node = node_load($output);
$people_work_zone_nid = 0;
if(isset($node->field_people_work_zone['und'][0]['nid'])){
	$people_work_zone_nid = $node->field_people_work_zone['und'][0]['nid'];
}

// Se obtiene la ruta actual
$current_url = explode('/', drupal_lookup_path('alias', $_GET['q']));
unset($current_url[count($current_url)-1]);
$current_url = implode('/', $current_url);

// Se obtienen todas las zonas de trabajo
$work_zones = node_load_multiple(array(), array('type' => 'work_zone', 'language' => $language->language));
$work_zone_urls = array();
foreach($work_zones as $work_zone){
	foreach($work_zone->field_work_zone_destination['und'] as $work_zone_destination_url){
		$work_zone_urls[$work_zone_destination_url['url']] = $work_zone->nid;
	}
}

$selected = '';
if(isset($work_zone_urls[$current_url]) && $work_zone_urls[$current_url] == $people_work_zone_nid){
	$selected = ' active-people';
}
?>
<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/desarrollo_negocio_ineco.js', 'file');?>
<div class="business-development<?php print $selected;?>">
	<div class="people-teaser">
		<div class="people-teaser-left float-left">
			<div class="people-teaser-left-name">
				<?php //print l($node->title, 'node/'.$node->nid); ?>
				<?php print $node->title; ?>
			</div>
			<div class="people-teaser-left-job">
				<?php print $node->field_people_team['und'][0]['safe_value'];?>
			</div>
			<div class="people-teaser-left-mail">
				<?php $url = url('contact-form-ajax/'.$node->nid, array('query' => array('type' => 154, 'subtype' => 155)));?>
				<a class="contact-form-lightbox" href="<?php print $url;?>" alt="<?php print t('Contact');?>" title="<?php print t('Contact');?>">
					<img src="<?php print $base_url.'/themes/bartik/images/sobre.png'; ?>" alt="<?php print t('Contact'); ?>" title="<?php print t('Contact'); ?>" />
				</a>
				<a class="contact-form-lightbox" href="<?php print $url;?>" alt="<?php print t('Contact');?>" title="<?php print t('Contact');?>">
					<?php print t('Contact ');?>
				</a>
			</div>
		</div>
		<div class="people-teaser-right float-right">
			<div class="people-teaser-right-photo">
				<?php print theme('image', array('path' => image_style_url('equipo-directivo-listado', $node->field_people_photo['und'][0]['uri']))); ?>
			</div>
		</div>
	</div>
</div>
