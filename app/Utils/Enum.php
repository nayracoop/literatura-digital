<?php

namespace App\Utils;

use BadMethodCallException;
use ReflectionClass;
use UnexpectedValueException;

abstract class Enum
{
    /**
     * The enum value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * The enum constants.
     *
     * @var array
     */
    protected static $constants = [];

    /**
     * Create a new enum instance.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        if (!static::constants()->contains($value)) {
            throw new UnexpectedValueException(sprintf(
                '`%s` no es un valor del enum %s',
                $value,
                static::class
            ));
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * Get the enum key.
     *
     * @return mixed
     */
    public function getKey()
    {
        return static::constants()->search($this->value, true);
    }

    /**
     * Get the enum value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the enum keys.
     *
     * @return array
     */
    public static function keys()
    {
        return static::constants()
            ->keys()
            ->all();
    }

    /**
     * Get the enum values.
     *
     * @return array
     */
    public static function values()
    {
        return static::constants()
            ->map(function ($value) {
                return new static($value);
            })
            ->all();
    }

    /**
     * Get the enum constants.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function constants()
    {
        if (!isset(static::$constants[static::class])) {
            static::$constants[static::class] = collect(
                (new ReflectionClass(static::class))->getConstants()
            );
        }

        return static::$constants[static::class];
    }

    /**
     * Returns a new enum instance when called statically.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     */
    public static function __callStatic($name, array $arguments)
    {
        if (static::constants()->has($name)) {
            return new static(static::constants()->get($name));
        }

        throw new BadMethodCallException(sprintf(
            'No existe la constante `%s` en la clase %s',
            $name,
            static::class
        ));
    }
}
