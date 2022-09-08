<?php declare(strict_types=1);

namespace Slotegrator\Http\Controllers;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slotegrator\Http\Constants\MessagesInterface;
use Slotegrator\Http\Requests\SignUpRequest;
use Slotegrator\Http\Responses\ErrorResponse;

class SignupController extends BaseController
{
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

        return new JsonResponse([
            'status' => 'ok',
            'data' => $signupRequest
        ]);
    }
}
