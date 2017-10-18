<?php global $base_url; ?>
<?php $show_image = isset($node->field_new_image_on['und'][0]['fid']) && isset($node->field_new_image_off['und'][0]['fid']);?>
<?php switch($view_mode):
		case 'teaser': ?>
		<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/new_ineco.js', 'file');?>
		<div class="new-teaser <?php print $classes; ?> clearfix"<?php print $attributes; ?>">
			<?php if($show_image):?>
				<?php print render($title_prefix); ?>
				<div class="new-teaser-title">
					<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
						<?php if(strlen(strip_tags($node->title, '')) > 35):?>
							<?php print drupal_substr(strip_tags($node->title, ''), 0, 35).' ...';?>
						<?php else:?>
							<?php print strip_tags($node->title, '');?>
						<?php endif;?>
					</a>
				</div>
				<?php print render($title_suffix); ?>
				<div class="new-teaser-date">
					<?php //print date('d.m.Y', $node->created);?>
					<?php print format_date($node->created, $node->language.'_new_no_hour');?>
				</div>
				<div id="new-teaser-off-<?php print $node->nid;?>" class="new-teaser-off">
					<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
						<?php print render($content['field_new_image_off']); ?>
					</a>
				</div>
				<div id="new-teaser-on-<?php print $node->nid;?>" class="new-teaser-on" style="display:none">
					<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
						<?php print render($content['field_new_image_on']); ?>
					</a>
				</div>
				<div class="new-teaser-body">
					<?php if(strlen(strip_tags($node->body['und'][0]['value'], '')) > 260):?>
						<?php print drupal_substr(strip_tags($node->body['und'][0]['value'], ''), 0, 260).' ...';?>
					<?php else:?>
						<?php print strip_tags($node->body['und'][0]['value'], '');?>
					<?php endif;?>
					<a class="new-teaser-more-info" href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
						<?php print t('(+info)');?>
					</a>
				</div>
			<?php else:?>
				<?php print render($title_prefix); ?>
				<div class="new-teaser-title">
					<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
						<?php if(strlen(strip_tags($node->title, '')) > 35):?>
							<?php print drupal_substr(strip_tags($node->title, ''), 0, 35).' ...';?>
						<?php else:?>
							<?php print strip_tags($node->title, '');?>
						<?php endif;?>
					</a>
				</div>
				<?php print render($title_suffix); ?>
				<div class="new-teaser-date">
					<?php //print date('d.m.Y', $node->created);?>
					<?php print format_date($node->created, $node->language.'_new_no_hour');?>
				</div>
				<div class="new-teaser-body">
					<?php if(strlen(strip_tags($node->body['und'][0]['value'], '')) > 500):?>
						<?php print drupal_substr(strip_tags($node->body['und'][0]['value'], ''), 0, 500).' ...';?>
					<?php else:?>
						<?php print strip_tags($node->body['und'][0]['value'], '');?>
					<?php endif;?>
					<a class="new-teaser-more-info" href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
						<?php print t('(+info)');?>
					</a>
				</div>
			<?php endif;?>
		</div>
		<?php break;?>
		<?php case 'teaser_view': ?>
			<div class="new-teaserview <?php print $classes; ?> clearfix"<?php print $attributes; ?>">
				<?php print render($title_prefix); ?>
					<div class="new-teaserview-date">
							<?php print format_date($node->created, $node->language.'_new_no_hour');?>
					</div>
				<?php print render($title_suffix); ?>
				<div class="new-teaserview-title">
					
						<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
							<?php if(strlen(strip_tags($node->title, '')) > 25):?>
								<?php print drupal_substr(strip_tags($node->title, ''), 0, 80).' ...';?>
							<?php else:?>
								<?php print strip_tags($node->title, '');?>
							<?php endif;?>
						</a>
							
				</div>
				<div class="new-teaserview-body">
					<?php if(strlen(strip_tags($node->body['und'][0]['value'], '')) > 260):?>
						<?php print drupal_substr(strip_tags($node->body['und'][0]['value'], ''), 0, 90).' ...';?>
					<?php else:?>
						<?php print strip_tags($node->body['und'][0]['value'], '');?>
					<?php endif;?>
				</div>
			</div>
			<?php break;?>
		<?php case 'full': ?>
			<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/new_ineco.js', 'file');?>
			<div class="new-fullcontent">
				<div class="new-wrapper-date-rrss">
					
					<div class="new-fullcontent-compartir addthis_toolbox addthis_default_style">
						<div class="compartir-text"><span><?php print t('Compartir:');?></span></div>
						<a class="addthis_button_facebook"></a>
						<a class="addthis_button_twitter"></a>
					</div>
					<div class="new-fullcontent-date">
						<?php print format_date($node->created, $node->language.'_new_no_hour');?>
					</div>
				</div>
				
				<div class="new-fullcontent-body">
					<div class="new-fullcontent-body-left float-left">
						<div class="new-fullcontent-body-left-image">
							<?php print render($content['field_new_image_on']); ?>
						</div>
					</div>
					<div class="new-fullcontent-body-wrapper">
						<div class="new-fullcontent-body-right float-right">
							<?php print $node->body['und'][0]['value'];?>
						</div>
						<div class="new-fullcontent-body-scroll-wrapper" style="display: none;">
							<a href="#" id="new-fullcontent-body-scroll-up">
								<img src="<?php print $base_url.'/themes/bartik/images/scroll-up.png'; ?>" alt="<?php print t('Up'); ?>" title="<?php print t('Up'); ?>" />
							</a>
							<br />
							<a href="#" id="new-fullcontent-body-scroll-down">
								<img src="<?php print $base_url.'/themes/bartik/images/scroll-down.png'; ?>" alt="<?php print t('down'); ?>" title="<?php print t('Down'); ?>" />
							</a>
						</div>
					</div>
					<div class="clear"></div>
					<?php
						if(isset($_GET['home']) && $_GET['home'] == '1'):
							$id = 133;
							if(language_default()->language != $language->language):
								$node = node_load($id);
								$id = $node->nid;
								if(isset($node->tnid)):
									$id = $node->tnid;
								endif;
							endif;
							print "<div class=\"more-news-link\">" . l(t('More news >>'), 'node/'.$id, array('query' => array('show_all' => 0))) . "</div>";
						endif;
					?>
				</div>
			</div>
			<?php break;?>
<?php endswitch;?>
