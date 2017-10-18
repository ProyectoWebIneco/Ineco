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
$mapamundi_selector_off = str_replace("/".$language->language."/", "/", url(drupal_get_path('theme', 'bartik') .'/images/puntito_off.png', array('absolute' => TRUE)));
$mapamundi_selector_on = str_replace("/".$language->language."/", "/", url(drupal_get_path('theme', 'bartik') .'/images/puntito_on.png', array('absolute' => TRUE)));
 
$country_term = taxonomy_term_load($row->tid);
if(isset($country_term) && $country_term->field_country_icon_type['und'][0]['value'] != ''){
	$mapamundi_selector_off = str_replace('puntito_off.png', $country_term->field_country_icon_type['und'][0]['value'].'_puntito_off.png', $mapamundi_selector_off);
	$mapamundi_selector_on = str_replace('puntito_on.png', $country_term->field_country_icon_type['und'][0]['value'].'_puntito_on.png', $mapamundi_selector_on);
}

$field_coordinate_x = field_get_items('taxonomy_term', $country_term, 'field_coordinate_x');
$field_coordinate_y = field_get_items('taxonomy_term', $country_term, 'field_coordinate_y');
$field_direction = field_get_items('taxonomy_term', $country_term, 'field_country_icon_position');
$coordinate_x = $field_coordinate_x[0]['value'];
$coordinate_y = $field_coordinate_y[0]['value'];
$direction = $field_direction[0]['value'];
$field_icon_type =  field_get_items('taxonomy_term', $country_term, 'field_country_icon_type');
$icon_type = !empty($field_icon_type[0]['value']) ? $field_icon_type[0]['value'] : 'blue';
?>

<?php if($direction=='right'): ?>
	<div id="country-<?php print $country_term->tid;?>" class="country position-rigth" style="position:absolute; margin-left:<?php print $coordinate_x;?>px; margin-top:<?php print $coordinate_y;?>px;">
		<div id="country-off-<?php print $country_term->tid;?>" class="country-off">
			<div class="country-title country-off-title icon-type-<?php print $icon_type;?>">
				<span><?php print $country_term->name;?></span>
			</div>
			<div class="country-selector country-off-selector icon-type-<?php print $icon_type;?>">
				<img src="<?php print $mapamundi_selector_off;?>"/>
			</div>
		</div>
		<div id="country-on-<?php print $country_term->tid;?>" class="country-on" style="display:none;">
			<div class="country-title country-on-title icon-type-<?php print $icon_type;?>">
				<?php print $country_term->name;?>
			</div>
			<div class="country-selector country-on-selector icon-type-<?php print $icon_type;?>">
				<img src="<?php print $mapamundi_selector_on;?>"/>
			</div>
		</div>
		
		<?php print $output; ?>
	</div>
<?php else: ?>
	<div id="country-<?php print $country_term->tid;?>" class="country position-left" style="position:absolute; margin-left:<?php print $coordinate_x;?>px; margin-top:<?php print $coordinate_y;?>px;">
		<div id="country-off-<?php print $country_term->tid;?>" class="country-off">
			<div class="country-selector country-off-selector icon-type-<?php print $icon_type;?>">
				<img src="<?php print $mapamundi_selector_off;?>"/>
			</div>
			<div class="country-title country-off-title icon-type-<?php print $icon_type;?>">
				<span><?php print $country_term->name;?></span>
			</div>
		</div>
		<div id="country-on-<?php print $country_term->tid;?>" class="country-on" style="display:none;">
			<div class="country-selector country-on-selector icon-type-<?php print $icon_type;?>">
				<img src="<?php print $mapamundi_selector_on;?>"/>
			</div>
			<div class="country-title country-on-title icon-type-<?php print $icon_type;?>">
				<?php print $country_term->name;?>
			</div>
		</div>

		<?php print $output; ?>
	</div>
<?php endif; ?>
