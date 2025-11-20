<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function posts(PostRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        // $posts = $repository->findAll();
        $posts = $repository->findBy(
            ["isPublished" => true],
            ['createdAt' => 'DESC']);
        //dd($posts);
        $pagination = $paginator->paginate($posts, $request->query->getInt('page', 1), 10);
        return $this->render('post/posts.html.twig', [
            'posts' => $pagination
        ]);
    }
    #[Route('/post/{slug:post}', name: 'app_post')]
    public function post(Post $post): Response
    {
        // $post = $repository->findOneBy(['slug'=>$slug]);
        // dd($post);
        return $this->render('post/post.html.twig', [
            'post' => $post
        ]);
    }

    #[Route('/posts/{category}', name: 'app_posts_by_category')]
    public function postsByCategory(PostRepository $repository,Request $request,PaginatorInterface $paginator, string $category): Response
    {
        /* $categorySlug = $categoryRepository->findOneBy(['slug'=>$category]);
        $posts = $repository->findBy(
            [
                'isPublished' => true,
                'category' => $categorySlug->getId()
            ],
            ['createdAt' => 'DESC']);*/
        $posts = $repository->findByCategory($category);
        $pagination = $paginator->paginate($posts, $request->query->getInt('page', 1), 10);
        return $this->render('post/posts.html.twig', [
            'posts' => $pagination]);
    }

}
