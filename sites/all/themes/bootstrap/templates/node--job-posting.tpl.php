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
<div id="node-<?php print $node->nid; ?>" class="rowBeca <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php /*if (!$page):*/ ?>
    <p<?php print $title_attributes; ?>  style="text-transform:uppercase">    
      <?php print $title; ?>
    </p>
  <?php /*endif;*/ ?>
  <?php print render($title_suffix); ?>
 <!-- <div class="field-label"><?php print t("General function:"); ?></div>-->
  <?php print render($content['field_func_general']); ?><br/>
   <a style="text-decoration: underline;" href="<?php print $node_url; ?>"><?php print t("SEE DETAIL"); ?></a>
</div>

<?php else: ?>

<img src="\webineco\sites\all\themes\bootstrap\templates\image\bg-mapa-web.png" alt="mapa web" height="100%" width="100%">
<div id="node-<?php print $node->nid; ?>" style="" class="<?php print $classes; ?> panel-display panel-2col panel-twocol-ineco clearfix"<?php print $attributes; ?>>
 
  <div class="panel-panel panel-col-first panel-twocol-ineco-sidebar" style="width: 80%;color: white;margin-top:-15%;margin-left:10%">
    <div class="inside">
     
    <!--<h2><?php print t($type_offer); ?></h2>-->
    <?php 
        if (!empty($reference)) { 
          $reference = ' Ref. ' . $reference; 
        } 
      ?>


    <h5><?php print $title.$reference; ?></h5>
      
      <br>
      <!--<div class="field-label"><?php print t("General function:"); ?></div>-->
      
    </div>
  </div>
  
  
  <div class="panel-panel panel-col-last panel-twocol-ineco-content"
   style="width: 80%;
  background-color: #EBF5FB;
  margin-left:10%;
  position:absolute; 
  PADDING: 3%;
  line-height: 2;
  height: auto;" >

   
    <div class="inside">
	<?php if((isset($_GET['show_link']) && $_GET['show_link'] == 1) || $mostrar_volver == TRUE):?>
		<a href="javascript:history.back(1);" class="back">

		</a>
	<?php endif;?>
	
  
  <?php print render($title_prefix); ?>
  <?php /*if (!$page):*/ ?>  
  <!--
    <h5<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h5>
    -->
  <?php /*endif;*/ ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix col-xs-12" id="oferta-detalle"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
    ?>
  <!--  <div class="field-label"><?php print t("Specific functions:"); ?></div>-->
  <strong style="font-size:14px;width: 50%;"><?php print render($content['field_func_general']); ?></strong>
    <div style="width: 50%;min-height: 230px;" id="subtitulo-detalle"><?php print render($content['field_func_especificas']); ?> </div>

     <div id="contentDetalle" style="width: 40%;float:right;margin-top:-23%">
 <div class="field-label field-label-inline"><strong><?php print t("Required experience:"); ?></strong></div>
   <?php print render($content['field_experiencia']); ?><br/>
    <div class="field-label"><strong><?php print t("Professional requirements:"); ?></strong></div>
    <?php print render($content['field_requisitos_profesionales']); ?><br/>
    <div class="field-label"><strong><?php print t("Knowledges and technical skills:"); ?></strong></div>
    <?php print render($content['field_conocimientos']); ?><br/>
     </div>  
    
   
    <div>
      <?php global $language; ?>
	  <?php if ($language -> language == 'es'): ?>
		  <a style=" background-color: #ece300;
      padding: 1% 13%;
      font-size: 26px;
      margin-left: 55%;
      position: absolute;
      /*margin-top: 3%;*/
          bottom: -5%;
      text-decoration:none;"
     target="_blank" 
     id="btn-inscribete"
     href="<?php print $base_url.'/trabaja-con-nosotros/?ref='.$reference; ?>" class="animacionAncla">Inscr&iacute;bete</a>
		  <a href="<?php print $base_url.'/trabaja-con-nosotros/ofertas-actuales/enviar-amigo?subject='.$subject.'&message='.$message.'&url='.$my_url; ?>" class="button">
      <img alt="" src="\webineco\sites\all\themes\bootstrap\templates\Iconos\share.png" style="height:4%; width:4%;margin-left: 102%;margin-top: -35%;" /></a>
      <?php else: ?>
		  <a style=" background-color: #ece300;
      padding: 2% 13%;
      font-size: 20px;
      margin-left: 55%;
      position: absolute;
      /*margin-top: 3%;*/
          bottom: -5%;
      text-decoration:none;"
     target="_blank"
     
     href="<?php print $base_url.'/en/careers/?ref='.$reference; ?>" class="animacionAncla">Sign up here</a>
		  <a href="<?php print $base_url.'/en/careers/current-offers/send-friend?subject='.$subject.'&message='.$message.'&url='.$my_url; ?>" class="button">
      <img alt="" src="\webineco\sites\all\themes\bootstrap\templates\Iconos\share.png" style="height:4%; width:4%;margin-left: 102%;margin-top: -35%;" /></a>
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
</div>
<?php endif; ?>