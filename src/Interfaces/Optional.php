<?php

namespace Aviator\Optionally\Interfaces;

use Aviator\Makeable\Interfaces\Makeable;
use Countable;
use IteratorAggregate;

interface Optional extends Makeable, Countable, IteratorAggregate
{
    /**
     * Get the underlying options array.
     * @return array
     */
    public function all () : array;

    /**
     * Get the option keys.
     * @return array
     */
    public function keys () : array;

    /**
     * Get an option if it exists, returning null if it does not.
     * @param string $option
     * @return null
     */
    public function get (string $option);

    /**
     * Return true if the option exists.
     * @param string $option
     * @return bool
     */
    public function has (string $option) : bool;

    /**
     * Completely replace the options with the given options.
     * @param array $options
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function replaceWith (array $options = []) : Optional;

    /**
     * Add the given array of options, overwriting any that already
     * exist.
     * @param array $options
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function add (array $options = []) : Optional;

    /**
     * Set an option.
     * @param string $option
     * @param mixed $value
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function set (string $option, bool $value) : Optional;

    /**
     * Removes a parameter.
     * @param string $option
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function remove (string $option) : Optional;
}
