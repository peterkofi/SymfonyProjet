<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('programme')]
class ProgrammeController extends AbstractController
{
    #[Route('/', name: 'programme.list')]
    public function index(ManagerRegistry $doctrine): Response
    {

         $repository=$doctrine->getRepository(Programme::class);
     
         $nombreProgramme=$repository->count([]);

         $nbre=10;
        
         $nombrePage=ceil($nombreProgramme/$nbre);

        $programme=$repository->findAll();

    //  $programme=$repository->findBy([],[],$page,($page - 1)*$nbre);
        return $this->render('programme/index.html.twig', [
            'programme' => $programme,
            'isPaginated'=>true,
             'nombrePage'=>$nombrePage,
            // 'page'=>$page,
             'nombreElent'=>$nbre

        ],
        );
    }
    #[Route('/{id<\d+>}', name: 'programme.detail')]
    public function detailProgramme(Programme $programme, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$programme){
             $this->addFlash('error'," ce programme recherche n'existe pas");
            return $this->redirectToRoute('programme.list');
        }
        
        return $this->render('programme/detail.html.twig', [
             'programme'=>$programme
        ]);
    }

   
    #[Route('/edit/{id?0}', name: 'programme.edit')]
    public function addProgramme(Programme $programme=null, ManagerRegistry $doctrine,Request $request): Response
    {
          
        $new=false;
       
            if(!$programme){ 
                $new=true;
                $programme= new Programme();
            }
     //   
     if($new){
        $message='le programme a été ajouté avec succès !';
     
     }else{
         $message='le programme a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(ProgrammeType::class, $programme);
            $form->remove("createdAt");
            $form->remove("updatedAt");
            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  dd($form->getData()); == dd($programme)

                $entityManager=$doctrine->getManager();

                $entityManager->persist($programme);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('programme.list');
            }else{


                 return $this->render('Programme/create_programme.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }

    // #[Route('/add/{libelle}/{description}', name: 'programme.addParam')]
    // public function addParamProgramme(ManagerRegistry $doctrine,$libelle,$description): RedirectResponse
    // {
    //     $entityManager=$doctrine->getManager();
 
    //      $programme= new Programme();

    //     $programme->setLibelle($libelle);
    //     $programme->setDescription($description);
    
    //     $entityManager->persist($programme);

    //     $entityManager->flush();
     
    // //    $this->addFlash(type:'success',message:'ajout reussi !');
   
    //     return $this->redirectToRoute('programme.list');
    // }

    #[Route('/delete/{id}', name: 'programme.delete')]
    public function deleteProgramme( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(Programme::class);
 
          $programme=$entityManager->find($id);

      //  dd($programme);
        
         if($programme){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($programme);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('programme.list');
    }

}
