<?php

namespace App\Controller;

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
     */
    public function index () {
        return $this->render('goal/index.html.twig');
    }
}
