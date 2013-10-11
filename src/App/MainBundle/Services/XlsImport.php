<?php

namespace App\MainBundle\Services;

class XlsImport extends Xls
{
    const KEY_STATUS = 'td:import_status';
    const KEY_TOTAL = 'td:import_total';
    const KEY_DONE = 'td:import_done';
    protected $productRepository;
    protected $categoryRepository;
    protected $prototypeRepository;
    protected $prototype;
    protected $em;
    protected $redis;

    public function setRedis($redis)
    {
        $this->redis = $redis;
    }

    public function status($val = null)
    {
        if (is_null($val)) { return (boolean) $this->redis->get(self::KEY_STATUS); }
        $this->redis->set(self::KEY_STATUS, (int) $val);
    }

    public function total($val = null)
    {
        if (is_null($val)) { return (int) $this->redis->get(self::KEY_TOTAL); }
        $this->redis->set(self::KEY_TOTAL, (int) $val);
    }

    public function done($val = null)
    {
        if (is_null($val)) { return (int) $this->redis->get(self::KEY_DONE); }
        $this->redis->set(self::KEY_DONE, (int) $val);
    }

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

    public function import($from = null, $to = null)
    {
        $rows = $this->toArray($from, $to);

        $this->createCategories($rows);
        $this->em->flush();
        foreach ($rows as $key => $row) {
            $this->importProduct($row);
            $this->done($key+$from);
        }
        $this->em->flush();
    }

    public function createCategories($rows)
    {
        $categories = $this->extractCategories($rows);

        foreach ($categories as $categoryName => $value) {
            if ($this->getCategory($categoryName)) {continue;}
            $object = $this->categoryRepository->createNew();
            $object->setName($categoryName);
            $this->em->persist($object);
        }
    }

    public function extractCategories($rows)
    {
        $categories = array();

        foreach ($rows as $row) {
            $name = trim($row[1]);
            $categories[$name] = 1;
        }

        return $categories;
    }

    protected function importProduct(array $row)
    {
        $category = $this->getCategory($row[1]);
        $product = $this->getProduct($row[0], $category);
        $product->setCategory($category);
        $product->setName(ucfirst($row[2]));
        $product->setPrice($row[3]);
        $product->setDescription($row[4]);
        $product->setInfo($row[4]);
        $product->setIsPresent($row[5]);
        if (isset($row[6])) {$product->setGuaranty($row[6]);}

        $this->em->persist($product);
    }

    protected function getProduct($code, $category)
    {
        $object = $this->productRepository->findOneBy(array('code' => (string) $code));

        if (!$object) {
            $object = $this->productRepository->createNew();
            $object->setCode($code);
            $prototype = $this->prototypeRepository->getOneByCategoryName($category->getName());
            if ($prototype) {
                $object->mergeProperties($prototype);
            }
            $this->em->persist($object);
        }

        return $object;
    }

    protected function getCategory($name)
    {
        $object = $this->categoryRepository->findOneBy(array('name' => trim($name)));

        return $object;
    }
}
