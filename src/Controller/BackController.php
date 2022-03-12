<?php

namespace App\Controller;


use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    /**
     * @Route("/back", name="back")
     */
    public function index(UserRepository $clientRepository , PostRepository $postRepository): Response
    {
        return $this->render('Back/Back.html.twig', [
            'clients' => $clientRepository->findAll(),
            'posts'=>$postRepository->findAll(),
             'user'=>$this->getUser(),
            
        ]);

    }
}
