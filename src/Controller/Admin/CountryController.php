<?php


namespace App\Controller\Admin;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CountryController  extends AbstractController
{


	public function list(Request $request,int $page,CountryRepository $country){

		$locale = $request->getLocale();

        $latestCountry = $country->findLatest($page,$locale);

        return $this->render('admin/country/country.html.twig', array('paginator' => $latestCountry));
	}

	public function new(Request $request){
		$country = new Country();
        
        if ($request->getMethod() == 'POST') {

        	$em = $this->getDoctrine()->getManager();

        	$repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        	$country->setName($request->request->get('name'));
            $repository->translate($country, 'name', 'hi', $request->request->get('name_hi'));
            $em->persist($country);
            $em->flush();

            $this->addFlash('success', 'msg.created_successfully');
            return $this->redirectToRoute('admin_country');
        }

        return $this->render('admin/country/new.html.twig');
	}


	public function edit(Request $request,$id,CountryRepository $country){

		$locale = $request->getLocale();

		$country_data = $country->getCountryById($id,$locale);
		
		$form = $this->createForm(CountryType::class, $country_data[0]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
    		$data = $form->getData();

        	$em = $this->getDoctrine()->getManager();
        	$country = $em->find('App\Entity\Country', $id);
			$country->setName($data->getName());
			$country->setTranslatableLocale($locale); // change locale
			$em->persist($country);
			$em->flush();

            $this->addFlash('success', 'msg.updated_successfully');

            return $this->redirectToRoute('admin_country');
        }

        return $this->render('admin/country/edit.html.twig', [
            'country' => $country_data[0],
            'form' => $form->createView(),
        ]);
	}


	public function delete(Request $request, Country $country){

        $em = $this->getDoctrine()->getManager();
        $em->remove($country);
        $em->flush();

        $this->addFlash('success', 'msg.deleted_successfully');

        return $this->redirectToRoute('admin_country');
	}


}
?>