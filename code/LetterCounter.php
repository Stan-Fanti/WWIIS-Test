<?php
	// This Class handles all the necessary functions for counting the appearance of letters in a certain string.
	class LetterCounter {
		// Dictionary is our array that associates each letter with their number of recurrences.
		// Marker is the symbol we mean to use in our output for how many times a letter appears.
		private $dictionary, $marker;

		// Our object starts out with * as a marker, and an empty array for a dictionary.
		function __construct(){
			$this->setMarker("*");
			$this->resetDictionary();
		}

		/*The main function of the object, and the only one that can be called by the user.
			It takes a single string parameter and returns a string containing each 
			case-insensitive letter in the parameter followed by a colon and an asterisk 
			for each occurrence of the letter, separated by a commas, with no spaces. */ 
		public function countLettersInString($string){
			// We split the input string into each individual character, sorted in an array.
			$stringArray = str_split(strtolower($string));

			// We run through each character in the string.
			foreach($stringArray as $char){
				// If it is a letter, then we add it to our dictionary, and keep track of its appearances.
				if(ctype_alpha($char)){
					$this->addDictionary($char);
				}
			}

			$dict = $this->getDictionary();
			$out = "";

			/* We print every item in our dictionary.
				First we print the "key" of each array item, in our case that is the letter itself.
				Then we repeat our marker the same number of times as are registered in the index value. */
			while ($repetitions = current($dict)) {
				$out .= key($dict) . ":" . str_repeat($this->getMarker(), $repetitions) . ",";
				next($dict);
			}

			// We reset our dictionary and return our final string (minus the final comma).
			$this->resetDictionary();
			return rtrim( $out, ', ');
		}

		//Add element to our dictionary
		private function addDictionary($key){
			$dict = $this->getDictionary();

			// If this letter has already appeared in the string:
			if(array_key_exists($key, $dict)){
				// We add 1 to the number of recurrences.
				$dict[$key] = $dict[$key]+1;
			// Otherwise, if it's the first time this letter appears:
			} else {
				// We create a new item in the array, with value 1.
				$dict[$key] = 1;
			}

			// We update the dictionary.
			$this->setDictionary($dict);
		}

		// Set the value of marker
		private function setMarker($mark) {
				$this->marker = $mark;
		}

		//Get the value of marker
		private function getMarker() {
				return $this->marker;
		}

		//Set the value of dictionary
		private function setDictionary($array){
			$this->dictionary = $array;
			return $this;
		}

		//Reset the dictionary to an empty array
		private function resetDictionary(){
			$this->dictionary = array();
			return $this;
		}

		// Get the value of dictionary
		private function getDictionary(){
			return $this->dictionary;
		}
	}
?>