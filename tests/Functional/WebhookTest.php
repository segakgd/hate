<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebhookTest extends WebTestCase
{
    public function test(){
        $client = static::createClient();

        $crawler = $client->request(
            'POST',
            '/webhook/1/telegram/',
            [],
            [],
            [],
            '{
              "update_id": 671775858,
              "message": {
                "message_id": 119,
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
                "date": 1686407114,
                "text": "Ничего"
              }
            }'
        );

        dd($crawler);


//        {
//            "update_id": 671775847,
//  "message": {
//            "message_id": 80,
//    "from": {
//                "id": 873817360,
//      "is_bot": false,
//      "first_name": "Sega",
//      "username": "sega_kgd",
//      "language_code": "ru"
//    },
//    "chat": {
//                "id": 873817360,
//      "first_name": "Sega",
//      "username": "sega_kgd",
//      "type": "private"
//    },
//    "date": 1685559541,
//    "text": "/command1",
//    "entities": [
//      {
//          "offset": 0,
//        "length": 9,
//        "type": "bot_command"
//      }
//    ]
//  }
//}

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
