<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\User;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use App\Repository\GoalSectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Goal $goal): Response
    {
        return $this->render('goal/show.html.twig', [
            'goal' => $goal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
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
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Goal $goal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goal_index');
    }
}
