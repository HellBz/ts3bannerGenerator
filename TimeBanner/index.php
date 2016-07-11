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
			$fontsize = $_GET['size'];
			$angle = $_GET['angle'];
			$x = $_GET['x'];
			$y = $_GET['y'];
			//$color = $_GET['color'];
			$font = $_GET['font'];
			outputImage();
		} catch (Exception $e) {
			echo "An Error occured: " . $e->getMessage();
		}
	} else {
		echo "Missing GET-Parameter";
	}
	
	function outputImage() {
		//Create Objects
		global $imageName, $fontsize, $angle, $x, $y, $color, $font;
		$imgMgr = new ImageManager();
		$imgList = $imgMgr->getImageList();
		$item = $imgList->getItemsByNameMatch($imageName)[0]; //Get first Item in returned list
		$itemRef = $item->getObject();
		$image = $itemRef->getImageResourceIdentifier();
		$imgMgr->drawTimeStampOnImage($image, $fontsize, $angle, $x, $y, $font);
		
		
		header("Content-Type: image/png");
		imagepng($image);
	}