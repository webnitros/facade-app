# Create my Facade

Subscribe event `FacadeAppAddSingleton` plugin

Facade class:

```php
<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool getChunk($name = '', array $properties = array(), $fastMode = false)
 * @see \pdoFetch::getChunk()
 */
class Pdo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'pdo';
    }
}


```

Plugin:

```php
<?php
$app->singleton('pdo', function () use ($modx) {
    $fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
    $path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
    if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
        $pdoFetch = new $pdoClass($modx, []);
    } else {
        return false;
    }
    return $pdoFetch;
});
```

Use:

```php
<?php
$site_name = \App\Facades\Pdo::getChunk('@INLINE Вот и имя {$site_name}', ['site_name' => $site_name]);
echo $site_name;
```


