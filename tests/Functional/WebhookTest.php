<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebhookTest extends WebTestCase
{
    public function testAcceptMessage(){
        $client = static::createClient();

        $crawler = $client->request(
            'POST',
            '/webhook/',
            [],
            [],
            [],
            '{
              "update_id": 671775841,
              "message": {
                "message_id": 45,
                "from": {
                   "id": 873817360,
                  "is_bot": false,
                  "first_name": "Sega",
                  "username": "sega_kgd",
                  "language_code": "ru"
                },
                "chat": {
                  "id": 873817360,
                  "first_name": "Sega",
                  "username": "sega_kgd",
                  "type": "private"
                },
                "date": 1683837388,
                "text": "asdasd"
              }
            }'
        );

        dd($crawler);

        // '/webhook/'

//        {
//          "update_id": 671775841,
//          "message": {
//            "message_id": 45,
//            "from": {
//               "id": 873817360,
//              "is_bot": false,
//              "first_name": "Sega",
//              "username": "sega_kgd",
//              "language_code": "ru"
//            },
//            "chat": {
//              "id": 873817360,
//              "first_name": "Sega",
//              "username": "sega_kgd",
//              "type": "private"
//            },
//            "date": 1683837388,
//            "text": "asdasd"
//          }
//        }
    }
}
