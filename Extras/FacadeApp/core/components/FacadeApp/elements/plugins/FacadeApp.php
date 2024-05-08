<?php
/** @var modX $modx */
/* @var array $scriptProperties */
switch ($modx->event->name) {
    case 'OnMODXInit':
        /* @var FacadeApp $FacadeApp */
        $FacadeApp = $modx->getService('FacadeApp', 'FacadeApp', $modx->getOption('FacadeApp_core_path', $scriptProperties, $modx->getOption('core_path') . 'components/FacadeApp/') . 'model/');
        if ($FacadeApp instanceof FacadeApp) {
            $FacadeApp->loadHandlerEvent($modx->event);
        }
        break;
}
return '';
