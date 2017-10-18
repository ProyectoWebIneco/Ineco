<?php

/**
 * Add body classes if certain regions have content.
 */
function bartik_preprocess_html(&$variables) {
	if (!empty($variables['page']['featured'])) {
		$variables['classes_array'][] = 'featured';
	}

	if (!empty($variables['page']['triptych_first'])
			|| !empty($variables['page']['triptych_middle'])
			|| !empty($variables['page']['triptych_last'])) {
		$variables['classes_array'][] = 'triptych';
	}

	if (!empty($variables['page']['footer_firstcolumn'])
			|| !empty($variables['page']['footer_secondcolumn'])
			|| !empty($variables['page']['footer_thirdcolumn'])
			|| !empty($variables['page']['footer_fourthcolumn'])) {
		$variables['classes_array'][] = 'footer-columns';
	}

	// ACLR: Se añaden clases en función de la sección
	global $language;
	// Se comprueba si estamos en español u otro idioma
	$default_language = language_default();

	$request_uri = explode('?', request_uri());
	if(count($request_uri) > 0){
		$request_uri = $request_uri[0];
	}else{
		$request_uri = request_uri();
	}

	$current_path_complete = str_replace(base_path(), '', drupal_get_path_alias($request_uri, 1));
	if($default_language->language != $language->language){
		$first_level = explode('/', $current_path_complete);
		if(isset($first_level[1])){
			$id = str_replace('node/', '', drupal_lookup_path('source', $first_level[1]));
			if($id == '' && isset($first_level[2])){
				$id = str_replace('node/', '', drupal_lookup_path('source', $first_level[1].'/'.$first_level[2]));
			}
		}
		if(isset($id)){
			$node = node_load($id);
			if(isset($node->tnid)){
				$id = $node->tnid;
			}
			$current_path_complete = drupal_lookup_path('alias', 'node/'.$id, $default_language->language);
		}
	}
	// $current_path = explode('/', drupal_lookup_path('alias',$_GET['q']));
	$current_path = explode('/', $current_path_complete);
	$aux = $current_path[0];

	if($aux == 'contacto' && isset($current_path[1])){
		$aux = $current_path[0].'-'.$current_path[0];
	}
	$variables['classes_array'][] = $aux;

	// ACLR: Si el usuario es gestor, se añade la clase
	global $user;
	if(array_key_exists(CONTENT_MANAGER_RID, $user->roles)){
		$variables['classes_array'][] = 'gestor';
	}

	// Add conditional stylesheets for IE
	drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
	drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
	
	drupal_add_js('http://s7.addthis.com/js/300/addthis_widget.js');
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function bartik_process_html(&$variables) {
	// Hook into color.module.
	if (module_exists('color')) {
		_color_html_alter($variables);
	}
}

/**
 * Override or insert variables into the page template.
 */
function bartik_process_page(&$variables) {
	// Hook into color.module.
	if (module_exists('color')) {
		_color_page_alter($variables);
	}
	// Always print the site name and slogan, but if they are toggled off, we'll
	// just hide them visually.
	$variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
	$variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
	if ($variables['hide_site_name']) {
		// If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
		$variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
	}
	if ($variables['hide_site_slogan']) {
		// If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
		$variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
	}
	// Since the title and the shortcut link are both block level elements,
	// positioning them next to each other is much simpler with a wrapper div.
	if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
		// Add a wrapper div using the title_prefix and title_suffix render elements.
		$variables['title_prefix']['shortcut_wrapper'] = array(
				'#markup' => '<div class="shortcut-wrapper clearfix">',
				'#weight' => 100,
		);
		$variables['title_suffix']['shortcut_wrapper'] = array(
				'#markup' => '</div>',
				'#weight' => -99,
		);
		// Make sure the shortcut link is the first item in title_suffix.
		$variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
	}
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function bartik_preprocess_maintenance_page(&$variables) {
	// By default, site_name is set to Drupal if no db connection is available
	// or during site installation. Setting site_name to an empty string makes
	// the site and update pages look cleaner.
	// @see template_preprocess_maintenance_page
	if (!$variables['db_is_active']) {
		$variables['site_name'] = '';
	}
	drupal_add_css(drupal_get_path('theme', 'bartik') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function bartik_process_maintenance_page(&$variables) {
	// Always print the site name and slogan, but if they are toggled off, we'll
	// just hide them visually.
	$variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
	$variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
	if ($variables['hide_site_name']) {
		// If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
		$variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
	}
	if ($variables['hide_site_slogan']) {
		// If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
		$variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
	}
}

/**
 * Override or insert variables into the node template.
 */
function bartik_preprocess_node(&$variables) {
	if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
		$variables['classes_array'][] = 'node-full';
	}
}

/**
 * Override or insert variables into the block template.
 */
function bartik_preprocess_block(&$variables) {
	// In the header region visually hide block titles.
	if ($variables['block']->region == 'header') {
		$variables['title_attributes_array']['class'][] = 'element-invisible';
	}
}

/**
 * Implements theme_menu_tree().
 */
function bartik_menu_tree($variables) {
	return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function bartik_field__taxonomy_term_reference($variables) {
	$output = '';

	// Render the label, if it's not hidden.
	if (!$variables['label_hidden']) {
		$output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
	}

	// Render the items.
	$output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
	foreach ($variables['items'] as $delta => $item) {
		$output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
	}
	$output .= '</ul>';
	
	echo('aaa: ' . $variables);

	// Render the top-level DIV.
	$output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

	return $output;
}

function formatBytes($size, $precision = 2){
	$base = log($size) / log(1024);
	$suffixes = array('', 'KB', 'MB', 'GB', 'TB');

	return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function bartik_preprocess_panels_pane(&$vars) {
	$panel = $vars['pane'];
	$panel_display = panels_load_display($panel->did);
	$_SESSION['used_layout'] = $panel_display->layout;
}

function bartik_links__locale_block(&$vars) {

	global $language, $base_url, $conf;

	$ineco_domain_context = $conf['ineco_domain_context'];

	$default_language = language_default();
	$value_link = $vars['links'][$default_language->language];
	$is_node = preg_match('/^node\/[0-9]*/', $value_link['href'], $coincidencias);
	
	$current_path = str_replace(base_path(), '', request_uri());

	$ineco_domain_name = $conf['ineco_domain_name'];
		
	if($is_node){
		$nid = str_replace('node/', '', $value_link['href']);
		$tranlations = translation_node_get_translations($nid);
		if(count($tranlations) == 0){
			$node = node_load($nid);
			if(isset($node->tnid)){
				$tranlations = translation_node_get_translations($node->tnid);
			}	
		}
		foreach($vars['links'] as $key_link => $value_link) {
			if(isset($tranlations[$key_link])){
				$sql = "SELECT * FROM {url_alias} WHERE source = '".'node/'.$tranlations[$key_link]->nid."' AND language = '".$key_link."' ORDER BY CHAR_LENGTH(alias)";
				$result = db_query($sql);
				$paths = array();
				
				switch($key_link){
					case 'es':
						$vars['links'][$key_link]['href'] = "http://www.$ineco_domain_name.es".$ineco_domain_context.drupal_get_path_alias('node/'.$tranlations[$key_link]->nid, $key_link);
						break;
					case 'en':
						$vars['links'][$key_link]['href'] = "http://www.$ineco_domain_name.com".$ineco_domain_context."en/".drupal_get_path_alias('node/'.$tranlations[$key_link]->nid, $key_link);
						break;
				}

				if(isset($_GET['show_link'])){
					$vars['links'][$key_link]['query'] = array('show_link' => 1);
				}
				foreach ($result as $record) {
					if(count(explode('/', $current_path)) == count(explode('/', $record->alias))){
						switch($key_link){
							case 'es':
								$vars['links'][$key_link]['href'] = "http://www.$ineco_domain_name.es".$ineco_domain_context.$record->alias;
								break;
							case 'en':
								$vars['links'][$key_link]['href'] = "http://www.$ineco_domain_name.com".$ineco_domain_context."en/".$record->alias;
								break;
						}
						//$vars['links'][$key_link]['href'] = $record->alias;
						if(isset($_GET['show_link'])){
							$vars['links'][$key_link]['query'] = array('show_link' => 1);
						}
					}
				}
				
				
				if($key_link == $language->language){
					$vars['links'][$key_link]['attributes']['class'][0] = $vars['links'][$key_link]['attributes']['class'][0].' active';
				}
			}
		}
	}
	
	// 20130130: Se añade este foreach para evitar bucles infinitos a la hora de hacer redirecciones
	foreach($vars['links'] as $key_link => $value_link) {
		$vars['links'][$key_link]['query'] = array('redirect' => 'false');
	}
	
	// $vars['links'][$key_link]['language']->language == "es"

	$content = theme_links($vars);
	return $content;
}

function fix_css() {
	global $base_url;
	
	$u_agent = $_SERVER['HTTP_USER_AGENT'];

    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');

 // $pattern = '#(?<browser>' . join('|', $known) .')[\ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    $pattern = '/(' . join('|', $known) .')[\ ]+([0-9.|a-zA-Z.]*)/';

    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

$matches['browser'] = $matches[1];
$matches['version'] = $matches[2];
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version == null || $version == "") {
		$version="?";
	}
	$browser = '';
	switch($bname){
		case 'Mozilla Firefox':
			$browser = '-fx';
			break;
		case 'Internet Explorer':
			$version = explode('.', $version);

			if($version == '?'){
				$version = array();
				$version[0] = '9';
			}
			$browser = '-ie'.$version[0];
			break;
		case 'Google Chrome':
			$browser = '-ch';
			break;
		case 'Apple Safari':
			$browser = '-sa';
			break;
		case 'Opera':
			$browser = '-op';
			break;
	}
	$fix = 'fix'.$browser.'.css';
	
	if(drupal_realpath("themes/bartik/css/$fix")){
		return '<link type="text/css" rel="stylesheet" media="all" href="'.$base_url.'/themes/bartik/css/'.$fix.'"/>';
	}
}


function bartik_webform_mail_headers($variables) {
	$headers = array(
			'Content-Type' => 'text/html; charset=UTF-8; format=flowed; delsp=yes',
			'X-Mailer' => 'Drupal Webform (PHP/'. phpversion() .')',
	);
	return $headers;
}

/*function bartik_preprocess_views_view_unformatted(&$vars) {
	$view = $vars['view'];

	foreach ($view->result as $delta => $item) {
		if (isset($item->nid)) {
			$vars['classes'][$delta][] = 'contextual-links-region';
			$vars['classes_array'][$delta] = implode(' ', $vars['classes'][$delta]);
			$element = element_info('contextual_links');
			$element['#contextual_links'] = array('node' => array(
												'node',
												array($item->nid)
			));
			$vars['contextual_node'][$delta] = drupal_render($element);
		}else if($item->tid){
			$vars['classes'][$delta][] = 'contextual-links-region';
			$vars['classes_array'][$delta] = implode(' ', $vars['classes'][$delta]);
			$element = element_info('contextual_links');
			$element['#contextual_links'] = array('taxonomy' => array(
												'taxonomy',
												array($item->tid)
			));
			$vars['contextual_node'][$delta] = drupal_render($element);
		}
	}
}*/


function bartik_preprocess_views_view($vars) {
	$view = $vars['view'];
	
	switch($view->name){
		case 'donde_estamos_europa':
			drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/map_country_ineco.js');
			
			drupal_add_js(array('donde_estamos_europa' => array('url_projects_country' => url('coordinate-selector/ajax/projects-country'))), array('type' => 'setting'));
			break;
		case 'donde_estamos':
			drupal_add_js(drupal_get_path('theme', 'bartik') .'/js/map_ineco.js');
			break;
	}
}