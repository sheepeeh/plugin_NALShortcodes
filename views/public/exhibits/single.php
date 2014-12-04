<?php
	// Determine what level heading to use.
	$h = 3;
	$dclass = '';

	if (isset($body_class)) {
		if ($body_class == "simple_pages_page") {
			$h = 2;
			$dclass = 'exhibits browse';
		}
	}

	$h_tag = "<h$h>";
	$h_end = "</h$h>";

	$exhibitTitle = metadata($exhibit,'title');
	?>

<div class="exhibit record <?php echo $dclass; ?>">
    <?php if (strpos($exhibitTitle,"Merrigan") == false): ?>
		<?php echo $h_tag; ?><?php echo exhibit_builder_link_to_exhibit($exhibit); ?><?php echo $h_end; ?>
	    <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
    	    <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
    	<?php endif; ?>
	<?php else: ?>
	    <?php echo $h_tag . "<a href=\"" . url("/merrigan") . "\" target=\"_blank\">Dr. Kathleen Merrigan Collection" . "</a>$h_end"; ?>
	    <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
    	     <?php echo  "<a href=\"" . url("/merrigan") . "\" target=\"_blank\" class=\"image\">" . $exhibitImage . "</a>"; ?>
	    <?php endif; ?>
    <?php endif; ?>
    <?php if ($exhibitDescription = metadata($exhibit, 'description', array('no_escape' => true, 'snippet' => 750))):

    		//Replace junk in descriptions (unparsed shortcodes, etc)
    
            $patterns = array('/Search\sthis\sExhibit/',
                '/Search\sthis\sExhibit/',
                '/\[exhibit_search\s.*\]/',
                '/\[build_url.*\]/',
                '/View\sall\sitems\sin\sthis\sexhibit./', 
                '/View\sall\sitems\sin\sthe.*\./',
                '/View\sall\sitems\sin\sthe.*\./'
                );

            $exhibitDescription = preg_replace($patterns ,'', $exhibitDescription);
            
            $words = explode(' ',trim($exhibitDescription));
            $words2 = explode("\r\n",trim($words[0]));

            if ($words2[0] == "Introduction") { 
                $exhibitDescription = preg_replace('/Introduction/','', $exhibitDescription,1);
            }
 ?>
        <p><?php echo $exhibitDescription; ?></p>
    <?php endif; ?>
</div>