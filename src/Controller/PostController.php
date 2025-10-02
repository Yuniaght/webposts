<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function posts(PostRepository $repository): Response
    {
        // $posts = $repository->findAll();
        $posts = $repository->findBy(
            ["isPublished" => true],
            ['createdAt' => 'DESC']);
        // dd($posts);
        return $this->render('post/posts.html.twig', [
            'posts' => $posts
        ]);
    }
    #[Route('/post/{slug}', name: 'app_post')]
    public function post(postRepository $repository, string $slug): Response
    {
        $post = $repository->findOneBy(['slug'=>$slug]);
        // dd($post);
        return $this->render('post/post.html.twig', [
            'post' => $post
        ]);
    }

    #[Route('/posts/{category}', name: 'app_posts_by_category')]
    public function postsByCategory(PostRepository $repository, CategoryRepository $categoryRepository, string $category): Response
    {
        $categorySlug = $categoryRepository->findOneBy(['slug'=>$category]);
        $posts = $repository->findBy(
            [
                'isPublished' => true,
                'category' => $categorySlug->getId()
            ],
            ['createdAt' => 'DESC']);
        return $this->render('post/posts.html.twig', [
            'posts' => $posts]);
    }
}
