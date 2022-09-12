<?php
declare(strict_types=1);

namespace Slotegrator\Http\Controllers;

use League\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slotegrator\Application\Raffle\Command\PlayCommand;
use Slotegrator\Application\Raffle\CommandHandler\PlayCommandHandler;
use Slotegrator\Business\User\Entities\User;
use Slotegrator\Http\Responses\RaffleResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RaffleController extends BaseController
{
    public function __construct(
        protected PlayCommandHandler $playCommandHandler,
        Container $container,
        ValidatorInterface $validator,
        TranslatorInterface $translator
    ) {
        parent::__construct($container, $validator, $translator);
    }

    public function play(ServerRequestInterface $request): ResponseInterface
    {
        /** @var User $user */
        $user = $request->getAttribute('user');
        $result = $this->playCommandHandler->handle(new PlayCommand($user->getId()));

        return new RaffleResponse($result->getRaffle());
    }
}
