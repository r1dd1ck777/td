<?php

namespace App\MainBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToProductTransformer implements DataTransformerInterface
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($page)
    {
        if (null === $page) {
            return "";
        }
        if (!is_object($page)) {
            return (string) $page;
        }

        return $page->getId();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param string $number
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        return $this->repository->find($id);
    }
}
