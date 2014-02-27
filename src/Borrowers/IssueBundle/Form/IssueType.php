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
            ->add('issue','text', array('attr' => array('class' => 'text form-control'),))
            ->add('title','text', array('attr' => array('class' => 'text form-control'),))
            ->add('description','text', array('attr' => array('class' => 'text form-control'),))
            ->add('subtitle','text', array('attr' => array('class' => 'text form-control'),))
            ->add('editors','text', array('attr' => array('class' => 'text form-control'),))
            ->add('display', 'choice', array('choices'   => array('0' => 'Development', '1' => 'Archive', '2' => 'Previous', '3' => 'Current'), 'required'  => true,'attr' => array('class' => 'form-control'),));
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
