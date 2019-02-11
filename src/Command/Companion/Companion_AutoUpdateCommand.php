<?php

namespace App\Command\Companion;

use App\Command\CommandHelperTrait;
use App\Service\Companion\CompanionMarketUpdater;
use App\Service\Companion\CompanionMarketUpdaterRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Companion_AutoUpdateCommand extends Command
{
    use CommandHelperTrait;

    const NAME = 'Companion_AutoUpdateCommand';

    /** @var CompanionMarketUpdater */
    private $companionMarketUpdater;

    public function __construct(CompanionMarketUpdater $companionMarketUpdater, $name = null)
    {
        $this->companionMarketUpdater = $companionMarketUpdater;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->addArgument('priority',    InputArgument::OPTIONAL, 'Priority')
            ->addArgument('limit',       InputArgument::OPTIONAL, 'DB Limit')
            ->addArgument('offset',      InputArgument::OPTIONAL, 'DB Offset');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->companionMarketUpdater->process(
            $input->getArgument('priority'),
            $input->getArgument('limit'),
            $input->getArgument('offset')
        );
    }
}