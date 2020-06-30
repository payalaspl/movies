<?php
namespace App\Controller;
use App\Form\LoginType;
use App\Form\UsersType;
use App\Entity\User;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController  extends AbstractController
{
    private $session;
     
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
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
    public function login(Request $request,  AuthenticationUtils $helper){
    	// $user = new User();
    	// $form = $this->createForm(LoginType::class, $user);
     //    $form->handleRequest($request);
     //    if ($request->isMethod('POST')) {
   
     //        if ($form->isSubmitted() && $form->isValid()) {
     //        	$data = $form->getData();
     //            $password = $encoder->encodePassword($user, $data->getPassword());
     //        	$checklogin = $users->checkLogin($data->getEmail(),$password);
     //        	print_r(($checklogin));exit();
     //        	if(count($checklogin) == 0){
     //        		$this->addFlash('msg','Email and password wrong');
     //        	}else{
	    //             $this->session->set('c_id', $data->getId());
	    //             return $this->redirectToRoute('index');
	    //         }
     //        }

     //    }
     //    return $this->render('users/login.html.twig', [
     //         'form' => $form->createView(),
     //    ]);
        return $this->render('users/login.html.twig', [
            // last username entered by the user (if any)
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }
    public function profile(){
        $user = $this->getUser();
        print_r($user);exit();
    }
}
?>
