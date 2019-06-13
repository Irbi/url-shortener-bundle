<?php

namespace irbi\UrlShortenerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use irbi\UrlShortenerBundle\Entity\Contracts\ShortUrlInterface;
use irbi\UrlShortenerBundle\Repository\Contracts\ShortUrlRepositoryInterface;
use irbi\UrlShortenerBundle\Exception\StorageException;

/**
 * Class ShortUrlRepository
 * @package irbi\UrlShortenerBundle\Repository
 */
class ShortUrlRepository implements ShortUrlRepositoryInterface
{
    /**
     * @var EntityRepository
     */
    protected $storageManager;

    /**
     * ShortUrlRepository constructor.
     * @param EntityManagerInterface $storageManager
     */
    public function __construct(EntityManagerInterface $storageManager)
    {
        $this->storageManager = $storageManager->getRepository(ShortUrlInterface::class);
    }

    /**
     * @param string $url
     * @return ShortUrlInterface
     */
    public function findByOriginUrl(string $url) : ShortUrlInterface
    {
        $result = $this->storageManager->findOneBy(['origin' => $url]);
        return $result;
    }

    /**
     * @param string $url
     * @return ShortUrlInterface
     */
    public function findByShortUrl(string $url): ShortUrlInterface
    {
        // TODO: Implement findByShortUrl() method.
    }

    /**
     * @param ShortUrlInterface $urlEntity
     * @return ShortUrlInterface
     * @throws ORMException
     */
    public function save(ShortUrlInterface $urlEntity): ShortUrlInterface
    {
        $this->_em->persist($urlEntity);
        try {
            $this->_em->flush();
        } catch(\ORMException $e) {
            throw StorageException::class($e->getMessage());
        }

        return $urlEntity;
    }
}
