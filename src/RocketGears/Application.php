<?php
	
	namespace RocketGears;
	
	/**
	 * Application class
	 */
	class Application
	{
		/**
		 * Request path
		 */
		protected $_request = NULL;
		
		/**
		 * Route array
		 */
		protected $_routes = array();



		/**
		 * Run the application
		 * @param Request $request
		 * @return void
		 */
		public function run(Request $request = NULL)
		{
			// If a request object was passed in, use it
			// otherwise create one from current request
			$this->_request = $request ? : new Request($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $_POST, $_GET);

			// Loop through routes and look for a match
			foreach($this->_routes as $route)
			{
			
				if($route->check($this->_request) === TRUE)
				{
					$route->run($this->_request);
					return;
				}
			}
		}


		
		/**
		 * Define a GET route
		 * @param string $path
		 * @param function
		 * @return Route
		 */
		public function get()
		{
			// Get argument array, and push GET
			$arguments = func_get_args();
			$arguments[] = 'GET';
			
			// Create route object (by reference to allow chaining)
			$route = & new Route($arguments);
			
			// Add to route array
			$this->_routes[] = $route;

			// Return reference to route
			return $route;
		}



	}
