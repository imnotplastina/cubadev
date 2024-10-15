<?php

declare(strict_types = 1);

bcscale(9);

interface Castable {}

final readonly class AmountValue implements Castable
{
    public function __construct(
        private string $value
    ) {
        if (! is_numeric($value)) {
            throw new \InvalidArgumentException(
                'Invalid amount value: ' . $this->value
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function sub(string $amount): self
    {
        return new self(bcsub($this->value, $amount));
    }
}

final class Discount
{
    public function distributeDiscount(AmountValue $discount, array $prices): array
    {
        $discountedPrices = [];

        foreach ($prices as $price) {
            $discountedPrice = (new AmountValue($price))->sub($discount->value());

            $discountedPrices[] = $discountedPrice;
        }

        return $discountedPrices;
    }
}
