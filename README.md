NetteRistretto
==============

Adds connection from [Nette](http://nette.org/) to [Ristretto](http://github.com/ViliamKopecky/Ristretto)

```php
// Application startup

Ristretto::register($port = 2013, $container->application);
```

```
# or in config.neon

extensions:
	ristretto: Ristretto\Extension

ristretto:
	port: 8000
	enable: true
```