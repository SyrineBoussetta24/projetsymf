<?php
namespace App\Controller;
use App\Entity\Livre; 
use App\Entity\Roman; 
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
Use Symfony\Component\Routing\Annotation\Route;
class IndexController extends AbstractController
{


    
#[Route('/clientLivre', name: 'clientLivre_list')]
public function home0(ManagerRegistry $doctrine)
{
$livres = $doctrine->getRepository(Livre::class)->findAll();
return  $this->render('clients/Cl.html.twig', ['livres' => $livres]);
}
 

#[Route('/clientRoman', name: 'clientRoman_list')]
public function home8(ManagerRegistry $doctrine)
{
$romans = $doctrine->getRepository(Roman::class)->findAll();
return  $this->render('clients/cr.html.twig', ['romans' => $romans]);

}
    




#[Route('/livre', name: 'livre_list')]
public function home(ManagerRegistry $doctrine)
{
$livres = $doctrine->getRepository(Livre::class)->findAll();
return $this->render('livres/index.html.twig', ['livres' => $livres]);
}
    
#[Route('/livre/save')]
public function save(ManagerRegistry $doctrine): Response {
$entityManager = $doctrine->getManager();
$livre = new Livre();
$livre->setNom('Livre 1');
$livre->setPrix(1000);
$entityManager->persist($livre);
$entityManager->flush();
return new Response('Livre enregisté avec id '.$livre->getId());
}
#[Route('/livre/new', name:'new_livre')]
public function new(Request $request,ManagerRegistry $doctrine): 
Response
{
$livre = new Livre();
$form = $this->createFormBuilder($livre)
->add('nom', TextType::class)
->add('prix', TextType::class)
->add('save', SubmitType::class, array('label' => 'Créer'))
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
    $livre = $form->getData();
    $entityManager = $doctrine->getManager();
    $entityManager->persist($livre);
    $entityManager->flush();
    return $this->redirectToRoute('livre_list');
    }
    return $this->render('livres/new.html.twig', ['form' => $form
    ->createView()]);
    }
#[Route('/livre/{id}', name:'livre_show')]
public function show($id,ManagerRegistry $doctrine): Response {
$livre = $doctrine->getRepository(Livre::class)->find($id);
return $this->render('livres/show.html.twig', array('livre' => 
$livre));
}

#[Route('/livre/edit/{id}', name: 'edit_livre')]
public function edit(Request $request, $id, ManagerRegistry $doctrine)
{
$livre = new Livre();
$livre = $doctrine->getRepository(Livre::class)->find($id);
$form = $this->createFormBuilder($livre)
->add('nom', TextType::class)
->add('prix', TextType::class)
->add('save', SubmitType::class, array('label' => 'Modifier'))
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$entityManager = $doctrine->getManager();
$entityManager->flush();

return $this->redirectToRoute('livre_list');
}
return $this->render('livres/edit.html.twig', ['form' => $form->createView()]);
}
#[Route('/livre/delete/{id}', name: 'delete_livre')]
public function delete(Request $request, $id, ManagerRegistry
$doctrine)
{
$livre = $doctrine->getRepository(Livre::class)->find($id);
$entityManager = $doctrine->getManager();
$entityManager->remove($livre);
$entityManager->flush();
$response = new Response();
$response->send();
return $this->redirectToRoute('livre_list');
}





















#[Route('/roman', name: 'roman_list')]
public function home1(ManagerRegistry $doctrine)
{
$romans = $doctrine->getRepository(Roman::class)->findAll();
return $this->render('romans/index.html.twig', ['romans' => $romans]);
}
    
#[Route('/roman/save')]
public function save1(ManagerRegistry $doctrine): Response {
$entityManager = $doctrine->getManager();
$roman = new Roman();
$roman->setNom('Roman 1');
$roman->setPrix(1000);
$entityManager->persist($roman);
$entityManager->flush();
return new Response('Roman enregisté avec id '.$roman->getId());
}
#[Route('/roman/new', name:'new_roman')]
public function new1(Request $request,ManagerRegistry $doctrine): 
Response
{
$roman = new Roman();
$form = $this->createFormBuilder($roman)
->add('nom', TextType::class)
->add('prix', TextType::class)
->add('save', SubmitType::class, array('label' => 'Créer'))
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
    $roman = $form->getData();
    $entityManager = $doctrine->getManager();
    $entityManager->persist($roman);
    $entityManager->flush();
    return $this->redirectToRoute('roman_list');
    }
    return $this->render('romans/new.html.twig', ['form' => $form
    ->createView()]);
    }
#[Route('/roman/{id}', name:'roman_show')]
public function show1($id,ManagerRegistry $doctrine): Response {
$roman = $doctrine->getRepository(Roman::class)->find($id);
return $this->render('romans/show.html.twig', array('roman' => 
$roman));
}

#[Route('/roman/edit/{id}', name: 'edit_roman')]
public function edit1(Request $request, $id, ManagerRegistry $doctrine)
{
$roman = new Roman();
$roman = $doctrine->getRepository(Roman::class)->find($id);
$form = $this->createFormBuilder($roman)
->add('nom', TextType::class)
->add('prix', TextType::class)
->add('save', SubmitType::class, array('label' => 'Modifier'))
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$entityManager = $doctrine->getManager();
$entityManager->flush();

return $this->redirectToRoute('roman_list');
}
return $this->render('romans/edit.html.twig', ['form' => $form->createView()]);
}
#[Route('/roman/delete/{id}', name: 'delete_roman')]
public function delete1(Request $request, $id, ManagerRegistry
$doctrine)
{
$roman = $doctrine->getRepository(Roman::class)->find($id);
$entityManager = $doctrine->getManager();
$entityManager->remove($roman);
$entityManager->flush();
$response = new Response();
$response->send();
return $this->redirectToRoute('roman_list');
}




}