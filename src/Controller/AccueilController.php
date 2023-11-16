<?php

namespace App\Controller;

use App\Entity\OrdinateurPortable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrdinateurPortableRepository;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AccueilController extends AbstractController
{
    
    /* #[Route('/accueil', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig');
    } */
    

    #[Route('/accueil', name: 'accueil')]
    public function afficherTous(ManagerRegistry $doctrine, OrdinateurPortableRepository $repository, Request $request)
    {
        $em = $doctrine->getManager();
        $rep = $em->getRepository(OrdinateurPortable::class);

        // notez que findBy renverra toujours un array même s'il trouve qu'un objet
        $ordis = $rep->findAll();

//        $form = $this->createForm()
//
//        if($form->isSubmitted() && $form->isValid())
//        {
//            $data = $form->getData();
//            $repository->findOneByBrand($data['brand']);
//        }


        // creates a task object and initializes some data for this example
        
        //pas cette partie
        /* $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTimeImmutable('tomorrow'));
 */
        $form = $this->createFormBuilder() //()vide
    /*      ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm(); */

            ->add(
                'marque', ChoiceType::class, 
                [
                'label' => 'Marque',    
                'choices' => OrdinateurPortable::MARQUE,
                'multiple' => true,
                'expanded' => true,
                ]
                )
            ->add('prix_min', MoneyType::class, 
                [
                'label' => 'Prix minimal',
                'required' => false,
                ]
                )
            ->add('prix_max', MoneyType::class, 
                [
            'label' => 'Prix maximal',
            'required' => false,
                ]
                )
            ->add('processeur', ChoiceType::class, 
                [
                'label' => 'Processeur',
                'choices' => OrdinateurPortable::PROCESSEUR,
                'multiple' => true,
                'expanded' => true,
                ]
                )
            ->add('systemeExploitation', ChoiceType::class, 
                [
                    'label' => 'Système exploitation',
                    'choices' => OrdinateurPortable::SYSTEME_EXPLOITATION,
                    'multiple' => true,
                    'expanded' => true,
                ]
                )
            
            // ->add('Filtrer', SubmitType::class)

            ->getForm();

        // ...

        //$form = $this->createForm(TaskType::class, $task);
        //return cfr plus bas

        // traitement doc

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $resultatduvisiteur = $form->getData(); //contient les valeurs de ce que la visiteur a coché - onrécupère les données rentrées par le visiteur

            // ... perform some action, such as saving the task to the database
            $ordis = $repository->recupererResultatRechercheVisiteur($resultatduvisiteur); // on récupère les données filtrées par le repository de ordinateurportablerepo...

            // return $this->redirectToRoute('task_success');
        }

        
        return $this->render(
            "accueil/index.html.twig",
            [
                'ordis' => $ordis,
            'formFiltre' => $form
            ]
        );
    }


}

