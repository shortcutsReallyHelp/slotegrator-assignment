<?php declare(strict_types=1);

namespace Slotegrator\Http\Controllers;

use Laminas\Diactoros\Response\JsonResponse;
use League\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slotegrator\Application\SignUp\Command\SignUpCommand;
use Slotegrator\Application\SignUp\CommandHandler\SignUpCommandHandlerInterface;
use Slotegrator\Http\Constants\MessagesInterface;
use Slotegrator\Http\Requests\SignUpRequest;
use Slotegrator\Http\Responses\ErrorResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SignupController extends BaseController
{
    public function __construct(
        private SignUpCommandHandlerInterface $signUpCommandHandler,
        Container $container,
        ValidatorInterface $validator,
        TranslatorInterface $translator,
    ) {
        parent::__construct($container, $validator, $translator);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function signup(ServerRequestInterface $request): ResponseInterface
    {
        /** @var SignUpRequest $signupRequest */
        $signupRequest = $this->mapRequest($request, SignUpRequest::class);

        $violationList = $this->validator->validate($signupRequest);

        if (count($violationList) > 0) {
            return new ErrorResponse(
                $this->translator->trans(MessagesInterface::VALIDATION_ERROR),
                422,
                [(string)$violationList]
            );
        }

        $result = $this->signUpCommandHandler->handle(new SignUpCommand($signupRequest->email, $signupRequest->password));

        if (!$result->isSuccess()) {
            return new ErrorResponse($result->getMessage(), 422);
        }

        return new JsonResponse([
            'status' => 'ok',
        ]);
    }
}
