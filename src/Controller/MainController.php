<?php

namespace App\Controller;

use App\Entity\User;
use ContainerNkfZlRr\getObjectManagerService;
use Doctrine\Persistence\ObjectManager as OM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     * @return Response
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

    /**
     * @Route("/experiences", name="experiences")
     * @return Response
     */
    public function ListExperiences()
    {
        $user = $this->getUser();
        $infos = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $user->getUsername()]);
        return $this->render('main/exp.html.twig', ['experiences' => $infos->getExperienceList()]);
    }
}
