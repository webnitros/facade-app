<?php

use Illuminate\Support\Facades\Facade;
use function FacadeApp\app;

/** @var modX $modx */
/* @var array $scriptProperties */
switch ($modx->event->name) {
    case 'OnMODXInit':


        $data = $modx->getVersionData();

        $autoload = MODX_CORE_PATH . 'components/FacadeApp/vendor/autoload.php';
        if (!file_exists($autoload)) {
            $modx->log(modX::LOG_LEVEL_ERROR, 'Plugin FacadeApp Not found autoload.php in ' . $autoload);
        } else {

            if ($data['version'] == 2) {


                // Подключаем автозагрузчик только для версии MODX 2.0 и выше
                include_once $autoload;

                $app = app();
                $app->singleton('modx', function () use ($modx) {
                    return $modx;
                });

                $modx->invokeEvent('FacadeAppAddSingleton', [
                    'app' => $app
                ]);

                Facade::clearResolvedInstances();
                Facade::setFacadeApplication($app);


            } else {

                $modx->services->add('modx', $modx);
                $modx->invokeEvent('FacadeAppAddSingleton', [
                    'app' => $modx->services
                ]);


                Facade::clearResolvedInstances();
                Facade::setFacadeApplication($modx->services);

            }
        }
        break;
}
return '';
