<?php

namespace Borrowers\IssueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IssueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('issue')
            ->add('title','text', array('attr' => array('class' => 'formtext'),))
            ->add('description','text', array('attr' => array('class' => 'formtext'),))
            ->add('subtitle','text', array('attr' => array('class' => 'formtext'),))
            ->add('editors','text', array('attr' => array('class' => 'formtext'),))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Borrowers\IssueBundle\Entity\Issue'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_issuetype';
    }
}
