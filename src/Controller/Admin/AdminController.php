<?php

namespace App\Controller\Admin;

use App\Form\EditEmployesFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrdinateurPortableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * TutoYTM
     * 
     * La route '/admin/' est le chemin pour pointer vers toute la partie administration.
     * Le nom du chemin <-> dans le config/packages/security.yaml à la ligne 40
     * Donc toutes les routes qui concernent l'administration devront obligatoirement commencer par '/admin/' dans la route
     */
    #[Route('/admin/', name: 'admin_index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
    
    // PARTIE  Gérer EMPLOYES


    #[Route('/admin/liste_employes', name: 'admin_liste_employes')]
    public function liste_employes(UserRepository $userRepository): Response
    {
        $employes = $userRepository->findAll();

        return $this->render('admin/listeEmployes.html.twig', [
            'employes' => $employes,
        ]);
    }

    // Ajout -> registration form 
    
    #[Route('/admin/edit_employes/{id}', name: 'admin_edit_employes')]
     // id pour pouvoir pointer ici ds route + ds path ds templatelisteEmployes
    public function edit_employe(UserRepository $userRepository, int $id, Request $request, EntityManagerInterface $em): Response
    {
        $employe = $userRepository->find($id);
        $form = $this->createForm(EditEmployesFormType::class, $employe);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $employe->setNom($data->getNom());
            $employe->setPrenom($data->getPrenom());
            $employe->setMail($data->getMail());

            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('admin_liste_employes');
        }

        return $this->render('admin/editEmployes.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/admin/delete_employes/{id}', name: 'admin_delete_employes')]
    public function delete_employe(UserRepository $userRepository, int $id, EntityManagerInterface $em): Response
    {
        $employe = $userRepository->find($id);
        $em->remove($employe);
        $em->flush();

        return $this->redirectToRoute('admin_liste_employes');
    }

    // PARTIE Gérer ORDINATEUR --> #TODO

    #[Route('/admin/liste_ordinateurs', name: 'admin_liste_ordinateurs')]
    public function liste_ordinateurs(OrdinateurPortableRepository $ordinateurPortableRepository): Response
    {
        $ordinateurs = $ordinateurPortableRepository->findAll();

        return $this->render('admin/listeOrdinateurs.html.twig', [
            'ordinateurs' => $ordinateurs,
        ]);
    }
    
    // ajouter semblable à ajout employes ; semblable à registration 

    /*  #[Route('/admin/edit_ordi', name: 'admin_edit_ordi')]
    public function edit_ordi(UserRepository $userRepository): Response
    {
        //TODO 
    }

    #[Route('/admin/delete_ordi', name: 'admin_delete_ordi')]
    public function delete_ordi(UserRepository $userRepository): Response
    {
        //TODO 
    } */
}
