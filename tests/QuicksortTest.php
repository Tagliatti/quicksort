<?php

namespace Tagliatti\Quicksort\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class QuicksortTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            'one element'             => [[1], [1]],
            'with negative elements'  => [
                [3, 0, 2, 5, -1, -4, 1, -10],
                [-10, -4, -1, 0, 1, 2, 3, 5],
            ],
            'with duplicate elements' => [
                [3, 0, 2, 5, 3, 1, 2],
                [0, 1, 2, 2, 3, 3, 5],
            ],
            'already sorted'          => [
                [1, 2, 3, 4, 5],
                [1, 2, 3, 4, 5],
            ],
            'reverse sorted'          => [
                [5, 4, 3, 2, 1],
                [1, 2, 3, 4, 5],
            ],
            'large array'             => [
                range(1000, 1),
                range(1, 1000),
            ],
        ];
    }

    #[Test]
    #[DataProvider('dataProvider')]
    public function success(array $array, $sortedArray): void
    {
        quicksort($array, 0, count($array) - 1);

        $this->assertEquals($sortedArray, $array);
    }

    #[Test]
    public function empty_array(): void
    {
        $array = [];
        quicksort($array, 0, 0);

        $this->assertEquals([], $array);
    }

    #[Test]
    public function throwInvalidArgumentExceptionWhenLeftIndexAreLessThanZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $array = range(10, 1);
        quicksort($array, -1, count($array));
    }

    #[Test]
    public function throwInvalidArgumentExceptionWhenRightIndexAreLessThanZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $array = range(10, 1);
        quicksort($array, 0, -1);
    }
}
