<?php

declare(strict_types = 1);

function distribute_discount(int $discount, array $prices): array
{
    $totalPrice = array_sum($prices);

    if ($totalPrice === 0) {
        return $prices;
    }

    $discountedPrices = [];

    foreach ($prices as $price) {
        $discountForItem = ($price / $totalPrice) * $discount;

        $newPrice = $price - $discountForItem;

        $discountedPrices[] = round($newPrice, 2);
    }

    return $discountedPrices;
}