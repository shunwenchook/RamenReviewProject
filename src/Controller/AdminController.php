<?php
/**
 * Summary comment
 */
namespace App\Controller;

use App\Entity\Ramen;
use App\Entity\Review;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * Admin index method which displays the admin panel
     * @Route("/admin", name="admin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {

        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();
        $ramens = $this->getDoctrine()
            ->getRepository(Ramen::class)
            ->findAll();
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();


        return $this->render('admin/index.html.twig', [
            'reviews'=>$reviews,
            'users'=>$users,
            'ramens'=>$ramens,
        ]);
    }
}
