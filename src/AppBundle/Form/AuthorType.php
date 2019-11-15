<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('lastname',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('institution',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('bio',TextType::class, array('attr' => array('class' => 'text form-control'),))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Author'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_authortype';
    }
}
