<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
$request_by_type_parent = array();
$request_by_type = array();
$request_by_country = array();
$request_by_path_access = array();
$request_by_business = array();


foreach($view->result as $res){

	//Cogemos la tax padres para llenar el array.
	$aux = array_keys(taxonomy_get_parents($res->field_field_contact_request_type[0]['rendered']['#options']['entity']->tid)); 
	$term = taxonomy_term_load($aux['0']);
	$name = $term->name;
	
	if(!isset($request_by_type_parent[t($name)] )){
		$request_by_type_parent[t($name)] = 1;
	}else{
		$request_by_type_parent[t($name)] = $request_by_type_parent[t($name)] + 1;
	}
	
	if(!isset($request_by_type[t(strip_tags($res->field_field_contact_request_type[0]['rendered']['#title']))])){
		$request_by_type[t(strip_tags($res->field_field_contact_request_type[0]['rendered']['#title']))] = 1;
	}else{
		$request_by_type[t(strip_tags($res->field_field_contact_request_type[0]['rendered']['#title']))] = $request_by_type[t(strip_tags($res->field_field_contact_request_type[0]['rendered']['#title']))] + 1;
	}
	
	if(!isset($request_by_country[t(strip_tags($res->field_field_contact_request_country[0]['rendered']['#markup']))])){
		$request_by_country[t(strip_tags($res->field_field_contact_request_country[0]['rendered']['#markup']))] = 1;
	}else{
		$request_by_country[t(strip_tags($res->field_field_contact_request_country[0]['rendered']['#markup']))] = $request_by_country[t(strip_tags($res->field_field_contact_request_country[0]['rendered']['#markup']))] + 1;
	}
	
	if(!isset($request_by_path_access[t(strip_tags($res->field_field_contact_request_origin[0]['rendered']['#markup']))])){
		$request_by_path_access[t(strip_tags($res->field_field_contact_request_origin[0]['rendered']['#markup']))] = 1;
	}else{
		$request_by_path_access[t(strip_tags($res->field_field_contact_request_origin[0]['rendered']['#markup']))] = $request_by_path_access[t(strip_tags($res->field_field_contact_request_origin[0]['rendered']['#markup']))] + 1;
	}
	
	if(!isset($request_by_business[t(strip_tags($res->field_field_contact_request_business[0]['rendered']['#markup']))])){
		$request_by_business[t(strip_tags($res->field_field_contact_request_business[0]['rendered']['#markup']))] = 1;
	}else{
		$request_by_business[t(strip_tags($res->field_field_contact_request_business[0]['rendered']['#markup']))] = $request_by_business[t(strip_tags($res->field_field_contact_request_business[0]['rendered']['#markup']))] + 1;
	}
}

ksort($request_by_type_parent);
ksort($request_by_type);
ksort($request_by_country);
ksort($request_by_path_access);
ksort($request_by_business);
?>
<a href="javascript:history.back(1);" class="back"></a>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
  	<div class="view-content-tools-wrapper">
  		<div class="view-content-tools-wrapper-right">
  			<?php $aux = $_GET;?>
  			<?php $filters = drupal_get_query_parameters($aux);?>
			<?php if(user_access('export contact request data', $user)):?>
		  		<div class="view-content-tools-wrapper-csv">
					<?php $_SESSION['resultados_consulta_estadisticas']['request_by_type_parent'] = $request_by_type_parent;?>
					<?php $_SESSION['resultados_consulta_estadisticas']['request_by_type'] = $request_by_type;?>
					<?php $_SESSION['resultados_consulta_estadisticas']['request_by_country'] = $request_by_country;?>
					<?php $_SESSION['resultados_consulta_estadisticas']['request_by_path_access'] = $request_by_path_access;?>
					<?php $_SESSION['resultados_consulta_estadisticas']['request_by_business'] = $request_by_business;?>
		  			<?php print l(t('Export'),  url('export-excel-statistics', array('absolute' => TRUE)));?>
		  		</div>
			<?php endif;?>
	  	</div>
  	</div>
	<div class="clear"></div>
		<div class="view-content">
		
			<div class="view-content-request-by-type-parent">
    				<div class="view-content-request-by-type-parent-content">
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChartByType);
						function drawChartByType() {
							// Create the data table.
							var data = new google.visualization.DataTable();
							data.addColumn('string', "<?php print t('Types');?>");
							data.addColumn('number', "<?php print t('Number');?>");
							data.addRows([
								<?php $total = 0;?>
								<?php foreach($request_by_type_parent as $key => $elem):?>
									<?php print "['".t($key)."', ".$elem."],";?>
									<?php $total = $total + $elem;?>
								<?php endforeach;?>
							]);
				
							// Set chart options
							var options = {'title':'<?php print t("Request by type")." (".$total.")";?>',
						               'width':400,
						               'height':300};
				
							// Instantiate and draw our chart, passing in some options.
							var chart = new google.visualization.PieChart(document.getElementById('chart_by_type_parent'));
							chart.draw(data, options);
						}
					</script>
					<div id="chart_by_type_parent"></div>
    				</div>
    			</div>
	
    	<div class="view-content-request-by-type">
    		<div class="view-content-request-by-type-content">
			    <script type="text/javascript">
			      google.load('visualization', '1.0', {'packages':['corechart']});
			      google.setOnLoadCallback(drawChartByType);
			      function drawChartByType() {
				        // Create the data table.
				        var data = new google.visualization.DataTable();
				        data.addColumn('string', "<?php print t('Types');?>");
				        data.addColumn('number', "<?php print t('Number');?>");
				        data.addRows([
						  <?php $total = 0;?>
						  <?php foreach($request_by_type as $key => $elem):?>
						      <?php print "['".t($key)."', ".$elem."],";?>
						      <?php $total = $total + $elem;?>
						  <?php endforeach;?>
				        ]);
				
				        // Set chart options
				        var options = {'title':'<?php print t("Request by subtype")." (".$total.")";?>',
				                       'width':400,
				                       'height':300};
				
				        // Instantiate and draw our chart, passing in some options.
				        var chart = new google.visualization.PieChart(document.getElementById('chart_by_type'));
				        chart.draw(data, options);
			      }
				</script>
    			<div id="chart_by_type"></div>
    		</div>
    	</div>
		
		<div class="view-content-request-by-country">
    		<div class="view-content-request-by-country-content">
			    <script type="text/javascript">
			      google.load('visualization', '1.0', {'packages':['corechart']});
			      google.setOnLoadCallback(drawChartByCountry);
			      function drawChartByCountry() {
				        // Create the data table.
				        var data = new google.visualization.DataTable();
				        data.addColumn('string', "<?php print t('Countries');?>");
				        data.addColumn('number', "<?php print t('Number');?>");
				        data.addRows([
						  <?php $total = 0;?>
						  <?php foreach($request_by_country as $key => $elem):?>
						      <?php print "['".$key."', ".$elem."],";?>
						      <?php $total = $total + $elem;?>
						  <?php endforeach;?>
				        ]);
				
				        // Set chart options
				        var options = {'title':'<?php print t("Request by country")." (".$total.")";?>',
				                       'width':400,
				                       'height':300};
				
				        // Instantiate and draw our chart, passing in some options.
				        var chart = new google.visualization.PieChart(document.getElementById('chart_by_country'));
				        chart.draw(data, options);
			      }
				</script>
    			<div id="chart_by_country"></div>
    		</div>
    	</div>
    	
    	<div class="view-content-request-by-path">
    		<script type="text/javascript">
			      google.load('visualization', '1.0', {'packages':['corechart']});
			      google.setOnLoadCallback(drawChartByPath);
			      function drawChartByPath() {
				        // Create the data table.
				        var data = new google.visualization.DataTable();
				        data.addColumn('string', "<?php print t('Path');?>");
				        data.addColumn('number', "<?php print t('Number');?>");
				        data.addRows([
						  <?php $total = 0;?>
						  <?php foreach($request_by_path_access as $key => $elem):?>
						      <?php print "['".t($key)."', ".$elem."],";?>
						      <?php $total = $total + $elem;?>
						  <?php endforeach;?>
				        ]);
				
				        // Set chart options
				        var options = {'title':'<?php print t("Request by path access")." (".$total.")";?>',
				                       'width':400,
				                       'height':300};
				
				        // Instantiate and draw our chart, passing in some options.
				        var chart = new google.visualization.PieChart(document.getElementById('chart_by_path'));
				        chart.draw(data, options);
			      }
				</script>
    			<div id="chart_by_path"></div>
    	</div>
    	
    	<div class="view-content-request-by-business">
    		<script type="text/javascript">
			      google.load('visualization', '1.0', {'packages':['corechart']});
			      google.setOnLoadCallback(drawChartByBusiness);
			      function drawChartByBusiness() {
				        // Create the data table.
				        var data = new google.visualization.DataTable();
				        data.addColumn('string', "<?php print t('Business');?>");
				        data.addColumn('number', "<?php print t('Number');?>");
				        data.addRows([
						  <?php $total = 0;?>
						  <?php foreach($request_by_business as $key => $elem):?>
						      <?php print "['".$key."', ".$elem."],";?>
						      <?php $total = $total + $elem;?>
						  <?php endforeach;?>
				        ]);
				
				        // Set chart options
				        var options = {'title':'<?php print t("Request by business")." (".$total.")";?>',
				                       'width':400,
				                       'height':300};
				
				        // Instantiate and draw our chart, passing in some options.
				        var chart = new google.visualization.PieChart(document.getElementById('chart_by_business'));
				        chart.draw(data, options);
			      }
				</script>
    			<div id="chart_by_business"></div>
    	</div>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div>
