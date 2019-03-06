<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Mail Log
 *
 * @package   OstMailLog
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2019 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstMailLog\Commands;

use Shopware\Commands\ShopwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanUpCommand extends ShopwareCommand
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        parent::__construct('ost-mail-log:clean-up');
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this->setDescription('Cleans the mail log from old entries')
            ->setHelp('The <info>%command.name%</info> cleans old mail logs.');
    }

    /**
     * {@inheritdoc}
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
        $output->writeln('cleaning up old mail logs');

        // ...
        $query = "
            SELECT COUNT(*)
            FROM ost_mail_logs
        ";
        $total = (integer) Shopware()->Db()->fetchOne( $query );

        // ...
        $query = "
            SELECT COUNT(*)
            FROM ost_mail_logs
            WHERE `date` NOT BETWEEN DATE_SUB(NOW(), INTERVAL " . (integer) $this->configuration['removeMailsAfterDays'] . " DAY) AND NOW()
        ";
        $remove = (integer) Shopware()->Db()->fetchOne( $query );

        // ...
        $query = "
            DELETE
            FROM ost_mail_logs
            WHERE `date` NOT BETWEEN DATE_SUB(NOW(), INTERVAL " . (integer) $this->configuration['removeMailsAfterDays'] . " DAY) AND NOW()
        ";
        Shopware()->Db()->query( $query );

        // ...
        $output->writeln('total emails: ' . $total);
        $output->writeln('removed emails: ' . $remove);
        $output->writeln('');
    }
}
