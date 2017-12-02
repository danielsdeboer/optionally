<?php

namespace Aviator\Optionally;

use ArrayIterator;
use Aviator\Makeable\Traits\MakeableTrait;
use Aviator\Optionally\Interfaces\Optional;

class Optionally implements Optional
{
    use MakeableTrait;

    /** @var bool[] */
    protected $options = [];

    /**
     * Constructor.
     * @param array $options
     */
    public function __construct (array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Get the underlying options array.
     * @return array
     */
    public function all () : array
    {
        return $this->options;
    }

    /**
     * Get the option keys.
     * @return array
     */
    public function keys () : array
    {
        return array_keys($this->options);
    }

    /**
     * Get an option if it exists, returning null if it does not.
     * @param string $option
     * @return null
     */
    public function get (string $option)
    {
        return $this->options[$option] ?? null;
    }

    /**
     * Return true if the option exists.
     * @param string $option
     * @return bool
     */
    public function has (string $option) : bool
    {
        return array_key_exists($option, $this->options);
    }

    /**
     * Completely replace the options with the given options.
     * @param array $options
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function replaceWith (array $options = []) : Optional
    {
        $this->options = [];

        $this->setOptions($options);

        return $this;
    }

    /**
     * Add the given array of options, overwriting any that already
     * exist.
     * @param array $options
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function add (array $options = []) : Optional
    {
        $this->setOptions($options);

        return $this;
    }

    /**
     * Set an option.
     * @param string $option
     * @param mixed $value
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function set (string $option, bool $value) : Optional
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * Removes an option by key.
     * @param string $option
     * @return \Aviator\Optionally\Interfaces\Optional
     */
    public function remove (string $option) : Optional
    {
        unset($this->options[$option]);

        return $this;
    }

    /**
     * Get the options iterator.
     * @return \ArrayIterator
     */
    public function getIterator () : ArrayIterator
    {
        return new ArrayIterator($this->options);
    }

    /**
     * Count the options.
     * @return int
     */
    public function count ()
    {
        return count($this->options);
    }

    /**
     * Set each of the options, ignoring integer keys.
     * @param array $options
     */
    protected function setOptions (array $options)
    {
        foreach ($options as $key => $value) {
            if (is_string($key) && is_bool($value)) {
                $this->set($key, $value);
            }
        }
    }
}
