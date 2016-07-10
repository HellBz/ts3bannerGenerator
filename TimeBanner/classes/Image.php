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
		private $imageName;
		
		public function __construct($imageName) {
			$this->imageName = $imageName;
			$this->imageResourceIdentifier = @imagecreatefrompng($this->imageName);
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
		public function getImageName() {
			return $this->imageName;
		}
	}