<?php

function get_speaker_playlist()
{
	$collections=get_records("Collection", array("public"=>"true","featured"=>"true"));
	$current_collection=end($collections);
	$items=get_records("Item", array("collection"=>$current_collection),50);
	$playlist = array();
	foreach ($items as $item) {
	    $titleMetadata = metadata($item, array('Dublin Core', 'Title'));
	    foreach ($item->Files as $file) {
	        $sourceMetadata = metadata($file, 'uri');
	        $imageMetadata = metadata($file, 'square_thumbnail_uri');
	        if ($file->getExtension() == 'mp3') {
	            $playlist[] = array(
	                '0' => array('src' => $sourceMetadata, 'type' => 'audio/mp3'),
	                'config' => array('title' => $titleMetadata, 'poster' => $imageMetadata)
	            );
	        }
	}       
}

$jsonPlaylist = json_encode($playlist);
$string = '$(document).ready(function() {projekktor(".projekktor").setFile(' . $jsonPlaylist . ');});';
queue_js_string($string);
}

function get_items_with_images() 
{$items=get_records("Item", array("collection"=>$current_collection));
$num=0;
foreach ($items as $item){			
	
		foreach($item->Files as $file) {
			if ($file->hasThumbnail()):?>
		<a href="<?php echo metadata($file, 'uri');?>"><img src="<?php echo metadata($file, 'square_thumbnail_uri');?>"></a>
	<?php endif;}
	$num++;}
}
