<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path',HiddenType::class)
            ->add('title',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('sortorder',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('display', ChoiceType::class, array('choices'   => array('Development' => '0', 'Production' => '1'), 'required'  => true,'attr' => array('class' => 'form-control'),))
            ->add('authors',EntityType::class, array('class'=> 'AppBundle\Entity\Author', 'choice_label'=>'name', 'expanded'=>false,'multiple'=>true,'required' => false,
                 'query_builder' =>
                 function(\AppBundle\Entity\AuthorRepository $er) {
                 return $er->createQueryBuilder('a')
                 ->orderBy('a.lastname', 'ASC');
                 }))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\File'
        ));
    }

    public function getName()
    {
        return 'borrowers_issuebundle_filetype';
    }
}
