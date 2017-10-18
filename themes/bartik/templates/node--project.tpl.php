<?php global $base_url; ?>
<?php global $language; ?>
<?php global $user; ?>

<?php
if(!function_exists('get_testimony_carousel')){
	function get_testimony_carousel($node, $position){

		$html = "";
		$width_1 = "width: 100%;";
		$width_2 = "width: 100%;";
		$global_tiene_datos = FALSE;
		if((isset($node->field_project_t_carousel_pos['und'][0]['value']) && $node->field_project_t_carousel_pos['und'][0]['value'] == $position)
			 || (!isset($node->field_project_t_carousel_pos['und'][0]['value']) && $position == 0)){
			if(isset($node->field_project_testimony_carousel['und'])){
				$html .= '<div class="clear"></div><br />';
				$html .= '<div class="carousel-wrapper" style="float:right; margin-top: 0px;">';
				$html .= '<div id="project-testimony-carousel" class="project-testimony-carousel">';
				$html .= '<div class="carousel-item-wrapper">';
				$html .= '<ul>';
				foreach($node->field_project_testimony_carousel['und'] as $testimony_item){
					$element = array_values(entity_load('field_collection_item', array($testimony_item['value'])));
					$element = $element[0];
					$html .= '<li>';
					$html .= '<div class="project-testimony-carousel-item">';
					$tiene_datos_cita = isset($element->field_project_tc_photo['und'][0]['fid']) || isset($element->field_project_tc_name['und'][0]['value']) || isset($element->field_project_tc_job['und'][0]['value']);
					$global_tiene_datos = $global_tiene_datos || $tiene_datos_cita;
					if($tiene_datos_cita){
						$html .= '<div class="project-testimony-carousel-item-data-wrapper">';
						if(isset($element->field_project_tc_photo['und'][0]['fid'])){
							$html .= '<div class="project-testimony-carousel-item-data-photo">';
							$html .= theme('image', array('path' => $element->field_project_tc_photo['und'][0]['uri']));
							$html .= '</div>';
						}
						if(isset($element->field_project_tc_name['und'][0]['value'])){
							$html .= '<div class="project-testimony-carousel-item-data-name">';
							$html .= $element->field_project_tc_name['und'][0]['value'];
							$html .= '</div>';
						}
						if(isset($element->field_project_tc_job['und'][0]['value'])){
							$html .= '<div class="project-testimony-carousel-item-data-job">';
							$html .= $element->field_project_tc_job['und'][0]['value'];
							$html .= '</div>';
						}
						$html .= '</div>';
						$width_1 = "width: 609px;";
						$width_2 = "width: 590px;";
					}

					if(isset($element->field_project_tc_sentence['und'][0]['value'])){
						if($tiene_datos_cita){
							$html .= '<div class="project-testimony-carousel-item-texto">';
						}else{
							$html .= '<div class="project-testimony-carousel-item-texto-sin-datos">';
						}
						$html .= "«".strip_tags($element->field_project_tc_sentence['und'][0]['value'])."».";
						$html .= '</div>';
					}
					$html .= '</div>';
					$html .= '</li>';
				}
				$html .= '</ul>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}
		}
		$html = str_replace("SUSTITUIR_WIDTH_1", $width_1, $html);
		$html = str_replace("SUSTITUIR_WIDTH_2", $width_2, $html);	
		if($global_tiene_datos){
			$html = str_replace('<div class="carousel-wrapper" style="float:right; margin-top: 0px;">', '<div class="carousel-wrapper con-datos" style="float:right; margin-top: 0px;">', $html);
		}	
		return $html;
	}
}

?>

<?php

if(!function_exists('get_paragraph_carousel')){
	function get_paragraph_carousel($node, $position){
		$html = "";
		$citas_html = array();
		if(isset($node->field_project_paragraph['und'][0]['value']) && isset($node->field_project_paragraph_pos['und'][0]['value']) && $node->field_project_paragraph_pos['und'][0]['value'] == $position){
			foreach($node->field_project_paragraph['und'] as $elem){
				$field_paragraph = $elem;
				$element = array_values(entity_load('field_collection_item', array($field_paragraph['value'])));
				$element = $element[0];
				$citas_html_aux = get_paragraph_carousel_cite($element);
				if($citas_html_aux != ''){
					$citas_html[] = $citas_html_aux;
				}
			}
		}elseif(isset($node->field_project_paragraph['und'][0]['value']) && !isset($node->field_project_paragraph_pos['und'][0]['value']) && $position == 0){
			foreach($node->field_project_paragraph['und'] as $elem){
				$field_paragraph = $elem;
				$element = array_values(entity_load('field_collection_item', array($field_paragraph['value'])));
				$element = $element[0];
				$citas_html_aux = get_paragraph_carousel_cite($element);
				if($citas_html_aux != ''){
					$citas_html[] = $citas_html_aux;
				}
			}
		}

		if(count($citas_html) > 1){
			$html .= '<div class="clear"></div><br />';
			$html .= '<div class="carousel-wrapper-ii" style="float:right; width: 609px; margin-top: 0px;">';
			$html .= '<div id="project-testimony-carousel-ii" class="project-testimony-carousel-ii">';
			$html .= '<div class="carousel-item-wrapper" style="width: 590px;">';
			$html .= '<ul>';
			foreach($citas_html as $cita_html){
				$html .= '<li>';
				$html .= $cita_html;
				$html .= '</li>';
			}
			$html .= '</ul>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}elseif(count($citas_html) == 1){
			$html = $citas_html[0];
			$html = str_replace('project-fullcontent-paragraph-0-right-body-testimony-ii', 'project-fullcontent-paragraph-0-right-body-testimony', $html);
		}
		return $html;
	}
}

if(!function_exists('get_paragraph_carousel_cite')){
	function get_paragraph_carousel_cite($testimony){
		$html = "";
		if(isset($testimony->field_project_t_photo['und'][0]['fid']) || isset($testimony->field_project_t_name['und'][0]['value']) || isset($testimony->field_project_t_job['und'][0]['value']) || isset($testimony->field_project_t_sentence['und'][0]['value'])){
			$html .= '<div class="project-fullcontent-paragraph-0-right">';
			$html .= '<div class="project-fullcontent-paragraph-0-right-body-testimony-ii">';
			$html .= '<div class="project-fullcontent-paragraph-0-right-test float-right">';
			if(isset($testimony->field_project_t_photo['und'][0]['fid'])){
				$html .= '<div class="project-fullcontent-paragraph-0-right-body-testimony-photo float-right">';
				$html .= theme('image', array('path' => $testimony->field_project_t_photo['und'][0]['uri']));
				$html .= '</div>';
			}

			if(isset($testimony->field_project_t_name['und'][0]['value'])){
				$html .= '<div class="project-fullcontent-paragraph-0-right-body-testimony-name">';
				$html .= $testimony->field_project_t_name['und'][0]['value'];
				$html .= '</div>';
			}

			if(isset($testimony->field_project_t_job['und'][0]['value'])){
				$html .= '<div class="project-fullcontent-paragraph-0-right-body-testimony-job">';
				$html .= $testimony->field_project_t_job['und'][0]['value'];
				$html .= '</div>';
			}
			$html .= '</div>';

			if(isset($testimony->field_project_t_sentence['und'][0]['value'])){
				$html .= '<div class="project-fullcontent-paragraph-0-right-body-testimony-sentence float-right">';
				$html .= "«".$testimony->field_project_t_sentence['und'][0]['value']."».";
				$html .= '</div>';
			}
			$html .= '</div>';
			$html .= '<div class="clear"></div>';
			$html .= '</div>';
		}
		return $html;
	}
}
?>

<?php if($teaser):
if ($_GET['q'] != "node/37" && $_GET['q'] != "node/297") {
	$country_GeographicArea = $node->field_project_geographic_area['und'][0]['tid'];
} else {
	$country_GeographicArea = $node->field_project_country['und'][0]['tid'];
}
?>
	<div class="project-teaser" id="up">
		<?php print render($title_prefix); ?>
		<div id="project-teaser-off-<?php print $node->nid;?>" class="project-teaser-off">
			<a href="<?php print url('project/'.$node->nid, array('query' => array('source' => $_GET['q'])));?>" alt="<?php print t($node->title);?>">
				<?php print render($content['field_project_image_off']); ?>
			</a>
		</div>
		<div id="project-teaser-on-<?php print $node->nid;?>" class="project-teaser-on" style="display:none">
			<a href="<?php print url('project/'.$node->nid, array('query' => array('source' => $_GET['q'])));?>" alt="<?php print t($node->title);?>">
				<?php print render($content['field_project_image_on']); ?>
			</a>
		</div>
		<div class="project-teaser-title">
			<span class="telon-gris">
				<a id="project-list-<?php print $node->nid;?>" href="<?php print url('project/'.$node->nid, array('query' => array('source' => $_GET['q'])));?>" alt="<?php print t($node->title);?>">
					<?php print $node->title; ?><b><?php print taxonomy_term_load($country_GeographicArea)->name; ?></b>
				</a>
			</span>
		</div>
		<?php print render($title_suffix); ?>
	</div>
<?php elseif($view_mode == 'project_carousel_view'):?>
	<div class="project-teaser" id="project-list">
		<?php print render($title_prefix); ?>
		<div id="project-teaser-off-<?php print $node->nid;?>" class="project-teaser-off">
			<a href="<?php print url('project/'.$node->nid, array('query' => array('source' => $_GET['q'])));?>" alt="<?php print t($node->title);?>">
				<?php print render($content['field_project_image_off']); ?>
			</a>
		</div>
		<div id="project-teaser-on-<?php print $node->nid;?>" class="project-teaser-on" style="display:none">
			<a href="<?php print url('project/'.$node->nid, array('query' => array('source' => $_GET['q'])));?>" alt="<?php print t($node->title);?>">
				<?php print render($content['field_project_image_on']); ?>
			</a>
		</div>
		<div class="project-teaser-title-fix" style="display:block">
			<span class="telon-gris">
				<a id="project-carousel-<?php print $node->nid;?>" href="<?php print url('project/'.$node->nid, array('query' => array('source' => $_GET['q'])));?>" alt="<?php print t($node->title);?>">
					<?php print $node->title; ?><b><?php print taxonomy_term_load($node->field_project_country['und'][0]['tid'])->name; ?></b>
				</a>
			</span>
		</div>
		<?php print render($title_suffix); ?>
	</div>
<?php else:?>
	<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/project_slideshow_ineco.js', 'file');?>
	<?php
		//$current_url = url($_GET['q'], array('absolute' => TRUE));
		$current_url = str_replace(base_path(), '', drupal_get_path_alias(request_uri(), 1));	
		$current_url = explode('/', $current_url);
		unset($current_url[count($current_url) - 1]);
		if($language->language != language_default()->language){
			unset($current_url[0]);
		}
		
		$current_url = implode('/', $current_url);
		$current_url = url($current_url, array('absolute' => TRUE));
	?>
	<div class="project-fullcontent">
		<div class="project-fullcontent-header">
			<div class="project-fullcontent-header-left">
				<div class="project-fullcontent-header-left-title">
					<?php print $node->title;?>
				</div>
				<?php if(isset($node->field_project_subtitle['und'][0]['value'])):?>
					<div class="project-fullcontent-header-left-subtitle">
						<?php print $node->field_project_subtitle['und'][0]['value'];?>
					</div>
				<?php endif;?>
			</div>
			<div class="project-fullcontent-header-right">
				<div id="project-fullcontent-header-right-slideshow-volver">
					<a href="<?php print $current_url;?>" alt="<?php print t("Return");?>" title="<?php print t("Return")?>">
					</a>
				</div>
				<a href="javascript:history.back(1);" class="back"></a>
				<?php if(isset($node->field_project_carousel['und'])):?>
					<?php if(count($node->field_project_carousel['und']) > 1):?>
						<div id="project-fullcontent-header-right-slideshow" class="project-fullcontent-header-right-slideshow">
							<ul>
								<?php foreach ($node->field_project_carousel['und'] as $field_image):?>
									<?php $element = array_values(entity_load('field_collection_item', array($field_image['value'])));?>
									<?php $element = $element[0];?>
									<?php $image = $element->field_project_carousel_image;?>
									<?php $link = $element->field_project_carousel_link;?>
									<li>
										<span class="project-fullcontent-header-right-slideshow-imagen">
											<?php if(isset($link['und'][0]['url']) && strLen($link['und'][0]['url']) > 0):?>
												<a href="<?php print $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
													<?php print  theme('image', array('path' => $image['und'][0]['uri'])); ?>
												</a>
											<?php else:?>
												<?php print  theme('image', array('path' => $image['und'][0]['uri'])); ?>
											<?php endif;?>
										</span>
										<span class="project-fullcontent-header-right-slideshow-text">
											<span class="project-fullcontent-header-right-slideshow-text-title">
												<?php print $image['und'][0]['title'];?>
											</span>
										</span>
									</li>
								<?php endforeach;?>
							</ul>
							<div class="project-fullcontent-header-right-slideshow-control">
								<div class="margin-project-fullcontent-header-right-slideshow-control">
									<?php $i = 1;?>
									<?php foreach ($node->field_project_carousel['und'] as $field_image):?>
										<a href="#" id="project-fullcontent-header-right-slideshow-control-<?php print $i;?>"><?php print $i;?></a>
										<?php $i ++;?>
									<?php endforeach;?>
								</div>
							</div>
						</div>
					<?php else:?>
						<div id="project-fullcontent-header-right-slideshow" class="project-fullcontent-header-right-slideshow">
							<ul>
								<?php foreach ($node->field_project_carousel['und'] as $field_image):?>
									<?php $element = array_values(entity_load('field_collection_item', array($field_image['value'])));?>
									<?php $element = $element[0];?>
									<?php $image = $element->field_project_carousel_image;?>
									<?php $link = $element->field_project_carousel_link;?>
									<li>
										<span class="project-fullcontent-header-right-slideshow-imagen">
											<?php if(isset($link['und'][0]['url'])):?>
												<a href="<?php $link['und'][0]['url'];?>" title="<?php print $link['und'][0]['title'];?>" alt="<?php print $link['und'][0]['title'];?>">
													<?php print  theme('image', array('path' => $image['und'][0]['uri'])); ?>
												</a>
											<?php else:?>
												<?php print  theme('image', array('path' => $image['und'][0]['uri'])); ?>
											<?php endif;?>
										</span>
										<span class="project-fullcontent-header-right-slideshow-text">
											<span class="project-fullcontent-header-right-slideshow-text-title">
												<?php print $image['und'][0]['title'];?>
											</span>
										</span>
									</li>
								<?php endforeach;?>
							</ul>
						</div>
					<?php endif;?>
				<?php endif;?>
			</div>
		</div>
		<?php if(isset($node->field_project_claim['und'][0]['value'])):?>
			<div class="project-fullcontent-claim">
				<?php print $node->field_project_claim['und'][0]['value'];?>
			</div>
		<?php endif;?>
		<?php if(isset($node->body['und'][0]['value'])):?>
			<div class="project-fullcontent-body">
				<?php print $node->body['und'][0]['value'];?>
			</div>
		<?php endif;?>

		<?php print get_testimony_carousel($node, 0);?>
		<?php print get_paragraph_carousel($node, 0);?>

		<?php if(isset($node->field_project_paragraph['und'])):?>
			<?php for($i = 0 ; $i < count($node->field_project_paragraph['und']) - 1 ; $i ++):?>
				<?php $field_paragraph = $node->field_project_paragraph['und'][$i];?>
				<?php $element = array_values(entity_load('field_collection_item', array($field_paragraph['value'])));?>
				<?php $element = $element[0];?>
				<?php // Se comprueba si tiene párrafo?>
				<?php if(isset($element->field_project_paragraph_title['und'][0]['value']) || isset($element->field_project_paragraph_body['und'][0]['value'])):?>
					<?php // Tiene párrafo, se comprueba si tiene cita?>
					<?php if(isset($element->field_project_t_photo['und'][0]['fid']) || isset($element->field_project_t_name['und'][0]['value']) || isset($element->field_project_t_job['und'][0]['value']) || isset($element->field_project_t_sentence['und'][0]['value'])):?>
						<?php //$testimony = array_values(entity_load('field_collection_item', array($element->field_project_testimony['und'][0]['value'])));?>
						<?php //$testimony = $testimony[0];?>

<?php $testimony = new StdClass();?>
<?php // $testimony->field_testimony_photo = $element->field_project_t_photo;?>
<?php // $testimony->field_testimony_name = $element->field_project_t_name;?>
<?php // $testimony->field_testimony_job = $element->field_project_t_job;?>
<?php // $testimony->field_testimony_sentence = $element->field_project_t_sentence;?>

						<?php // Cuerpo con párrafo y con cita?>
						<div class="clear"></div><br />
						<div class="project-fullcontent-paragraph-1">
							<div class="float-left texto-testimonio float-left">
								<?php if(isset($element->field_project_paragraph_title['und'][0]['value'])):?>
									<div class="project-fullcontent-paragraph-1-title">
										<?php print $element->field_project_paragraph_title['und'][0]['value'];?>
									</div>
								<?php endif;?>

								<?php if(isset($element->field_project_paragraph_body['und'][0]['value'])):?>
									<div class="project-fullcontent-paragraph-1-body">
										<?php print $element->field_project_paragraph_body['und'][0]['value'];?>
									</div>
								<?php endif;?>
							</div>
							<?php if(FALSE):?>
								<div class="project-fullcontent-paragraph-1-body-testimony float-right">
									<?php if(isset($testimony->field_testimony_photo['und'][0]['fid'])):?>
										<div class="project-fullcontent-paragraph-1-body-testimony-photo">
											<?php print theme('image', array('path' => $testimony->field_testimony_photo['und'][0]['uri']));?>
										</div>
									<?php endif;?>
									<?php if(isset($testimony->field_testimony_name['und'][0]['value'])):?>
										<div class="project-fullcontent-paragraph-1-body-testimony-name">
											<?php print $testimony->field_testimony_name['und'][0]['value'];?>
										</div>
									<?php endif;?>
									<?php if(isset($testimony->field_testimony_job['und'][0]['value'])):?>
										<div class="project-fullcontent-paragraph-1-body-testimony-job">
											<?php print $testimony->field_testimony_job['und'][0]['value'];?>
										</div>
									<?php endif;?>
									<?php if(isset($testimony->field_testimony_sentence['und'][0]['value'])):?>
										<div class="project-fullcontent-paragraph-1-body-testimony-sentence">
											<?php print $testimony->field_testimony_sentence['und'][0]['value'];?>
										</div>
									<?php endif;?>
								</div>
							<?php endif;?>
						</div>
						<?php print get_testimony_carousel($node, $i+1);?>
						<?php print get_paragraph_carousel($node, $i+1);?>
					<?php else:?>
						<?php // Cuerpo con párrafo y sin cita?>
						<div class="clear"></div><br />
						<div class="float-left texto-testimonio float-left">
							<?php if(isset($element->field_project_paragraph_title['und'][0]['value'])):?>
								<div class="project-fullcontent-paragraph-1-title">
									<?php print $element->field_project_paragraph_title['und'][0]['value'];?>
								</div>
							<?php endif;?>
							<?php if(isset($element->field_project_paragraph_body['und'][0]['value'])):?>
								<div class="project-fullcontent-paragraph-1-body">
									<?php print $element->field_project_paragraph_body['und'][0]['value'];?>
								</div>
							<?php endif;?>
						</div>
						<?php print get_testimony_carousel($node, $i+1);?>
						<?php print get_paragraph_carousel($node, $i+1);?>
					<?php endif;?>
				<?php else:?>
					<?php // No tiene párrafo, se comprueba si tiene cita?>
					<?php if(isset($element->field_project_t_photo['und'][0]['fid']) || isset($element->field_project_t_name['und'][0]['value']) || isset($element->field_project_t_job['und'][0]['value']) || isset($element->field_project_t_sentence['und'][0]['value'])):?>
						<?php // Cuerpo sin párrafo y con cita?>
						<?php // $testimony = array_values(entity_load('field_collection_item', array($element->field_project_testimony['und'][0]['value'])));?>
						<?php // $testimony = $testimony[0];?>

<?php $testimony = new StdClass();?>
<?php // $testimony->field_testimony_photo = $element->field_project_t_photo;?>
<?php // $testimony->field_testimony_name = $element->field_project_t_name;?>
<?php // $testimony->field_testimony_job = $element->field_project_t_job;?>
<?php // $testimony->field_testimony_sentence = $element->field_project_t_sentence;?>

						<?php if(FALSE):?>
							<div class="project-fullcontent-paragraph-0-right">
								<div class="project-fullcontent-paragraph-0-right-body-testimony">
									<div class="project-fullcontent-paragraph-0-right-test float-right">
										<?php if(isset($testimony->field_testimony_photo['und'][0]['fid'])):?>
											<div class="project-fullcontent-paragraph-0-right-body-testimony-photo float-right">
												<?php print theme('image', array('path' => $testimony->field_testimony_photo['und'][0]['uri']));?>
											</div>
										<?php endif;?>
										<?php if(isset($testimony->field_testimony_name['und'][0]['value'])):?>
											<div class="project-fullcontent-paragraph-0-right-body-testimony-name">
												<?php print $testimony->field_testimony_name['und'][0]['value'];?>
											</div>
										<?php endif;?>
										<?php if(isset($testimony->field_testimony_job['und'][0]['value'])):?>
											<div class="project-fullcontent-paragraph-0-right-body-testimony-job">
												<?php print $testimony->field_testimony_job['und'][0]['value'];?>
											</div>
										<?php endif;?>
									</div>
									<?php if(isset($testimony->field_testimony_sentence['und'][0]['value'])):?>
										<div class="project-fullcontent-paragraph-0-right-body-testimony-sentence float-right">
											<?php print "«".$testimony->field_testimony_sentence['und'][0]['value']."».";?>
										</div>
									<?php endif;?>
								</div>
								<div class="clear"></div>
							</div>
						<?php endif;?>
						<?php print get_testimony_carousel($node, $i+1);?>
						<?php print get_paragraph_carousel($node, $i+1);?>
					<?php else:?>
						<?php // Cuerpo sin párrafo y sin cita. Esta situación no se puede dar?>
					<?php endif;?>
				<?php endif;?>
			<?php endfor;?>
			
			<div class="clear"></div>
			<div class="project-top">
				<a href="#">
					<img src="<?php print $base_url.'/themes/bartik/images/project-top.png'; ?>" alt="<?php print t('Top'); ?>" title="<?php print t('Top'); ?>" />
					<span><?php print t('Go to top'); ?></span>
				</a>
			</div>
			<div class="clear"></div>
			
			<?php // Se procesa el último elemento?>
			<?php $field_paragraph = $node->field_project_paragraph['und'][count($node->field_project_paragraph['und'])-1];?>
			<?php $element = array_values(entity_load('field_collection_item', array($field_paragraph['value'])));?>
			<?php $element = $element[0];?>
			<?php // Se comprueba si tiene párrafo?>
			<?php if(isset($element->field_project_paragraph_title['und'][0]['value']) || isset($element->field_project_paragraph_body['und'][0]['value'])):?>
				<?php // Tiene párrafo, se comprueba si tiene cita?>
				<?php if(isset($element->field_project_t_photo['und'][0]['fid']) || isset($element->field_project_t_name['und'][0]['value']) || isset($element->field_project_t_job['und'][0]['value']) || isset($element->field_project_t_sentence['und'][0]['value'])):?>
					<?php // $testimony = array_values(entity_load('field_collection_item', array($element->field_project_testimony['und'][0]['value'])));?>
					<?php // $testimony = $testimony[0];?>

<?php $testimony = new StdClass();?>
<?php // $testimony->field_testimony_photo = $element->field_project_t_photo;?>
<?php // $testimony->field_testimony_name = $element->field_project_t_name;?>
<?php // $testimony->field_testimony_job = $element->field_project_t_job;?>
<?php // $testimony->field_testimony_sentence = $element->field_project_t_sentence;?>

					<?php // Cuerpo con párrafo y con cita?>
					<div class="clear"></div><br />
					<div class="project-fullcontent-paragraph-1">
						<div class="float-left texto-testimonio float-left">
							<?php if(isset($element->field_project_paragraph_title['und'][0]['value'])):?>
								<div class="project-fullcontent-paragraph-1-title">
									<?php print $element->field_project_paragraph_title['und'][0]['value'];?>
								</div>
							<?php endif;?>
							<?php if(isset($element->field_project_paragraph_body['und'][0]['value'])):?>
								<div class="project-fullcontent-paragraph-1-body">
									<?php print $element->field_project_paragraph_body['und'][0]['value'];?>
								</div>
							<?php endif;?>
						</div>
						<?php if(FALSE):?>
							<div class="project-fullcontent-paragraph-1-body-testimony float-right">
								<?php if(isset($testimony->field_testimony_photo['und'][0]['fid'])):?>
									<div class="project-fullcontent-paragraph-1-body-testimony-photo">
										<?php print theme('image', array('path' => $testimony->field_testimony_photo['und'][0]['uri']));?>
									</div>
								<?php endif;?>
								<?php if(isset($testimony->field_testimony_name['und'][0]['value'])):?>
									<div class="project-fullcontent-paragraph-1-body-testimony-name">
										<?php print $testimony->field_testimony_name['und'][0]['value'];?>
									</div>
								<?php endif;?>
								<?php if(isset($testimony->field_testimony_job['und'][0]['value'])):?>
									<div class="project-fullcontent-paragraph-1-body-testimony-job">
										<?php print $testimony->field_testimony_job['und'][0]['value'];?>
									</div>
								<?php endif;?>
								<?php if(isset($testimony->field_testimony_sentence['und'][0]['value'])):?>
									<div class="project-fullcontent-paragraph-1-body-testimony-sentence">
										<?php print $testimony->field_testimony_sentence['und'][0]['value'];?>
									</div>
								<?php endif;?>
							</div>
						<?php endif;?>
						<?php print get_testimony_carousel($node, 1000);?>
						<?php print get_paragraph_carousel($node, 1000);?>
						<div class="project-fullcontent-paragraph-0-tech float-left">
							<div class="project-fullcontent-paragraph-0-tech-title"><?php print t('Data Sheet'); ?></div>
							<div class="project-fullcontent-paragraph-0-tech-all">
								<div class="project-fullcontent-paragraph-0-tech-all-local">
									<b>
										<?php print t('Location'); ?>:
									</b>
									<?php $localization = taxonomy_term_load($node->field_project_country['und'][0]['tid']);?>
									<?php print $localization->name;?> 
								</div>
								<div class="project-fullcontent-paragraph-0-tech-all-client">
									<b>
										<?php print t('Client'); ?>:
									</b> 
									<?php print $node->field_project_customer['und'][0]['value'];?> 
								</div>
								<div class="project-fullcontent-paragraph-0-tech-all-ejec">
									<b>
										<?php print t('Execution period'); ?>:
									</b> 
									<?php print $node->field_project_execution_period['und'][0]['value'];?> 
								</div>
								<div class="project-fullcontent-paragraph-0-tech-all-activi">
									<b>
										<?php print t('Market'); ?>:
									</b> 
									<?php $sector = taxonomy_term_load($node->field_project_sector['und'][0]['tid']);?>
									<?php print $sector->name;?>
								</div>
							</div>
						</div>
					</div>
					
				<?php else:?>
					<?php // Cuerpo con párrafo y sin cita?>
					<div class="clear"></div><br />
					<div class="float-left texto-testimonio float-left">
						<?php if(isset($element->field_project_paragraph_title['und'][0]['value'])):?>
							<div class="project-fullcontent-paragraph-1-title">
								<?php print $element->field_project_paragraph_title['und'][0]['value'];?>
							</div>
						<?php endif;?>
						<?php if(isset($element->field_project_paragraph_body['und'][0]['value'])):?>
							<div class="project-fullcontent-paragraph-1-body">
								<?php print $element->field_project_paragraph_body['und'][0]['value'];?>
							</div>
						<?php endif;?>
					</div>
					<?php print get_testimony_carousel($node, 1000);?>
					<div class="project-fullcontent-paragraph-1-tech float-left">
						<div class="project-fullcontent-paragraph-1-tech-title">
							<?php print t('Data Sheet'); ?>
						</div>
						<div class="project-fullcontent-paragraph-1-tech-all">
							<div class="project-fullcontent-paragraph-1-tech-all-izq"></div>
							<div class="project-fullcontent-paragraph-1-tech-all-cen">
								<div class="project-fullcontent-paragraph-1-tech-all-local">
									<b>
										<?php print t('Location'); ?>:
									</b> 
									<?php $localization = taxonomy_term_load($node->field_project_country['und'][0]['tid']);?>
									<?php print $localization->name;?> 
								</div>
								<div class="project-fullcontent-paragraph-1-tech-all-client">
									<b>
										<?php print t('Client'); ?>:
									</b> 
									<?php print $node->field_project_customer['und'][0]['value'];?>
								</div>
								<div class="project-fullcontent-paragraph-1-tech-all-ejec">
									<b>
										<?php print t('Execution period'); ?>:
									</b> 
									<?php print $node->field_project_execution_period['und'][0]['value'];?>
								</div>
								<div class="project-fullcontent-paragraph-1-tech-all-activi">
									<b>
										<?php print t('Market'); ?>:
									</b> 
									<?php $sector = taxonomy_term_load($node->field_project_sector['und'][0]['tid']);?>
									<?php print $sector->name;?>
								</div>
							</div>
							<div class="project-fullcontent-paragraph-1-tech-all-der"></div>
						</div>
					</div>
				<?php endif;?>
			<?php else:?>
				<?php // No tiene párrafo, se comprueba si tiene cita?>
				<?php if(isset($element->field_project_t_photo['und'][0]['fid']) || isset($element->field_project_t_name['und'][0]['value']) || isset($element->field_project_t_job['und'][0]['value']) || isset($element->field_project_t_sentence['und'][0]['value'])):?>
					<?php // Cuerpo sin párrafo y con cita?>
					<?php // $testimony = array_values(entity_load('field_collection_item', array($element->field_project_testimony['und'][0]['value'])));?>
					<?php // $testimony = $testimony[0];?>

<?php $testimony = new StdClass();?>
<?php // $testimony->field_testimony_photo = $element->field_project_t_photo;?>
<?php // $testimony->field_testimony_name = $element->field_project_t_name;?>
<?php // $testimony->field_testimony_job = $element->field_project_t_job;?>
<?php // $testimony->field_testimony_sentence = $element->field_project_t_sentence;?>

					<div class="project-fullcontent-paragraph-0-right">
						<?php if(FALSE):?>
							<div class="project-fullcontent-paragraph-0-right-body-testimony">
								<div class="project-fullcontent-paragraph-0-right-test float-right">
									<?php if(isset($testimony->field_testimony_photo['und'][0]['fid'])):?>
										<div class="project-fullcontent-paragraph-0-right-body-testimony-photo float-right">
											<?php print theme('image', array('path' => $testimony->field_testimony_photo['und'][0]['uri']));?>
										</div>
									<?php endif;?>
									<?php if(isset($testimony->field_testimony_name['und'][0]['value'])):?>
										<div class="project-fullcontent-paragraph-0-right-body-testimony-name">
											<?php print $testimony->field_testimony_name['und'][0]['value'];?>
										</div>
									<?php endif;?>
									<?php if(isset($testimony->field_testimony_job['und'][0]['value'])):?>
										<div class="project-fullcontent-paragraph-0-right-body-testimony-job">
											<?php print $testimony->field_testimony_job['und'][0]['value'];?>
										</div>
									<?php endif;?>
								</div>
								<?php if(isset($testimony->field_testimony_sentence['und'][0]['value'])):?>
									<div class="project-fullcontent-paragraph-0-right-body-testimony-sentence float-right">
										<?php print "«".$testimony->field_testimony_sentence['und'][0]['value']."».";?>
									</div>
								<?php endif;?>
							</div>
						<?php endif;?>
						<?php print get_testimony_carousel($node, 1000);?>
						<div class="project-fullcontent-paragraph-1-tech float-left">
							<div class="project-fullcontent-paragraph-1-tech-title"><?php print t('Data Sheet'); ?></div>
							<div class="project-fullcontent-paragraph-1-tech-all">
								<div class="project-fullcontent-paragraph-1-tech-all-izq"></div>
								<div class="project-fullcontent-paragraph-1-tech-all-cen">
									<div class="project-fullcontent-paragraph-1-tech-all-local">
										<b>
											<?php print t('Location'); ?>:
										</b>
										<?php $localization = taxonomy_term_load($node->field_project_country['und'][0]['tid']);?>
										<?php print $localization->name;?> 
									</div>
									<div class="project-fullcontent-paragraph-1-tech-all-client">
										<b>
											<?php print t('Client'); ?>:
										</b> 
										<?php print $node->field_project_customer['und'][0]['value'];?> 
									</div>
									<div class="project-fullcontent-paragraph-1-tech-all-ejec">
										<b>
											<?php print t('Execution period'); ?>:
										</b> 
										<?php print $node->field_project_execution_period['und'][0]['value'];?> 
									</div>
									<div class="project-fullcontent-paragraph-1-tech-all-activi">
										<b>
											<?php print t('Market'); ?>:
										</b> 
										<?php $sector = taxonomy_term_load($node->field_project_sector['und'][0]['tid']);?>
										<?php print $sector->name;?>
									</div>
								</div>
								<div class="project-fullcontent-paragraph-1-tech-all-der"></div>
							</div>
						</div>
					</div>
				<?php else:?>
					<?php // Cuerpo sin párrafo y sin cita. Esta situación no se puede dar?>
				<?php endif;?>
			<?php endif;?>
			
		<?php endif;?>
	</div>
<?php endif;?>
