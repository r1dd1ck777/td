<?php
namespace App\MainBundle\DataFixtures\Production\ORM;

use App\MainBundle\Entity\Property;
use App\MainBundle\Entity\Prototype;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class LoadPrototypeData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        $properties = $this->container->get('app.repository.property')->findAll();

        $prototype= new Prototype();
        $prototype->setName('Базовый продукт');
        foreach ($properties as $property) {
            $prototype->addPropertie($property);
        }

        $manager->persist($prototype);

        $manager->flush();
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
