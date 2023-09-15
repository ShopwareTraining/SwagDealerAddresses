<?php declare(strict_types=1);

namespace Swag\DealerAddresses\Page;

use Shopware\Storefront\Page\Page;

class DealersPage extends Page
{
    private array $dealers;

    public function setDealers(array $dealers)
    {
        $this->dealers = $dealers;
    }

    public function getDealers(): array
    {
        return $this->dealers;
    }
}