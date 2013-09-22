<?php

namespace App\MainBundle\Services;

class XlsImport extends Xls
{
    protected $productRepository;
    protected $categoryRepository;
    protected $prototypeRepository;
    protected $prototype;
    protected $em;

    public function setCategoryRepository($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function setProductRepository($productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function setPrototypeRepository($prototypeRepository)
    {
        $this->prototypeRepository = $prototypeRepository;
    }

    public function setEm($em)
    {
        $this->em = $em;
    }

    public function import()
    {
        $this->prototype = $this->prototypeRepository->findOneBy(array());

        $first = true;
        foreach ($this->toArray() as $row) {
            if ($first) {$first = false; continue;}
            $this->importProduct($row);
        }
        $this->em->flush();
    }

    protected function importProduct(array $row)
    {
        $category = $this->getCategory($row[1]);
        $product = $this->getProduct($row[0]);
        $product->setCategory($category);
        $product->setName(ucfirst($row[2]));
        $product->setPrice($row[3]);
        $product->setDescription($row[4]);
        $product->setInfo($row[4]);
        $product->setIsPresent($row[5]);

        $this->em->persist($product);
    }

    protected function getProduct($code)
    {
        $object = $this->productRepository->findOneBy(array('code' => (string) $code));
        if (!$object) {
            $object = $this->productRepository->createNew();
            $object->setCode($code);
            $object->mergeProperties($this->prototype);
            $this->em->persist($object);
        }

        return $object;
    }

    protected function getCategory($name)
    {
        $object = $this->categoryRepository->findOneBy(array('name' => $name));
        if (!$object) {
            $object = $this->categoryRepository->createNew();
            $object->setName($name);
            $this->em->persist($object);
            $this->em->flush();
        }

        return $object;
    }
}
