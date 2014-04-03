<?php

	namespace RocketGears;

	/**
	 * Base class
	 */
	abstract class Base
	{
		/**
		 * Validate that a string looks like a valid path
		 * @param string $path
		 * @return bool
		 */		
		static function isValidPath($path)
		{
			return (is_string($path) && $path{0} == '/');
		}



		/**
		 * Check if a verb is valid
		 * @param string
		 * @return bool
		 */
		static function isValidVerb($verb)
		{
			return in_array($verb, array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH'));
		}	



	}
