<?php

namespace irbi\UrlShortenerBundle\Controller;

use irbi\UrlShortenerBundle\Service\Contracts\EncoderInterface;
use irbi\UrlShortenerBundle\Exception\InvalidUrlException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EncodeController extends AbstractController
{
    /**
     * @var EncoderInterface
     */
    protected $service;

    public function __construct(EncoderInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/shortUrl")
     * @param Request
     * @return JsonResponse
     * @throws InvalidUrlException
     */
    public function create(Request $request) : JsonResponse
    {
        $url = $request->request->get('url');
        $lifeTime = $request->request->get('lifeTime');

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException();
        }

        $newUrl = $this->service->create($url, $lifeTime);
        $entity = $this->service->shortenUrl($newUrl);
        $result = $this->service->save($entity);

        return new JsonResponse([
            'url' => $result->getOriginalUrl(),
            'code' => $result->getShortUrl(),
            'expDate' => $result->getExpirationDate()
        ]);
    }
}
