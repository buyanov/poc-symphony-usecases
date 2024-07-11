<?php

namespace App\Command;

use App\UseCase\Shop\CreateShopUseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-shop',
    description: 'Create new shop'
)]
class CreateShopCommand extends Command
{

    public function __construct(private readonly CreateShopUseCase $createShopUseCase)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new shop.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the shop.')
            ->addArgument('location', InputArgument::REQUIRED, 'The address of the shop.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $address = $input->getArgument('location');

        $shop = $this->createShopUseCase->execute($name, $address);

        $output->writeln('Shop created with ID: ' . $shop->getId());

        return Command::SUCCESS;
    }
}