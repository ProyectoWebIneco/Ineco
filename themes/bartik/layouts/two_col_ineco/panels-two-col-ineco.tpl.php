<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * each column roughly equal in width.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 */
global $base_url;
$current_url = explode('/', drupal_lookup_path('alias', $_GET['q']));
$mostrar_volver = FALSE;
if(count($current_url) > 2){
	$mostrar_volver = TRUE;
}
?>
<div class="panel-display panel-2col panel-twocol-ineco clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="panel-panel panel-col-first panel-twocol-ineco-sidebar">
    <div class="inside"><?php print $content['left']; ?></div>
  </div>

  <div class="panel-panel panel-col-last panel-twocol-ineco-content">
    <div class="inside">
	<?php if((isset($_GET['show_link']) && $_GET['show_link'] == 1) || $mostrar_volver == TRUE):?>
		<a href="javascript:history.back(1);" class="back">

		</a>
	<?php endif;?>
	<?php print $content['content']; ?>
    </div>  
  </div>
</div>
