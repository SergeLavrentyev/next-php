<?php

namespace App\Core\Router;

use App\Core\Request\Contract\RequestInterface;
use App\Core\Router\Contract\RouteInfoInterface;

class RouteInfo implements RouteInfoInterface
{
    private string $module = 'Index';
    private array $fragments = [];
    private array $options = [];
    private string $regex = '';
    private string $controllerPattern = '\\App\\{module}\\Controller\\{module}Controller';

    public function __construct(
        protected string $route
    ) {
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return $this
     */
    public function setFragments(): self
    {
        $fragments = explode('/', $this->route);
        $this->fragments = array_values(array_filter($fragments, fn ($f) => !empty($f)));
        return $this;
    }

    /**
     * @return string[]
     */
    public function getFragments(): array
    {
        return $this->fragments;
    }

    /**
     * @return $this
     */
    public function setModule(): self
    {
        if (isset($this->fragments[0])) {
            $this->module = ucfirst($this->fragments[0]);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return str_replace('{module}', $this->module, $this->controllerPattern);
    }

    /**
     * @return $this
     */
    public function setOptions(): self
    {

        foreach ($this->fragments as $index => $fragment) {
            if (strpos($fragment, ':') !== 0) {
                continue;
            }

            $this->options[$index] = is_numeric($fragment) ? (int)$fragment : (string)$fragment;
        }
        $options = array_filter(
            $this->fragments,
            fn ($fragment) => strpos($fragment, ':') === 0
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return $this
     */
    public function setRegex(): self
    {
        $this->regex = (new Regex())->createFromRoute($this);

        return $this;
    }

    /**
     * @return string
     */
    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * @return bool
     */
    public function hasOptions(): bool
    {
        return !empty($this->options);
    }
}