<?php

/**
 * Ristretto\ResponseSnippet
 * @author Viliam Kopecký
 * @license WTFPL (http://en.wikipedia.org/wiki/WTFPL)
 */

namespace Ristretto;

use	Nette\Object;
use	Nette\Application\Application;
use	Nette\Diagnostics\Debugger;
use Nette\Utils\Strings;

class ResponseSnippet extends Object {

	private static $instance;

	private $disable = false;
	public $port;
	private $application;

	function __construct($port, Application $application, $config_filepath = null) {
		$this->port = $port;
		$this->application = $application;
		$application->onShutdown[] = callback($this, 'renderSnippet');
		
		if(file_exists($port)) {
			$config = json_decode(file_get_contents($port));
			if(isset($config->port)) {
				$this->port = $config->port;
			}
		}

		if(!empty($config_filepath) && file_exists($config_filepath)) {
			$config = json_decode(file_get_contents($config_filepath));
			if(isset($config->port)) {
				$this->port = $config->port;
			}
		}
	}

	private function shouldWeShowRistretto() {
		if($this->disable) {
			return false;
		}

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
			echo '<script>(function(){var s=document.createElement("script");s.setAttribute("src", "http://"+location.hostname+":'.$this->port.'/ristretto.js");document.getElementsByTagName("body")[0].appendChild(s);void(s);})();</script>';
		}
	}
}