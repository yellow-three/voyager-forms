<?php

if (!function_exists('forms')) {
    function forms($key, $default = null)
    {
        $forms = new \YellowThree\VoyagerForms\Forms();

        return $forms->forms($key, $default);
    }
}
