<?php

namespace Tests\Feature;

use App\Product;
use JWTAuth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $credentials = ['email' => 'dinhtanphuoc@gmail.com', 'password' => 'tanphuoc'];
        $token       = JWTAuth::attempt($credentials);
        return $token;
    }

    public function tokenExpired()
    {
        return $tokenExpired = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDgwXC9wdWJsaWNcL2xvZ2luIiwiaWF0IjoxNDk0MjA2NTU5LCJleHAiOjE0OTQyMTAxNTksIm5iZiI6MTQ5NDIwNjU1OSwianRpIjoiMXJ1NnJkdk50TzhuTmt0WiJ9.oMhsVlbRii72HFghua2g40kbWX9Lghn-Ti27_YTswO8';
    }

    public function testGetIndexFound()
    {
        $res = $this->call('GET', "/api/product?token={$this->testLogin()}");
        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetIndexTokenInvalid()
    {
        $res = $this->call('GET', "/api/product?token=0{$this->testLogin()}");

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetIndexTokenExpired()
    {
        $res = $this->call('GET', "/api/product?token={$this->tokenExpired()}");

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetIndexNotFound()
    {
        $res = $this->call('GET', '/api/products');

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateSuccess()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('POST', "/api/product?token={$this->testLogin()}", [
            'name'          => $product->name,
            'detail'        => $product->detail,
            'image'         => $product->image,
            'price'         => $product->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(201, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateTokenExpired()
    {
        $res = $this->call('POST', "/api/product?token={$this->tokenExpired()}", []);

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateValidationFailure()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('POST', "/api/product?token={$this->testLogin()}", []);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());

        $res = $this->call('POST', "/api/product?token=0{$this->testLogin()}", [
            'name'          => $product->name,
            'detail'        => $product->detail,
            'image'         => $product->image,
            'price'         => $product->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateNotFound()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('POST', "/api/products?token={$this->testLogin()}", [
            'name'          => $product->name,
            'detail'        => $product->detail,
            'image'         => $product->image,
            'price'         => $product->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowFound()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('GET', "/api/product/$product->id?token={$this->testLogin()}");

        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowNotFound()
    {
        $res = $this->call('GET', "/api/product/null?token={$this->testLogin()}");

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowTokenExpired()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('GET', "/api/product/$product->id?token={$this->tokenExpired()}");

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowTokenInvalid()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('GET', "/api/product/$product->id?token=0{$this->tokenExpired()}");

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateSuccess()
    {
        $product  = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        $res = $this->call('PUT', "/api/product/$product->id?token={$this->testLogin()}", [
            'name'          => $product2->name,
            'detail'        => $product2->detail,
            'image'         => $product2->image,
            'price'         => $product2->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateValidationFailse()
    {
        $product  = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        $res = $this->call('PUT', "/api/product/$product->id?token={$this->testLogin()}", []);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());

        $res = $this->call('PUT', "/api/product/$product->id?token=0{$this->tokenExpired()}", [
            'name'          => $product2->name,
            'detail'        => $product2->detail,
            'image'         => $product2->image,
            'price'         => $product2->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateTokenExpired()
    {
        $product  = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        $res = $this->call('PUT', "/api/product/$product->id?token={$this->tokenExpired()}", [
            'name'          => $product2->name,
            'detail'        => $product2->detail,
            'image'         => $product2->image,
            'price'         => $product2->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateNotFound()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('PUT', "/api/product/null?token={$this->testLogin()}", [
            'name'          => $product->name,
            'detail'        => $product->detail,
            'image'         => $product->image,
            'price'         => $product->price,
            'categories_id' => $product->categories_id,
        ]);

        $this->assertEquals(404, $res->getStatusCode());
        $results = json_decode($res->getContent());
    }

    public function testDeleteDestroySuccess()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('DELETE', "/api/product/$product->id?token={$this->testLogin()}");

        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testDeleteDestroyTokenInvalid()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('DELETE', "/api/product/$product->id?token=0{$this->tokenExpired()}");

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testDeteleDestroyTokenExpired()
    {
        $product = factory(Product::class)->create();

        $res = $this->call('DELETE', "/api/product/$product->id?token={$this->tokenExpired()}");

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testDeteleDestroyNotFound()
    {
        $res = $this->call('DELETE', "/api/product/null?token={$this->testLogin()}");

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }
}
