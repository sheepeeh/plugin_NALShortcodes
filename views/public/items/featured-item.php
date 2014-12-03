<div id="featured-item" style="width:100%;">
<h2>Featured Item</h2>
<div class="item record">
    <?php
    $title = metadata($item, array('Dublin Core', 'Title'),array('snippet' => '75'));
    $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 200));
    ?>
<h3><?php echo link_to($item, 'show', strip_formatting($title)); ?></h3>
<div class="featured-image">
<?php if (metadata($item, 'has files')) {
            echo link_to_item(
                item_image('square_thumbnail', array(), 0, $item),
                array('class' => 'image'), 'show', $item
            );
        }
        ?>
</div>
<?php if ($description): ?>
<p class="item-description"><?php echo $description; ?></p>
<?php endif; ?>
</div>

<div style="float:right;clear:both;margin-bottom:-20px;"><p>
	<?php

        $featuredItems =  get_random_featured_items(5);

        usort($featuredItems, function($a, $b) {
             return $a['id'] - $b['id'];
        });

        $i = 0;
        $positions = array();

        foreach ($featuredItems as $fItem) {
           $positions[$i] = $fItem['id'];
           $num = $i + 1;

           if ($fItem['id'] == $item->id) {

             echo '<a href="' . url('items/browse/items/browse?search=&advanced[0][element_id]=&advanced[0][type]=&advanced[0][terms]=&range=&collection=&type=&user=&tags=&public=&featured=1&exhibit=&submit_search=Search+for+items') . "\">View all " . count($featuredItems) . ' featured items.</a>';
           
            }


           $i += 1;
        }
    ?>

</p></div>
</div>