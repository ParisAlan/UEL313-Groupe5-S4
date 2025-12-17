<?php

namespace App\Form;

use App\Entity\Liens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Motcle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ])
            ->add('nouveau_tag_texte', TextType::class, [
                'mapped' => false, 
                'required' => false,
                'label' => 'Vous pouvez créer un nouveau tag si vous ne le trouvez pas dans la liste au dessus'
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Liens::class,
        ]);
    }
}
