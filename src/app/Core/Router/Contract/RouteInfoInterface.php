<?php

namespace App\Core\Router\Contract;

interface RouteInfoInterface
{
    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return $this
     */
    public function setFragments(): self;

    /**
     * @return string[]
     */
    public function getFragments(): array;

    /**
     * @return $this
     */
    public function setModule(): self;

    /**
     * @return string|null
     */
    public function getModule(): ?string;

    /**
     * @return $this
     */
    public function setOptions(): self;

    /**
     * @return string[]
     */
    public function getOptions(): array;

    /**
     * @return $this
     */
    public function setRegex(): self;

    /**
     * @return string
     */
    public function getRegex(): string;

    /**
     * @return string
     */
    public function getController(): string;

    /**
     * @return bool
     */
    public function hasOptions(): bool;
}