<?php
namespace App\Controller;
use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class HomeController  extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function index()
    {
        return $this->render('home/home.html.twig');
    }
    public function show($slug)
    {
        if ($slug == 'about') {
            return $this->render('home/about.html.twig');
        }else{
             return $this->render('home/privacy.html.twig');
        }
    }
    public function show_contact(Request $request,\Swift_Mailer $mailer){
        $task = new Contact();
        $form = $this->createForm(ContactType::class, $task);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($data);
                $entityManager->flush();
                $message = (new \Swift_Message('You Got Mail!'))
                    ->setFrom($data->getEmail())
                    ->setTo('payal@aum.bz')
                    ->setBody($data->getMessage(),'text/plain')
                ;
                $mailer->send($message);
                $this->session->set('c_id', $data->getId());
                $this->addFlash('notice','Your changes were saved!');
                return $this->redirectToRoute('contact_success');
            }
        }
        return $this->render('home/contact.html.twig', [
             'form' => $form->createView(),
        ]);
    }
    public function contact_submit(){
        $cid = $this->session->get('c_id');
        return $this->render('home/msg.html.twig',['cid'=>$cid]);                                    
    }                                                                     
}
?>