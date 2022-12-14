<?php

namespace App\Core\Router;

class Regex
{
    /**
     * @param string $route
     * @return string
     */
    public function createFromRoute(RouteInfo $routeInfo): string
    {
        $fragments = $routeInfo->getFragments();

        $regex = '/^';

        foreach ($fragments as $fragment) {
            if (empty($fragment)) {
                continue;
            }

            if (strpos($fragment, ':') === false) {
                $regex .= "\/{$fragment}";
                continue;
            }

            $regex .= "\/[\w'-]+";
        }

        $regex .= '+(?!\/)/';
        return $regex;
    }
}