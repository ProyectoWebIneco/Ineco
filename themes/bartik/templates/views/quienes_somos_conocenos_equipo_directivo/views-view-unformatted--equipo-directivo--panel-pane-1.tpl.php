<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
$level = ($title % 2 == 0)? 'x' : 'y';
?>
<?php $orden = array();?>
<?php foreach ($rows as $row): ?>
	<?php $node = node_load(intval($row));?>
  <?php /*print_r($row); die();*/ ?>
	<?php $order = field_get_items('node',$node,'field_people_order')?>
	<?php $order = reset($order);?>
	<?php $orden[] = $order['value'];?>
<?php endforeach; ?>

<?php foreach ($orden as $key=>&$order): //Hacemos esto para que si hay elementos con el mismo orden los ponga seguidos?>
	<?php $next = ++$key;?>
	<?php $prev = $key--;?>
	<?php if( isset($orden[$next])):?>
		<?php $order == $orden[$next] ? $orden[++$key]=$orden[$next]+1:0;?>
	<?php endif;?>
<?php endforeach;?>

<?php $max = max($orden);?>

<div class="row-level-<?php print $level; ?>">
	<?php $i = 0;?>
	<?php $id = array_keys($rows);?>
	<?php $id = reset($id);?>
	
	<?php while($i <= $max):?>
		<?php if(in_array($i, $orden)):?>
			<div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
			 	<?php $teaser = node_view(node_load(intval($rows[$id])), 'teaser'); ?>
			 	<?php print render($teaser); ?>
		  	</div>
		  	<?php $id++?>
		<?php else:?>
			<div class="empty-equipo-directivo"></div>	
		<?php endif;?>
		<?php $i++;?>
			
	<?php endwhile;?>
	
</div>