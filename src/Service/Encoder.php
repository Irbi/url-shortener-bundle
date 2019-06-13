<?php

namespace irbi\UrlShortenerBundle\Service;

use Hashids\Hashids;
use irbi\UrlShortenerBundle\Entity\Contracts\ShortUrlInterface;
use irbi\UrlShortenerBundle\Service\Contracts\EncoderInterface;
use irbi\UrlShortenerBundle\Repository\Contracts\ShortUrlRepositoryInterface;

/**
 * Class Encoder
 * @package irbi\UrlShortenerBundle\Service
 */
class Encoder implements EncoderInterface
{
    /**
     * @var ShortUrlInterface
     */
    protected $entity;

    /**
     * @var ShortUrlRepositoryInterface
     */
    protected $repo;

    /**
     * @var Hashids
     */
    protected $hashService;

    /**
     * Encoder constructor.
     * @param ShortUrlInterface $entity
     * @param ShortUrlRepositoryInterface $repo
     * @param Hashids $hashids
     */
    public function __construct(ShortUrlInterface $entity, ShortUrlRepositoryInterface $repo, Hashids $hashids)
    {
        $this->entity = $entity;
        $this->repo = $repo;
        $this->hashService = $hashids;
    }

    /**
     * @param string $url
     * @param string|null $lifeTime
     * @return ShortUrlInterface
     */
    public function create(string $url, string $lifeTime = null): ShortUrlInterface
    {
        $entity = $this->entity->create();
        $entity->setOriginalUrl($url);
        if (!empty($lifeTime)) {
            $expire = strtotime($lifeTime);
            $entity->setExpirationDate($expire);
        }
        $result = $this->repo->save($entity);

        return $result;
    }

    /**
     * @param ShortUrlInterface $entity
     * @return ShortUrlInterface
     */
    public function shortenUrl(ShortUrlInterface $entity): ShortUrlInterface
    {
        $urlId = $entity->getId();
        $shortUrl = $this->hashService->encode($urlId);
        $entity->setShortUrl($shortUrl);

        return $entity;
    }

    /**
     * @param ShortUrlInterface $entity
     * @return ShortUrlInterface
     */
    public function save(ShortUrlInterface $entity): ShortUrlInterface
    {
        $result = $this->repo->save($entity);
        return $result;
    }
}
