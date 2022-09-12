<?php declare(strict_types=1);

namespace Slotegrator\Console\Commands;


use Doctrine\ORM\EntityManager;
use League\Container\Container;
use Slotegrator\Infrastructure\Entities\Gift;
use Slotegrator\Infrastructure\Entities\GiftTransaction;
use Slotegrator\Infrastructure\Entities\MoneyTransaction;
use Slotegrator\Infrastructure\Entities\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Seed extends Command
{
    public function __construct(private Container $container)
    {
        parent::__construct('db:seed');
    }

    /**
     * @var string
     */
    protected $signature = 'db:seed';

    /**
     * @var string
     */
    protected $description = 'Seed';

    protected const GIFT_COUNT = 100;
    protected const USER_COUNT = 100;
    protected const MONEY = 1000000;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->seedGifts();
        $this->seedUsers();
        $this->seedMoneyTransactions();

        return 0;
    }

    protected function seedGifts()
    {
        $gifts = [];
        for ($i = 0; $i < self::GIFT_COUNT; $i++) {
            $gifts[] = (new Gift())
                ->setName('Gift ' . $i)
                ->setBalance(rand(1, 1000))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());
        }

        /** @var EntityManager $em */
        $em = $this->container->get(EntityManager::class);

        foreach ($gifts as $gift) {
            $em->persist($gift);
        }

        $em->flush();

        foreach ($gifts as $gift) {
            #add gift transaction for each gift
            $em->persist((new GiftTransaction())
                ->setGiftId($gift->getId())
                ->setAmount($gift->getBalance())
                ->setGiftBalance($gift->getBalance())
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime()));
        }
    }

    protected function seedUsers()
    {
        $users = [];
        for ($i = 0; $i < self::USER_COUNT; $i++) {
            $users[] = (new User())
                ->setEmail('mail' . time() . rand(0, 100000) . '@mail.com')
                ->setPassword(password_hash($_ENV['PASSWORD_SECRET'] . '12345678', PASSWORD_DEFAULT))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());
        }

        /** @var EntityManager $em */
        $em = $this->container->get(EntityManager::class);

        foreach ($users as $user) {
            $em->persist($user);
        }

        $em->flush();
    }

    protected function seedMoneyTransactions()
    {
        /** @var EntityManager $em */
        $em = $this->container->get(EntityManager::class);

        $em->persist(
            (new MoneyTransaction())
                ->setUserId(null)
                ->setAmount(self::MONEY)
                ->setBalance(self::MONEY)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
        );
    }
}
