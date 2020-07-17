<?php
namespace App\Form;

use App\Entity\State;
use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StateType extends AbstractType
{
	 public function __construct(CountryRepository $cr){
        $this->cr = $cr;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('country', EntityType::class, [
                'class'       => Country::class,
                'expanded' => false,
                'multiple' => false,
                'empty_data' => '',
                'choice_label' => 'name',
                'label' => 'label.country',
                'placeholder' => 'select.country',
                'choices' => $this->cr->selectCountry($options['locale']),
            ])
             ->add('name', TextType::class,[
                'label' => 'label.name',
             ])
             ->add('save', SubmitType::class, ['label' => 'btn.submit'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => State::class,
            'locale' => 'en',
        ]);
    }
}
?>