<?php

	namespace RocketGears;
	
	/**
	 * Route pattern class
	 */
	class RoutePattern
	{
		/**
		 * Result array
		 */
		protected $_results = array();

		/**
		 * Match was found
		 */
		protected $_match = FALSE;



		/**
		 * Set result array
		 * @return array
		 */
		public function setResults($results)
		{
			return $this->_results = (is_array($results) ? $results : array());
		}



		/**
		 * Set result array
		 * @return array
		 */
		public function setMatch($match)
		{
			return $this->_match = (is_bool($match) ? $match : FALSE);
		}



		/**
		 * Get result array
		 * @return array
		 */
		public function getResults()
		{
			return $this->_results;
		}
		

		
		/**
		 * Get match flag
		 * @return bool
		 */
		public function isMatch()
		{
			return $this->_match;
		}	


	
	}
