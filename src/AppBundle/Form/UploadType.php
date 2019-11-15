<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Tests\Extension\Core\Type\TextTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UploadType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add(FileType::class)
            ->add('title',TextType::class, array('attr' => array('class' => 'text form-control'),))
            ->add('sortorder',TextTypeTest::class, array('attr' => array('class' => 'text form-control'),))
            ->add('display', ChoiceType::class, array('choices'   => array('0' => 'Development', '1' => 'Production'), 'required'  => true,'attr' => array('class' => 'form-control'),))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
