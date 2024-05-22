<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportCsvCommand extends Command
{
    // Remove static $defaultName and set it explicitly in configure method
    protected static $defaultName = 'app:import-csv';

    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName('app:import-csv')
            ->setDescription('Imports data from a CSV file into the database.')
            ->setHelp('This command allows you to import data from a CSV file into the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = $this->container->get('doctrine')->getConnection();
        $filePath = '/Users/jillwets/Downloads/rodeDuivelsFanProject/public/fan_artikel_2024.csv';

        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                $geboortedatum = new \DateTime($data[1]);
                $lidnummer = $data[2];
                $cadeau = $data[3];

                $sql = "INSERT INTO fans (geboortedatum, lidnummer, cadeau) VALUES (:geboortedatum, :lidnummer, :cadeau)";

                $stmt = $connection->prepare($sql);
                $stmt->execute(['geboortedatum' => $geboortedatum->format('Y-m-d'), 'lidnummer' => $lidnummer, 'cadeau' => $cadeau]);

                $output->writeln("Record imported successfully.");
            }

            fclose($handle);
        } else {
            $output->writeln("<error>Could not open the CSV file.</error>");
        }

        return Command::SUCCESS;
    }
}
