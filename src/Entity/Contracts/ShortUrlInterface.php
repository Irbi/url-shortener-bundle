<?php

namespace irbi\UrlShortenerBundle\Entity\Contracts;

interface ShortUrlInterface
{
    /**
     * Create empty instance
     * @return ShortUrlInterface
     */
    public function create() : ShortUrlInterface;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return ShortUrlInterface
     */
    public function setId(int $id): ShortUrlInterface;

    /**
     * @return string
     */
    public function getOriginalUrl(): string;

    /**
     * @param string $originalUrl
     * @return ShortUrlInterface
     */
    public function setOriginalUrl(string $originalUrl): ShortUrlInterface;

    /**
     * @return string
     */
    public function getShortUrl(): string;

    /**
     * @param string $shortUrl
     * @return ShortUrlInterface
     */
    public function setShortUrl(string $shortUrl): ShortUrlInterface;

    /**
     * @return int|null
     */
    public function getExpirationDate(): ?int;

    /**
     * @param int|null $expirationDate
     * @return ShortUrlInterface
     */
    public function setExpirationDate(?int $expirationDate): ShortUrlInterface;
}