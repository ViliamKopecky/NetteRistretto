<?php

/**
 * Ristretto\Extension
 * @author Viliam Kopecký
 * @license WTFPL (http://en.wikipedia.org/wiki/WTFPL)
 */

namespace Ristretto;

use	Nette\DI\CompilerExtension;
use	Nette\Application\Application;
use	Nette\Diagnostics\Debugger;
use Nette\PhpGenerator\ClassType;

class Extension extends CompilerExtension {

	private $defaults = array(
			'port' => 8000,
			'enable' => true,
		);

	public function afterCompile(ClassType $class)
	{
		$initialize = $class->methods['initialize'];
		$container = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);
		
		if($config['enable']) {
			$initialize->addBody('Ristretto::register(?, $this->getService("application"));', array($config['port']));
		}
	}
}
