<?php
	$mapamundi_selector_off = url(drupal_get_path('theme', 'bartik') .'/images/puntito_off1.png', array('absolute' => TRUE, 'language' => language_default()));
	$mapamundi_selector_on = url(drupal_get_path('theme', 'bartik') .'/images/puntito_on1.png', array('absolute' => TRUE, 'language' => language_default()));
?>
<div id="work-zone-<?php print $node->nid;?>" class="work-zone" style="position:absolute; margin-left:<?php print $node->field_work_zone_x['und'][0]['value'];?>px; margin-top:<?php print $node->field_work_zone_y['und'][0]['value'];?>px;">
	<?php print render($title_prefix); ?>
	<div id="work-zone-off-<?php print $node->nid;?>" class="work-zone-off">
		<div class="work-zone-off-title">
			<a href="<?php print $node->field_work_zone_destination['und'][0]['url'];?>" title="<?php print $node->field_work_zone_destination['und'][0]['title'];?>" alt="<?php print $node->field_work_zone_destination['und'][0]['title'];?>">
				<?php print $node->title;?>
			</a>
		</div>
		<div class="work-zone-off-selector">
			<a href="<?php print $node->field_work_zone_destination['und'][0]['url'];?>" title="<?php print $node->field_work_zone_destination['und'][0]['title'];?>" alt="<?php print $node->field_work_zone_destination['und'][0]['title'];?>">
				<img src="<?php print $mapamundi_selector_off;?>"/>
			</a>
		</div>
	</div>
	<div id="work-zone-on-<?php print $node->nid;?>" class="work-zone-on" style="display:none;">
		<div class="work-zone-on-title">
			<a href="<?php print $node->field_work_zone_destination['und'][0]['url'];?>" title="<?php print $node->field_work_zone_destination['und'][0]['title'];?>" alt="<?php print $node->field_work_zone_destination['und'][0]['title'];?>">
				<?php print $node->title;?>
			</a>
		</div>
		<div class="work-zone-on-selector">
			<a href="<?php print $node->field_work_zone_destination['und'][0]['url'];?>" title="<?php print $node->field_work_zone_destination['und'][0]['title'];?>" alt="<?php print $node->field_work_zone_destination['und'][0]['title'];?>">
				<img src="<?php print $mapamundi_selector_on;?>"/>
			</a>
		</div>
	</div>
	<?php print render($title_suffix); ?>
</div>
