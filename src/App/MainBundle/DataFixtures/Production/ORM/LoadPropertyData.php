<?php
namespace App\MainBundle\DataFixtures\Production\ORM;

use App\MainBundle\Entity\Property;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class LoadPropertyData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        $properties = array(
            array(
                'pid' => 'base_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            // Бытовая техника
            array(
                'pid' => 'bt_price',
                'title' => 'Цена',
                'type' => 'text'
            ),
            array(
                'pid' => 'bt_power',
                'title' => 'Мощность Вт',
                'type' => 'text'
            ),
            array(
                'pid' => 'bt_class',
                'title' => 'Класс энергопотребления',
                'type' => 'choice'
            ),
            array(
                'pid' => 'bt_diagonal',
                'title' => 'Диагональ',
                'type' => 'text'
            ),
            array(
                'pid' => 'bt_color',
                'title' => 'Цвет',
                'type' => 'choice'
            ),
            array(
                'pid' => 'bt_material',
                'title' => 'Материал корпуса',
                'type' => 'text'
            ),
            // Системы видеонаблюдения
            array(
                'pid' => 'guard_street',
                'title' => 'Уличная',
                'type' => 'text'
            ),
            array(
                'pid' => 'guard_kupol',
                'title' => 'Купольная',
                'type' => 'text'
            ),
            array(
                'pid' => 'guard_ik',
                'title' => 'с ИК подсветкой',
                'type' => 'text'
            ),
            array(
                'pid' => 'guard_dimension',
                'title' => 'Разрешение',
                'type' => 'text'
            ),
            // Климатическая техника
            array(
                'pid' => 'climat_price',
                'title' => 'Цена',
                'type' => 'text'
            ),
            array(
                'pid' => 'climat_square',
                'title' => 'Площадь охлаждения',
                'type' => 'text'
            ),
            array(
                'pid' => 'climat_freon_mark',
                'title' => 'Марка фреона',
                'type' => 'choice'
            ),
            array(
                'pid' => 'climat_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'pid' => 'climat_worktime',
                'title' => 'Режим работы',
                'type' => 'choice'
            ),
            array(
                'pid' => 'climat_power',
                'title' => 'Мощность потребления',
                'type' => 'text'
            ),
            // Компьютерная техника
            array(
                'pid' => 'pc_price',
                'title' => 'Цена',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_netbook',
                'title' => 'Нетбуки',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_sys_block',
                'title' => 'Готовые сист.блоки',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_mb',
                'title' => 'Материнская плата',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_cpu',
                'title' => 'Процессор',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_ram',
                'title' => 'Опертивная память',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_hdd',
                'title' => 'Жесткий диск',
                'type' => 'text'
            ),
            array(
                'pid' => 'pc_video',
                'title' => 'Видеоплата',
                'type' => 'text'
            ),
            // Процессор
            array(
                'pid' => 'cpu_socket',
                'title' => 'Разъем процессора',
                'type' => 'choice'
            ),
            array(
                'pid' => 'cpu_family',
                'title' => 'Семейство процессора',
                'type' => 'choice'
            ),
            // Оперативная память
            array(
                'pid' => 'ram_volume',
                'title' => 'Объем',
                'type' => 'text'
            ),
            array(
                'pid' => 'ram_ram_type',
                'title' => 'Тип оперативной памяти',
                'type' => 'choice'
            ),
            array(
                'pid' => 'ram_frequency',
                'title' => 'Частота памяти',
                'type' => 'choice'
            ),
            // Видеокарты
            array(
                'pid' => 'gpu_chipset',
                'title' => 'Графический чипсет',
                'type' => 'choice'
            ),
            array(
                'pid' => 'gpu_ram_size',
                'title' => 'Объем памяти',
                'type' => 'choice'
            ),
            array(
                'pid' => 'gpu_ram_type',
                'title' => 'Тип памяти',
                'type' => 'choice'
            ),
            array(
                'pid' => 'gpu_bit',
                'title' => 'Битность',
                'type' => 'choice'
            ),
            array(
                'pid' => 'gpu_cool',
                'title' => 'Охлаждение',
                'type' => 'choice'
            ),
            array(
                'pid' => 'gpu_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // HDD
            array(
                'pid' => 'hdd_size',
                'title' => 'Объем',
                'type' => 'text'
            ),
            // SDD
            array(
                'pid' => 'sdd_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            array(
                'pid' => 'sdd_speed',
                'title' => 'Скорость чтения',
                'type' => 'choice'
            ),
            array(
                'pid' => 'sdd_read',
                'title' => 'Скорость записи',
                'type' => 'choice'
            ),
            // ODD
            array(
                'pid' => 'odd_class',
                'title' => 'Класс',
                'type' => 'choice'
            ),
            array(
                'pid' => 'odd_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            array(
                'pid' => 'odd_color',
                'title' => 'Цвет',
                'type' => 'choice'
            ),
            // Материнские платы
            array(
                'pid' => 'mb_proc',
                'title' => 'Процессорная совместимость',
                'type' => 'choice'
            ),
            array(
                'pid' => 'mb_socket',
                'title' => 'Сокет',
                'type' => 'choice'
            ),
            array(
                'pid' => 'mb_chipset',
                'title' => 'Чипсет (северный мост)',
                'type' => 'choice'
            ),
            array(
                'pid' => 'mb_memory',
                'title' => 'Тип памяти',
                'type' => 'choice'
            ),
            array(
                'pid' => 'mb_build_in_video',
                'title' => 'Встроенное видео',
                'type' => 'checkbox'
            ),
            array(
                'pid' => 'mb_raid',
                'title' => 'Поддержка RAID',
                'type' => 'checkbox'
            ),
            // Корпус
            array(
                'pid' => 'box_class',
                'title' => 'Класс корпуса',
                'type' => 'choice'
            ),
            array(
                'pid' => 'box_form',
                'title' => 'Форм-фактор МП',
                'type' => 'choice'
            ),
            array(
                'pid' => 'box_power',
                'title' => 'Мощность блока питания',
                'type' => 'choice'
            ),
            array(
                'pid' => 'box_inputs',
                'title' => 'Внешние разьемы',
                'type' => 'checkbox'
            ),
            // Блок питания
            array(
                'pid' => 'bp_power',
                'title' => 'Мощность',
                'type' => 'choice'
            ),
            array(
                'pid' => 'bp_cooler',
                'title' => 'Установленный вентилятор',
                'type' => 'choice'
            ),
            // Накопители Flash USB
            array(
                'pid' => 'fusb_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'pid' => 'fusb_size',
                'title' => 'Объем',
                'type' => 'choice'
            ),
            array(
                'pid' => 'fusb_size',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            array(
                'pid' => 'fusb_size',
                'title' => 'Материал корпуса',
                'type' => 'choice'
            ),
            // Клавиатура
            array(
                'pid' => 'pid_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pid_connection',
                'title' => 'Тип подключения',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pid_connection_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // Мышь
            array(
                'pid' => 'mouse_sensor_type',
                'title' => 'Тип сенсора',
                'type' => 'choice'
            ),
            array(
                'pid' => 'mouse_connection_type',
                'title' => 'Тип подключения',
                'type' => 'choice'
            ),
            array(
                'pid' => 'mouse_connection_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // Планшет
            array(
                'pid' => 'pad_class',
                'title' => 'Класс планшета',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pad_size',
                'title' => 'Размер экрана',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pad_proc',
                'title' => 'Процессор',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pad_memory_ddr',
                'title' => 'Объем памяти',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pad_memory_hdd',
                'title' => 'Объем накопителя',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pad_os',
                'title' => 'Операционная система',
                'type' => 'choice'
            ),
            array(
                'pid' => 'pad_wireless',
                'title' => 'Беспроводные подключения',
                'type' => 'choice'
            ),
            // Принтеры, МФУ
            array(
                'pid' => 'printer_functions',
                'title' => 'Функции устройства',
                'type' => 'choice'
            ),
            array(
                'pid' => 'printer_print_technology',
                'title' => 'Технология печати',
                'type' => 'choice'
            ),
            array(
                'pid' => 'printer_print_colors',
                'title' => 'Цветность печати',
                'type' => 'choice'
            ),
            array(
                'pid' => 'printer_print_format',
                'title' => 'Формат печати',
                'type' => 'choice'
            ),
            array(
                'pid' => 'printer_print_speed_mono',
                'title' => 'Скорость ч/б печати',
                'type' => 'choice'
            ),
            array(
                'pid' => 'printer_print_speed_color',
                'title' => 'Скорость цв. печати',
                'type' => 'choice'
            ),
            array(
                'pid' => 'printer_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            // Сетевое оборудование Маршрутизаторы
            array(
                'pid' => 'router_speed',
                'title' => 'Скорость передачи данных',
                'type' => 'choice'
            ),
            array(
                'pid' => 'router_wifi',
                'title' => 'Стандарт Wi-Fi',
                'type' => 'choice'
            ),
            // Сетевые адаптеры
            array(
                'pid' => 'web_adapter_class',
                'title' => 'Класс',
                'type' => 'choice'
            ),
            array(
                'pid' => 'web_adapter_cart',
                'title' => 'Сетевая карта',
                'type' => 'choice'
            ),
            array(
                'pid' => 'web_adapter_cart_wifi',
                'title' => 'Сетевая карта Wi-Fi',
                'type' => 'choice'
            ),
            // ИБП
        );

        foreach ($properties as $data) {
            $entity = $this->create($data);
            $manager->persist($entity);
        }

        $manager->flush();
    }

    protected function create($data)
    {
        $entity = new Property();
        $entity->setTitle($data['title']);
        $entity->setType($data['type']);
        $entity->setPid($data['pid']);

        return $entity;
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
