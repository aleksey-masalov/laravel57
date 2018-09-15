<?php

if (!function_exists('homeRoute')) {

    /**
     * @return string
     */
    function homeRoute()
    {
        return route('frontend.index');
    }
}

if (! function_exists('userName')) {

    /**
     * @return string
     */
    function userName()
    {
        return auth()->check() ? auth()->user()->name : 'Guest';
    }
}

if (!function_exists('generateConfirmationToken')) {

    /**
     * @return string
     */
    function generateConfirmationToken()
    {
        return bin2hex(random_bytes(32));
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * @param string $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('isActiveRoute')) {

    /**
     * @param string $routeName
     * @return string
     */
    function isActiveRoute($routeName)
    {
        return app('request')->is(substr(route($routeName, [], false), 1) . '*');
    }
}
