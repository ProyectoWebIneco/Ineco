<?php global $base_url; ?>

<?php

function getBrowser(){ 

    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){ 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)){ 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)){ 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)){ 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)){ 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)){ 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '/(' . join('|', $known) .')[\ ]+([0-9.|a-zA-Z.]*)/';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

$matches['browser'] = $matches[1];
$matches['version'] = $matches[2];
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {
	$version="?";
    }

    return array('bname' => $bname, "bversion" => $version);
}

$browser = getBrowser();

$video_url = file_create_url($node->field_video_file['und'][0]['uri']);
if(isset($node->field_video_file_link['und'])){
	$video_url = $node->field_video_file_link['und'][0]['url'];
}
?>

<div class="video">
	<div class="video-video">
		<div class="field field-name-field-video-file field-type-file field-label-hidden">
			<div class="field-items">
				<div class="field-item even">
					<div class="mediaelement-video">
<?php
	$show_flash = ($browser['bname'].' '.$browser['bversion'] != 'Internet Explorer 9.0');
	$show_flash = $show_flash || ($browser['bname'].' '.$browser['bversion'] != 'Internet Explorer 10.0');
	$show_flash = $show_flash || ($browser['bname'] == 'Apple Safari');
?>

						<?php if($browser['bname']  == 'Internet Explorer' && ($browser['bversion'] == '?' || $browser['bversion'] == '8.0' || $browser['bversion'] == '6.0' || $browser['bversion'] == '7.0')):?>
<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" width="640" height="385">
<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
<param name="allowFullScreen" value="true" />
<param name="wmode" value="transparent" />
<param name="flashVars" value="config={'playlist':['<?php print $base_url .'/'. path_to_theme();?>/flowplayer/ineco.jpg',{'url':'<?php print $video_url;?>','autoPlay':true}]}" />
<img alt="<?php print $node->title;?>" src="<?php print $base_url .'/'. path_to_theme();?>/flowplayer/ineco.jpg" width="640" height="385" title="<?php print t('No video playback capabilities, please download the video below');?>" />
</object>
						<?php elseif(!$show_flash):?>
<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" width="640" height="385">
<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
<param name="allowFullScreen" value="true" />
<param name="wmode" value="transparent" />
<param name="flashVars" value="config={'playlist':['<?php print $base_url .'/'. path_to_theme();?>/flowplayer/ineco.jpg',{'url':'<?php print $video_url;?>','autoPlay':true}]}" />
<img alt="<?php print $node->title;?>" src="<?php print $base_url .'/'. path_to_theme();?>/flowplayer/ineco.jpg" width="640" height="385" title="<?php print t('No video playback capabilities, please download the video below');?>" />
</object>
						<?php else:?>
							<video controls autoplay src="<?php print $video_url;?>" 
								class="mediaelement-formatter-identifier-1377964613-0 mediaelement-processed" 
								height="385" width="640">
							</video>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if(isset($node->field_video_subtitle['und'][0]['safe_value']) && $node->field_video_subtitle['und'][0]['safe_value'] != ''):?>
		<div class="video-title">
			<?php print $node->field_video_subtitle['und'][0]['safe_value']; ?>
		</div>
	<?php endif; ?>
</div>
