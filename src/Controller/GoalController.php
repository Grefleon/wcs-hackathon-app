<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Repository\GoalRepository;
use App\Repository\GoalSectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/goal", name="goal_")
 */
class GoalController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param GoalRepository $goals
     * @param GoalSectionRepository $goalSectionRepository
     * @return Response
     */
    public function index (GoalRepository $goals, GoalSectionRepository $goalSectionRepository) {

        return $this->render('goal/index.html.twig', [
            'goals'=>$goals->findAll(),
            'goalSectionRepository'=>$goalSectionRepository->findAll()
        ]);
    }
}
