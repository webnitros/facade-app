<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 19.11.2022
 * Time: 13:26
 */

namespace FacadeApp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getOption($key, $options = null, $default = null, $skipEmpty = false)
 * @see \modX::getOption
 * @see modX
 */
class ModX extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'modx';
    }
}
