<?php

if (! function_exists('service')) {
    /**
     * @template T
     *
     * @param  class-string<T>  $className
     * @return T
     */
    function service(string $className)
    {
        return Craft::$container->get($className);
    }
}
