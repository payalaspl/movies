<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use App\Entity\Country;
use App\Entity\State;
/**
 * Defines the form used to edit an user.
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
class EdituserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('username', TextType::class, [
                'label' => 'label.username',         
            ])
            ->add('email', EmailType::class, [
                'label' => 'label.email',
                'disabled' => true,
            ])
             ->add('image', FileType::class, [
                'mapped'=>false,
                'required'=> false,
                'label' => 'label.image',
            ])
            ->add('country', EntityType::class, [
                'class'       => Country::class,
                'expanded' => false,
                'multiple' => false,
                'empty_data' => '',
                'choice_label' => 'name',
                'label' => 'label.country',
                'placeholder' => 'select.country'
            ])
            ->add('save', SubmitType::class, ['label' => 'btn.submit'])
        ;


        $formModifier = function (FormInterface $form, Country $country = null) {
            $state = null === $country ? [] : $country->getStates();

            $form->add('state', EntityType::class, [
                'class' => 'App\Entity\State',
                'placeholder' => 'select.state',
                'expanded' => false,
                'multiple' => false,
                'empty_data' => '',
                'choice_label' => 'name',
                'label' => 'label.state',
                'choices' => $state
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCountry());
            }
        );

        $builder->get('country')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $country = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $country);
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
