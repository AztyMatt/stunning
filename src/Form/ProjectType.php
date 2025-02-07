<?php

namespace App\Form;

use App\Entity\Project;
use App\Enum\ProjectVisibilityEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'required' => true
            ])
            ->add('visibility', ChoiceType::class, [
                'choices' => array_combine(
                    array_map(fn($visibility) => $visibility->value, ProjectVisibilityEnum::cases()),
                    ProjectVisibilityEnum::cases()
                ),
                'choice_label' => function ($choice, $key, $value) {
                    return $key;
                },
                'placeholder' => false,
                'required' => false
            ])
            ->add('numberOfViews', null, [
                'required' => false
            ])
            ->add('likes', null, [
                'required' => false
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'by_reference' => false,
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('technologies', CollectionType::class, [
                'label' => false,
                'entry_type' => TechnologyType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
                'empty_data' => function () {
                    return new ArrayCollection();
                },
            ])
            ->add('tags', CollectionType::class, [
                'label' => false,
                'entry_type' => TagType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'required' => false,
                'empty_data' => function () {
                    return new ArrayCollection();
                },
            ])
            ->add('publicInformations', PublicInformationsType::class, [
                'label' => false,
                'required' => false,
                'by_reference' => false,
            ])
            ->add('privateInformations', PrivateInformationsType::class, [
                'label' => false,
                'required' => false,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
