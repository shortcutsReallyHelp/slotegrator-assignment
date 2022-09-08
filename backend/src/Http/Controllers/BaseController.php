<?php declare(strict_types=1);

namespace Slotegrator\Http\Controllers;

use League\Container\Container;
use Psr\Http\Message\RequestInterface;
use Slotegrator\Http\Requests\BaseRequest;
use Slotegrator\Http\Requests\SignUpRequest;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class BaseController
{
    /**
     * @param Container $container
     * @param ValidatorInterface $validator
     * @param TranslatorInterface $translator
     */
    public function __construct(
        protected Container $container,
        protected ValidatorInterface $validator,
        protected TranslatorInterface $translator
    ) {}

    /**
     * @param RequestInterface $request
     * @param string $class
     * @return BaseRequest
     */
    protected function mapRequest(RequestInterface $request, string $class): BaseRequest
    {
        $requestClass = $this->container->getNew($class);
        return $requestClass->fromArray($request->getParsedBody());
    }
}
