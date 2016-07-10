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
			$this->templateDirectory = "template/";
			$this->imageList = new ItemList();
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
				$this->imageList->addItem(new Image($templateFileName));
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
		
		public function generatePictureWithWatermark() {
			$watermark = imagecreatefrompng("stamp/watermark.png");
			$wmX = imagesx($watermark);
			$wmY = imagesy($watermark);
		
				
			imagecopy($this->imgOutputStreamStream,
					$watermark,
					imagesx($this->imgOutputStreamStream) - $wmX - 16,
					imagesy($this->imgOutputStreamStream) - $wmY - 16,
					0, 0, imagesx($watermark), imagesy($watermark));
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