NetteRistretto
==============

Adds connection from [Nette](http://nette.org/) to [Ristretto](http://github.com/ViliamKopecky/Ristretto)

*Firstly get familiar with [Grunt.js](http://gruntjs.com) and [RistrettoExample](https://github.com/ViliamKopecky/RistrettoExample)*

```php
// Application startup

Ristretto::register($port = 2013, $container->application);

// or even better

Ristretto::register($filepath = __DIR__ . '/../ristretto.json', $container->application);

```

```
# or in config.neon simply as this:

extensions:
	ristretto: Ristretto\Extension

# it automatically looks for config file `%appDir%/../ristretto.json`
# and loads Ristretto's port from there
```
