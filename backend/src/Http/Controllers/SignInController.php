<?php
declare(strict_types=1);

namespace Slotegrator\Http\Controllers;

use League\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slotegrator\Application\SignIn\Command\SignInCommand;
use Slotegrator\Application\SignIn\CommandHandler\SignInCommandHandlerInterface;
use Slotegrator\Http\Constants\MessagesInterface;
use Slotegrator\Http\Requests\SignInRequest;
use Slotegrator\Http\Responses\ErrorResponse;
use Slotegrator\Http\Responses\TokenResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SignInController extends BaseController
{
    public function __construct(
        private SignInCommandHandlerInterface $signInCommandHandler,
        Container $container,
        ValidatorInterface $validator,
        TranslatorInterface $translator
    ) {
        parent::__construct($container, $validator, $translator);
    }

    public function signIn(ServerRequestInterface $request): ResponseInterface
    {
        /** @var SignInRequest $signupRequest */
        $signupRequest = $this->mapRequest($request, SignInRequest::class);

        $violationList = $this->validator->validate($signupRequest);

        if (count($violationList) > 0) {
            return new ErrorResponse(
                $this->translator->trans(MessagesInterface::VALIDATION_ERROR),
                422,
                [(string)$violationList]
            );
        }

        $result = $this->signInCommandHandler->handle(new SignInCommand($signupRequest->email, $signupRequest->password));

        if (!$result->isSuccess()) {
            return new ErrorResponse($result->getMessage(), 422);
        }

        return new TokenResponse($result->getToken());
    }
}
