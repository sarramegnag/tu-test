<?php

namespace Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testTitle()
    {
        $product = new Product();
        $product->setTitle('Stylo');

        $this->assertEquals('Stylo', $product->getTitle());
    }

    public function testPrice()
    {
        $product = new Product();
        $product->setPrice(100);

        $this->assertEquals(100, $product->getPrice());
    }

    public function testPriceWithTax()
    {
        $product = new Product();
        $product->setPrice(100);

        $this->assertEquals(110, $product->getPriceWithTax());
    }

    public function testPriceWithTaxUnderZero()
    {
        $product = new Product();
        $product->setPrice(-20);

        $this->expectException(\LogicException::class);

        $product->getPriceWithTax();
    }

    /**
     * @dataProvider prices
     */
    public function testMorePricesWithTax($price, $priceWithTax)
    {
        $product = new Product();
        $product->setPrice($price);

        $this->assertSame($priceWithTax, $product->getPriceWithTax());
    }

    public function prices()
    {
        return [
            [0, 0],
            [20, 22],
            [100, 110]
        ];
    }
}
