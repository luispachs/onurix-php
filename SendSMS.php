<?php

//Ejecutar composer require guzzlehttp/guzzle

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="app_api")
     */
    public function sendSMS()
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
          ];
        
        $parameters = [
            'form_params' => [
                'client' => 'AQUI_SU_CLIENT',
                'key' => 'AQUI_SU_KEY',
                'phone' => 'AQUI_EL_NUMERO_DE_CELULAR',
                'sms' => 'AQUI_EL_SMS_A_ENVIAR',
                'country-code' => 'CO'
                ]
        ];

        $client = new Client([
            'base_uri' => 'https://www.onurix.com/api/v1/'
        ]);
        $request = new Request('POST','send-sms',['body' => $headers]);
        $response = $client->sendAsync($request,$parameters)->wait();
        //dump($response->getBody()->getContents());exit;
        return $response->getBody()->getContents();
    }
}