<?php

namespace Borrowers\IssueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path','text', array('attr' => array('class' => 'formtext'),))
            ->add('title','text', array('attr' => array('class' => 'formtext'),))
            ->add('sortorder') 
            ->add('file')    
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Borrowers\IssueBundle\Entity\File'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_filetype';
    }
}
