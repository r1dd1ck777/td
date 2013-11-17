<?php

namespace App\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSupervizorCommand extends ContainerAwareCommand
{
    const ITEMS_PER_CMD = 500;
    protected function configure()
    {
        $this
            ->setName('app:admin:import_supervizor')
            ->addOption('xls', null, InputOption::VALUE_REQUIRED, 'file path')
            ->setDescription('')
        ;
    }

    protected function get($key)
    {
        return $this->getContainer()->get($key);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = $this->get('logger');
        $logger->info("XLS: start");
        $file = $input->getOption('xls');
        /** @var \App\MainBundle\Services\XlsImport $xls */
        $xls = $this->get('app.main.services.xls_import');
        $xls->createFrom($file);
        $firstRow = 2;
        $total = $xls->getHighestRow();
        var_dump($total);
        $cmds = floor($total / self::ITEMS_PER_CMD);
        $xls->status(true);
        $xls->total($total);
        $o = null;
        for ($i = 0; $i < $cmds; $i++) {
            $start = ($i * self::ITEMS_PER_CMD) + $firstRow;
            $logger->info("RUN: {$this->getCmd($file, $start, $start + self::ITEMS_PER_CMD)}");
            exec($this->getCmd($file, $start, $start + self::ITEMS_PER_CMD), $o);
            $output->writeln(var_export($o));
        }
        $start = ($i * self::ITEMS_PER_CMD) + $firstRow;
        $logger->info("RUN: {$this->getCmd($file, $start, $start + self::ITEMS_PER_CMD)}");
        exec($this->getCmd($file, $start, $total), $o);
        $output->writeln(var_export($o));

        $xls->status(false);
        $output->writeln($this->getMemoryInfo());
        $logger->info("XLS: end");
    }

    protected function getCmd($file, $start, $end)
    {
        return "php ".$this->getContainer()->getParameter('kernel.root_dir')."/console app:admin:import --xls={$file} --start={$start} --end=".$end;
    }

    private function getMemoryInfo()
    {
        return 'memory='. memory_get_peak_usage()/(1024*1024).'Mb';
    }
}
