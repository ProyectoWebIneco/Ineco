<?php global $base_url; ?>

<?php if($teaser): ?>
	<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/book_ineco.js', 'file');?>
	<div class="book-teaser">
		<?php print render($title_prefix); ?>
		<div id="book-teaser-off-<?php print $node->nid;?>" class="book-teaser-off">
			<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
				<?php print render($content['field_book_image_off']); ?>
			</a>
		</div>
		<div id="book-teaser-on-<?php print $node->nid;?>" class="book-teaser-on" style="display:none">
			<a href="<?php print url('node/'.$node->nid);?>" alt="<?php print t($node->title);?>">
				<?php print render($content['field_book_image_resume']); ?>
			</a>
		</div>
		<?php print render($title_suffix); ?>
		<div class="book-teaser-high">
			<div class="book-teaser-title">
				<?php print l($node->title, 'node/'.$node->nid);?>
			</div>
			<div class="book-teaser-author">
				<?php print $node->field_book_author['und'][0]['value'];?>
			</div>
			<div class="book-teaser-revsion">
				<?php print $node->field_book_revision['und'][0]['value'];?>
			</div>
		</div>
		<div class="book-teaser-resume">
			<?php if(strlen(strip_tags($node->field_book_resume['und'][0]['value'], '')) > 165):?>
				<?php print drupal_substr(strip_tags($node->field_book_resume['und'][0]['value'], ''), 0, 165).' ...';?>
			<?php else:?>
				<?php print strip_tags($node->field_book_resume['und'][0]['value'], '');?>
			<?php endif;?>
		</div>
		<div class="book-teaser-read-more">
			<?php print l(t("Read more"), 'node/'.$node->nid);?>
		</div>
	</div>
<?php else: ?>
<?php drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/book_ineco.js', 'file');?>
	<div class="book-fullcontent">
		<div class="book-fullcontent-title">
			<?php print $node->title;?>
		</div>
		<div class="book-fullcontent-author">
			<?php print $node->field_book_author['und'][0]['value'];?>
		</div>
		<div class="book-fullcontent-body">
			<div class="book-fullcontent-body-left float-left">
				<div class="book-fullcontent-body-left-image">
					<?php print render($content['field_book_image_resume']); ?>
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
		</div>
	</div>
<?php endif; ?>