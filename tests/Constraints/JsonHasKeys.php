<?php

declare(strict_types=1);

namespace App\Tests\Constraints;

use PHPUnit\Framework\Constraint\Constraint;

class JsonHasKeys extends Constraint
{
    protected $json;

    /**
     * EqualKeys constructor.
     *
     * @param string $json
     */
    public function __construct(string $json)
    {
        $this->json = json_decode($json, true);
    }

    /**
     * @param mixed $keys
     *
     * @return string
     */
    public function failureDescription($keys): string
    {
        return sprintf(
            "keys \n %s \n not present in json \n %s",
            json_encode($keys, JSON_PRETTY_PRINT),
            $this->toString(JSON_PRETTY_PRINT)
        );
    }

    /**
     * @param mixed $keys
     *
     * @return bool
     */
    public function matches($keys): bool
    {
        return empty(array_diff_key(array_flip($keys), $this->json));
    }

    /**
     * @param int $options
     *
     * @return string
     */
    public function toString(int $options = 0): string
    {
        return json_encode($this->json, $options);
    }
}
