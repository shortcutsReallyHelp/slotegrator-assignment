<?php declare(strict_types=1);

namespace Slotegrator\Console\Commands;

use Slotegrator\Business\MoneyTransaction\MoneyTransactionServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessPayments extends Command
{
    public function __construct(private MoneyTransactionServiceInterface $moneyTransactionService)
    {
        parent::__construct($this->signature);
    }

    /**
     * @var string
     */
    protected $signature = 'payments:process';

    /**
     * @var string
     */
    protected $description = 'Process payments';

    protected function configure(): void
    {
        $this->addArgument('limit', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = $input->getArgument('limit');
        $transactions = $this->moneyTransactionService->getWithdrawals((int)$limit);

        //call bank api related service
        $this->moneyTransactionService->markMoneyTransactionsProcessed(array_map(fn($transaction) => $transaction->getId(), $transactions));

        return 0;
    }
}
