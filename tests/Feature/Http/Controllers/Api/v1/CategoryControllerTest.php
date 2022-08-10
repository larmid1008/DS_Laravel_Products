<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryIndex()
    {
        $response = $this->get('/api/v1/categories');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCategoryStore()
    {
        $data = [
            'name' => 'TESTTEST',
        ];
        $response = $this->post('/api/v1/categories', $data);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('TESTTEST', $response->json()['data']['name']);
    }

    public function testCategoryNotEmptyDelete()
    {
        $response = $this->delete('/api/v1/categories/1');
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testCategoryDelete()
    {
        $data = [
            'name' => 'TESTTEST1',
        ];
        $response = $this->post('/api/v1/categories', $data);
        $this->assertEquals(201, $response->getStatusCode());
        $response = $this->delete('/api/v1/categories/' . $response->json()['data']['id']);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
