<?php

/**
 * Ristretto Debug bar panel
 * @author Viliam Kopecký
 * @license WTFPL (http://en.wikipedia.org/wiki/WTFPL)
 *
 * use in Nette app:
 * Ristretto::register($container, $port = 2013);
 * 
 */

use	Nette\Utils\Strings;

class Ristretto extends Nette\Object {

	private static $instance;
	private static $disable = false;
	public static $port;
	private $container;

	public static function register($container, $port = 2013) {
		self::$port = $port;
		self::$instance = new self($container);
		if(!empty($container->parameters['ristretto'])) {
			$container->application->onShutdown[] = callback(self::$instance, 'renderSnippet');
		}
	}

	function __construct(\SystemContainer $container) {
		$this->container = $container;
	}

	private function shouldWeShowRistretto() {
		if(self::$disable)
			return false;

		$allowedContentTypes = array(
			'text/html',
			'application/xhtml'
		);

		$headers = headers_list();
		foreach($headers as $header) {
			foreach($allowedContentTypes as $act) {
				if(Strings::startsWith($header, 'Content-Type: '.$act)) {
					return true;
				}
			}
		}
	}

	public function renderSnippet($app) {
		if($this->shouldWeShowRistretto()) {
			echo '<script>(function(){var s=document.createElement("script");s.setAttribute("src", "http://"+location.hostname+":'.self::$port.'/ristretto.js");document.getElementsByTagName("body")[0].appendChild(s);void(s);})();</script>';
		}
	}
}