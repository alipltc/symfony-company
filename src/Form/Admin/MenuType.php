<?php

namespace App\Form\Admin;

use App\Entity\Admin\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentid')
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('image')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'True' => 'True',
                    'False' => 'False'],
            ])
        ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
            'csrf_protection'=>false,
        ]);
    }
}
