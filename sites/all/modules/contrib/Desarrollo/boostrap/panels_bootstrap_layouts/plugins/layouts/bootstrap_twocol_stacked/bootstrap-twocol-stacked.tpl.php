<div class="<?php print $classes ?> col-xs-12" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="row">
    <?php print $content['top']; ?>
  </div>
  <div class="row">
    <?php print $content['left']; ?>
    <?php print $content['right']; ?>
  </div>
  <div class="row">
    <?php print $content['bottom']; ?>
  </div>
</div>
