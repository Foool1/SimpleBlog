<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Post;
use App\Form\PostType;

class BlogController extends AbstractController
{
    // ...existing code...
    #[Route('/blog/{id}/delete', name: 'blog_delete', methods: ['POST'])]
    public function deletePost(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post nie istnieje.');
        }
        if ($this->isCsrfTokenValid('delete_post_' . $post->getId(), $request->request->get('_token'))) {
            $em->remove($post);
            $em->flush();
            $this->addFlash('success', 'Post został usunięty.');
        }
        return $this->redirectToRoute('blog');
    }
    #[Route('/blog', name: 'blog')]
    public function index(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(\App\Entity\Post::class)->findBy([], ['createdAt' => 'DESC']);
        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/blog/add', name: 'blog_post_add')]
    public function addPost(Request $request, EntityManagerInterface $em): Response
    {
        $post = new \App\Entity\Post();
        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('content')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setAuthor($this->getUser());
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
        #[Route('/blog/{id}/edit', name: 'blog_edit')]
        public function editPost(int $id, Request $request, EntityManagerInterface $em): Response
        {
            $post = $em->getRepository(Post::class)->find($id);
            if (!$post) {
                throw $this->createNotFoundException('Post nie istnieje.');
            }

            $form = $this->createForm(PostType::class, $post);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
                $this->addFlash('success', 'Post został zaktualizowany.');
                return $this->redirectToRoute('blog_show', ['id' => $post->getId()]);
            }

            return $this->render('blog/edit.html.twig', [
                'form' => $form->createView(),
                'post' => $post,
            ]);
        }
    #[Route('/blog/{id}', name: 'blog_post_show', requirements: ['id' => '\\d+'])]
    public function showPost(int $id, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(\App\Entity\Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post nie istnieje.');
        }
        return $this->render('blog/show.html.twig', [
            'post' => $post,
        ]);
    }
}
