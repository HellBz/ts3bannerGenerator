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
	$f = new ImageManager();
	$fl = $f->getImageList();
	$fl->addItem(new Image("template/template.png"), 0);
	$fitem = $fl->getItemByKey(0)->getObject();
	$frid = $fitem->getImageResourceIdentifier();
	//print_r($fitem);
	
	header("Content-Type: image/png");
	imagepng($frid);