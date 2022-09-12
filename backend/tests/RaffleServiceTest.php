<?php
declare(strict_types=1);

namespace Tests;

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Slotegrator\Business\Gift\GiftServiceInterface;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionServiceInterface;
use Slotegrator\Business\Raffle\Entities\Raffle;
use Slotegrator\Business\Raffle\Factory\ProbabilityFactory;
use Slotegrator\Business\Raffle\ProbabilityGenerator\ProbabilityGenerator;
use Slotegrator\Business\Raffle\ProbabilityGenerator\ProbabilityGeneratorInterface;
use Slotegrator\Business\Raffle\RaffleService;
use Slotegrator\Business\Raffle\RaffleServiceInterface;
use Slotegrator\Infrastructure\Entities\Gift;
use Slotegrator\Infrastructure\Entities\GiftTransaction;
use Slotegrator\Infrastructure\Entities\MoneyTransaction;
use Slotegrator\Infrastructure\Entities\User;

class RaffleServiceTest extends TestCase
{
    use CreatesApplication;

    private EntityManager $entityManager;
    private RaffleService $raffleService;

    protected function setUp(): void
    {
        parent::setUp();

        if (!$this->container) {
            $this->container = $this->createApplication();
        }

        $this->moneyTransactionService = $this->container->get(MoneyTransactionServiceInterface::class);
        $this->entityManager = $this->container->get(EntityManager::class);
    }

    public function testWinsMoney()
    {
        $this->container->extend(ProbabilityGeneratorInterface::class)->setConcrete(function () {
            return new class(
                $this->container->get(GiftServiceInterface::class),
                $this->container->get(ProbabilityFactory::class),
            ) extends ProbabilityGenerator implements ProbabilityGeneratorInterface {
                protected function generateBonusProbabilities(): array
                {
                    return [];
                }

                protected function generateGiftProbabilities(): array
                {
                    return [];
                }
            };
        });

        $this->raffleService = $this->container->get(RaffleServiceInterface::class);

        $this->entityManager->getConnection()->beginTransaction();

        $user = (new User())
            ->setEmail('mail' . time() . rand(0, 100000) . '@mail.com')
            ->setPassword(password_hash($_ENV['PASSWORD_SECRET'] . '12345678', PASSWORD_DEFAULT))
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($user);

        $this->entityManager->persist(
            (new MoneyTransaction())
                ->setAmount(100)
                ->setUpdatedAt(new \DateTime())
                ->setCreatedAt(new \DateTime())
                ->setIsWithdrawalProcessed(false)
                ->setBalance(10000000)
        );
        $this->entityManager->flush();


        $raffle = $this->raffleService->play($user->getId());

        $this->assertEquals(Raffle::TYPE_MONEY, $raffle->getType());

        $this->entityManager->getConnection()->rollBack();
    }

    public function testWinsGift()
    {
        $this->container->extend(ProbabilityGeneratorInterface::class)->setConcrete(function () {
            return new class(
                $this->container->get(GiftServiceInterface::class),
                $this->container->get(ProbabilityFactory::class),
            ) extends ProbabilityGenerator implements ProbabilityGeneratorInterface {
                protected function generateMoneyProbability(): array
                {
                    return [];
                }

                protected function generateBonusProbabilities(): array
                {
                    return [];
                }
            };
        });

        $this->raffleService = $this->container->get(RaffleServiceInterface::class);

        $this->entityManager->getConnection()->beginTransaction();

        $this->seedGifts();

        $user = (new User())
            ->setEmail('mail' . time() . rand(0, 100000) . '@mail.com')
            ->setPassword(password_hash($_ENV['PASSWORD_SECRET'] . '12345678', PASSWORD_DEFAULT))
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($user);

        $this->entityManager->persist(
            (new MoneyTransaction())
                ->setAmount(100)
                ->setUpdatedAt(new \DateTime())
                ->setCreatedAt(new \DateTime())
                ->setIsWithdrawalProcessed(false)
                ->setBalance(10000000)
        );
        $this->entityManager->flush();


        $raffle = $this->raffleService->play($user->getId());

        $this->assertEquals(Raffle::TYPE_GIFT, $raffle->getType());

        $this->entityManager->getConnection()->rollBack();
    }

    public function testWinsBonus()
    {
        $this->container->extend(ProbabilityGeneratorInterface::class)->setConcrete(function () {
            return new class(
                $this->container->get(GiftServiceInterface::class),
                $this->container->get(ProbabilityFactory::class),
            ) extends ProbabilityGenerator implements ProbabilityGeneratorInterface {
                protected function generateGiftProbabilities(): array
                {
                    return [];
                }

                protected function generateMoneyProbability(): array
                {
                    return [];
                }
            };
        });

        $this->raffleService = $this->container->get(RaffleServiceInterface::class);

        $this->entityManager->getConnection()->beginTransaction();

        $user = (new User())
            ->setEmail('mail' . time() . rand(0, 100000) . '@mail.com')
            ->setPassword(password_hash($_ENV['PASSWORD_SECRET'] . '12345678', PASSWORD_DEFAULT))
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($user);

        $this->entityManager->persist(
            (new MoneyTransaction())
                ->setAmount(100)
                ->setUpdatedAt(new \DateTime())
                ->setCreatedAt(new \DateTime())
                ->setIsWithdrawalProcessed(false)
                ->setBalance(10000000)
        );
        $this->entityManager->flush();


        $raffle = $this->raffleService->play($user->getId());

        $this->assertEquals(Raffle::TYPE_BONUS, $raffle->getType());

        $this->entityManager->getConnection()->rollBack();
    }


    protected function seedGifts()
    {
        $gifts = [];
        for ($i = 0; $i < 10; $i++) {
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
}
