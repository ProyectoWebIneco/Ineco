<?php if($teaser): ?>
	<div class="tender-teaser">
		<div class="tender-teaser-title">
			<?php print l($node->title, 'node/'.$node->nid);?>
		</div>
		<?php if(isset($node->field_tender_expedient_numer['und'][0]['value'])):?>
			<div class="tender-teaser-expedient">
				<div class="tender-teaser-expedient-label">
					<?php print t("Expedient number:")?>
				</div>
				<div class="tender-teaser-expedient-content">
					<?php print $node->field_tender_expedient_numer['und'][0]['value'];?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php /* if(isset($node->field_tender_limit_date['und'][0]['value'])):?>
			<div class="tender-teaser-limit-date">
				<div class="tender-teaser-limit-date-label">
					<?php print t("Limit date:")?>
				</div>
				<div class="tender-teaser-limit-date-content">
					<?php print format_date(strtotime($node->field_tender_limit_date['und'][0]['value']), $node->language.'_new');?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;*/?>
		<?php if(isset($node->field_limit_date['und'][0]['value'])):?>
			<div class="tender-teaser-limit-date">
				<div class="tender-teaser-limit-date-label">
					<?php print t("Limit date:")?>
				</div>
				<div class="tender-teaser-limit-date-content">
					<?php //print date('H:i, j \d\e F \d\e Y', strtotime($node->field_limit_date['und'][0]['value']));
						$field = field_get_items('node', $node, 'field_limit_date');
						$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $field[0]['value'], new DateTimeZone($field[0]['timezone_db']));
						$timestamp = $datetime->getTimestamp();
						print format_date($timestamp, $type = 'tender_date_'.$node->language);
						//print date('H:i, j \d\e F \d\e Y', $timestamp);			
					?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php /*if(isset($node->field_tender_approximate_date['und'][0]['value'])):?>
			<div class="tender-teaser-approximate-date">
				<div class="tender-teaser-approximate-date-label">
					<?php print t("Approximate date:")?>
				</div>
				<div class="tender-teaser-approximate-date-content">
					<?php print format_date(strtotime($node->field_tender_approximate_date['und'][0]['value']), $node->language.'_new');?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;*/?>
		<?php if(isset($node->field_approximate_date['und'][0]['value'])):?>
			<div class="tender-teaser-approximate-date">
				<div class="tender-teaser-approximate-date-label">
					<?php print t("Approximate date:")?>
				</div>
				<div class="tender-teaser-approximate-date-content">
					<?php //print format_date(strtotime($node->field_approximate_date['und'][0]['value']), $node->language.'_new');?>
					<?php //print date('H:i, j \d\e F \d\e Y', strtotime($node->field_approximate_date['und'][0]['value']));
							
						$field = field_get_items('node', $node, 'field_approximate_date');
						$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $field[0]['value'], new DateTimeZone($field[0]['timezone_db']));
						$timestamp = $datetime->getTimestamp();
						print format_date($timestamp, $type = 'tender_aprox');
						//print date('j \d\e F \d\e Y', $timestamp);			
					?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php if(isset($node->field_tender_technical_manager['und'][0]['value'])):?>
			<div class="tender-teaser-technical-manager">
				<div class="tender-teaser-technical-manager-label">
					<?php print t("Technical manager:")?>
				</div>
				<div class="tender-teaser-technical-manager-content">
					<?php print $node->field_tender_technical_manager['und'][0]['value'];?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php if(isset($node->field_tender_documents['und'][0]['value'])):?>
			<div class="tender-teaser-documents">
				<?php foreach ($node->field_tender_documents['und'] as $field_document):?>
					<?php $element = array_values(entity_load('field_collection_item', array($field_document['value'])));?>
					<?php $element = $element[0];?>
					<?php $document = $element->field_tender_document_file;?>
					<?php $show = $element->field_tender_document_show;?>
					<?php if($show['und'][0]['tid'] == 43):?>
						<div class="tender-teaser-documents-document tender-teaser-documents-document-<?php print str_replace('application/', '', $document['und'][0]['filemime']);?>">
							<?php print l($document['und'][0]['description'], file_create_url($document['und'][0]['uri']));?>
						</div>
						<div class="clear"></div>
					<?php endif;?>
				<?php endforeach;?>
			</div>
			<div class="clear"></div>
		<?php endif;?>
	</div>
<?php else:
	/*$result  = db_query('SELECT * FROM field_data_field_tender_post_date');
	while($row = $result->fetchAssoc()){	
		db_insert('field_revision_field_post_date')
          ->fields(array('entity_type'=> $row['entity_type'],
                         'bundle'=> $row['bundle'],
                         'deleted'=> $row['deleted'],
                         'entity_id'=> $row['entity_id'],
                         'revision_id'=> $row['revision_id'],
                         'language'=> $row['language'],
                         'delta'=> $row['delta'],
                         'field_post_date_value'=> $row['field_tender_post_date_value']
          ))
          ->execute();*/
		  
		  /*  watchdog('fechas',$row['field_tender_approximate_date_value']);
		 db_update('field_data_field_approximate_date')
          ->fields(array('field_approximate_date_value' => $row['field_tender_approximate_date_value']))
		  ->condition('entity_id', $row['entity_id'], '=')
          ->execute();*/
	//}

 ?>
	<div class="tender-fullcontent">
		<div class="tender-fullcontent-title">
			<?php print node_load($node->nid)->title;?>
		</div>
		<br/>
		<?php if(isset($node->field_tender_expedient_numer['und'][0]['value'])):?>
			<div class="tender-fullcontent-expedient">
				<div class="tender-fullcontent-expedient-label float-left">
					<?php print t("Expedient number:")?>
				</div>
				<div class="tender-fullcontent-expedient-content float-left negrita">
					<?php print $node->field_tender_expedient_numer['und'][0]['value'];?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php /*if(isset($node->field_tender_limit_date['und'][0]['value'])):?>
			<div class="tender-fullcontent-limit-date">
				<div class="tender-fullcontent-limit-date-label float-left">
					<?php print t("Limit date:")?>
				</div>
				<div class="tender-fullcontent-limit-date-content float-left negrita">
					<?php print format_date(strtotime($node->field_tender_limit_date['und'][0]['value']), $node->language.'_new');?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;*/?>
		<?php if(isset($node->field_limit_date['und'][0]['value'])):?>
			<div class="tender-fullcontent-limit-date">
				<div class="tender-fullcontent-limit-date-label float-left">
					<?php print t("Limit date:")?>
				</div>
				<div class="tender-fullcontent-limit-date-content float-left negrita">
					<?php //print format_date(strtotime($node->field_limit_date['und'][0]['value']), $node->language.'_new');?>
					<?php // print date('H:i, j \d\e F \d\e Y', strtotime($node->field_limit_date['und'][0]['value']));
						$field = field_get_items('node', $node, 'field_limit_date');
						$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $field[0]['value'], new DateTimeZone($field[0]['timezone_db']));
						$timestamp = $datetime->getTimestamp();
						print format_date($timestamp, $type = 'tender_date_'.$node->language);
					?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php /*if(isset($node->field_tender_approximate_date['und'][0]['value'])):?>
			<div class="tender-fullcontent-approximate-date">
				<div class="tender-fullcontent-approximate-date-label float-left">
					<?php print t("Approximate date:")?>
				</div>
				<div class="tender-fullcontent-approximate-date-content float-left negrita">
					<?php print format_date(strtotime($node->field_tender_approximate_date['und'][0]['value']), $node->language.'_new');?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;*/?>
		<?php if(isset($node->field_approximate_date['und'][0]['value'])):?>
			<div class="tender-fullcontent-approximate-date">
				<div class="tender-fullcontent-approximate-date-label float-left">
					<?php print t("Approximate date:")?>
				</div>
				<div class="tender-fullcontent-approximate-date-content float-left negrita">
					<?php //print format_date(strtotime($node->field_approximate_date['und'][0]['value']), $node->language.'_new');?>
					<?php //print date('H:i, j \d\e F \d\e Y', strtotime($node->field_approximate_date['und'][0]['value']));
						$field = field_get_items('node', $node, 'field_approximate_date');						
						$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $field[0]['value'], new DateTimeZone($field[0]['timezone_db']));
						$timestamp = $datetime->getTimestamp();						
						print format_date($timestamp, $type = 'tender_aprox');
						//print date('d-m-y', $timestamp);
						//print format_date($timestamp, $type = 'tender_date_'.$node->language);
					?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		<?php if(isset($node->field_tender_technical_manager['und'][0]['value'])):?>
			<div class="tender-fullcontent-technical-manager">
				<div class="tender-fullcontent-technical-manager-label float-left">
					<?php print t("Technical manager:")?>
				</div>
				<div class="tender-fullcontent-technical-manager-content float-left negrita">
					<?php print $node->field_tender_technical_manager['und'][0]['value'];?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		
		<?php if(isset($node->field_tender_documents['und'][0]['value'])):?>
			<div class="tender-fullcontent-documents">
				<?php foreach ($node->field_tender_documents['und'] as $field_document):?>
					<?php $element = array_values(entity_load('field_collection_item', array($field_document['value'])));?>
					<?php $element = $element[0];?>
					<?php $document = $element->field_tender_document_file;?>
					<?php $show = $element->field_tender_document_show;?>
					<div class="tender-fullcontent-documents-document tender-teaser-documents-document-<?php print str_replace('application/', '', $document['und'][0]['filemime']);?>">
						<?php print l($document['und'][0]['description'], file_create_url($document['und'][0]['uri']));?>
					</div>
				<?php endforeach;?>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		
		<?php /*if(isset($node->field_tender_post_date['und'][0]['value'])):?>
			<div class="tender-fullcontent-post-date">
				<div class="tender-fullcontent-post-date-label float-left">
					<?php print t("Post date:")?>
				</div>
				<div class="tender-fullcontent-post-date-content float-left negrita">
					<?php print format_date(strtotime($node->field_tender_post_date['und'][0]['value']), $node->language.'_new');?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;*/?>
		<?php if(isset($node->field_tender_post_date['und'][0]['value'])):?>
			<div class="tender-fullcontent-post-date">
				<div class="tender-fullcontent-post-date-label float-left">
					<?php print t("Post date:")?>
				</div>
				<div class="tender-fullcontent-post-date-content float-left negrita">
					<?php //print format_date(strtotime($node->field_tender_post_date['und'][0]['value']), $node->language.'_new');?>
					<?php //print date('H:i, j \d\e F \d\e Y', strtotime($node->field_post_date['und'][0]['value']));
						$field = field_get_items('node', $node, 'field_post_date');
						$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $field[0]['value'], new DateTimeZone($field[0]['timezone_db']));
						$timestamp = $datetime->getTimestamp();						
						print format_date($timestamp, $type = 'tender_date_'.$node->language);
					?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		
		<?php if(isset($node->field_tender_c_required['und'][0]['value'])):?>
			<div class="tender-fullcontent-clasification-required">
				<div class="tender-fullcontent-clasification-required-label float-left">
					<?php print t("Clasification required:")?>
				</div>
				<div class="tender-fullcontent-clasification-required-content float-left negrita">
					<?php print $node->field_tender_c_required['und'][0]['value'];?>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		
		<?php if(isset($node->field_tender_place_receipt['und'][0]['value'])):?>
			<div class="tender-fullcontent-place">
				<div class="tender-fullcontent-place-label textosecundario3d">
					<?php print t("Place of receipt and shipping terms")?>
				</div>
				<div class="tender-fullcontent-place-content">
					<?php print $node->field_tender_place_receipt['und'][0]['value'];?>
				</div>
			</div>
		<?php endif;?>
		<?php if(isset($node->field_observaciones['und'][0]['value'])):?>
			<div class="tender-fullcontent-place">
				<div class="tender-fullcontent-place-label textosecundario3d">
					<?php print t("Observations")?>
				</div>
				<div class="tender-fullcontent-place-content">
					<?php print $node->field_observaciones['und'][0]['value'];?>
				</div>
			</div>
		<?php endif;?>
	</div>
<?php endif; ?>
