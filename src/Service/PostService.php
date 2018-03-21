<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 20/03/18
 * Time: 18:47
 */

namespace App\Service;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;

class PostService
{
    const POST_PER_PAGE = 5;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        EntityManagerInterface $em,
        RouterInterface $router
    )
    {
        $this->em = $em;
        $this->router = $router;
    }

    public function findPaginatePost(int $page = 1): array
    {
        $repository = $this->em->getRepository(Post::class);

        $count = $repository->count([]);

        if ($page < 1 || $page - 1 > $count / self::POST_PER_PAGE) {
            throw new \InvalidArgumentException("Page invalide");
        }

        $posts = $repository->findBy([], null, self::POST_PER_PAGE, ($page-1) * self::POST_PER_PAGE);

        $hasNext = $count > ($page-1) * self::POST_PER_PAGE + self::POST_PER_PAGE;

        return [
            'has_next_page' => $hasNext,
            'next' => $hasNext ?
                $this->router->generate(
                    'homepage',
                    [ 'page' => $page + 1 ]
                ):null,
            'posts' => $posts
        ];
    }
}