<?php
/*
 * Copyright (c) 2022. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace YellowThree\VoyagerForms\Helpers;

class ClassEvents
{
    /**
     * Fire in the hole! Execute our custom functionality.
     *
     * @param $classString
     * @param mixed $forcedParams (eg. for form hooks, we pass through form data)
     * @return mixed
     */
    public static function executeClass($classString, $forcedParams = null)
    {
        list($className, $methodName) = explode('::', $classString);
        preg_match('/\(.*?\)/', $methodName, $parameters);

        if (count($parameters) > 0) {
            $methodName = str_replace($parameters[0], '', $methodName);
            $parameters = explode(',', str_replace(['(', ')'], '', $parameters[0]));
        }

        $class = resolve($className);

        if($forcedParams) {
            array_unshift($parameters, ...$forcedParams);
        }

        return $class->$methodName(...$parameters);
    }
}
