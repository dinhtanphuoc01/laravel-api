<?php

namespace Tests\Feature;

use App\Category;
use JWTAuth;
use Tests\TestCase;

class CategoryTest extends TestCase
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
        $res = $this->call('GET', "/api/category?token={$this->testLogin()}");
        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetIndexTokenInvalid()
    {
        $res = $this->call('GET', "/api/category?token=0{$this->testLogin()}");

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetIndexTokenExpired()
    {
        $res = $this->call('GET', "/api/category?token={$this->tokenExpired()}");

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetIndexNotFound()
    {
        $res = $this->call('GET', '/api/categories');

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateSuccess()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('POST', "/api/category?token={$this->testLogin()}", [
            'name'      => $category->name,
            'parent_id' => $category->parent_id,
        ]);

        $this->assertEquals(201, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateTokenExpired()
    {
        $res = $this->call('POST', "/api/category?token={$this->tokenExpired()}", []);

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateValidationFailure()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('POST', "/api/category?token={$this->testLogin()}", []);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());

        $res = $this->call('POST', "/api/category?token=0{$this->testLogin()}", [
            'name'      => $category->name,
            'parent_id' => $category->parent_id,
        ]);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPostCreateNotFound()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('POST', "/api/categories?token={$this->testLogin()}", [
            'name'      => $category->name,
            'parent_id' => $category->parent_id,
        ]);

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowFound()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('GET', "/api/category/$category->id?token={$this->testLogin()}");

        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowNotFound()
    {
        $res = $this->call('GET', "/api/category/null?token={$this->testLogin()}");

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowTokenExpired()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('GET', "/api/category/$category->id?token={$this->tokenExpired()}");

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testGetShowTokenInvalid()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('GET', "/api/category/$category->id?token=0{$this->tokenExpired()}");

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateSuccess()
    {
        $category  = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();

        $res = $this->call('PUT', "/api/category/$category->id?token={$this->testLogin()}", [
            'name'      => $category2->name,
            'parent_id' => $category2->parent_id,
        ]);

        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateValidationFailse()
    {
        $category  = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();

        $res = $this->call('PUT', "/api/category/$category->id?token={$this->testLogin()}", []);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());

        $res = $this->call('PUT', "/api/category/$category->id?token=0{$this->tokenExpired()}", [
            'name'      => $category2->name,
            'parent_id' => $category2->parent_id,
        ]);

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateTokenExpired()
    {
        $category  = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();

        $res = $this->call('PUT', "/api/category/$category->id?token={$this->tokenExpired()}", [
            'name'      => $category2->name,
            'parent_id' => $category2->parent_id,
        ]);

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testPutUpdateNotFound()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('PUT', "/api/category/null?token={$this->testLogin()}", [
            'name'      => $category->name,
            'parent_id' => $category->parent_id,
        ]);

        $this->assertEquals(404, $res->getStatusCode());
        $results = json_decode($res->getContent());
    }

    public function testDeleteDestroySuccess()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('DELETE', "/api/category/$category->id?token={$this->testLogin()}");

        $this->assertEquals(200, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testDeleteDestroyTokenInvalid()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('DELETE', "/api/category/$category->id?token=0{$this->tokenExpired()}");

        $this->assertEquals(400, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testDeteleDestroyTokenExpired()
    {
        $category = factory(Category::class)->create();

        $res = $this->call('DELETE', "/api/category/$category->id?token={$this->tokenExpired()}");

        $this->assertEquals(401, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }

    public function testDeteleDestroyNotFound()
    {
        $res = $this->call('DELETE', "/api/category/null?token={$this->testLogin()}");

        $this->assertEquals(404, $res->getStatusCode());

        $results = json_decode($res->getContent());
    }
}
