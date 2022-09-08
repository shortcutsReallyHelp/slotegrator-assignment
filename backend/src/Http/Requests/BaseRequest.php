<?php declare(strict_types=1);

namespace Slotegrator\Http\Requests;

use ReflectionProperty;

abstract class BaseRequest
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @param array $data
     * @return BaseRequest
     * @throws \ReflectionException
     */
    public function fromArray(array $data): self
    {
        foreach ($data as $key => $value) {
            $key = lcfirst(str_replace('_', '', ucwords($key, '_')));

            $property = new ReflectionProperty($this, $key);
            $typeName = $property->getType()->getName();

            if (!in_array($typeName, ['boolean', 'integer', 'double', 'string', 'array']) && gettype($value) === 'array') {
                $this->$key = (new $typeName)->fromArray($value);
            } else {
                $this->$key = $value;
            }
        }
        return $this;
    }
}
