<?php

require_once 'API_UnitTest.php';

use PHPUnit\Framework\TestCase;

class APITest extends TestCase{

    protected function setUp(): void{
        $this->api = new API();
    }

     public function payload($request_method) :array{

        switch($request_method){

            case 'POST':
                $payload = [
                    "first_name" => "Test",
                    "middle_name" => "test",
                    "last_name" => "last test",
                    "contact_number" => 654655,
                ];
                break;

            case 'GET':
                $payload = [];
                break;

            case 'DELETE':
                $payload = [];
                break;

            case 'PUT':
                $payload = [
                    "first_name" => "Edited",
                    "middle_name"=> "Edited",
                    "last_name" => "Test Edited",
                    "contact_number" => 666666,
                ];
                break;
        }
        $this->assertNotEmpty($payload);
        return $payload;
    }

     public function testHttpPost() :array {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $payload = array(
           'first_name' => 'Test',
           'middle_name' => 'test',
           'last_name' => 'last test',
           'contact_number' => 654655
        );

        $result = json_decode($this->api->httpPost($payload), true);
        //Check if $result has a key = "status"
        $this->assertArrayHasKey('status', $result);
        //Check if value of $result['status'] is equal to "success"
        $this->assertEquals($result['status'], 'success');
        //Check if $result has a key = "data"
        $this->assertArrayHasKey('data', $result);
        
        return $result;
        
     }

     /**
      * @depends testHttpPost
      */
     public function testHttpGet(array $result){
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $payload = $result;

        $result = json_decode($this->api->httpGet($payload), true);
        //Check if $result has a key = "status"
        $this->assertArrayHasKey('status', $result);
        //Check if value of $result['status'] is equal to "success"
        $this->assertEquals($result['status'], 'success');
        //Check if $result has a key = "data"
        $this->assertArrayHasKey('data', $result);

     }

     /**
      * @depends testHttpPost
      */
     public function testHttpPut(array $result) :array{
        $_SERVER['REQUEST_METHOD'] = 'PUT';

        $id = $result['id'];
        $payload = array(
           'first_name' => 'Test2',
           'middle_name' => 'test2',
           'last_name' => 'last test2',
           'contact_number' => 654655
        );

        $result = json_decode($this->api->httpPut($id, $payload), true);
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals($result['status'], 'success');
        $this->assertArrayHasKey('data', $result);
        return $result;
     }
     
     /**
      * @depends testHttpPost
      */
     public function testHttpDelete(array $result) :array {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';

        $id = (String)$result['id'];
        
        $payload = $result;

        $result = json_decode($this->api->httpDelete($id, $payload), true);
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals($result['status'], 'success');
        $this->assertArrayHasKey('data', $result);
        return $result;
     }

        /**
      * @depends testHttpPost
      */
      public function testHttpGet_Fail(array $result){
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        // $payload = $result;
        $payload = array (
            'id' => 9999
        );

        $result = json_decode($this->api->httpGet($payload), true);
        //Check if $result has a key = "status"
        $this->assertArrayHasKey('status', $result);
        //Check if value of $result['status'] is equal to "success"
        $this->assertEquals($result['status'], 'fail');
        //Check if $result has a key = "data"
        $this->assertArrayHasKey('data', $result);

     }

     /**
      * @depends testHttpPost
      */
      public function testHttpPut_Fail(array $result) :array{
         $_SERVER['REQUEST_METHOD'] = 'PUT';
     
         $id = "9999";
         $payload = array(
            'first_name' => 'Test2',
            'middle_name' => 'test2',
            'last_name' => 'last test2',
            'contact_number' => 654655
         );
     
         $result = json_decode($this->api->httpPut($id, $payload), true);
         $this->assertArrayHasKey('status', $result);
         $this->assertEquals($result['status'], 'fail');
         $this->assertArrayHasKey('data', $result);
         return $result;
     }
     
     /**
      * @depends testHttpPost
      */
     public function testHttpDelete_Fail(array $result) :void {
         $_SERVER['REQUEST_METHOD'] = 'DELETE';
     
         $id = "9999";
         $payload = $result;
     
         $result = json_decode($this->api->httpDelete($id, $payload), true);
         $this->assertArrayHasKey('status', $result);
         $this->assertEquals($result['status'], 'fail');
         // $this->assertArrayHasKey('data', $result);
     }


}
?>
