<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CarpoolingTopic
 *
 * @ORM\Table(name="carpooling_topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarpoolingTopicRepository")
 */
class CarpoolingTopic
{
    const CARPOOLING_OFFER = 0;
    const CARPOOLING_REQUEST = 1;

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
     * @ORM\Column(name="posted_at", type="datetime")
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
     * @var int
     *
     * @ORM\Column(name="offer_or_request", type="integer")
     */
    private $offerOrRequest;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="CarpoolingMessage",
     *     mappedBy="carpoolingTopic"
     * )
     */
    private $messages;


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
     * @return CarpoolingTopic
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
     * @return CarpoolingTopic
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
     * @return CarpoolingTopic
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
     * Set offerOrRequest
     *
     * @param integer $offerOrRequest
     *
     * @return CarpoolingTopic
     */
    public function setOfferOrRequest($offerOrRequest)
    {
        $this->offerOrRequest = $offerOrRequest;

        return $this;
    }

    /**
     * Get offerOrRequest
     *
     * @return int
     */
    public function getOfferOrRequest()
    {
        return $this->offerOrRequest;
    }

    /**
     * @return ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }
}

