<?php if($teaser):?>
	<div class="people-teaser">
		<div class="people-teaser-left float-left">
			<div class="people-teaser-left-name">
				<?php print $node->title; ?>
			</div>
			<div class="people-teaser-left-job">
				<?php print $node->field_people_job['und'][0]['safe_value'];?>
			</div>
			<div class="people-teaser-left-see-profile">
				<?php print l(t('View profile'), 'node/'.$node->nid); ?>
			</div>
		</div>
		<div class="people-teaser-right float-right">
			<div class="people-teaser-right-photo">
				<?php print render($content['field_people_photo']); ?>
			</div>
		</div>
	</div>
<?php else:?>
	<a href="javascript:history.back(1);" class="back"></a>
	<div class="people-full">
		<div class="people-full-left float-left">
			<div class="people-full-left-section">
				<?php print $node->field_people_team['und'][0]['safe_value'];?>
			</div>
			<div class="people-full-left-wrapper">
				<div class="people-full-left-name">
					<?php print $node->title; ?>
				</div>
				<div class="people-full-left-job">
					<?php print $node->field_people_job['und'][0]['safe_value'];?>
				</div>
			</div>
			<div class="people-full-left-see-profile">
				<?php print $node->body['und'][0]['value']; ?>
			</div>
		</div>
		<div class="people-full-right float-right">
			<div class="people-full-right-photo">
				<?php print  theme('image', array('path' => $node->field_people_photo['und'][0]['uri'])); ?>
			</div>
			<div class="people-full-right-name">
				<?php print $node->title; ?>
			</div>
		</div>
	</div>
<?php endif;?>
