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

namespace OstMailLog\Listeners\Enlight\Components;

use Enlight_Event_EventArgs as EventArgs;
use Enlight_Components_Mail as MailComponent;
use OstMailLog\Models\Mail as MailModel;

class Mail
{
    /**
     * ...
     *
     * @var array
     */
    private $configuration;

    /**
     * ...
     *
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        // set params
        $this->configuration = $configuration;
    }

    /**
     * ...
     *
     * @param EventArgs   $arguments
     *
     * @return void
     */

    public function onMailSend( EventArgs $arguments )
    {
        /* @var $mailComponent MailComponent */
        $mailComponent = $arguments->get( "mail" );

        // create a new mail
        $mail = new MailModel();

        // set it up
        $mail->setDate( new \DateTime() );
        $mail->setSender( (string) $mailComponent->getFrom() );
        $mail->setRecipient( (string) array_shift( $mailComponent->getTo() ) );
        $mail->setSubject( (string) $mailComponent->getPlainSubject() );
        $mail->setBody( (string) $mailComponent->getPlainBody() );
        $mail->setIsHtml( !( $mailComponent->getBodyHtml() === false ) );

        // save it
        Shopware()->Container()->get( "models" )->persist( $mail );
        Shopware()->Container()->get( "models" )->flush( $mail );
    }
}
