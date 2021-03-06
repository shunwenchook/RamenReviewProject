<?php
/**
 * Summary comment
 */
namespace App\Controller;

use App\Entity\Ramen;
use App\Entity\Review;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * Index page for the homepage
     * @Route("/", name="default")
     */
    public function index()
    {
        $ramens = $this->getDoctrine()
            ->getRepository(Ramen::class)
            ->findAll();

        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        return $this->render('default/index.html.twig', [
            'ramens' => $ramens,
            'reviews'=> $reviews,
        ]);
    }
}
