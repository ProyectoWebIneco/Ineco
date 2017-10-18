<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/project_carousel_ineco_grey_box.js', 'file');?>
<?php if(taxonomy_term_load($node->field_project_carousel_view_mode['und'][0]['tid'])->name == 'Carousel'):?>
	<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/project_carousel_ineco.js', 'file');?>
	<?php print render($title_prefix); ?>
	<div class="project-carousel-wrapper">
		<?php if(isset($node->field_project_carousel_header['und'][0]['value'])):?>
			<div class="project-carousel-header">
				<?php print $node->field_project_carousel_header['und'][0]['value'];?>
			</div>
		<?php endif;?>
		<?php if(isset($node->field_project_carousel_projects['und']) && count($node->field_project_carousel_projects['und']) > 0):?>
			<div class="project-carousel-carousel-wrapper">
				<ul id="project-carousel-carousel" class="project-carousel-carousel">
					<?php foreach ($node->field_project_carousel_projects['und'] as $field_project):?>
						<li>
							<?php if(isset($field_project['node'])):?>
								<?php $node = node_view($field_project['node'], 'project_carousel_view');?>
								<?php $html_node = str_replace('telon-gris', 'telon-gris-carousel', drupal_render($node));?>
								<?php print $html_node;?>
							<?php endif;?>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
		<?php endif;?>
	</div>
	<?php print render($title_suffix); ?>
<?php elseif(taxonomy_term_load($node->field_project_carousel_view_mode['und'][0]['tid'])->name == 'Lista'):?>
	<?php print render($title_prefix); ?>
	<div class="project-list-wrapper">
		<?php if(isset($node->field_project_carousel_header['und'][0]['value'])):?>
			<div class="project-list-header">
				<?php print $node->field_project_carousel_header['und'][0]['value'];?>
			</div>
		<?php endif;?>
		<?php if(isset($node->field_project_carousel_projects['und']) && count($node->field_project_carousel_projects['und']) > 0):?>
			<?php $index = 0;?>
			<?php foreach ($node->field_project_carousel_projects['und'] as $field_project):?>
				<?php if(isset($field_project['node'])):?>			
					<?php $node = node_view($field_project['node'], 'teaser');?>
					<?php $aux = drupal_render($node);?>
					<?php if($index % 3 == 1):?>
						<?php $aux = str_replace('class="project-teaser"', 'class="project-teaser project-teaser-mid-col"', $aux);?>
					<?php endif;?>
					<?php print $aux;?>
					<?php $index ++;?>
				<?php endif;?>
			<?php endforeach;?>
		<?php endif;?>
	</div>
	<?php print render($title_suffix); ?>
<?php endif;?>
