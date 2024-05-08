<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 07.05.2024
 * Time: 11:19
 */

namespace FacadeApp;

if (!function_exists('app')) {

    /**
     * Get the available container instance.
     *
     * @param string|null $abstract
     * @param array $parameters
     * @return mixed|\FacadeApp\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return \FacadeApp\Application::getInstance();
        }
        return \FacadeApp\Application::getInstance()->make($abstract, $parameters);
    }
}

