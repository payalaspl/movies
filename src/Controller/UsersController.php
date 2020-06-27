<?php
namespace App\Controller;
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
    public function register(Request $request,FileUploader $fileUploader){
    	$user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
            	$usersFile = $form['image']->getData();
		        if ($usersFile) {
		            $FileName = $fileUploader->upload($usersFile);
		            $user->setImage($FileName);
		        }
                $data = $form->getData();
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
        return $this->render('users/register.html.twig', [
             'form' => $form->createView(),
        ]);
    }
}
?>