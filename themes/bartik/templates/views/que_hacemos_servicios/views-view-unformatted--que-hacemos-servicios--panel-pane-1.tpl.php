<?php 
	if ($classes_array[$id]) { 
		$clases = $classes_array[$id];  
	}
?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <div class="<?php print $clases;?> <?php print  "col-".(($id+1) % 3) ?>" >
    <?php print $row; ?>
  </div>
<?php endforeach; ?>