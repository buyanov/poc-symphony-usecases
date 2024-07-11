<?php

namespace App\Tests;

use App\Tests\Constraints\JsonHasKeys;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\RouterInterface;

class CustomWebTestCase extends WebTestCase
{
    /**
     * Generate URL by route name
     */
    public function route(string $name, array $params = []): string
    {
        /** @var RouterInterface $router */
        $router = static::getContainer()->get('router')
            ?? throw new \RuntimeException('Router not found');

        return $router->generate($name, $params);
    }

    /**
     * @param array  $expectedKeys
     * @param string $json
     */
    protected static function assertJsonStructure(array $expectedKeys, string $json): void
    {
        self::assertThat($expectedKeys, new JsonHasKeys($json));
    }

    /**
     * @param array<mixed> $expectedKeys
     * @param array<mixed> $data
     */
    protected static function assertJsonArrayStructure(array $expectedKeys, array $data): void
    {
        foreach ($expectedKeys as $key => $value) {
            if (is_array($value) && $key === '*') {
                self::assertIsArray($data);

                foreach ($data as $responseDataItem) {
                    self::assertJsonArrayStructure($expectedKeys['*'], $responseDataItem);
                }
            } elseif (is_array($value)) {
                self::assertArrayHasKey($key, $data);

                self::assertJsonArrayStructure($value, $data[$key]);
            } else {
                self::assertArrayHasKey($value, $data);
            }
        }
    }

    public static function assertJsonArrayStructureResponse(array $expectedStructure): void
    {
        self::assertJsonArrayStructure(
            $expectedStructure,
            json_decode(
                self::getClient()->getResponse()->getContent(),
                true,
                512,
                JSON_ERROR_NONE
            )
        );
    }

    public static function assertJsonCollectionLengthResponse(int $expectedCount): void
    {
        self::assertCount(
            $expectedCount,
            json_decode(
                self::getClient()->getResponse()->getContent(),
                true,
                512,
                JSON_ERROR_NONE
            )
        );
    }
}