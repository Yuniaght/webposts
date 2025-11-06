<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

final class AdminPostController extends AbstractController
{
    //public function __construct(private readonly SluggerInterface $slugger)
    //{

    //}
    #[Route('/admin/posts', name: 'app_admin_posts')]
    public function AdminPosts(PostRepository $postsRepository): Response
    {
        $posts = $postsRepository->findBy(
            [],
            ['createdAt' => 'DESC']
        );
        return $this->render('admin/post/post.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/admin/newPost', name: 'app_admin_newPost')]
    public function newPost(EntityManagerInterface $manager, Request $request): Response
    {

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $slugger = new AsciiSlugger();
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setEditedAt(new \DateTimeImmutable());
            $post->setSlug($slugger->slug($post->getTitle()));
            $post->setUser($this->getUser());
            $manager->persist($post);
            $manager->flush();
            $this->addFlash(
                'success',
                'L\'article a été ajouté'
            );
            return $this->redirectToRoute('app_admin_posts');
        }
        return $this->render('admin/post/newpost.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/deletePost/{id}', name: 'app_admin_deletePost')]
    public function deletePost(Post $post, EntityManagerInterface $manager): Response
    {
        $manager->remove($post);
        $manager->flush();
        $this->addFlash(
            'success',
            'L\'article a été supprimé'
        );
        return $this->redirectToRoute('app_admin_posts');
    }

    #[Route('/admin/editPost/{id}', name: 'app_admin_editPost')]
    public function editPost(Post $post, EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $slugger = new AsciiSlugger();
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setEditedAt(new \DateTimeImmutable());
            $post->setSlug($slugger->slug($post->getTitle()));
            $manager->flush();
            $this->addFlash(
                'success',
                'L\'article a été modifié'
            );
            return $this->redirectToRoute('app_admin_posts');
        }
        return $this->render('admin/post/editpost.html.twig', [
            'form' => $form,
            'post' => $post,
        ]);
    }

    #[Route('/admin/isPublished/{id}', name: 'app_admin_ispublished')]
    public function publishPost(Post $post, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            'La visibilité de l\'article à changé'
        );
        $post->setIsPublished(!$post->isPublished());
        $manager->flush();
        return $this->redirectToRoute('app_admin_posts');
    }
}

