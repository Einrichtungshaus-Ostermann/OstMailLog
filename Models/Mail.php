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

namespace OstMailLog\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="ost_mail_logs")
 */
class Mail extends ModelEntity
{
    /**
     * Auto-generated id.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * ...
     *
     * @var DateTime
     *
     * @Assert\DateTime()
     *
     * @ORM\Column(name="`date`", type="datetime", nullable=false)
     */

    private $date;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="sender", type="string", nullable=false)
     **/

    private $sender;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="recipient", type="string", nullable=false)
     **/

    private $recipient;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="subject", type="string", nullable=false)
     **/

    private $subject;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=false)
     **/

    private $body;

    /**
     * ...
     *
     * @var boolean
     *
     * @ORM\Column(name="isHtml", type="boolean", nullable=false, options={"default": 0})
     **/

    private $isHtml;



    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Setter method for the property.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }



    /**
     * Getter method for the property.
     *
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }



    /**
     * Setter method for the property.
     *
     * @param DateTime $date
     *
     * @return void
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }



    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }



    /**
     * Setter method for the property.
     *
     * @param string $sender
     *
     * @return void
     */
    public function setSender(string $sender)
    {
        $this->sender = $sender;
    }



    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }



    /**
     * Setter method for the property.
     *
     * @param string $recipient
     *
     * @return void
     */
    public function setRecipient(string $recipient)
    {
        $this->recipient = $recipient;
    }



    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }



    /**
     * Setter method for the property.
     *
     * @param string $subject
     *
     * @return void
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }



    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }



    /**
     * Setter method for the property.
     *
     * @param string $body
     *
     * @return void
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }



    /**
     * Getter method for the property.
     *
     * @return bool
     */
    public function getisHtml()
    {
        return $this->isHtml;
    }



    /**
     * Setter method for the property.
     *
     * @param bool $isHtml
     *
     * @return void
     */
    public function setIsHtml(bool $isHtml)
    {
        $this->isHtml = $isHtml;
    }



}
