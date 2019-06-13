<?php

namespace irbi\UrlShortenerBundle\Entity;

use irbi\UrlShortenerBundle\Entity\Contracts\ShortUrlInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class ShortUrl
 * @package irbi\UrlShortenerBundle\Entity
 * @ORM\Table(name="shorturl", indexes={@ORM\Index(name="idx_su_complex", columns={"id", "url"})})
 */
class ShortUrl implements ShortUrlInterface
{
    /**
     * Primary key
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose()
     */
    protected $id;

    /**
     * Original URL
     * @var string
     * @ORM\Column(name="original", type="string", length=255)
     * @Assert\NotBlank(message="Original URL couldn't be empty")
     * @Assert\Length(max = 255, maxMessage = "Url too long, max length is {{ limit }} chars")
     * @JMS\Expose()
     */
    protected $originalUrl;

    /**
     * Short URL
     * @var string
     * @ORM\Column(name="short", type="string", length=50, nullable=true)
     * @JMS\Expose()
     */
    protected $shortUrl;

    /**
     * Expiration date (if exists, unlimited otherwise)
     * @var int|null
     * @ORM\Column(name="expiration", type="integer", nullable=true)
     * @JMS\Expose()
     */
    protected $expirationDate;

    /**
     * @return ShortUrlInterface
     */
    public function create(): ShortUrlInterface
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ShortUrlInterface
     */
    public function setId(int $id): ShortUrlInterface
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    /**
     * @param string $originalUrl
     * @return ShortUrlInterface
     */
    public function setOriginalUrl(string $originalUrl): ShortUrlInterface
    {
        $this->originalUrl = $originalUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }

    /**
     * @param string $shortUrl
     * @return ShortUrlInterface
     */
    public function setShortUrl(string $shortUrl): ShortUrlInterface
    {
        $this->shortUrl = $shortUrl;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpirationDate(): ?int
    {
        return $this->expirationDate;
    }

    /**
     * @param int|null $expirationDate
     * @return ShortUrlInterface
     */
    public function setExpirationDate(?int $expirationDate): ShortUrlInterface
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }
}
