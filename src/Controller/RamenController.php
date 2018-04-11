<?php

namespace App\Controller;

use App\Entity\Ramen;
use App\Form\RamenType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/ramen", name="ramen_")
 */
class RamenController extends Controller
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        $ramens = $this->getDoctrine()
            ->getRepository(Ramen::class)
            ->findAll();

        return $this->render('ramen/index.html.twig', ['ramens' => $ramens]);
    }

    /**
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $raman = new Ramen();
        $form = $this->createForm(RamenType::class, $raman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($raman);
            $em->flush();

            return $this->redirectToRoute('ramen_edit', ['id' => $raman->getId()]);
        }

        return $this->render('ramen/new.html.twig', [
            'raman' => $raman,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Ramen $raman)
    {
        return $this->render('ramen/show.html.twig', [
            'raman' => $raman,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Ramen $raman)
    {
        $form = $this->createForm(RamenType::class, $raman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ramen_edit', ['id' => $raman->getId()]);
        }

        return $this->render('ramen/edit.html.twig', [
            'raman' => $raman,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, Ramen $raman)
    {
        if (!$this->isCsrfTokenValid('delete'.$raman->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('ramen_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($raman);
        $em->flush();

        return $this->redirectToRoute('ramen_index');
    }
}
