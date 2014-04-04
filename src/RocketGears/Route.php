<?php 

	namespace RocketGears;
	
	/**
	 * Route class
	 */
	class Route extends Base
	{
		/**
		 * Array of constraints
		 */
		protected $_constraints = array(); // [name] => pattern
	
		/**
		 * Array of verbs
		 */
		protected $_verbs = array(); // [] => verb
	
		/**
		 * Route path
		 */
		protected $_path = NULL;
	
		/**
		 * Route function
		 */
		protected $_function = NULL;
		
		/**
		 * Pattern object
		 */
		protected $_pattern = NULL;
	
	
	
		/**
		 * Construct route
		 * @param array $arguments
		 */
		public function __construct($arguments)
		{
			// [0] => path
			// [1] => function
			// [2] => verb
			if(is_string($arguments[0]) && strlen($arguments[0]) > 0 && is_callable($arguments[1]) && self::isValidVerb($arguments[2]))
			{
				// Set path
				$this->_path = $arguments[0];
	
				// Set function
				$this->_function = $arguments[1];
	
				// Set verb
				$this->_verbs[] = $arguments[2];
			}
		}
		
		
		
		/**
		 * Check if the route matches a request
		 * @param Request $request
		 * @return bool
		 */
		public function check(Request $request)
		{
			// Check that the verb and pattern matches
			return (in_array($request->getVerb(), $this->_verbs) && $this->runPattern($request)->isMatch());
		}
	
	
	
		/**
		 * Run route function
		 * @param Request $request
		 * @return void
		 */
		public function run(Request $request)
		{
			// Check that this route matches the request
			if($this->check($request))
			{
				// Call user supplied route function
				call_user_func_array($this->_function, $this->runPattern($request)->getResults());
			}
		}
	
	
	
		/**
		 * Build regex pattern for path
		 * @param Request $request
		 * @return stdClass
		 */
		protected function runPattern(Request $request)
		{
			// Check if this pattern has already been run
			if($this->_pattern !== NULL)
			{
				return $this->_pattern;
			}
		
			// Start building pattern
			$pattern = "#^{$this->getPath()}$#";
			
			// Fill in constraint patterns
			foreach($this->_constraints as $name => $expression)
			{
				$pattern = str_replace('{'.$name.'}', "({$expression})", $pattern);
			}
			
			// Look for generic patterns
			if(preg_match_all('/\{([_a-z]+)\}/', $pattern, $matches))
			{
				foreach($matches[0] as $match)
				{
					$pattern = str_replace($match, "([^/]+)", $pattern);
				}
			}

			// Check for matches
			$this->_pattern = new RoutePattern;
			if(preg_match($pattern, $request->getPath(), $matches))
			{
				// Remove path from match array
				array_shift($matches);
				
				$this->_pattern->setResults($matches);
				$this->_pattern->setMatch(TRUE);
			}
		
			// Pattern
			return $this->_pattern;
		}
	
	
	
		/**
		 * Get the path
		 * @return string
		 */
		public function getPath()
		{
			return ($this->_path === NULL) ? '' : '/' . trim($this->_path, '/');
		}
	
	
	
		/**
		 * Add a route parameter constraint
		 * @param string $name
		 * @param string $expression
		 * @return Route
		 */
		public function where($name, $expression)
		{
			if(is_string($name) && is_string($expression))
			{
				$this->_constraints[$name] = $expression;
			}
	
			return $this;
		}
	
	
	
	}
