<?php

namespace Evrinoma\ExchangeRateBundle\Command;

use Evrinoma\ExchangeRateBundle\Command\Fetch\Description\DummyDescription;
use Evrinoma\ExchangeRateBundle\Command\Fetch\Handler\DummyHandler;
use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PullCommand extends Command
{
//region SECTION: Fields
    protected static $defaultName = 'evrinoma:'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.':pull';
//endregion Fields

//region SECTION: Constructor
    public function __construct()
    {
        parent::__construct();
    }
//endregion Constructor

//region SECTION: Protected
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName(static::$defaultName)
            ->setDescription('Pull Exchange Rate data')
            ->setHelp(
                <<<'EOT'
The <info>evrinoma:menu:create</info> command pull exchange rate data and save it in database

  <info>php %command.full_name%</info>
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = new DummyHandler(new DummyDescription());
        try {
            $resource = $handler->run();

            $output->writeln(['============']);

            foreach($resource->getHeader() as $key => $value) {
                $output->writeln($key);
                $output->writeln($value);

            }
            $data = $resource->getData();

            $output->writeln(['============']);
        } catch (\Exception $e) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
//endregion Protected

}