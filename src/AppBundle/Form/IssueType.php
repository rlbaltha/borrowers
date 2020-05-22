<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('issue',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('title',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('description',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('subtitle',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('editors',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('display', ChoiceType::class, array('choices'   => array('Development' => '0', 'Archive' => '1', 'Previous' => '2', 'Current' => '3'), 'required'  => true,'attr' => array('class' => 'form-control'),));
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Issue'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_issuetype';
    }
}
