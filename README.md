NetteRistretto
==============

Adds connection from [Nette](http://nette.org/) to [Ristretto](http://github.com/ViliamKopecky/Ristretto)

```php
// Application startup

$application = container->application;
$port = 2013;

Extras\Ristretto::register($application, $port);
```