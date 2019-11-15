<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('display', ChoiceType::class, array('choices'   => array('0' => 'Development', '1' => 'Archive', '2' => 'Previous', '3' => 'Current'), 'required'  => true,'attr' => array('class' => 'form-control'),));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
