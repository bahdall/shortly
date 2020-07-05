<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLink;
use App\Services\LinkShorter\LinkShorterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\UrlGenerator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LinkController extends BaseController
{
    /**
     * @var LinkShorterService
     */
    private $linkShorterService;

    /**
     * LinkController constructor.
     * @param LinkShorterService $linkShorterService
     */
    public function __construct(LinkShorterService $linkShorterService)
    {
        $this->linkShorterService = $linkShorterService;
    }

    /**
     * @param CreateLink $createLink
     * @param UrlGenerator $urlGenerator
     * @return JsonResponse
     * @throws \Throwable
     */
    public function create(CreateLink $createLink, UrlGenerator $urlGenerator)
    {
        $url = $createLink->get('url');
        $userToken = (string) $createLink->header('TOKEN');

        $link = $this->linkShorterService->createLink($url, $userToken);
        $redirectUrl = $urlGenerator->route('link.redirect', [
            'hash' => $link->hash
        ]);

        return new JsonResponse(['url' => $redirectUrl]);
    }

    public function redirect(string $hash)
    {
        $link = $this->linkShorterService->findByHash($hash);

        if (is_null($link)) {
            throw new NotFoundHttpException('not found');
        }

        return new RedirectResponse($link->url);
    }
}
