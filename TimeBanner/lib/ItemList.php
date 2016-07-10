<?php
	/**
	 * This Class is used to create and maintane a organized List of objects
	 * These objects can be selected by their IDs or by their Key from the Array
	 * 
	 * @author Sheg Mourway
	 * @copyright
	 * This Class is property of Sheg Mourway
	 * All Rights Reserved 2016
	 */
	class ItemList {
		//Saves an object of type Item in the $arrayList
		private $itemList;
		//Saves the actual Count of Items in the $arrayList
		private $itemListCount;
		
		/**
		 * Creates a List of Items
		 * Each Item has an ID beginning with the ID 0
		 */
		public function __construct() {
			$this->itemList = array();
			$this->itemListCount = $this->countItemList();
		}
		
		public function __destruct() {
			unset($this->itemList);
			unset($this->itemListCount);
		}
		
		/**
		 * Counts all Items of the $arrayList and returns this value.
		 * @return int
		 * Value of type Integer
		 */
		private function countItemList() : int {
			return count($this->itemList);
		}
		
		/**
		 * Is Called whenever an Item is added or removed from the List
		 */
		private function itemListChanged() {
			$this->itemListCount = $this->countItemList();
		}
		
		/**
		 * Returns the value of $itemListCount
		 * @return int
		 * Value of type Integer
		 */
		public function getCount() : int{
			return $this->itemListCount;
		}
		
		/**
		 * Returns an Array with all saved Item IDs
		 * @return NULL[]
		 * Array of all IDs of the List
		 */
		public function getItemIDList() {
			$itemIDList = array();
			foreach($this->itemList as $item) {
				$itemIDList[] = $item->getItemID();
			}
			return $itemIDList;
		}
		
		/**
		 * Adds an item to the list $itemList
		 * @param unknown $object
		 * Accepts object of all types
		 * @param mixed $key
		 * Accepts values of type Integer or String
		 */
		public function addItem($object, $key = null) {
			if(isset($key)) {
				$this->itemList[$key] = new Item($this->itemListCount, $object);
			} else {
				$this->itemList[] = new Item($this->itemListCount, $object);
			}
			$this->itemListChanged();
		}
		
		/**
		 * Removes given Item from parameter $object from List
		 * If Item can't be found method returns NULL
		 * @param unknown $object
		 * Accepts object of all types
		 * @return mixed
		 * Returns 0 if Item was removed successfully or FALSE if an Error occured
		 */
		public function removeItem(Item $object) {
			foreach($this->itemList as $item) {
				if($item === $object) {
					unset($this->itemList[key($this->itemList)]);
					$this->itemListChanged();
					return 0;
				}
			}
			return FALSE;
		}
		
		/**
		 * Removes Item by given ID from parameter $id
		 * @param int $id
		 * Accepts value of Integer
		 * @return mixed
		 * Returns either 0 if successfull or FALSE if no Item with given ID was found
		 */
		public function removeItemByID($id) {
			foreach($this->itemList as $item) {
				if($item->getItemID() === $id) {
					unset($this->itemList[key($this->itemList)]);
					$this->itemListChanged();
					return 0;
				}
			}
			return FALSE;
		}
		
		public function removeItemByKey($key) {
			if(isset($this->itemList[$key])) {
				unset($this->itemList[$key]);
			} else {
				throw new Exception("Invalid key $key!");
			}
		}
		
		
		/**
		 * Removes all Items from the List
		 */
		public function removeAllItems() {
			foreach($this->itemList as $item) {
				unset($this->itemList[key($this->itemList)]);
			}
		}
		
		/**
		 * ID of the wanted Item
		 * @param unknown $id
		 * Accepts value of type Integer
		 * @return mixed
		 * Returns either the Key pointing to the Item or NULL if no such Item could be found
		 */
		public function getItemKeyByID($id) {
			foreach($this->itemList as $item) {
				if($item->getItemID() === $id) {
					return key($this->itemList);
				}
			}
			return NULL;
		}
		
		/**
		 * Key of the Wanted Item
		 * @param unknown $key
		 * Accepts either value of type String or Integer
		 * @return mixed
		 * Returns either the Reference of wanted Object throws an KeyInvalidException if no such object could be found
		 */
		public function getItemIDByKey($key) {
			if(isset($this->itemList[$key])) {
				return $this->itemList[$key]->getItemID();
			} else {
				throw new Exception("Invalid key $key!");
			}
		}
		
		/**
		 * Key of the wanted Item
		 * @param unknown $key
		 * Accepts either value of type String or Integer
		 * @return mixed
		 * Returns either the Reference of wanted Object or throws a KeyInvalidException if no such object could be found
		 */
		public function getItemByKey($key) {
			if(isset($this->itemList[$key])) {
				return $this->itemList[$key];
			} else {
				throw new Exception("Invlid key $key");
			}
		}
		
		/**
		 * ID of the wanted Item
		 * @param unknown $id
		 * Accepts value of type Integer
		 * @return mixed
		 * Returns either the Reference of wanted Object or NULL if no such object could be found
		 */
		public function getItemByID($id) {
			foreach($this->itemList as $item) {
				if($item->getItemID() === $id) {
					return $item;
				}
			}
			return NULL;
		}
	}