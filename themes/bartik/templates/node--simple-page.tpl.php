<?php
	global $base_url, $language;
	$current_url = url($_GET['q'], array('absolute' => TRUE));
	$mostrar_volver = FALSE;
	$current_aux = explode('/', drupal_lookup_path('alias', $_GET['q']));
	unset($current_aux[count($current_aux) - 1]);
	$current_aux = implode('/', $current_aux);

	$depth = count(explode('/', drupal_lookup_path('alias', $_GET['q'])));
	$id_ofrecemos = '';
	if(isset($node->body['und'][0]['value']) && strpos($node->body['und'][0]['value'], "soluciones-ofrecemos") !== FALSE){
		$id_ofrecemos = 'id="simple-page-altura-ofrecemos"';
	}
?>
<?php if(!isset($_SESSION['used_layout']) || $_SESSION['used_layout'] == 'one_col_ineco'):?>
	<div class="simple-page one-col">
		<div class="simple-page-title">
			<?php print $node->title; ?>
		</div>
		<?php if(isset($node->field_landing_page_subtitle['und'][0]['safe_value'])):?>
			<div <?php print $id_ofrecemos;?> class="simple-page-subtitle">
				<?php print $node->field_landing_page_subtitle['und'][0]['safe_value']; ?>
			</div>
		<?php endif;?>
		<?php if(isset($node->body['und'][0]['value'])):?>
			<?php if(!isset($node->field_use_scroll['und'][0]['value'])):?>
				<div class="simple-page-body">
					<?php print $node->body['und'][0]['value']; ?>
				</div>
			<?php elseif(isset($node->field_use_scroll['und'][0]['value']) && $node->field_use_scroll['und'][0]['value'] == 1):?>
				<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/simple_page_ineco.js', 'file');?>
				<div class="simple-page-fullcontent-body-scroll-wrapper">
					<div class="simple-page-body">
						<?php print $node->body['und'][0]['value']; ?>
					</div>
					<div class="simple-page-controllers">
						<a href="#" id="simple-page-fullcontent-body-scroll-up">
							<img src="<?php print $base_url.'/themes/bartik/images/scroll-up.png'; ?>" alt="<?php print t('Up'); ?>" title="<?php print t('Up'); ?>" />
						</a>
						<br />
						<a href="#" id="simple-page-fullcontent-body-scroll-down">
							<img src="<?php print $base_url.'/themes/bartik/images/scroll-down.png'; ?>" alt="<?php print t('down'); ?>" title="<?php print t('Down'); ?>" />
						</a>
					</div>
				</div>
			<?php endif;?>
		<?php endif;?>
		<?php if(isset($node->field_landing_page_links['und'][0]['url'])):?>
			<div class="simple-page-links">
				<ul>
					<?php foreach ($node->field_landing_page_links['und'] as $link):?>
						<?php $attributes = array();?>
						<?php if($current_url == $link['url'] || url($current_aux, array('absolute' => TRUE)) == $link['url']):?>
							<?php $attributes = array('attributes' => array('class' => array('active')));?>
							<?php $mostrar_volver = TRUE;?>
						<?php endif;?>
						<li>
							<?php print l($link['title'], $link['url'], $attributes); ?>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
		<?php endif;?>
		
		<?php if(/*$mostrar_volver*/FALSE):?>
			<div class="simple-page-volver">
				<?php $return_url = explode('/', url($_GET['q']));?>
				<?php $return_url = array_slice($return_url, 2);?>
				<?php $return_url = array_slice($return_url, 0, count($return_url) - 1);?>
				<?php $return_url = implode('/', $return_url);?>
				<?php print l(t('Volver'), $return_url); ?>
			</div>
		<?php endif;?>
	</div>
<?php else:?>
	<div class="simple-page">
		<div class="simple-page-title">
			<?php print $node->title; ?>
		</div>
		<?php if(isset($node->field_landing_page_subtitle['und'][0]['safe_value'])):?>
			<div <?php print $id_ofrecemos;?> class="simple-page-subtitle">
				<?php print $node->field_landing_page_subtitle['und'][0]['safe_value']; ?>
			</div>
		<?php endif;?>
		<?php if(isset($node->body['und'][0]['value'])):?>
			<?php if(!isset($node->field_use_scroll['und'][0]['value'])):?>
				<div class="simple-page-body">
					<?php print $node->body['und'][0]['value']; ?>
				</div>
			<?php elseif(isset($node->field_use_scroll['und'][0]['value']) && $node->field_use_scroll['und'][0]['value'] == 1):?>
				<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/simple_page_ineco.js', 'file');?>
				<div class="simple-page-fullcontent-body-scroll-wrapper">
					<div class="simple-page-body">
						<?php print $node->body['und'][0]['value']; ?>
					</div>
					<div class="simple-page-controllers">
						<a href="#" id="simple-page-fullcontent-body-scroll-up">
							<img src="<?php print $base_url.'/themes/bartik/images/scroll-up.png'; ?>" alt="<?php print t('Up'); ?>" title="<?php print t('Up'); ?>" />
						</a>
						<br />
						<a href="#" id="simple-page-fullcontent-body-scroll-down">
							<img src="<?php print $base_url.'/themes/bartik/images/scroll-down.png'; ?>" alt="<?php print t('down'); ?>" title="<?php print t('Down'); ?>" />
						</a>
					</div>
				</div>
			<?php endif;?>
		<?php endif;?>
		<?php if(isset($node->field_landing_page_links['und'][0]['url'])):?>
			<div class="simple-page-links">
				<ul>
					<?php foreach ($node->field_landing_page_links['und'] as $link):?>
						<?php $attributes = array();?>
						<?php if($current_url == $link['url'] || url($current_aux, array('absolute' => TRUE)) == $link['url']):?>
							<?php $attributes = array('attributes' => array('class' => array('active')));?>
							<?php $mostrar_volver = TRUE;?>
						<?php endif;?>
						<li>
							<?php print l($link['title'], $link['url'], $attributes); ?>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
		<?php endif;?>
		
		<?php if(/*$mostrar_volver*/FALSE):?>
			<div class="simple-page-volver">
				<a href="javascript:history.back(1);"><?php print t('Return');?></a>
			</div>
		<?php endif;?>
	</div>
	<div class="clear"></div>
<?php endif;?>
