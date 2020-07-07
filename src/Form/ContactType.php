<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('name', TextType::class,[
                'label' => 'label.name',
             ])
             ->add('email', EmailType::class,[
                'label' => 'label.email',
             ])
             ->add('phone', TextType::class,[
                'label' => 'label.phone',
             ])
             ->add('message', TextareaType::class,[
                'label' => 'label.message',
             ])
             ->add('save', SubmitType::class, ['label' => 'btn.submit'])
        ;
    }
}
?>