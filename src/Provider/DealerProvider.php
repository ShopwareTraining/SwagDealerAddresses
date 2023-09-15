<?php

namespace Swag\DealerAddresses\Provider;

use Shopware\Core\Framework\Struct\Struct;
use Shopware\Core\Framework\Uuid\Uuid;

class DealerProvider extends Struct
{
    public function getDealers()
    {
        return [
            [
                'id' => Uuid::randomHex(),
                'name' => 'Shopware AG',
                'description' => 'Ebbinghoff 10, 48624 Schöppingen, Germany',
                'latitude' => '52.0881322',
                'longitude' => '7.2429295',
            ],
            [
                'id' => Uuid::randomHex(),
                'name' => 'Strix Poland',
                'description' => 'Zygmunta Miłkowskiego 5/3U, 30-349 Kraków, Poland',
                'latitude' => '50.0271963',
                'longitude' => '19.9168767',
            ],
            [
                'id' => Uuid::randomHex(),
                'name' => 'Yireo',
                'description' => 'Amalialaan 126, Baarn, The Netherlands',
                'latitude' => '52.2059744',
                'longitude' => '5.2742907',
            ],
        ];
    }
}