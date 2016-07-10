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
	
	//Create Objects
	$imgMgr = new ImageManager();
	$imgList = $imgMgr->getImageList();
	$item = $imgList->getItemByID(0);
	$itemRef = $item->getObject();
	$rid = $itemRef->getImageResourceIdentifier();

	
	header("Content-Type: image/png");
	imagepng($rid);