<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private PostRepository $postRepository;
    private $em;

    public function __construct(PostRepository $postRepository, EntityManagerInterface $em){
        $this->postRepository = $postRepository;
        $this->em = $em;
    }
    
    
    #[Route('/lista', name: 'app_post')]
    public function index(): Response
    {
        $posts = $this->postRepository->findAll();
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
    
    #[Route('/lista/delete/{id}', methods: ['GET', 'DELETE'], name: 'app_post_delete')]
    public function delete($id) :Response
    {
        $post = $this->postRepository->find($id);
        $this->em->remove($post);
        $this->em->flush();

        $this->addFlash('success', 'użytkownik został usunięy!');

        
        return $this->redirectToRoute('app_post');
        
    }
}
