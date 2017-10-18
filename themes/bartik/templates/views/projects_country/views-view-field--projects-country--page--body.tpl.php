<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
$node = node_load($row->nid);
$ps = array();
$count = preg_match_all('/<p[^>]*>(.*?)<\/p>/is', $output, $matches);
$str = strip_tags($matches[0][0]);
$last = $str[strlen($str)-1];

if($node->type == 'project'){
	if($last == '.'){
		$str = substr($str, 0, strlen($str)-1);
		$str = $str.' ...';
	}else{
		$str = $str.' ...';
	}
}else{

}
?>
<?php if($node->type == 'project'):?>
	<p class="MsoNormal">
		<span lang="ES-TRAD" xml:lang="ES-TRAD">
			<?php print $str.'&nbsp;'.l('[+info]', 'node/'.$row->nid, array('attributes' => array('class' => 'mas-info-donde-estamos'))); ?>
		</span>
	</p>
<?php else:?>
	<p class="MsoNormal">
		<span lang="ES-TRAD" xml:lang="ES-TRAD">
			<?php print $str; ?>
		</span>
	</p>
<?php endif;?>
