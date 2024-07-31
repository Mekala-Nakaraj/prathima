<?php

if (!function_exists('is_active_route')) {
    /**
     * Check if the route is active.
     *
     * @param string|array $route
     * @param string $output
     * @return string
     */
    function is_active_route($route, $output = 'active')
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (Route::currentRouteName() == $r) {
                    return $output;
                }
            }
        } else {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }

        return '';
    }
}

if (!function_exists('is_active_pattern')) {
    /**
     * Check if the request matches a pattern.
     *
     * @param string $pattern
     * @param string $output
     * @return string
     */
    function is_active_pattern($pattern, $output = 'active')
    {
        return request()->is($pattern) ? $output : '';
    }
}
