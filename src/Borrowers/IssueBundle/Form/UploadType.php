<?php

namespace Borrowers\IssueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UploadType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('file')
            ->add('title','text', array('attr' => array('class' => 'text form-control'),))
            ->add('sortorder','text', array('attr' => array('class' => 'text form-control'),))
            ->add('display', 'choice', array('choices'   => array('0' => 'Development', '1' => 'Production'), 'required'  => true,'attr' => array('class' => 'form-control'),))
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
