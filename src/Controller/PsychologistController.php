<?php

namespace App\Controller;

use App\Entity\Psychologist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PsychologistController extends AbstractController
{
    /**
     * @Route("/psychologues", name="psychologist")
     */
    public function index()
    {
        $psys = $this->getDoctrine()
            ->getRepository(Psychologist::class)
            ->findAll();
        return $this->render('psychologist/index.html.twig', [
            'psys' => $psys
        ]);
    }
}
