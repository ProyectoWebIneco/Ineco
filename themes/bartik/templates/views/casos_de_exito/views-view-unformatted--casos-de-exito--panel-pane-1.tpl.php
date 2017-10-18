<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php $i = 0; ?>
<?php foreach ($rows as $id => $row): ?>
	<?php if ($classes_array[$id]):?> 
		<?php $clases = $classes_array[$id];?>  
	<?php endif;?>
	<div class="<?php print $clases;?> <?php print  "col-".(($i+1) % 3) ?>" >
    	<?php print $row; ?>
  	</div>
  	<?php $i ++; ?>
<?php endforeach; ?>