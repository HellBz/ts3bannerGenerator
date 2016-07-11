<?php
	/**
	 * This Class Manages a List of Items
	 * These Items contains References to Objects of type of class Image
	 * 
	 * These Class creates a Bannerrelated Image with a Timestamp on it
	 * 
	 * @author Sheg Mourway
	 * @copyright
	 * This Class is property of Sheg Mourway
	 * All Rights Reserved 2016
	 */
	class ImageManager {
		private $imageList;
		private $templateDirectory;
		private $image;
		
		public function __construct() {
			$this->imageList = new ItemList();
			$this->templateDirectory = "template/";
			$this->prepareImageList();
		}
		
		public function __destruct() {
			unset($this->imageList);
			unset($this->templateDirectory);
			unset($this->image);
		}
		
		/**
		 * Prepares the imagelist and adds all Images from the given Folder
		 */
		private function prepareImageList() {
			foreach(scandir($this->templateDirectory) as $templateFileName) {
				if((strcmp($templateFileName, ".") !== 0) && (strcmp($templateFileName, "..") !== 0)) {
					$this->imageList->addItem(new Image($this->templateDirectory, $templateFileName), $templateFileName);
				}
			}
		}
		
		/**
		 * Returns the Time in HH:MM Format
		 * @return string
		 * Returns value of type String
		 */
		private function GetTimeHHMM() : string {
			$dt = new DateTime();
			return $dt->format("H:i");
		}
		
		/**
		 * Returns a Reference to the Imagelist
		 * @return ItemList
		 * Returns object of type ItemList
		 */
		public function getImageList() {
			return $this->imageList;
		}
		
		/**
		 * Returns the Path to the Templates
		 * @return string
		 * Returns value of type String
		 */
		public function getTemplateDirectory() : string {
			return $this->templateDirectory;
		}
		
		/**
		 * Returns the image Stream from generated Image
		 * @return mixed
		 * Returns Filestream
		 */
		public function getImage() {
			return $this->image;
		}
		
		/**
		 * Draws a String (Time) to the Image given by the parameter $image
		 * @param mixed $image
		 * Accepts Imagestream
		 * @param string $string
		 * Accepts value of type String
		 * @param int $x
		 * Accepts value of type Integer
		 * Represents the X coordinate to draw on
		 * @param int $y
		 * Accepts Value of type Integer
		 * Represents the Y coordinate to draw on
		 */
		public function drawTimeStampOnImage($image, $size, $angle = 0, $x = 0, $y = 0, $fontfile = "Arial.ttf", $text = null, $color = null) {
			$colorImg = imagecreatetruecolor(1, 1);
			$textColor = imagecolorexact($colorImg, 255, 255, 255);
			
			
			imagefttext($image, $size, $angle, $x, $y, ($color === null) ? $textColor : $color, "./fonts/" . $fontfile, ($text === null) ? $this->GetTimeHHMM() : $text);
			
			//imagestring($image, $font, $x, $y, ($string !== NULL) ? $string : $this->GetTimeHHMM(), $textColor);
		}
		
		/**
		 * Outputs the generated Image to the Caller
		 */
		public function getImageOutputStream() {
			//Send Modified Header
			header("Content-Type: image/png");
			
			//Output Image and destroy the Stream
			imagepng($this->image);
			imagedestroy($this->image);
		}
	}