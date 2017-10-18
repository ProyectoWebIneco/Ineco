<a href="javascript:history.back(1);" class="back"></a>
<div class="contact-request">
	<div class="contact-request-data">
		<div class="contact-request-first-wrapper">
			<div class="contact-request-first-title">
				<?php print t("Request information");?>
			</div>
			
			<div class="contact-request-id">
				<div class="contact-request-id-label">
					<?php print t("ID: ");?>
				</div>
				<div class="contact-request-id-value">
					<?php print $node->title;?>
				</div>
			</div>
			
			<div class="contact-request-date">
				<div class="contact-request-date-label">
					<?php print t("Request date: ");?>
				</div>
				<div class="contact-request-date-value">
					<?php $fecha = explode(' ', $node->field_contact_request_date['und'][0]['value']);?>
					<?php $filters['date']['min']['date'] = $fecha[0];?>
					<?php $filters['date']['max']['date'] = $fecha[0];?>
					<?php print l(strip_tags(render($content['field_contact_request_date'])), url('contact-request-dashboard', array('absolute' => TRUE, 'query' => $filters))); ?>
				</div>
			</div>
			
			<div class="contact-request-status">
				<div class="contact-request-status-label">
					<?php print t("Request status: ");?>
				</div>
				<div class="contact-request-status-value">
					<?php $term_tid = $node->field_contact_request_status['und'][0]['taxonomy_term']->tid;?>
					<?php $term_name = $node->field_contact_request_status['und'][0]['taxonomy_term']->name;?>
					<?php $filters['status'] = $term_tid;?>
					<?php print l($term_name, url('contact-request-dashboard', array('absolute' => TRUE, 'query' => $filters)));?>
				</div>
			</div>

			<?php $parents = taxonomy_get_parents($node->field_contact_request_type['und'][0]['taxonomy_term']->tid);?>
			<?php $term_name_parent = "";?>
			<?php foreach($parents  as $parent_key => $parent_value):?>
				<?php $termino = taxonomy_term_load($parent_key);?>
				<?php $term_name_parent = $termino->name;?>
			<?php endforeach;?>
			<div class="contact-request-type">
				<div class="contact-request-type-label">
					<?php print t("Request type: ");?>
				</div>
				<div class="contact-request-type-value">
					<?php $term_tid = $node->field_contact_request_type['und'][0]['taxonomy_term']->tid;?>
					<?php $term_name = $node->field_contact_request_type['und'][0]['taxonomy_term']->name;?>
					<?php print t($term_name_parent);?>
				</div>
				<div class="contact-request-type-label">
					<?php print t("Request subtype: ");?>
				</div>
				<div class="contact-request-type-value">
					<?php $filters['type'] = $term_tid;?>
					<?php print l(t($term_name), url('contact-request-dashboard', array('absolute' => TRUE, 'query' => $filters)));?>
				</div>
			</div>
		</div>
		
		<div class="contact-request-second-wrapper">
			<div class="contact-request-first-title">
				<?php print t("User information");?>
			</div>
			
			<div class="contact-request-name">
				<div class="contact-request-name-label">
					<?php print t("Name: ");?>
				</div>
				<div class="contact-request-name-value">
					<?php print render($content['field_contact_request_name']);?>
				</div>
			</div>
			
			<div class="contact-request-first-surname">
				<div class="contact-request-first-surname-label">
					<?php print t("First surname: ");?>
				</div>
				<div class="contact-request-first-surname-value">
					<?php print render($content['field_contact_request_first_s']);?>
				</div>
			</div>
			
			<div class="contact-request-second-surname">
				<div class="contact-request-second-surname-label">
					<?php print t("Second surname: ");?>
				</div>
				<div class="contact-request-second-surname-value">
					<?php print render($content['field_contact_request_ss']);?>
				</div>
			</div>
		</div>
		
		<div class="contact-request-third-wrapper">
			<div class="contact-request-first-title">
				<?php print t("Contact data");?>
			</div>
			
			<div class="contact-request-mail">
				<div class="contact-request-mail-label">
					<?php print t("Mail: ");?>
				</div>
				<div class="contact-request-mail-value">
					<a href="mailto:<?php print $node->field_contact_request_email['und'][0]['value'];?>">
						<?php print render($content['field_contact_request_email']);?>
					</a>
				</div>
			</div>
			
			<div class="contact-request-phone">
				<div class="contact-request-phone-label">
					<?php print t("Phone: ");?>
				</div>
				<div class="contact-request-phone-value">
					<?php print render($content['field_contact_request_phone']);?>
				</div>
			</div>
			
			<div class="contact-request-business">
				<div class="contact-request-business-label">
					<?php print t("Business: ");?>
				</div>
				<div class="contact-request-business-value">
					<?php print render($content['field_contact_request_business']);?>
				</div>
			</div>
			
			<div class="contact-request-country">
				<div class="contact-request-country-label">
					<?php print t("Country: ");?>
				</div>
				<div class="contact-request-country-value">
					<?php print render($content['field_contact_request_country']);?>
				</div>
			</div>
		</div>
		
		<div class="contact-request-fourth-wrapper">
			<div class="contact-request-comments">
				<div class="contact-request-comments-label">
					<?php print t("Comments: ");?>
				</div>
				<div class="contact-request-comments-value">
					<?php print render($content['field_contact_request_comments']);?>
				</div>
			</div>
		</div>
		
		<div class="contact-request-fifth-wrapper">
			<div class="contact-request-documents">
				<div class="contact-request-documents-value">
					<?php print render($content['field_contact_request_documents']);?>
				</div>
			</div>
		</div>
	</div>
	
	
	<?php $revisions = node_revision_list($node);?>
	<?php if(count($revisions) > 0):?>
		<div class="contact-request-changes">
			<div class="contact-request-changes-title">
				<?php print t("Changelog: ");?>
			</div>
			<div class="contact-request-changes-row-names">
				<div class="contact-request-changes-row-names-date">
					<?php print t('Date'); ?>
				</div>
				<div class="contact-request-changes-row-names-status">
					<?php print t('Status'); ?>
				</div>
				<div class="contact-request-changes-row-names-user">
					<?php print t('User'); ?>
				</div>
				<div class="contact-request-changes-row-names-message">
					<?php print t('Message'); ?>
				</div>
			</div>
			<?php foreach($revisions as $revision):?>
				<?php $aux = node_load($node->nid, $revision->vid);?>
				<?php if(isset($aux->field_contact_request_status['und'][0]['tid'])):?>
					<div class="contact-request-changes-row">
						<div class="contact-request-changes-row-date">
							<?php $filters['date']['min']['date'] = date('Y-m-d', $revision->timestamp);?>
							<?php $filters['date']['max']['date'] = date('Y-m-d', $revision->timestamp);?>
							<?php print l(date('d/m/Y', $revision->timestamp), url('contact-request-dashboard', array('absolute' => TRUE, 'query' => $filters))); ?>
						</div>
						<div class="contact-request-changes-row-status">
							<?php $term = taxonomy_term_load($aux->field_contact_request_status['und'][0]['tid']);?>
							<?php $term_tid = $term->tid;?>
							<?php $term_name = $term->name;?>
							<?php $filters['status'] = $term_tid;?>
							<?php print l($term_name, url('contact-request-dashboard', array('absolute' => TRUE, 'query' => $filters)));?>
						</div>
						<div class="contact-request-changes-row-user">
							<?php print $revision->name?>
						</div>
						<div class="contact-request-changes-row-message">
							<?php print $revision->log?>
						</div>
					</div>
				<?php endif;?>
			<?php endforeach;?>
		</div>
	<?php endif;?>
</div>
