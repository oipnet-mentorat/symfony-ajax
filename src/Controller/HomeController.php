<?php

namespace App\Controller;

use App\Service\PostService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @var PostService
     */
    private $postService;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(PostService $postService, Environment $twig)
    {
        $this->postService = $postService;
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        $page = $request->get('page') ?? 1;

        $paginatePosts = $this->postService->findPaginatePost($page);

        if ($request->isXmlHttpRequest()) {
            $render = $this->twig->render('partials/_posts.html.twig', compact('paginatePosts'));

            $paginatePosts['render'] = $render;
            return new JsonResponse(json_encode($paginatePosts));
        }

        return new Response($this->twig->render('home.html.twig', compact('paginatePosts')));
    }
}
