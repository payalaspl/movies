<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\UsersType;
use App\Form\EdituserType;
use App\Service\FileUploader;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController  extends AbstractController
{
    /* REGISTER USER */
    public function register(Request $request,FileUploader $fileUploader,UserRepository $users,UserPasswordEncoderInterface $encoder){

    	$user = new User();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);
        
        if ($request->isMethod('POST')) {
            
            if ($form->isSubmitted() && $form->isValid()) {
            	$data = $form->getData();
            	$checkemail = $users->checkEmail($data->getEmail());
            	
                if(count($checkemail) != '0'){
            		$this->addFlash('msg','Already Exit Email');
            	
                }else{	
                    $usersFile = $form['image']->getData();
			        
                    if ($usersFile) {
			            $FileName = $fileUploader->upload($usersFile);
			            $user->setImage($FileName);
			        }

	                $user->setUsername($data->getUsername());
	                $user->setPassword($encoder->encodePassword($user, $data->getPassword()));
	                $user->setEmail($data->getEmail());
                    $user->setRoles(array("ROLE_USER"));
	                $entityManager = $this->getDoctrine()->getManager();
	                $entityManager->persist($user);
	                $entityManager->flush();

	                return $this->redirectToRoute('login');
	            }
            }
        }

        return $this->render('users/register.html.twig', [
             'form' => $form->createView(),
        ]);
    }

    /* uSER LOGIN */
    public function login(Request $request,  AuthenticationUtils $helper){

        return $this->render('users/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);

    }

    /* EDIT USER PROFILE */
    public function profile(Request $request,FileUploader $fileUploader){
        $user = $this->getUser();
        $form = $this->createForm(EdituserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersFile = $form['image']->getData();
                    
            if ($usersFile) {
                $FileName = $fileUploader->upload($usersFile);
                $user->setImage($FileName);
            }
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('profile');
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
?>
