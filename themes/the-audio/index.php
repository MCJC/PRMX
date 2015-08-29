<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>

<div id="primary">
	<?php if ($homepageText = get_theme_option('Homepage Text')): ?>
		<div id="homepage-text">
    		<p><?php echo $homepageText; ?></p>
		</div>
    <?php endif; ?>
	
	<!-- Main Image -->
	<?php if (get_theme_option('photo')):;?>
		<div id="main_image">
			<img src="<?php echo absolute_url('files/theme_uploads/'.get_theme_option('photo'));?>">
		</div>
	<?php endif;?>

    <!-- Featured Collection -->
    <?php $collections=get_records("collection", array("public"=>"true","featured"=>"true"));
	if (get_theme_option('content') === 'collection' && $collections != null):?>
    	<div id="featured-collection">
			<?php $current_collection=end($collections);?>
			<h2><?php echo metadata($current_collection, array('Dublin Core', 'Title'));?></h2>
			<p><?php echo metadata($current_collection, array('Dublin Core', 'Description'));?></p>
    	</div>
		<div id="image_slider">
			<?php $image_uris=array();
			$image_thumbnails=array();
			$items=get_records("item", array("collection"=>$current_collection),200);
			foreach ($items as $item){			
				foreach($item->Files as $file) {
					if ($file->hasThumbnail()):
						array_push($image_uris, metadata($file, 'uri'));
						array_push($image_thumbnails, metadata($file, 'square_thumbnail_uri'));
					endif;}}?>
				<?php if ($image_uris != null):?>
					<h2><?php echo __('Collection Images'); ?></h2>
					<div id="lesphotos">
					<?php foreach (array_combine($image_uris, $image_thumbnails) as $uri => $thumbnail) {
						echo "<a href=". $uri . "><img src=". $thumbnail ."></a>";}?>
					</div>
					<?php endif?>
		</div>
	<?php elseif (get_theme_option('content') === 'collection' && $collections == null):?>
		<div>
			<p>No featured collections are available. Add a featured collection or go to "Appearance"->"Configure Theme"->"Home Page Content" to choose another content source.</p>
		</div>		
    <?php endif; ?>
	<!-- end featured collection -->
	
	<!-- Recent Items -->
		<?php if (get_theme_option('content') === 'items'): ?>
    <div id="recent-items">
        <h2><?php echo __('Recent Items'); ?></h2>
        <?php 
        $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
        set_loop_records('items', get_recent_items($homepageRecentItems));
        if (has_loop_records('items')): 
        ?>
        <ul class="items-list">
        <?php foreach (loop('items') as $item): ?>
        <li class="item">
            <h3><?php echo link_to_item(); ?></h3>
            <?php if($itemDescription = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                <p class="item-description"><?php echo $itemDescription; ?></p>
            <?php endif; ?>						
        </li>
        <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p><?php echo __('No recent items available.'); ?></p>
        <?php endif; ?>
        <p class="view-items-link"><?php echo link_to_items_browse(__('View All Items')); ?></p>
		<?php endif; ?>
    </div><!-- end recent-items -->

<div>
	<audio class="projekktor speakker dark">
	</audio>
</div>

<?php echo foot(); ?>