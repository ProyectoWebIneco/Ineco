<?php
// 	print "<pre>";
// 	print_r($from);
// 	print "</pre>";


// 	print "<pre>";
// 	print_r($result);
// 	print "</pre>";


	global $base_url;
?>

<div class="ajax-search">
	
	<form action="<?php print $url_search; ?>" method="get">
		<div>
			<input type="text" id="ajax-search-input" class="ajax-search-input" name="keys"  size="100" value="<?php print $value; ?>"/>
			<input class="btn-buscar" type="submit" value="<?php print t("Buscar"); ?>" />
		</div>
	</form>
	
	<div id="ajax-search-results" style="display:none">
		
	
	</div>
</div>
