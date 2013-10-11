<?php

namespace App\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:admin:import')
            ->addOption('xls', null, InputOption::VALUE_REQUIRED, 'file path')
            ->addOption('start', null, InputOption::VALUE_REQUIRED, 'Start index')
            ->addOption('end', null, InputOption::VALUE_REQUIRED, 'End index')
            ->setDescription('')
        ;
    }

    protected function get($key)
    {
        return $this->getContainer()->get($key);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = (int) $input->getOption('start');
        $end = (int) $input->getOption('end');

        /** @var \App\MainBundle\Services\XlsImport $xls */
        $xls = $this->get('app.main.services.xls_import');
        $file = $input->getOption('xls');
        $xls->createFrom($file);
        $xls->import($start, $end);
        $output->writeln($this->getMemoryInfo());
    }

    private function getMemoryInfo()
    {
        return 'sub-cmd-memory='. memory_get_peak_usage()/(1024*1024).'Mb';
    }
}
