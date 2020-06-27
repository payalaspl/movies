<?php
namespace App\Controller;
use App\Form\LoginType;
use App\Form\UsersType;
use App\Entity\Users;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\UsersRepository;
class UsersController  extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function register(Request $request,FileUploader $fileUploader,UsersRepository $users){
    	$user = new Users();
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
	                $user->setPassword($data->getPassword());
	                $user->setEmail($data->getEmail());
	                $entityManager = $this->getDoctrine()->getManager();
	                $entityManager->persist($user);
	                $entityManager->flush();
	                $this->session->set('c_id', $data->getId());
	                return $this->redirectToRoute('index');
	            }
            }
        }
        return $this->render('users/register.html.twig', [
             'form' => $form->createView(),
        ]);
    }
    public function login(Request $request,UsersRepository $users){
    	$user = new Users();
    	$form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
   
            if ($form->isSubmitted() && $form->isValid()) {
            	$data = $form->getData();
            	$checklogin = $users->checkLogin($data->getEmail(),$data->getPassword());
            	//print_r(count($checklogin));exit();
            	if(count($checklogin) == 0){
            		$this->addFlash('msg','Email and password wrong');
            	}else{
	                $this->session->set('c_id', $data->getId());
	                return $this->redirectToRoute('index');
	            }
            }

        }
        return $this->render('users/login.html.twig', [
             'form' => $form->createView(),
        ]);
    }
}
?>