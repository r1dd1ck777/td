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
    protected $properties;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->properties = $this->container->get('app.repository.property')->findAll();

        //
        $prototype= new Prototype();
        $prototype->setName('Базовый продукт');
        foreach ($this->properties as $property) {
            $prototype->addPropertie($property);
        }
        $manager->persist($prototype);
        //
        $prefixes = array(
            'Бытовая техника',
            'Системы видеонаблюдения',
            'Климатическая техника',
            'Процессор',
            'Оперативная память',
            'Видеокарты',
            'HDD',
            'SDD',
            'ODD',
            'Материнские платы',
            'Корпус',
            'Блок питания',
            'Накопители Flash USB',
            'Клавиатура',
            'Мышь',
            'Планшет',
            'Принтеры, МФУ',
            'Сетевое оборудование, Маршрутизаторы',
            'ИБП',
        );
        foreach ($prefixes as $prefix) {
            $prototype = $this->create($prefix);
            $manager->persist($prototype);
        }

        $manager->flush();
    }

    protected function create($prefix = null)
    {
        $prototype= new Prototype();
        $prototype->setName($prefix);
        foreach ($this->properties as $property) {
            if ($property->getPrefix() == $prefix) {
                $prototype->addPropertie($property);
            }
        }

        return $prototype;
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
