<?php

namespace Borrowers\IssueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname','text', array('attr' => array('class' => 'text form-control'),))
            ->add('lastname','text', array('attr' => array('class' => 'text form-control'),))
            ->add('institution','text', array('attr' => array('class' => 'text form-control'),))
            ->add('bio','text', array('attr' => array('class' => 'text form-control'),))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Borrowers\IssueBundle\Entity\Author'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_authortype';
    }
}
