<?php print $title;?>
<?php if(isset($node->field_images['und'][0])):?>
	<?php if(!isset($_SESSION['used_layout']) || $_SESSION['used_layout'] == 'one_col_ineco'):?>
		<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/one_col_ineco.js', 'file');?>
		<div id="slideshow-item-one-col" class="slideshow-item-one-col">
			<?php print render($title_prefix); ?>
			<ul>
				<?php $index = 1;?>
				<?php foreach ($node->field_images['und'] as $field_image):?>
					<?php $element = array_values(entity_load('field_collection_item', array($field_image['value'])));?>
					<?php $element = $element[0];?>
					<?php $image = $element->field_slideshow_image;?>
					<?php $link = $element->field_slideshow_link;?>
					<li>
						<div class="slideshow-item-one-col">
							<div class="slideshow-item-one-col-imagen">
								<?php if(isset($link['und'])):?>
									<a href="<?php print $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
								<?php endif;?>
									<?php print  theme('image', array('path' => $image['und'][0]['uri'])); ?>
								<?php if(isset($link['und'])):?>
									</a>
								<?php endif;?>
							</div>
							<div class="slideshow-item-one-col-text-block">
								<div id="slideshow-item-one-col-text-<?php print $index;?>" class="slideshow-item-one-col-text">
									<?php if(isset($link['und'])):?>
										<a class="slideshow-item-one-col-text-title" href="<?php print $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
									<?php endif;?>
											<?php print $image['und'][0]['title'];?>
									<?php if(isset($link['und'])):?>
										</a>
									<?php endif;?>
								</div>
								<div id="slideshow-item-one-col-text-on-<?php print $index;?>" class="slideshow-item-one-col-text-on" style="display:none;">
									<?php if(isset($link['und'])):?>
										<a class="slideshow-item-one-col-text-title" href="<?php print $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
									<?php endif;?>
											<?php print $image['und'][0]['title'];?>
									<?php if(isset($link['und'])):?>
										</a>
									<?php endif;?>
									<br/>
									<?php if(isset($link['und'])):?>
										<a class="slideshow-item-one-col-text-subtitle" href="<?php print $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
									<?php endif;?>
											<?php print $image['und'][0]['alt'];?>
									<?php if(isset($link['und'])):?>
										</a>
									<?php endif;?>
								</div>
							</div>
						</div>
					</li>
					<?php $index ++;?>
				<?php endforeach;?>
			</ul>
			<?php print render($title_suffix); ?>
		</div>
	<?php else:?>
		<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/two_col_ineco.js', 'file');?>
		<div id="slideshow-item-two-col" class="slideshow-item-two-col">
			<?php print render($title_prefix); ?>
			<ul>
				<?php foreach ($node->field_images['und'] as $field_image):?>
					<?php $element = array_values(entity_load('field_collection_item', array($field_image['value'])));?>
					<?php $element = $element[0];?>
					<?php $image = $element->field_slideshow_image;?>
					<?php $link = $element->field_slideshow_link;?>
					<li>
						<div class="slideshow-item-two-col-imagen">
							<?php if(isset($link['und']) && strLen($link['und'][0]['url']) > 0):?>
								<a href="<?php print $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
							<?php endif;?>
								<?php print  theme('image', array('path' => $image['und'][0]['uri'])); ?>
							<?php if(isset($link['und']) && strLen($link['und'][0]['url']) > 0):?>
								</a>
							<?php endif;?>
						</div>
            <?php if(isset($image['und']) && strLen($image['und'][0]['title']) > 0):?>
						<div class="slideshow-item-two-col-text">
							<div class="slideshow-item-two-col-text-title">
								<?php print $image['und'][0]['title'];?>
							</div>
						</div>
            <?php endif;?>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="slideshow-item-two-col-control"><div class="margin-slideshow-item-two-col-control">
				<?php $i = 1;?>
				<?php foreach ($node->field_images['und'] as $field_image):?>
					<a href="#" id="slideshow-item-two-col-control-<?php print $i;?>"><?php print $i;?></a>
					<?php $i ++;?>
				<?php endforeach;?>
			</div></div>
			<?php print render($title_suffix); ?>
		</div>
	<?php endif;?>
<?php endif;?>
