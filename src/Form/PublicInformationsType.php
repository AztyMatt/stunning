<?php

namespace App\Form;

use App\Entity\PublicInformations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;
use App\Validator\Constraints\PublicInfoContainMedia;
use Symfony\Component\Validator\Constraints\Count;

class PublicInformationsType extends AbstractType
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
                'label_html' => true,
                'entry_type' => MediaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'mapped' => true,
                'required' => false,
                'empty_data' => function () {
                    return new ArrayCollection();
                },
                'constraints' => [
                    new Count([
                        'min' => 1,
                        'minMessage' => 'Public Informations need at least one media.',
                    ]),
                ],
            ])
            ->add('comments', CollectionType::class, [
                'label' => false,
                'label_html' => true,
                'entry_type' => CommentType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'mapped' => true,
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
            'data_class' => PublicInformations::class,
        ]);
    }
}
