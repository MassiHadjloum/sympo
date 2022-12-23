<?php

namespace App\Form;

use App\Entity\Paye;
use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class PaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
				'constraints' => [
					new NotBlank([
						'message' => 'name is required',
					]),
					new Length([
						'min' => 3,
						'minMessage' => 'Country name is too short'
					]),
				],
			])
            ->add('drapeau', FileType::class, [
				'data_class' => null,
				// contraintes uniquement si le joueur est en cours de création
				'constraints' => $options['data']->getId() ? [] : [
					new NotBlank([
						'message' => 'Drapeau is required',
					])
				],
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paye::class,
        ]);
    }
}
