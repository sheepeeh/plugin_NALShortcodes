<?php
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
    <?php if ($exhibitDescription = metadata($exhibit, 'description', array('no_escape' => true, 'snippet' => 500))):

    $exhibitDescription = preg_replace('/Search\sthis\sExhibit/' ,'', $exhibitDescription);
    $exhibitDescription = preg_replace('/\[exhibit_search\s.*\]/' ,'', $exhibitDescription);
    $exhibitDescription = preg_replace('/\[build_url.*\]/' ,'', $exhibitDescription);
    $exhibitDescription = preg_replace('/View\sall\sitems\sin\sthis\sexhibit./' ,'', $exhibitDescription);
    $exhibitDescription = preg_replace('/View\sall\sitems\sin\sthe.*\./' ,'', $exhibitDescription);
 ?>
        <p><?php echo $exhibitDescription; ?></p>
    <?php endif; ?>
</div>