<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testGet_ValidInput_BookObject()
    {
		$response = $this->call('GET', '/api/v1/books/32');
        $this->assertEquals(200, $response->getStatusCode());
 		$data = json_decode($response->getcontent(), true);
        $this->assertEquals(12345, $data['data']['isbn']);
    }

    public function testDelete_BookObject()
    {
		$response = $this->call('DELETE', '/api/v1/books/30');
        $this->assertEquals(200, $response->getStatusCode());
    }    

    public function testCreate_BookObject()
    {

	    $response = $this->call('POST','/api/v1/books/', [
	            'title'     => 'My Random Test Book',
	            'description'    => 'Description',
	            'author'    => 'Test Author',
	            'publisher'    => 'Test Publisher',	            	            	            
	            'amount'    => 10
    	]);

    	$this->assertEquals(200, $response->getStatusCode());

    	$data = json_decode($response->getcontent(), true);
		$this->assertArrayHasKey('bookId', $data['data']);
    }        

   public function testUpdate_BookObject()
    {
	    $response = $this->call('PUT','/api/v1/books/35', [
	            'title'     => 'My Random Test Book1',
	            'description'    => 'Description',
	            'author'    => 'Test Author',
	            'publisher'    => 'Test Publisher',	            	            	            
	            'isbn'    => '12345',	            	            	            	            
	            'amount'    => 10
    	]);

    	$this->assertEquals(200, $response->getStatusCode());

    	$data = json_decode($response->getcontent(), true);
		$this->assertArrayHasKey('bookId', $data['data']);
    }            
}