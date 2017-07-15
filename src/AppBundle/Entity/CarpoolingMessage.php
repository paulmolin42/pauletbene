<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarpoolingMessage
 *
 * @ORM\Table(name="carpooling_message")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarpoolingMessageRepository")
 */
class CarpoolingMessage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postedAt", type="datetime")
     */
    private $postedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var CarpoolingTopic
     *
     * @ORM\ManyToOne(
     *     targetEntity="CarpoolingTopic",
     *     inversedBy="messages"
     * )
     */
    private $carpoolingTopic;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set postedAt
     *
     * @param \DateTime $postedAt
     *
     * @return CarpoolingMessage
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return CarpoolingMessage
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return CarpoolingMessage
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return CarpoolingTopic
     */
    public function getCarpoolingTopic()
    {
        return $this->carpoolingTopic;
    }

    /**
     * @param CarpoolingTopic $carpoolingTopic
     */
    public function setCarpoolingTopic($carpoolingTopic)
    {
        $this->carpoolingTopic = $carpoolingTopic;
    }
}

