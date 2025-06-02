<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\CreatesApplication;
use Tests\TestCase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

class CarTest extends TestCase
{
    use WithoutMiddleware;
    public $test = [
        'brand'     => 'test car',
        'type'      => 'tester 2000',
        'license'   => '38499921',
        'capacity'  => 4,
        'allow_wheel_chair' => true,
        'category_id' => '607159c56b590000dc002b73'
    ];
    public $new_test = [
        'brand'     => 'test car',
        'type'      => 'tester 2000',
        'license'   => '38499921',
        'capacity'  => 5,
        'allow_wheel_chair' => true,
        'category_id' => '607159c56b590000dc002b73'
    ];

    public function test_store()
    {
        $test = $this->test;
        $response = $this->call('POST', '/api/cars', $test);
        $this->assertEquals(201, $response->status());
    }

    public function test_get_all()
    {
        $test = $this->test;
        $response = $this->call('GET', '/api/cars');
        $response->assertsee($test);
    }

    public function test_show()
    {
        $test = $this->test;
        $response = $this->call('GET', '/api/cars');
        $id = end($response->json()["data"])['_id'];

        $response = $this->call('GET', '/api/cars/' . $id);
        $response->assertsee($test);
    }

    public function test_update()
    {
        $new_test = $this->new_test;
        $response = $this->call('GET', '/api/cars');
        $id = end($response->json()["data"])['_id'];

        $response = $this->call('PUT', '/api/cars/' . $id, $new_test);
        $this->assertEquals(200, $response->status());
    }

    public function test_delete()
    {
        $response = $this->call('GET', '/api/cars');
        $id = end($response->json()["data"])['_id'];

        $response = $this->call('DELETE', '/api/cars/' . $id);
        $this->assertEquals(202, $response->status());
    }

    //    public function test_store()
//    {
//        $this->visit('/cars/create')
//            ->type('test car', 'brand')
//            ->type('tester 2000', 'type')
//            ->type('7898670', 'license')
//            ->type('4', 'capacity')
//            ->type('607159c56b590000dc002b73', 'category_id')
//            ->check('allow_wheel_chair')
//            ->press('Voeg auto toe')
//            ->seePageIs('/cars');
//    }
}
