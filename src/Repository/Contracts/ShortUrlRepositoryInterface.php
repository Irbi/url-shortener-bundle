<?php

namespace irbi\UrlShortenerBundle\Repository\Contracts;

use irbi\UrlShortenerBundle\Entity\Contracts\ShortUrlInterface;

/**
 * Interface ShortUrlRepositoryInterface
 * @package irbi\UrlShortenerBundle\Repository
 */
interface ShortUrlRepositoryInterface
{
    /**
     * @param string $url
     * @return ShortUrlInterface
     */
    public function findByOriginUrl(string $url) : ShortUrlInterface;

    /**
     * @param string $url
     * @return ShortUrlInterface
     */
    public function findByShortUrl(string $url) : ShortUrlInterface;

    /**
     * @param ShortUrlInterface $urlEntity
     * @return ShortUrlInterface
     */
    public function save(ShortUrlInterface $urlEntity) : ShortUrlInterface;
}
