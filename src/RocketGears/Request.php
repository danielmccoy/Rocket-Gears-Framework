<?php

	namespace RocketGears;
	
	/**
	 * Request class
	 */
	class Request extends Base
	{
		/**
		 * Path
		 */
		protected $_path = NULL;

		/**
		 * Verb
		 */
		protected $_verb = NULL;


		
		/**
		 * Create a request object
		 * @param string $verb
		 * @param string $path
		 * @param array $post
		 * @param array $get
		 * @return void
		 */
		function __construct($verb, $path)
		{
			$this->_verb = self::isValidVerb($verb) ? $verb : NULL;
			$this->_path = self::isValidPath($path) ? $path : NULL;
		}



		/**
		 * Get the path
		 * @return string
		 */
		public function getPath()
		{
			return ($this->_path == '/') ? '/' : rtrim($this->_path, '/');
		}



		/**
		 * Get the verb
		 * @return string
		 */
		public function getVerb()
		{
			return $this->_verb;
		}



	}
