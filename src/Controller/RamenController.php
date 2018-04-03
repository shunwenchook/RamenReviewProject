<?php

namespace App\Controller;

use App\Entity\Ramen;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\RamenRepository;

class RamenController extends Controller
{
    /**
     * @Route("/ramen/{id}", name="ramen_show")
     */
    public function showAction($id)
    {
        $ramenRepository = new RamenRepository();
        $ramen = $ramenRepository->find($id);
        $template = 'ramen/show.html.twig';
        $args = [
            'ramen' => $ramen
        ];

        if (!$ramen) {
            $template = 'error/404.html.twig';
        }

        return $this->render($template, $args);

    }

    /**
     * @Route("/ramen", name="ramen_list")
     */
    public function listAction()
    {
        $ramenRepository = new RamenRepository();
        $ramens = $ramenRepository->findAll();
        $template = 'ramen/list.html.twig';
        $args = [
            'ramens' => $ramens
        ];
        return $this->render($template, $args);
    }
}
