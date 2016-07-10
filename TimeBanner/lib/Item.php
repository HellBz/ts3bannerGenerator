<?php
	/**
	 * This Class is used to store a Object of mixed type and stores an ID with it
	 * So Items can be managed and identified combined with an Array or List
	 * 
	 * @author Sheg Mourway
	 * @copyright
	 * This Class is property of Sheg Mourway
	 * All Rights Reserved 2016
	 */
	class Item {
		private $itemID;
		private $itemName;
		private $object;
		
		public function __construct($itemID, $object, $itemName = null) {
			$this->itemID = $itemID;
			$this->itemName = $itemName;
			$this->object = $object;
		}
		
		/**
		 * Returns the ID of the Item
		 * @return int
		 * Value of type Integer
		 */
		public function getItemID() : int {
			return $this->itemID;
		}
		
		/**
		 * Returns a Nameidentifier of the Item
		 * @return string
		 * Value of type String
		 */
		public function getItemName() {
			return $this->itemName;
		}
		
		/**
		 * Returns the Reference to this Object
		 * @return mixed
		 * Object of type mixed
		 */
		public function getObject() {
			return $this->object;
		}
	}