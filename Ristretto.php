<?php

/**
 * Ristretto Debug bar panel
 * @author Viliam Kopecký
 * @license WTFPL (http://en.wikipedia.org/wiki/WTFPL)
 *
 * use in Nette app:
 * Extras\Ristretto::register($container->application, $port = 2013);
 * 
 */

namespace Extras;

use Nette,
	Nette\Utils\Strings;

class Ristretto extends Nette\Object {

	private static $instance;
	private static $disable = false;
	public static $port;
	private $application;

	public static function register($application, $port=2013) {
		self::$port = $port;
		self::$instance = new self($application);
		$application->onShutdown[] = self::$instance->renderSnippet;
	}

	function __construct(Nette\Application\Application $application) {
		$this->application = $application;
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
			$host = $this->application->presenter->context->httpRequest->url->host;
			echo '<script src="//'.$host.':'.self::$port.'/ristretto.js"></script>';
		}
	}
}