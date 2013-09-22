<?php
namespace App\MainBundle\DataFixtures\ORM;

use App\MainBundle\Entity\Brand;
use App\MainBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class LoadBrandData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        $this->categories = $this->container->get('app.repository.category')->findAll();
        $brands = array('b1', 'b2');

        foreach ($brands as $name) {
            $brand = new Brand();
            $brand->setName($name);
            $brand->addCategory($this->getRandomCategory());
            $manager->persist($brand);
        }

        $manager->flush();
    }

    protected function create($name, $cats)
    {
        $category = new Category();
        $category->setName($name);
        if (is_array($cats)) {
            foreach ($this->createMany($cats,$category) as $child) {
                $category->addChild($child);
            }
        }

        return $category;
    }

    protected function getRandomCategory()
    {
        return $this->categories[array_rand($this->categories)];
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
