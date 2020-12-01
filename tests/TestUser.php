<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestUser extends WebTestCase{
    public function authentification(String $username, String $password){
        $client = static::createClient();
        $infosClient = [
            'username'=> $username,
            'password'=> $password
        ];

        $client-> request('POST', 'api/login_check',[],[],[
                            'CONTENT_TYPE' => 'application/json'
                            ], json_encode($infosClient)
                        );
        
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        

    }
}