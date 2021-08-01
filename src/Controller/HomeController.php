<?php

namespace App\Controller;

use App\Entity\Excuse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $nbexcuses = $this->getDoctrine()->getRepository(Excuse::class)->findAll();

        $repository = $this->getDoctrine()->getRepository(Excuse::class);

        $excuses = $repository->createQueryBuilder('a')
            ->orderBy('RAND()')
            ->setMaxResults(1)
            ->getQuery()
            ->execute();

        return $this->render('home/index.html.twig', [
            'excuses' => $excuses,
            'nbexcuses' => $nbexcuses,
            'current_menu' => 'accueil',
        ]);
    }

    /**
     * @Route("/apropos", name="apropos")
     */
    public function apropos()
    {
        return $this->render('home/apropos.html.twig', [
            'current_menu' => 'apropos',
        ]);
    }
}
