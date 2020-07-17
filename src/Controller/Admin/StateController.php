<?php


namespace App\Controller\Admin;

use App\Entity\State;
use App\Form\StateType;
use App\Repository\StateRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StateController  extends AbstractController
{


	public function list(Request $request,int $page,StateRepository $state){

		$locale = $request->getLocale();

        $latestState = $state->findLatest($page,$locale);

        return $this->render('admin/state/state.html.twig', array('paginator' => $latestState));
	}


    public function new(Request $request,CountryRepository $country){
        $state = new State();
        $locale = $request->getLocale();
        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

            $state->setName($request->request->get('name'));
            $state->setCountry($request->request->get('country'));
            $repository->translate($state, 'name', 'hi', $request->request->get('name_hi'));
            $em->persist($state);
            $em->flush();

            $this->addFlash('success', 'msg.created_successfully');
            return $this->redirectToRoute('admin_state');
        }

        $country = $country->selectCountry($locale);    
        return $this->render('admin/state/new.html.twig',array('country' => $country));
    }


    public function edit(Request $request,$id,StateRepository $state){

        $locale = $request->getLocale();

        $state_data = $state->getStateById($id,$locale);
        
        $form = $this->createForm(StateType::class, $state_data[0],array('locale' => $locale));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $country = $em->find('App\Entity\State', $id);
            $country->setName($data->getName());
            $country->setTranslatableLocale($locale); // change locale
            $em->persist($country);
            $em->flush();

            $this->addFlash('success', 'msg.updated_successfully');

            return $this->redirectToRoute('admin_state');
        }

        return $this->render('admin/country/edit.html.twig', [
            'state' => $state_data[0],
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, State $state){

        $em = $this->getDoctrine()->getManager();
        $em->remove($state);
        $em->flush();

        $this->addFlash('success', 'msg.deleted_successfully');

        return $this->redirectToRoute('admin_state');
    }


}
?>
