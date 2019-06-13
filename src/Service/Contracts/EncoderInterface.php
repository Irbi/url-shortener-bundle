<?php

namespace irbi\UrlShortenerBundle\Service\Contracts;

use irbi\UrlShortenerBundle\Entity\Contracts\ShortUrlInterface;

interface EncoderInterface
{
    public const TAG = 'url.shortener.service';

    /**
     * Create new URL in db
     *
     * @param string $url
     * @param string|null $lifeTime
     * @return ShortUrlInterface
     */
    public function create(string $url, string $lifeTime = null) : ShortUrlInterface;

    /**
     * Create short URL from original URL
     *
     * @param ShortUrlInterface $entity
     * @return ShortUrlInterface
     */
    public function shortenUrl(ShortUrlInterface $entity) : ShortUrlInterface;

    /**
     * Save record
     *
     * @param ShortUrlInterface $entity
     * @return ShortUrlInterface
     */
    public function save(ShortUrlInterface $entity) : ShortUrlInterface;
}