<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        $user = $this->getUser();
        $infos = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $user->getUsername()]);

        return $this->render('main/index.html.twig', [
            'infos' => $infos,
        ]);
    }
}
