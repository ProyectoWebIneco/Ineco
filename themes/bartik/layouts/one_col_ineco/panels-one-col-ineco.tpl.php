<?php
/**
 * @file
 * Template for a 3 column panel layout.
 *
 * This template provides a very simple "one column" panel display layout.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   $content['middle']: The only panel in the layout.
 */
global $base_url;
?>
<div class="panel-display panel-1col panel-onecol-ineco clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="panel-panel panel-col panel-onecol-ineco-content">
    <div>
	<?php if(isset($_GET['show_link']) && $_GET['show_link'] == 1):?>
		<a href="#" class="back" onclick="history.back(1);">
			
		</a>
	<?php endif;?>
	<?php print $content['content']; ?>
    </div>
  </div>
</div>
