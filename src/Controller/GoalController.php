<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\GoalSection;
use App\Entity\User;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use App\Repository\GoalSectionRepository;
use App\Service\InterestManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @IsGranted("ROLE_USER")
     * @param GoalSectionRepository $goalSectionRepository
     * @return Response
     */
    public function index (GoalSectionRepository $goalSectionRepository, InterestManager $interestManager)
    {
        $userGoals = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneByUsername($this->getUser()->getUsername());
        $remainingGoals = $goalSectionRepository->findAll();
        foreach ($remainingGoals as $remainingGoal) {
            foreach ($userGoals->getGoals() as $key => $goal) {
                if ($remainingGoal->getGoals()->contains($goal)) {
                    unset($remainingGoals[$key]);
                }
            }
        }
        $userInterests = $interestManager->parseInterests($goalSectionRepository->findAll(), $userGoals);
        return $this->render('goal/index.html.twig', [
            'userGoals'=>$userGoals,
            'remainingGoals' => $remainingGoals,
            'userInterests'=> $userInterests
        ]);
    }

    /**
     * @Route("/my-goal/{id}", name="set", methods={"GET","POST"})
     * @param Goal $goal
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function setToMyGoal(Goal $goal, EntityManagerInterface $manager): Response {
        $this->getUser()->addGoal($goal);
        $manager->flush();
        return $this->redirectToRoute('goal_index');
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @param UserInterface $user
     * @return Response
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        $actuallyUser = $user->getId();

        $actualUser = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['id' => $actuallyUser]);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $goal->setCreatorId($actuallyUser);
            $entityManager->persist($goal);
            $entityManager->flush();
            return $this->redirectToRoute('goal_index');
        }

        return $this->render('goal/new.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Goal $goal
     * @return Response
     */
    public function edit(Request $request, Goal $goal): Response
    {
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goal_index');
        }

        return $this->render('goal/edit.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="show", methods={"GET","POST"})
     * @param Goal $goal
     * @return Response
     */
    public function show(Goal $goal): Response
    {
        $userGoals = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneByUsername($this->getUser()->getUsername());
        $goalSelected = $this->getDoctrine()
            ->getRepository(Goal::class)
            ->find($goal->getId());
        return $this->render('goal/show.html.twig', [
            'userGoals'=>$userGoals,
            'goal' => $goal,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"GET", "DELETE"})
     * @param Request $request
     * @param Goal $goal
     * @return Response
     */
    public function delete(Request $request, Goal $goal): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($goal);
        $entityManager->flush();
        return $this->redirectToRoute('goal_index');
    }

    /**
     * @Route("remove/{id}", name="remove", methods={"GET","POST"})
     * @param UserInterface $user
     * @param Request $request
     * @param Goal $goal
     * @return Response
     */
    public function remove(UserInterface $user, Request $request, Goal $goal): Response
    {
        $actuallyUser = $user->getId();

        $actualUser = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['id' => $actuallyUser]);

        $actualUser->removeGoal($goal);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($actualUser);

        $entityManager->flush();

        return $this->redirectToRoute('goal_index');
    }
}
