<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('TypeR',ChoiceType::class, [
                'choices' => [
                    'selectionner'=>'',
                    'Technique' => 'Technique',
                    'Au cours de voyage' => 'Au cours de voyage',
                    'Autre' => 'Autre',
                ]])
            ->add('DescriptionR' ,TextareaType::class,['attr'=>['placeholder'=>'Decrire votre Reclamation']])
            ->add('DateR')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
