<?php

namespace App\Command;

use App\Integrations\FooInsuranceApi;
use App\Utils\Mappings\AnosSegTag;
use App\Utils\Mappings\CondPpalTag;
use App\Utils\Mappings\CondUniTag;
use App\Utils\Mappings\FecCotTag;
use App\Utils\Mappings\Mapper;
use App\Utils\Mappings\NroCondOcaTag;
use App\Utils\Mappings\SegVigTag;
use App\Utils\Reader\ReaderCsv;
use App\Utils\Xml\XmlOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the "name" and "description" arguments of AsCommand replace the
// static $defaultName and $defaultDescription properties
#[AsCommand(
    name: 'app:foo-mapping',
    description: 'Mapping FOO Insurance API',
    hidden: false,
    aliases: ['app:foo-mapping']
)]
class DataGettheringCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('data:getthering')
            ->setDescription('To run the mapping in the console use: php bin/console app:foo-mapping </path/to/input.csv>')
            ->setHelp('This command allows make mapping FOO Insurance API')
            ->addArgument('pathfile', InputArgument::REQUIRED, 'Insert the path of the csv file')
            ;
    }

    // ...
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            '========================================================',
            'Hi, to mapping FOO Insurance API add input csv file path',
            '========================================================',
            '',
        ]);
        try {
            //code...
            $pathFile = $input->getArgument('pathfile');
            $reader = new ReaderCsv($pathFile);
            $reader->validateFileExist();
            $dataIput = $reader->readFile();

            $fooApi = new FooInsuranceApi($dataIput);
            $output->writeln($fooApi->responseAsString());

            
            $output->writeln('The xml generate is: ');
        } catch (\Exception $e) {
            $output->writeln('Exception error: '.$e->getMessage());
            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }
}
