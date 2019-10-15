<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{


    private function getConfiguration($label, $placeholder)
    {
        return [
            'label'=>$label,
            'attr' => [
            'placeholder' => $placeholder
            ]
        ];

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class, $this->getConfiguration("Libelle", "Tapez le nom de l'article"))
            ->add('prix',MoneyType::class, $this->getConfiguration("Prix", "Tapez le prix de l'article"))
            ->add('description',TextareaType::class, $this->getConfiguration("Descrpition", "Tapez la description de l'article"))
            ->add('image',UrlType::class, $this->getConfiguration("URL", "Adresse de l'image"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
