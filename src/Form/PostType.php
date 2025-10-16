<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title de l\'article'])
            ->add('content', TextareaType::class, ['label' => 'Contenu de l\'article'])
            ->add('imageFile', VichFileType::class,
                ['label' => 'Image de l\'article',
                 'required' => false,
                 'allow_delete' => false,
                 'download_uri' => false,
                 'asset_helper' => true,
                ])
            ->add('isPublished', CheckboxType::class, [
                'label' => 'Publier l\'article',
                'required' => false])
            ->add('category', EntityType::class, [
                'label' => 'Category',
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $repository) {
                return $repository->getCatbyNameAsc();
                },
                'choice_label' => 'name',
                'placeholder' => 'Choississez une catégorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
