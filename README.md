NetteRistretto
==============

Adds connection from [Nette](http://nette.org/) to [Ristretto](http://github.com/ViliamKopecky/Ristretto)

```php
// Application startup

Ristretto::register($port = 2013, $container->application);

// or even better

Ristretto::register($filepath = __DIR__ . '/../ristretto.json', $container->application);

```

```
# or in config.neon
extensions:
	ristretto: Ristretto\Extension
# it automatically looks for config file `%appDir%/../ristretto.json`
# and loads Ristretto's port
```

Start with RistrettoExample
===========