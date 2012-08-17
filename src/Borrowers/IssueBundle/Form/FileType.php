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
            ->add('path','hidden')
            ->add('title','text', array('attr' => array('class' => 'formtext'),))
            ->add('sortorder') 
            ->add('display', 'choice', array('choices'   => array('0' => 'Development', '1' => 'Production'), 'required'  => true,))
            ->add('authors','entity', array('class'=> 'Borrowers\IssueBundle\Entity\Author', 'property'=>'name', 'expanded'=>false,'multiple'=>true,'required' => false,'query_builder' => 
                 function(\Borrowers\IssueBundle\Entity\AuthorRepository $er) {
                 return $er->createQueryBuilder('a')
                 ->orderBy('a.lastname', 'ASC');
                 })) 
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
