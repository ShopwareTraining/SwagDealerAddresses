<?php declare(strict_types=1);

namespace Swag\DealerAddresses\Controller;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Swag\DealerAddresses\Page\DealersPageLoader;
use Swag\DealerAddresses\Provider\DealerProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class DealersController extends StorefrontController
{
    public function __construct(
        private DealersPageLoader $dealersPageLoader
    ) {
    }

    #[Route(path: '/dealer/addresses', name: 'dealer.address.index', methods: ['GET'])]
    public function addresses(Request $request, SalesChannelContext $context)
    {
        return $this->renderStorefront('@SwagDealerAddresses/storefront/addresses.html.twig', [
            'page' => $this->dealersPageLoader->load($request, $context)
        ]);
    }
}