<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testProductsIndex()
    {
        $response = $this->get('/api/v1/products');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testProductsOneCategoryStore()
    {
        $data = [
            'name' => 'TESTTEST',
            'description' => 'Test DEscription',
            'price' => '123.45',
            'is_publish' => true,
            'categories_id' => [
                1,
            ]
        ];
        $response = $this->post('/api/v1/products', $data);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('The categories id must have at least 2 items.', $response->json()['error']['message']);
    }

    public function testProductsStore()
    {
        $data = [
            'name' => 'TESTTEST',
            'description' => 'Test DEscription',
            'price' => '123.45',
            'is_publish' => true,
            'categories_id' => [
                1,
                13,
            ]
        ];
        $response = $this->post('/api/v1/products', $data);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testProductsDelete()
    {
        $data = [
            'name' => 'TESTTEST',
            'description' => 'Test DEscription',
            'price' => '123.45',
            'is_publish' => true,
            'categories_id' => [
                1,
                13,
            ]
        ];
        $response = $this->post('/api/v1/categories', $data);
        $this->assertEquals(201, $response->getStatusCode());
        $response = $this->delete('/api/v1/categories/' . $response->json()['data']['id']);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
