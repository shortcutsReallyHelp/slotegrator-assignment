<?php declare(strict_types=1);

namespace Tests;

use Doctrine\ORM\EntityManager;
use League\Container\Container;
use PHPUnit\Framework\TestCase;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionService;
use Slotegrator\Business\MoneyTransaction\MoneyTransactionServiceInterface;
use Slotegrator\Infrastructure\Entities\MoneyTransaction;

class MoneyTransactionServiceTest extends TestCase
{
    use CreatesApplication;

    private MoneyTransactionService $moneyTransactionService;
    private EntityManager $entityManager;


    protected function setUp(): void
    {
        parent::setUp();

        if (!$this->container) {
            $this->container = $this->createApplication();
        }

        $this->moneyTransactionService = $this->container->get(MoneyTransactionServiceInterface::class);
        $this->entityManager = $this->container->get(EntityManager::class);
    }

    public function testGetBalance(): void
    {
        $this->entityManager->getConnection()->beginTransaction();

        $this->entityManager->persist(
            (new MoneyTransaction())
                ->setAmount(100)
                ->setUpdatedAt(new \DateTime())
                ->setCreatedAt(new \DateTime())
                ->setIsWithdrawalProcessed(false)
                ->setBalance(100)
        );
        $this->entityManager->flush();

        $this->assertEquals(100, $this->moneyTransactionService->getBalance());

        $this->entityManager->getConnection()->rollBack();
    }


    public function testGetMoneyTransactions(): void
    {
        $this->entityManager->getConnection()->beginTransaction();

        $this->entityManager->persist(
            (new MoneyTransaction())
                ->setAmount(100)
                ->setUserId(1)
                ->setUpdatedAt(new \DateTime())
                ->setCreatedAt(new \DateTime())
                ->setIsWithdrawalProcessed(false)
                ->setBalance(100)
        );
        $this->entityManager->flush();

        $this->assertEquals(100, $this->moneyTransactionService->getWithdrawals(1)[0]->getAmount());

        $this->entityManager->getConnection()->rollBack();
    }

}
