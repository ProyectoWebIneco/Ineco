<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
$terms = taxonomy_get_tree(16);
drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/preconfigured_reports_ineco.js', 'file');
$path = drupal_get_path('module', 'ineco_contact_request');
drupal_add_js("{$path}/js/ineco_contact_request.js");
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>
<div class="views-exposed-form">
	<div class="views-exposed-widgets clearfix">
  
		<div class="contact-request-form-first-row">
  			<div id="preconfigured-reports-wrapper" class="views-exposed-widget views-widget-preconfigured-reports">
	          	<label for="preconfigured-reports-select">
	            	<?php print t("Preconfigured reports"); ?>
	          	</label>
		        <select id="preconfigured-reports-select">
		        	<option value="All" selected="selected"><?php print t("- Any -");?></option>
		        	<?php foreach($terms as $term):?>
		        		<option value="<?php print $term->tid;?>"><?php print $term->name;?></option>
		        	<?php endforeach;?>
		        </select>
      		</div>
  		</div>
  		<div class="clear"></div>
  
  		<?php unset($widgets[$id]);?>
  
  		<?php $id = key($widgets)?>
  		<?php $widget = $widgets[$id];?>
  
	  	<div class="contact-request-form-second-row">
	  		<div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
	        	<?php if (!empty($widget->operator)): ?>
	          		<div class="views-operator">
	            		<?php print $widget->operator; ?>
	          		</div>
	        	<?php endif; ?>
	        	<div class="views-widget">
	          		<?php print $widget->widget; ?>
	        	</div>
	        	<?php if (!empty($widget->description)): ?>
	          		<div class="description">
	            		<?php print $widget->description; ?>
	          		</div>
	        	<?php endif; ?>
			</div>
		</div>
  		<div class="clear"></div>
		
		<?php unset($widgets[$id]);?>

  		<?php $id = key($widgets)?>
  		<?php $widget = $widgets[$id];?>
  
	  	<div class="contact-request-form-third-row">
	  		<div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
				<label for="edit-pretype"><?php print t('Contains');?></label>
	        	<?php if (!empty($widget->operator)): ?>
	          		<div class="views-operator">
	            		<?php print $widget->operator; ?>
	          		</div>
	        	<?php endif; ?>
	        	<div class="views-widget">
	          		<?php print $widget->widget; ?>
	        	</div>
	        	<?php if (!empty($widget->description)): ?>
	          		<div class="description">
	            		<?php print $widget->description; ?>
	          		</div>
	        	<?php endif; ?>
			</div>
		</div>
  		<div class="clear"></div>
		
		<?php unset($widgets[$id]);?>
  
		<div class="contact-request-form-fourth-row">

			<div class="form-item form-type-select form-item-pretype">
				<label for="edit-pretype"><?php print t('Request type');?></label>
			   	<select id="edit-pretype" name="pretype" class="form-select">
			      		<option value="All" selected="selected"><?php print t('- Any -');?></option>
					<?php $terms = taxonomy_get_tree(18);?>
					<?php foreach($terms as $term):?>
						<?php if($term->depth == 0):?>
					      		<option value="<?php print $term->tid;?>"><?php print t($term->name);?></option>
						<?php endif;?>
					<?php endforeach;?>
				</select>
			</div>

			<?php $id = key($widgets)?>
	  		<?php $widget = $widgets[$id];?>
	  
	  		<div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
				<?php if (!empty($widget->operator)): ?>
			  		<div class="views-operator">
			    		<?php print $widget->operator; ?>
			  		</div>
				<?php endif; ?>
				<label for="edit-type"><?php print t('Request subtype');?></label>
				<div class="views-widget">
			  		<?php print $widget->widget; ?>
				</div>
				<?php if (!empty($widget->description)): ?>
			  		<div class="description">
			    		<?php print $widget->description; ?>
			  		</div>
				<?php endif; ?>
			</div>
		</div>
  		<div class="clear"></div>
		
		<?php unset($widgets[$id]);?>

		<div class="contact-request-form-fifth-row">
	    		<?php foreach ($widgets as $id => $widget): ?>
      			<div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
        			<?php if (!empty($widget->label)): ?>
          				<label for="<?php print $widget->id; ?>">
            				<?php print $widget->label; ?>
          				</label>
        			<?php endif; ?>
			        <?php if (!empty($widget->operator)): ?>
			          	<div class="views-operator">
			            	<?php print $widget->operator; ?>
			          	</div>
			        <?php endif; ?>
			        <div class="views-widget">
			          	<?php print $widget->widget; ?>
			        </div>
			        <?php if (!empty($widget->description)): ?>
			          	<div class="description">
			            	<?php print $widget->description; ?>
			          	</div>
			        <?php endif; ?>
      			</div>
   			<?php endforeach; ?>
  		</div>
  		<div class="clear"></div>
  		
  		<div class="contact-request-form-buttons-row">
		    <?php if (!empty($sort_by)): ?>
		      	<div class="views-exposed-widget views-widget-sort-by">
		        	<?php print $sort_by; ?>
		      	</div>
		      	<div class="views-exposed-widget views-widget-sort-order">
		        	<?php print $sort_order; ?>
		      	</div>
		    <?php endif; ?>
		    <?php if (!empty($items_per_page)): ?>
		      	<div class="views-exposed-widget views-widget-per-page">
		        	<?php print $items_per_page; ?>
		      	</div>
		    <?php endif; ?>
		    <?php if (!empty($offset)): ?>
		      	<div class="views-exposed-widget views-widget-offset">
		        	<?php print $offset; ?>
		      	</div>
		    <?php endif; ?>
		    <div class="views-exposed-widget views-submit-button">
		      	<?php print $button; ?>
		    </div>
		    <?php if (!empty($reset_button)): ?>
		      	<div class="views-exposed-widget views-reset-button">
		        	<?php print $reset_button; ?>
		      	</div>
		    <?php endif; ?>
  		</div>
	</div>
</div>
