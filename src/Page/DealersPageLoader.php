<?php declare(strict_types=1);

namespace Swag\DealerAddresses\Page;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoader;
use Swag\DealerAddresses\Provider\DealerProvider;
use Symfony\Component\HttpFoundation\Request;

class DealersPageLoader
{
    public function __construct(
        private GenericPageLoader $genericPageLoader,
        private DealerProvider $dealerProvider
    ) {
    }

    public function load(Request $request, SalesChannelContext $context): DealersPage
    {
        $page = $this->genericPageLoader->load($request, $context);
        $page = DealersPage::createFrom($page);
        $page->setDealers($this->dealerProvider->getDealers());
        return $page;
    }
}