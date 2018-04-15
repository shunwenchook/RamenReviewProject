<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePageStatusOkay() {
        // Arrange
        $url ="/";
        $httpMethod ='GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_OK;

        // assert
        $client->request($httpMethod, $url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        // act
        $this->assertEquals($expectedResult, $resultStatusCode);
    }
}