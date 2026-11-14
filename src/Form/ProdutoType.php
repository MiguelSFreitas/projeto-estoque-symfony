<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Produto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, ['label' => 'Nome'])
            ->add('codigo', TextType::class, ['label' => 'Código (SKU)'])
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => 'nome',
                'label' => 'Categoria',
                'placeholder' => 'Selecione...',
            ])
            ->add('descricao', TextareaType::class, [
                'label' => 'Descrição',
                'required' => false,
            ])
            ->add('preco', NumberType::class, [
                'label' => 'Preço (R$)',
                'input' => 'string',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01', 'min' => '0'],
            ])
            ->add('quantidade', IntegerType::class, ['label' => 'Quantidade em estoque'])
            ->add('estoqueMinimo', IntegerType::class, ['label' => 'Estoque mínimo'])
            ->add('ativo', CheckboxType::class, [
                'label' => 'Ativo',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Produto::class]);
    }
}