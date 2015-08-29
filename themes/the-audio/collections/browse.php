<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyid'=>'collections','bodyclass' => 'browse'));
?>

<h1><?php echo $pageTitle; ?></h1>
<?php echo pagination_links(); ?>

<?php foreach (loop('collections') as $current_collection): ?>
	
<div class="collection">
	
	<div class="collection_image">
		<?php $items=get_records("Item", array("collection"=>$current_collection));
		$images=array();
		$thumbnails=array();
		foreach ($items as $item){			
				foreach($item->Files as $file) {
					if ($file->hasThumbnail()):
						array_push($images, metadata($file, 'uri'));
						array_push($thumbnails, metadata($file, 'square_thumbnail_uri'));
					endif;}
		}?>
		<?php if ($images != null):?>
			<a href="<?php echo $images[1]?>"><img src="<?php echo $thumbnails[1]?>"></a>
		<?php endif;?>
	</div>
	<div class="collection_data">
    <h2><?php echo link_to_collection(); ?></h2>

    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
    <div class="element">
        <h3><?php echo __('Description'); ?></h3>
        <div class="element-text"><?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?></div>
    </div>
    <?php endif; ?>
    
    <?php if ($current_collection->hasContributor()): ?>
    <div class="element">
        <h3><?php echo __('Contributors(s)'); ?></h3>
        <div class="element-text">
            <p><?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></p>

    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $current_collection)); ?>
</div>

</div><!-- end class="collection" -->
<?php fire_plugin_hook('public_collections_browse', array('collections'=>$current_collection, 'view' => $this)); ?>

<?php endforeach; ?>

<?php echo pagination_links(); ?>


<?php echo foot(); ?>