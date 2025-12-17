<?php

namespace App\Form;

use App\Entity\Liens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Motcle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lien_url')
            ->add('lien_titre')
            ->add('lien_desc')
            ->add('motcles', EntityType::class, [
                'class' => Motcle::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Sélectionnez les tags'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Liens::class,
        ]);
    }
}
