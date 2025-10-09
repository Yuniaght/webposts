<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

final class AdminPostController extends AbstractController
{
    //public function __construct(private readonly SluggerInterface $slugger)
    //{

    //}
    #[Route('/admin/posts', name: 'app_admin_posts')]
    public function AdminPosts(): Response
    {
        return $this->render('admin/post/post.html.twig', []);
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
            $manager->persist($post);
            $manager->flush();
            return $this->redirectToRoute('app_admin_posts');
        }
        return $this->render('admin/post/newpost.html.twig', [
            'form' => $form
        ]);
    }
}
