<?php

namespace App\Form;

use App\Entity\PrivateInformations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;

class PrivateInformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('links', CollectionType::class, [
                'label' => false,
                'entry_type' => LinkType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
                'empty_data' => function () {
                    return new ArrayCollection();
                },
            ])
            ->add('medias', CollectionType::class, [
                'label' => false,
                'entry_type' => MediaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
                'empty_data' => function () {
                    return new ArrayCollection();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrivateInformations::class,
        ]);
    }
}
