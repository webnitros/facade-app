<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/FacadeApp/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/FacadeApp')) {
            $cache->deleteTree(
                $dev . 'assets/components/FacadeApp/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/FacadeApp/', $dev . 'assets/components/FacadeApp');
        }
        if (!is_link($dev . 'core/components/FacadeApp')) {
            $cache->deleteTree(
                $dev . 'core/components/FacadeApp/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/FacadeApp/', $dev . 'core/components/FacadeApp');
        }
    }
}

return true;