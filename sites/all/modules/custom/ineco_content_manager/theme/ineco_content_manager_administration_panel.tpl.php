<?php global $user;?>
<?php global $base_url;?>
<?php 
	$preselecciones = array(
		'calidad' => 141,
		'comunicación' => 140,
		'rrhh' => 142,
		'unidad de compras' => 143,
	);
	
	$preseleccion='';
	foreach($user->roles as $role){
		if(isset($preselecciones[$role])){
			$preseleccion = $preselecciones[$role];
			break;
		}
	}
?>
<div class="region region-content">
	<div id="block-system-main" class="block block-system">
		<div class="content">
			<div class="admin clearfix">
				<div class="float-left clearfix">
					<div class="admin-panel">
						<h3><?php print t('My profile');?></h3>
						<div class="body">
							<dl class="admin-list">
								<dt><?php print l(t('Edit access data'), 'user/'.$user->uid.'/edit', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Edit your own access data');?></dd>
							</dl>
						</div>
					</div>
					<div class="admin-panel">
						<h3><?php print t('Content management');?></h3>
						<div class="body">
							<dl class="admin-list">
								<dt><?php print l(t('Manage content'), 'admin/content', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Search, find and manage all the contents present in the site');?></dd>
							</dl>
							<dl class="admin-list">
								<dt><?php print l(t('Forms'), 'admin/content/webform', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Explore all form submissions');?></dd>
							</dl>
							<dl class="admin-list">
								<dt><?php print l(t('Create content'), 'node/add', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Create new contents in the site');?></dd>
							</dl>
							<?php if(user_access('gestion_licitaciones')):?>
							<dl class="admin-list">
								<dt><?php print l(t('Manage tenders'), 'admin/manage-purchases', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Manage all tenders');?></dd>
							</dl>
							<?php endif;?>
						</div>
					</div>
				</div>
				<div class="float-right clearfix">
					<div class="admin-panel">
						<h3><?php print t('Taxonomy');?></h3>
						<div class="body">
							<dl class="admin-list">
								<dt><?php print l(t('Vocabularios y términos'), 'admin/structure/taxonomy', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Manage tagging, categorization and classification of your content');?></dd>
							</dl>
						</div>
					</div>
					<div class="admin-panel">
						<h3><?php print t('Translations');?></h3>
						<div class="body">
							<dl class="admin-list">
								<dt><?php print l(t('Translate'), 'admin/config/regional/translate/translate', array('render' => 'overlay'));?></dt>
								<dd><?php print t('Find and translate strings');?></dd>
							</dl>
						</div>
					</div>
					<?php if(user_access('access dashboard contact request', $user)):?>
						<div class="admin-panel">
							<h3><?php print t('Request contacts');?></h3>
							<div class="body">
								<dl class="admin-list">
									<dt><?php print l(t('Manage request contacts'), 'contact-request-dashboard', array('query' => array('responsible' => $preseleccion)));?></dt>
									<dd><?php print t('Manage and process request contacts');?></dd>
								</dl>
							</div>
						</div>
					<?php endif;?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>