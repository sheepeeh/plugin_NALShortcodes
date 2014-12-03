 <div id="recent-items">

<h2><?php echo __('Items in the Collection'); ?></h2>
    <ul class="items-list">
        <?php asort($collections); ?>
        <?php foreach ($collections as $collection): ?>
            <?php set_current_record('collection',$collection); ?>
             <?php if (metadata($collection, 'total_items') > 0): ?>
            <?php 
                $cid = metadata($collection,'id');
                set_loop_records('items',get_item_obj(array('sort_field' => 'random', 'collection' => $cid, 'type' => 'Text' )),1);
            ?>
            <?php foreach (loop('items') as $item): ?>
                <li class="item">
                    <?php if (metadata('item', 'has thumbnail')): ?>
                        <?php echo files_for_item(array('item_image' => 'square_thumbnail', 'imgAttributes' => array('alt' => 'Thumbnail for the first content page of the item, linking to the full file.' ))); ?>
                    <?php endif; ?>
                    <h3><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title'), array('snippet'=>100)), array('class'=>'permalink')); ?></h3>
                    <?php preg_match('/(Series.*)(\:)/',metadata('collection',array('Dublin Core','Title')),$series); 
                    $series = str_replace(":",'',$series[0]); ?>
                    <p style="font-style:italic;font-size:0.96em;text-align:right;clear:both;">This item appears in <?php echo "<a href=\"" . url('/collections/show/') . $cid . "\">" . $series . "</a>"; ?></p>
                </li>
             
            <?php endforeach; ?>
            <?php endif; ?> 
            <?php release_object($collection); ?>
        <?php endforeach; ?></ul>
        <p style="text-align:right;"><a href="<?php echo url('items/browse'); ?>">View All Items</a></p>
    </div>

