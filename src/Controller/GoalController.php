<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\User;
use App\Repository\GoalRepository;
use App\Repository\GoalSectionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/goal", name="goal_")
 */
class GoalController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param GoalSectionRepository $goalSectionRepository
     * @return Response
     */
    public function index (GoalSectionRepository $goalSectionRepository) {

        $user = $this->getUser();
        $userGoals = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneByUsername($this->getUser()->getUsername());
        return $this->render('goal/index.html.twig', [
          'userGoals'=>$userGoals,
            'goalSectionRepository'=>$goalSectionRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/my-goal", name="set", methods={"GET","POST"})
     * @param Goal $goal
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function setToMyGoal(Goal $goal, EntityManagerInterface $manager): Response {
        $this->getUser()->addGoal($goal);
        $manager->flush();
        return $this->redirectToRoute('goal_index');
    }
}
