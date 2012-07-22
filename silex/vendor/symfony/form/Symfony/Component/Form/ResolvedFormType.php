<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form;

use Symfony\Component\Form\Exception\FormException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\TypeDefinitionException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * A wrapper for a form type and its extensions.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ResolvedFormType implements ResolvedFormTypeInterface
{
    /**
     * @var FormTypeInterface
     */
    private $innerType;

    /**
     * @var array
     */
    private $typeExtensions;

    /**
     * @var ResolvedFormType
     */
    private $parent;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    public function __construct(FormTypeInterface $innerType, array $typeExtensions = array(), ResolvedFormType $parent = null)
    {
        if (!preg_match('/^[a-z0-9_]*$/i', $innerType->getName())) {
            throw new FormException(sprintf(
                'The "%s" form type name ("%s") is not valid. Names must only contain letters, numbers, and "_".',
                get_class($innerType),
                $innerType->getName()
            ));
        }

        foreach ($typeExtensions as $extension) {
            if (!$extension instanceof FormTypeExtensionInterface) {
                throw new UnexpectedTypeException($extension, 'Symfony\Component\Form\FormTypeExtensionInterface');
            }
        }

        // BC
        if ($innerType instanceof AbstractType) {
            /* @var AbstractType $innerType */
            $innerType->setExtensions($typeExtensions);
        }

        $this->innerType = $innerType;
        $this->typeExtensions = $typeExtensions;
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->innerType->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getInnerType()
    {
        return $this->innerType;
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeExtensions()
    {
        // BC
        if ($this->innerType instanceof AbstractType) {
            return $this->innerType->getExtensions();
        }

        return $this->typeExtensions;
    }

    /**
     * {@inheritdoc}
     */
    public function createBuilder(FormFactoryInterface $factory, $name, array $options = array(), FormBuilderInterface $parent = null)
    {
        $options = $this->getOptionsResolver()->resolve($options);

        // Should be decoupled from the specific option at some point
        $dataClass = isset($options['data_class']) ? $options['data_class'] : null;

        $builder = new FormBuilder($name, $dataClass, new EventDispatcher(), $factory, $options);
        $builder->setType($this);
        $builder->setParent($parent);

        $this->buildForm($builder, $options);

        return $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function createView(FormInterface $form, FormViewInterface $parent = null)
    {
        $options = $form->getConfig()->getOptions();

        $view = new FormView($form->getConfig()->getName());
        $view->setParent($parent);

        $this->buildView($view, $form, $options);

        foreach ($form as $child) {
            /* @var FormInterface $child */
            $view->add($child->createView($view));
        }

        $this->finishView($view, $form, $options);

        return $view;
    }

    private function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null !== $this->parent) {
            $this->parent->buildForm($builder, $options);
        }

        $this->innerType->buildForm($builder, $options);

        foreach ($this->typeExtensions as $extension) {
            /* @var FormTypeExtensionInterface $extension */
            $extension->buildForm($builder, $options);
        }
    }

    private function buildView(FormViewInterface $view, FormInterface $form, array $options)
    {
        if (null !== $this->parent) {
            $this->parent->buildView($view, $form, $options);
        }

        $this->innerType->buildView($view, $form, $options);

        foreach ($this->typeExtensions as $extension) {
            /* @var FormTypeExtensionInterface $extension */
            $extension->buildView($view, $form, $options);
        }
    }

    private function finishView(FormViewInterface $view, FormInterface $form, array $options)
    {
        if (null !== $this->parent) {
            $this->parent->finishView($view, $form, $options);
        }

        $this->innerType->finishView($view, $form, $options);

        foreach ($this->typeExtensions as $extension) {
            /* @var FormTypeExtensionInterface $extension */
            $extension->finishView($view, $form, $options);
        }
    }

    private function getOptionsResolver()
    {
        if (null === $this->optionsResolver) {
            if (null !== $this->parent) {
                $this->optionsResolver = clone $this->parent->getOptionsResolver();
            } else {
                $this->optionsResolver = new OptionsResolver();
            }

            $this->innerType->setDefaultOptions($this->optionsResolver);

            foreach ($this->typeExtensions as $extension) {
                /* @var FormTypeExtensionInterface $extension */
                $extension->setDefaultOptions($this->optionsResolver);
            }
        }

        return $this->optionsResolver;
    }
}
