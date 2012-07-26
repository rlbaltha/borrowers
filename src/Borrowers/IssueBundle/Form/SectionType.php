<?php

namespace Borrowers\IssueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array('attr' => array('class' => 'formtext'),))
            ->add('description','text', array('attr' => array('class' => 'formtext'),))
            ->add('sortorder')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Borrowers\IssueBundle\Entity\Section'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_sectiontype';
    }
}
