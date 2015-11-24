<?php

namespace Hypersites\StockBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductVariationControllerTest extends WebTestCase
{
    public function testUpdatestockitems()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stock/variation/updateStockItem');
    }

}
