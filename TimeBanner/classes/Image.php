<?php
	/**
	 * This Class is used to store and manage Images
	 * Their Paths and their Filestreams can be stored and called with specific methods
	 * 
	 * @author Sheg Mourway
	 * @copyright
	 * This Class is property of Sheg Mourway
	 * All Rights Reserved 2016
	 */
	class Image {
		private $imageResourceIdentifier;
		private $imageFileName;
		private $imageFilePath;
		
		public function __construct($imageFilePath, $imageFileName) {
			$this->imageFileName = $imageFileName;
			$this->imageFilePath = $imageFilePath;
			$this->imageResourceIdentifier = @imagecreatefrompng($this->imageFilePath.$this->imageFileName);
		}
		
		/**
		 * Returns the Filestream of $image
		 * @return mixed
		 * Object of type Filestream
		 */
		public function getImageResourceIdentifier() {
			return $this->imageResourceIdentifier;
		}
		
		/**
		 * Returns the Imagename as String
		 * @return string
		 * Value of type String
		 */
		public function getImageFileName() {
			return $this->imageFileName;
		}
		
		/**
		 * Returns the Path to the Imagefile as String
		 * @return string
		 * Value of type String
		 */
		public function getImagePath() {
			return $this->imageFilePath;
		}
	}