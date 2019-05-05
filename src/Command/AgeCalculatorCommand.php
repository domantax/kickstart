<?php

namespace App\Command;

use App\Services\ManageAgeResult;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AgeCalculatorCommand extends Command
{
    protected static $defaultName = 'app:age:calculator';

    private $manageAgeResult;

    public function __construct(ManageAgeResult $manageAgeResult)
    {
        parent::__construct();
        $this->manageAgeResult = $manageAgeResult;
    }

    protected function configure()
    {
        $this
            ->setDescription('Age calculator command with adulthood checking functionality ')
            ->addArgument('birthDate', InputArgument::REQUIRED, 'Birth date')
            ->addOption('adult', null, InputOption::VALUE_NONE, 'Option to check adulthood or not')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $birthDate = $input->getArgument('birthDate');

        $io->note($this->manageAgeResult->formatYearsOldResponse($birthDate));

        if ($input->getOption('adult')) {
            if ($this->manageAgeResult->checkIfAdult($birthDate)) {
                $io->success($this->manageAgeResult->formatAdultResponse());
            } else {
                $io->warning($this->manageAgeResult->formatNotAdultResponse());
            }
        }
    }
}
