<?php
	/**
	 * Initial PHP File
	 * @author Sheg Mourway
	 * @copyright
	 * This Class is property of Sheg Mourway
	 * All Rights Reserved 2016
	 */
	require_once 'classes/ImageManager.php';
	require_once 'lib/ItemList.php';
	require_once 'lib/Item.php';
	require_once 'classes/Image.php';
	
	$imageName;
	$imageX;
	$imageY;
	$imageFont;
	
	if(isset($_GET)) {
		try {
			$imageName = $_GET['name'];
			$imageX = $_GET['axisX'];
			$imageY = $_GET['axisY'];
			$imageFont = $_GET['font'];
			outputImage();
		} catch (Exception $e) {
			echo "An Error occured: " . $e->getMessage();
		}
	} else {
		echo "Missing GET-Parameter";
	}
	
	function outputImage() {
		//Create Objects
		global $imageName, $imageX, $imageY, $imageFont;
		$imgMgr = new ImageManager();
		$imgList = $imgMgr->getImageList();
		$item = $imgList->getItemsByNameMatch($imageName)[0]; //Get first Item in returned list
		$itemRef = $item->getObject();
		$rid = $itemRef->getImageResourceIdentifier();
		$imgMgr->drawTimeStampOnImage($rid, $imageX, $imageY, $imageFont);
		
		
		header("Content-Type: image/png");
		imagepng($rid);
	}