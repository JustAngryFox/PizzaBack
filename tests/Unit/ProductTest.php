<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
	 use DatabaseTransactions;
	 
	 
	public function test_get_products()
    {
        $response = $this->json('GET', '/api/get_products');

        $response
            ->assertStatus(200)
            ->assertJson([]);
    }
	
	public function test_upload_product(){
		
		Storage::fake('pizza');
		
        $response = $this->json('POST', '/api/upload_product',
		['name'=>'testname',
		'description'=>'test descripton',
		'price'=>'1000',
		'image'=> UploadedFile::fake()->image('pizza.jpg')
		]);
		
		    $response
            ->assertStatus(200)
            ->assertJson(['success'=>'ok']);
		}	
		
	public function test_upload_order(){
		
        $response = $this->json('POST', '/api/upload_order',
		['name'=>'testname',
		'tel'=>'89536786676',
		'email'=>'admin@foxread.ru',
	'products_id'=>'1|2|3|'
		]);
		
		    $response
            ->assertStatus(200)
            ->assertJson(['success'=>'ok']);
		}	
		
		
	public function test_get_orders(){
        $response = $this->json('GET', '/api/get_orders');

        $response
            ->assertStatus(200)
            ->assertJson([]);
	}		
		
	public function test_get_product_orders(){
        $response = $this->json('GET', '/api/get_product_orders',['order_id'=>'5']);

        $response
            ->assertStatus(200)
            ->assertJson([]);
	}		
}
