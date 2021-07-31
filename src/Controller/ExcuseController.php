<?php

namespace App\Controller;

use App\Entity\Excuse;
use App\Form\ExcuseType;
use App\Repository\ExcuseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/excuse")
 */
class ExcuseController extends AbstractController
{
    /**
     * @Route("/", name="excuse_index", methods={"GET"})
     */
    public function index(
        ExcuseRepository $excuseRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $excuseRepository->findBy([], ['id' => 'DESC']);

        $excuses = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('excuse/index.html.twig', [
            'excuses' => $excuses,
            'current_menu' => 'excuses',
        ]);
    }

    /**
     * @Route("/new", name="excuse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $excuse = new Excuse();
        $form = $this->createForm(ExcuseType::class, $excuse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Date de création de l'excuse
            $excuse->setCreatedAt(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($excuse);
            $entityManager->flush();

            $this->addFlash(
                'message',
                'Votre excuse a bien été enregistrée. Elle va être modérée par l\'admin dans 
                les plus brefs délais. Merci de votre participation.'
            );

            return $this->redirectToRoute('excuse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('excuse/new.html.twig', [
            'excuse' => $excuse,
            'form' => $form,
            'current_menu' => 'excuseNew',
        ]);
    }

    /**
     * @Route("/{id}", name="excuse_show", methods={"GET"})
     */
    public function show(Excuse $excuse): Response
    {
        return $this->render('excuse/show.html.twig', [
            'excuse' => $excuse,
        ]);
    }

    /**
     * @Route("/{id}", name="excuse_random", methods={"GET"})
     */
    public function showRandom(Excuse $excuse): Response
    {
        return $this->render('excuse/show.html.twig', [
            'excuse' => $excuse,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="excuse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Excuse $excuse): Response
    {
        $form = $this->createForm(ExcuseType::class, $excuse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('excuse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('excuse/edit.html.twig', [
            'excuse' => $excuse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="excuse_delete", methods={"POST"})
     */
    public function delete(Request $request, Excuse $excuse): Response
    {
        if ($this->isCsrfTokenValid('delete' . $excuse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($excuse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('excuse_index', [], Response::HTTP_SEE_OTHER);
    }
}
