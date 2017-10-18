<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
if(!isset($_SESSION['contador'])){
	$_SESSION['contador'] = 0;
}
$clase = ' column-'.$_SESSION['contador'];
$_SESSION['contador'] ++;
$i = 0;
?>
<div class="column<?php print $clase;?>">
	<?php if (!empty($title)): ?>
		<h3><?php print t($title); ?></h3>
	<?php endif; ?>
	<?php foreach ($rows as $id => $row): ?>
		<?php $clase_last = '';?>
		<?php if($i == 3):?>
			<?php $clase_last = ' last-mercado';?>
			<?php $i = 0;?>
		<?php endif;?>
		<div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id].$clase_last.'"';  } ?>>
			<?php print $row; ?>
		</div>
		<?php $i ++;?>
	<?php endforeach; ?>
</div>
