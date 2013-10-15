<?php
namespace App\MainBundle\DataFixtures\Production\ORM;

use App\MainBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class LoadCategoryData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        /** @var \App\MainBundle\Services\XlsImport $xls */
        $xls = $this->container->get('app.main.services.xls_import');
        $xls->createFrom(__DIR__.'/price.xls');
        $cats = $xls->extractCategories($xls->toArray(2));

        foreach ($cats as $name => $value) {
            $cat = $this->create($name);
            $manager->persist($cat);
        }

        $manager->flush();
    }

    protected function create($name)
    {
        $category = new Category();
        $category->setName($name);

        return $category;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
