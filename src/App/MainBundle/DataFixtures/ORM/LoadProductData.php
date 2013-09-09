<?php
namespace App\MainBundle\DataFixtures\ORM;

use App\MainBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class LoadProductData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        $cats = array(
            '1' => array(
                '1_1' => array(
                    '1_1_1' => null,
                    '1_1_2' => null,
                    '1_1_3' => null,
                ),
                '1_2' => array(
                    '1_2_1' => null,
                    '1_2_2' => null,
                    '1_2_3' => null,
                    '1_2_4' => null,
                    '1_2_5' => null,
                )
            ),
            '2' => array(
                '2_1' => array(
                    '2_1_1' => null,
                    '2_1_2' => null,
                    '2_1_3' => null,
                    '2_1_4' => null,
                ),
                '2_2' => array(
                    '2_2_1' => null,
                    '2_2_2' => null,
                    '2_2_3' => null,
                    '2_2_4' => null,
                    '2_2_5' => null,
                    '2_2_6' => null,
                )
            ),
        );

        foreach ($this->createMany($cats) as $category) {
//            $manager->persist($category);
        }

//        $manager->flush();
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

    protected function createMany($cats, Category $parent = null)
    {
        $result = array();
        foreach ($cats as $name=>$cat) {
            $category = $this->create($name, $cat);
            if (!is_null($parent)) {
                $category->setParent($parent);
            }
            $result[] = $category;
        }

        return $result;
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
