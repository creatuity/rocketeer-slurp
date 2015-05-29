# 'Slurp' plugin for Rocketeer

Defines commands that allow you to 'slurp' a copy of a site to your local machine.

Helpful for building and updating development copies of live sites.

To setup add this to your `composer.json` and update :

```json
"creatuity/rocketeer-slurp": "dev-master"
```

Then you'll need to set it up, so do `artisan config:publish rocketeer/rocketeer-slurp` and complete the configuration in `app/packages/rocketeer/rocketeer-slurp/config.php`.

Once that's done add the following to your providers array in `app/config/app.php` :

```php
'Rocketeer\Plugins\RocketeerSlurp\RocketeerSlurpServiceProvider',
```
