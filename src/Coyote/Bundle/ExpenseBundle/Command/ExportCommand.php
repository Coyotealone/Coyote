<?php

namespace Coyote\Bundle\ExpenseBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends ContainerAwareCommand
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Console\Command\Command::configure()
	 */
    protected function configure()
    {
        $this
            ->setName('export:expense')
            ->setDescription('Export expense for X3');
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$em = $this->getContainer()->get('doctrine')->getManager();
    	$dataexpense = $em->getRepository('CoyoteExpenseBundle:Expense')->createFileExpense();
    	$em->getRepository('CoyoteExpenseBundle:Expense')->updateStatusTo0($em);
    	$output->write($dataexpense);
    }
}