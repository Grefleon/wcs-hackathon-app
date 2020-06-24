<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Repository\GoalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/goal", name="goal_index")
 */
class GoalController extends AbstractController
{
    /**
     * @Route("/", name="goal_index")
     * @param GoalRepository $goals
     * @return Response
     */
    public function index (GoalRepository $goals) {

        return $this->render('goal/index.html.twig', [
            'goals'=>$goals->findAll()
        ]);
    }
}
