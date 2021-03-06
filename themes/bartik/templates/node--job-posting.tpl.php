<?php

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */

global $base_url;
$current_url = explode('/', drupal_lookup_path('alias', $_GET['q']));
$mostrar_volver = FALSE;
if(count($current_url) > 2){
	$mostrar_volver = TRUE;
}

$my_url = url(current_path(), array('absolute' => TRUE));

$field_type = field_get_items('node', $node, 'field_type'); 
$output = field_view_value('node', $node, 'field_type', $field_type[0]); 
$type_offer = render($output);

$field_referencia = field_get_items('node', $node, 'field_referencia'); 
$output = field_view_value('node', $node, 'field_referencia', $field_referencia[0]); 
$reference = render($output);

$subject = $title;

$field_func_general = field_get_items('node', $node, 'field_func_general'); 
$output = field_view_value('node', $node, 'field_func_general', $field_func_general[0]); 
$message = render($output);
$message .= '%0D%0D';
$message .= $my_url;

// FIX Para evitar el doble .../en/en/... en la URL de vuelta
$my_url = str_replace('/en/', '/', $my_url);
?>

<?php if($teaser): ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php /*if (!$page):*/ ?>
    <h2<?php print $title_attributes; ?>>
      <?php 
        if (!empty($reference)) { 
          $reference = ' Ref. ' . $reference; 
        } 
      ?>
      <a href="<?php print $node_url; ?>"><?php print $title.$reference; ?></a>
    </h2>
  <?php /*endif;*/ ?>
  <?php print render($title_suffix); ?>
  <div class="field-label"><?php print t("General function:"); ?></div>
  <?php print render($content['field_func_general']); ?>
</div>

<?php else: ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> panel-display panel-2col panel-twocol-ineco clearfix"<?php print $attributes; ?>>
  <div class="panel-panel panel-col-first panel-twocol-ineco-sidebar">
    <div class="inside">
      <h2><?php print t($type_offer); ?></h2>
      <br>
      <div class="field-label"><?php print t("General function:"); ?></div>
      <?php print render($content['field_func_general']); ?>
    </div>
  </div>
  
  <div class="panel-panel panel-col-last panel-twocol-ineco-content">
    <div class="inside">
	<?php if((isset($_GET['show_link']) && $_GET['show_link'] == 1) || $mostrar_volver == TRUE):?>
		<a href="javascript:history.back(1);" class="back">

		</a>
	<?php endif;?>
	
  
  <?php print render($title_prefix); ?>
  <?php /*if (!$page):*/ ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php /*endif;*/ ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
    ?>
    <div class="field-label"><?php print t("Specific functions:"); ?></div>
    <?php print render($content['field_func_especificas']); ?> 
    <div class="field-label field-label-inline"><?php print t("Required experience:"); ?></div>
    <?php print render($content['field_experiencia']); ?>
    <div class="field-label"><?php print t("Professional requirements:"); ?></div>
    <?php print render($content['field_requisitos_profesionales']); ?>
    <div class="field-label"><?php print t("Knowledges and technical skills:"); ?></div>
    <?php print render($content['field_conocimientos']); ?>    
    <div>
      <?php global $language; ?>
	  <?php if ($language -> language == 'es'): ?>
		  <a href="<?php print $base_url.'/trabaja-con-nosotros/?ref='.$reference; ?>" class="button">Inscr&iacute;bete aqu&iacute;</a>
		  <a href="<?php print $base_url.'/trabaja-con-nosotros/ofertas-actuales/enviar-amigo?subject='.$subject.'&message='.$message.'&url='.$my_url; ?>" class="button">Enviar a un amigo</a>
      <?php else: ?>
		  <a href="<?php print $base_url.'/en/careers/?ref='.$reference; ?>" class="button">Sign up here</a>
		  <a href="<?php print $base_url.'/en/careers/current-offers/send-friend?subject='.$subject.'&message='.$message.'&url='.$my_url; ?>" class="button">Send to friend</a>
      <?php endif; ?>
    </div>
  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

    </div>  
  </div>
</div>
<?php endif; ?>