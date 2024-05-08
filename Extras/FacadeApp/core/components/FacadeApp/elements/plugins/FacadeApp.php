<?php

use Illuminate\Support\Facades\Facade;
use function FacadeApp\app;

/** @var modX $modx */
/* @var array $scriptProperties */
switch ($modx->event->name) {
    case 'OnMODXInit':


        $data = $modx->getVersionData();

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
            $modx->invokeEvent('FacadeAppAddSingleton', [
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

            $modx->invokeEvent('FacadeAppAddSingleton', [
                'app' => $modx->services
            ]);

            Facade::clearResolvedInstances();
            Facade::setFacadeApplication($modx->services);

        }

        break;
}
return '';
