<?php
declare(strict_types=1);

namespace Slotegrator\Console\Commands;

use Doctrine\ORM\EntityManager;
use Slotegrator\Business\Auth\AuthServiceInterface;
use Slotegrator\Business\Auth\DTO\SignInDTO;
use Slotegrator\Infrastructure\Entities\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateLoadTestPayload extends Command
{
    public function __construct(private AuthServiceInterface $authService, private EntityManager $entityManager)
    {
        parent::__construct('generate:payload');
    }

    /**
     * @var string
     */
    protected $signature = 'generate:payload';

    /**
     * @var string
     */
    protected $description = 'Generates json config for load testing';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);

        $token = $this->authService->login(new SignInDTO($user->getEmail(), '12345678'));

        $json = [
            'request_count' => 1000,
            'load_type' => 'linear',
            'duration' => 10,
            'steps' => [
               [
                   "id" => 1,
                   "url" => "http://nginx/api/raffle/play",
                   "protocol" => "http",
                   "method" => "POST",
                   "headers" => [
                       "Content-Type" => "application/json",
                       "Authorization" => "Bearer $token"
                   ],
               ]
            ]
        ];

        file_put_contents(BASE_DIR . '/../payload.json', json_encode($json));

        return 0;
    }
}
