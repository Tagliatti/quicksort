<?php

if (!function_exists('partition')) {
    function partition(array &$array, int $left, int $right): int
    {
        $pivot = $array[floor(($left + $right) / 2)];

        while ($left <= $right) {
            while ($array[$left] < $pivot) {
                $left++;
            }
            while ($array[$right] > $pivot) {
                $right--;
            }

            if ($left <= $right) {
                [$array[$left], $array[$right]] = [$array[$right], $array[$left]];
                $left++;
                $right--;
            }
        }

        return $left;
    }
}

if (!function_exists('quicksort')) {
    function quicksort(array &$array, int $left, int $right): void
    {
        if ($left < 0 || $right < 0) {
            throw new InvalidArgumentException('Left and right indexes must be greater than or equal to 0');
        }
        if (count($array) == 0) {
            return;
        }

        $partition = partition($array, $left, $right);

        if ($left < $partition - 1) {
            quicksort($array, $left, $partition - 1);
        }
        if ($partition < $right) {
            quicksort($array, $partition, $right);
        }
    }
}




