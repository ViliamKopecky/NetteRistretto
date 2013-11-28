<?php

/**
 * Ristretto
 * @author Viliam Kopecký
 * @license WTFPL (http://en.wikipedia.org/wiki/WTFPL)
 *
 * use in bootstrap.php:
 * Ristretto::register($port, $container->application);
 *
 * use in config.neon:
 * extensions:
 *	ristretto: Ristretto\Extension
 *		port: 8000
 * 
 */

require_once __DIR__ . '/Ristretto/ResponseSnippet.php';

use	Nette\Application\Application;

class Ristretto {
	public static function register($port, Application $application) {
		return new Ristretto\ResponseSnippet($port, $application);
	}
}