<?php

use Illuminate\Support\Facades\Facade;
use function FacadeApp\app;

class FacadeApp
{
    /** @var modX $modx */
    public $modx;

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
    }


    /**
     * Обработчик для событий
     * @param modSystemEvent $event
     * @param array $scriptProperties
     */
    public function loadHandlerEvent(modSystemEvent $event, array $scriptProperties = [])
    {
        switch ($event->name) {
            case 'OnMODXInit':

                $data = $this->modx->getVersionData();

                if ($data['version'] == 2) {
                    // Подключаем автозагрузчик только для версии MODX 2.0 и выше
                    include_once MODX_CORE_PATH . 'components/FacadeApp/vendor/autoload.php';

                    $app = app();
                    $app->singleton('modx', function () {
                        return $this->modx;
                    });

                    /*
                     * Event reg for FacadeAppAddSingleton
                     * $app->singleton('myapp', function () use ($modx) {
                     *      return $modx->getService('myapp');
                     * });
                     * */
                    $this->modx->invokeEvent('FacadeAppAddSingleton', [
                        'app' => $app
                    ]);

                    Facade::clearResolvedInstances();
                    Facade::setFacadeApplication($app);

                } else {

                    /*
                     * From MODX 3.0 add FacadeAppAddSingleton event
                     $app->add('myapp', function () use ($modx) {
                        return  $modx->services->get('myapp');
                    });
                    */

                    $this->modx->invokeEvent('FacadeAppAddSingleton', [
                        'app' => $this->modx->services
                    ]);

                    Facade::clearResolvedInstances();
                    Facade::setFacadeApplication($this->modx->services);

                }


                break;
        }

    }

}
