<?php

namespace App\Form\Admin;

use App\Entity\Admin\Konu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KonuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('yazar')
            ->add('detail')
            ->add('image')
            ->add('menu_id')
            ->add('url')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'True' => 'True',
                    'False' => 'False'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Konu::class,
            'csrf_protection'=>false,
        ]);
    }
}
