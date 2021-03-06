<?php namespace Bugotech\Migration\Schema;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Support\Fluent;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class FieldFluent implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
    /**
     * @var Table
     */
    protected $table;

    /**
     * @var Fluent
     */
    protected $base;

    /**
     * @param Table $table
     * @param Fluent $base
     */
    public function __construct(Table $table, $base)
    {
        $this->table = $table;
        $this->base = $base;
    }

    /**
     * Executar alterações.
     */
    public function compile()
    {
        $this->table->compile();
    }

    /**
     * Get an attribute from the container.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->base->get($key, $default);
    }

    /**
     * Get the attributes from the container.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->base->getAttributes();
    }

    /**
     * Convert the Fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->base->toArray();
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->base->jsonSerialize();
    }

    /**
     * Convert the Fluent instance to JSON.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return $this->base->toJson($options);
    }

    /**
     * Determine if the given offset exists.
     *
     * @param  string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->base->offsetExists($offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  string $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->base->offsetGet($offset);
    }

    /**
     * Set the value at the given offset.
     *
     * @param  string $offset
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->base->offsetSet($offset, $value);
    }

    /**
     * Unset the value at the given offset.
     *
     * @param  string $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->base->offsetUnset($offset);
    }

    /**
     * Handle dynamic calls to the container to set attributes.
     *
     * @param  string $method
     * @param  array $parameters
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->base->__call($method, $parameters);

        return $this;
    }

    /**
     * Dynamically retrieve the value of an attribute.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Dynamically set the value of an attribute.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->base->__set($key, $value);
    }

    /**
     * Dynamically check if an attribute is set.
     *
     * @param  string $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->base->__isset($key);
    }

    /**
     * Dynamically unset an attribute.
     *
     * @param  string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->base->__unset($key);
    }
}