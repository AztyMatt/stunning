<?php

namespace App\Form;

use App\Entity\SocialMedias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SocialMediasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('xTwitter', TextType::class, [
                'required' => false,
                'empty_data' => null
            ])
            ->add('instagram', TextType::class, [
                'required' => false,
                'empty_data' => null
            ])
            ->add('github', TextType::class, [
                'required' => false,
                'empty_data' => null
            ])
            ->add('figma', TextType::class, [
                'required' => false,
                'empty_data' => null
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SocialMedias::class,
        ]);
    }
}
