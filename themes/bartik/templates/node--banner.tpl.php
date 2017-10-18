<?php global $language;?>
<?php $current_url = url($_GET['q'], array('absolute' => TRUE));?>
<div class="banner-wrapper">
	<?php print render($title_prefix); ?>
	<?php if(isset($node->field_banner_header['und'][0]['value'])):?>
		<div class="banner-header">
			<?php print $node->field_banner_header['und'][0]['value'];?>
		</div>
	<?php endif;?>
	
	<?php if(isset($node->field_banner_links['und']) && count($node->field_banner_links['und']) > 0):?>
		<?php $index = 1;?>
		<?php $last = "";?>
		<div class="banner-list banner-list-<?php print count($node->field_banner_links['und']);?>">
			<?php foreach ($node->field_banner_links['und'] as $field_banner_links):?>
				<?php $element = array_values(entity_load('field_collection_item', array($field_banner_links['value'])));?>
				<?php $element = $element[0];?>
				<?php $image_off = $element->field_banner_link_image_off;?>
				<?php $image_on = $element->field_banner_link_image_on;?>
				<?php $link = $element->field_banner_link_link;?>
	  			<?php $banner_url = '';?>

				<?php if(isset($link['und'])):?>				
					<?php $options = drupal_parse_url($link['und'][0]['url']);?>
					<?php $options['absolute'] = TRUE;?>
		  			<?php $banner_url = url($options['path'], $options);?>
				<?php endif;?>

				<?php if(drupal_lookup_path('source', $link['und'][0]['url']) == ''):?>
					<?php $banner_url = str_replace('/'.$language->language.'/', '/', $banner_url);?>
				<?php endif;?>

				<?php if($index == count($node->field_banner_links['und'])):?>
					<?php $last = "-last";?>
				<?php endif;?>

				<?php if($current_url != $banner_url):?>
					<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/banner_ineco.js', 'file');?>
					<div class="banner-teaser<?php print $last;?>">
						<div id="banner-teaser-off-<?php print $image_off['und'][0]['fid'];?>" class="banner-teaser-off">
							<?php if($banner_url != ''):?>
								<a href="<?php print $banner_url.'?show_link=1';?>" alt="<?php print $image_off['und'][0]['title'];?>">
							<?php endif;?>
								<?php print theme('image', array('path' => $image_off['und'][0]['uri'], 'alt' => $image_off['und'][0]['title'])); ?>
							<?php if($banner_url != ''):?>
								</a>
							<?php endif;?>
						</div>
						<div id="banner-teaser-on-<?php print $image_off['und'][0]['fid'];?>" class="banner-teaser-on" style="display:none">
							<?php if($banner_url != ''):?>
								<a href="<?php print $banner_url.'?show_link=1';?>" alt="<?php print $image_on['und'][0]['title'];?>">
							<?php endif;?>
								<?php print theme('image', array('path' => $image_on['und'][0]['uri'], 'alt' => $image_on['und'][0]['title'])); ?>
							<?php if($banner_url != ''):?>
								</a>
							<?php endif;?>
						</div>
					</div>
				<?php else:?>
					<div class="banner-teaser<?php print $last;?>">
						<div class="banner-teaser-on">
							<?php if($banner_url != ''):?>
								<a href="<?php print $banner_url.'?show_link=1';?>" alt="<?php print t($image_on['und'][0]['title']);?>">
							<?php endif;?>
								<?php print theme('image', array('path' => $image_on['und'][0]['uri'], 'alt' => $image_on['und'][0]['title'])); ?>
							<?php if($banner_url != ''):?>
								</a>
							<?php endif;?>
						</div>
					</div>
				<?php endif;?>
				<?php $index ++;?>
			<?php endforeach;?>
		</div>
	<?php endif;?>
	<?php print render($title_suffix); ?>
</div>
