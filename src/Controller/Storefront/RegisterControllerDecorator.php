<?php declare(strict_types=1);

namespace Dwmd\RemoveGuestOrder\Controller\Storefront;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Shopware\Storefront\Controller\RegisterController;
use Shopware\Core\Checkout\Cart\SalesChannel\CartService;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Storefront\Page\Account\Login\AccountLoginPageLoader;
use Shopware\Core\Checkout\Customer\SalesChannel\AbstractRegisterRoute;
use Shopware\Storefront\Page\Checkout\Register\CheckoutRegisterPageLoader;
use Shopware\Core\Checkout\Customer\SalesChannel\AbstractRegisterConfirmRoute;
use Shopware\Storefront\Page\Account\CustomerGroupRegistration\AbstractCustomerGroupRegistrationPageLoader;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class RegisterControllerDecorator extends RegisterController
{
    public function __construct(
        private readonly RegisterController $innerController,
        private readonly AccountLoginPageLoader $loginPageLoader,
        private readonly AbstractRegisterRoute $registerRoute,
        private readonly AbstractRegisterConfirmRoute $registerConfirmRoute,
        private readonly CartService $cartService,
        private readonly CheckoutRegisterPageLoader $registerPageLoader,
        private readonly SystemConfigService $systemConfigService,
        private readonly EntityRepository $customerRepository,
        private readonly AbstractCustomerGroupRegistrationPageLoader $customerGroupRegistrationPageLoader,
        private readonly  EntityRepository $domainRepository
    ) {
        parent::__construct(
            $loginPageLoader,
            $registerRoute,
            $registerConfirmRoute,
            $cartService,
            $registerPageLoader,
            $systemConfigService,
            $customerRepository,
            $customerGroupRegistrationPageLoader,
            $domainRepository
        );
    }

    #[Route(path: '/account/register', name: 'frontend.account.register.save', defaults: ['_captcha' => true], methods: ['POST'])]
    public function register(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->get('DwmdRemoveGuestOrder.config.deactivateGuests', $context->getSalesChannelId())) {
            $data->set('createCustomerAccount', true);
        }

        return $this->innerController->register($request, $data, $context);
    }
}