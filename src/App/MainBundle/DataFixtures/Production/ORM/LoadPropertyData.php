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
//            array(
//                'pid' => 'base_brand',
//                'title' => 'Производитель',
//                'type' => 'choice_brand'
//            ),
//            array(
//                'pid' => 'base_price',
//                'title' => 'Цена',
//                'type' => 'integer'
//            ),
            // Бытовая техника
            array(
                'prefix' => 'Бытовая техника',
                'pid' => 'bt_power',
                'title' => 'Мощность Вт',
                'type' => 'integer'
            ),
            array(
                'prefix' => 'Бытовая техника',
                'pid' => 'bt_class',
                'title' => 'Класс энергопотребления',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Бытовая техника',
                'pid' => 'bt_diagonal',
                'title' => 'Диагональ',
                'type' => 'integer'
            ),
            array(
                'prefix' => 'Бытовая техника',
                'pid' => 'bt_color',
                'title' => 'Цвет',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Бытовая техника',
                'pid' => 'bt_material',
                'title' => 'Материал корпуса',
                'type' => 'text'
            ),
            // Системы видеонаблюдения
            array(
                'prefix' => 'Системы видеонаблюдения',
                'pid' => 'guard_street',
                'title' => 'Уличная',
                'type' => 'checkbox'
            ),
            array(
                'prefix' => 'Системы видеонаблюдения',
                'pid' => 'guard_kupol',
                'title' => 'Купольная',
                'type' => 'checkbox'
            ),
            array(
                'prefix' => 'Системы видеонаблюдения',
                'pid' => 'guard_ik',
                'title' => 'с ИК подсветкой',
                'type' => 'checkbox'
            ),
            array(
                'prefix' => 'Системы видеонаблюдения',
                'pid' => 'guard_dimension',
                'title' => 'Разрешение',
                'type' => 'text'
            ),
            // Климатическая техника
            array(
                'prefix' => 'Климатическая техника',
                'pid' => 'climat_square',
                'title' => 'Площадь охлаждения',
                'type' => 'text'
            ),
            array(
                'prefix' => 'Климатическая техника',
                'pid' => 'climat_freon_mark',
                'title' => 'Марка фреона',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Климатическая техника',
                'pid' => 'climat_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Климатическая техника',
                'pid' => 'climat_worktime',
                'title' => 'Режим работы',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Климатическая техника',
                'pid' => 'climat_power',
                'title' => 'Мощность потребления',
                'type' => 'text'
            ),
            // Компьютерная техника
//            array(
//                'pid' => 'pc_netbook',
//                'title' => 'Нетбуки',
//                'type' => 'text'
//            ),
//            array(
//                'pid' => 'pc_sys_block',
//                'title' => 'Готовые сист.блоки',
//                'type' => 'text'
//            ),
//            array(
//                'pid' => 'pc_mb',
//                'title' => 'Материнская плата',
//                'type' => 'text'
//            ),
//            array(
//                'pid' => 'pc_cpu',
//                'title' => 'Процессор',
//                'type' => 'text'
//            ),
//            array(
//                'pid' => 'pc_ram',
//                'title' => 'Опертивная память',
//                'type' => 'text'
//            ),
//            array(
//                'pid' => 'pc_hdd',
//                'title' => 'Жесткий диск',
//                'type' => 'text'
//            ),
//            array(
//                'pid' => 'pc_video',
//                'title' => 'Видеоплата',
//                'type' => 'text'
//            ),
            // Процессор
            array(
                'prefix' => 'Процессор',
                'pid' => 'cpu_socket',
                'title' => 'Разъем процессора',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Процессор',
                'pid' => 'cpu_family',
                'title' => 'Семейство процессора',
                'type' => 'choice'
            ),
            // Оперативная память
            array(
                'prefix' => 'Оперативная память',
                'pid' => 'ram_volume',
                'title' => 'Объем',
                'type' => 'text'
            ),
            array(
                'prefix' => 'Оперативная память',
                'pid' => 'ram_ram_type',
                'title' => 'Тип оперативной памяти',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Оперативная память',
                'pid' => 'ram_frequency',
                'title' => 'Частота памяти',
                'type' => 'choice'
            ),
            // Видеокарты
            array(
                'prefix' => 'Видеокарты',
                'pid' => 'gpu_chipset',
                'title' => 'Графический чипсет',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Видеокарты',
                'pid' => 'gpu_ram_size',
                'title' => 'Объем памяти',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Видеокарты',
                'pid' => 'gpu_ram_type',
                'title' => 'Тип памяти',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Видеокарты',
                'pid' => 'gpu_bit',
                'title' => 'Битность',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Видеокарты',
                'pid' => 'gpu_cool',
                'title' => 'Охлаждение',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Видеокарты',
                'pid' => 'gpu_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // HDD
            array(
                'prefix' => 'HDD',
                'pid' => 'hdd_size',
                'title' => 'Объем',
                'type' => 'text'
            ),
            array(
                'prefix' => 'HDD',
                'pid' => 'hdd_buffer',
                'title' => 'Размер буфера',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'HDD',
                'pid' => 'hdd_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            // SDD
            array(
                'prefix' => 'SDD',
                'pid' => 'sdd_size',
                'title' => 'Объем',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'SDD',
                'pid' => 'sdd_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'SDD',
                'pid' => 'sdd_speed',
                'title' => 'Скорость чтения',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'SDD',
                'pid' => 'sdd_read',
                'title' => 'Скорость записи',
                'type' => 'choice'
            ),
            // ODD
            array(
                'prefix' => 'ODD',
                'pid' => 'odd_class',
                'title' => 'Класс',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'ODD',
                'pid' => 'odd_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'ODD',
                'pid' => 'odd_color',
                'title' => 'Цвет',
                'type' => 'choice'
            ),
            // Материнские платы
            array(
                'prefix' => 'Материнские платы',
                'pid' => 'mb_proc',
                'title' => 'Процессорная совместимость',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Материнские платы',
                'pid' => 'mb_socket',
                'title' => 'Сокет',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Материнские платы',
                'pid' => 'mb_chipset',
                'title' => 'Чипсет (северный мост)',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Материнские платы',
                'pid' => 'mb_memory',
                'title' => 'Тип памяти',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Материнские платы',
                'pid' => 'mb_build_in_video',
                'title' => 'Встроенное видео',
                'type' => 'checkbox'
            ),
            array(
                'prefix' => 'Материнские платы',
                'pid' => 'mb_raid',
                'title' => 'Поддержка RAID',
                'type' => 'checkbox'
            ),
            // Корпус
            array(
                'prefix' => 'Корпус',
                'pid' => 'box_class',
                'title' => 'Класс корпуса',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Корпус',
                'pid' => 'box_form',
                'title' => 'Форм-фактор МП',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Корпус',
                'pid' => 'box_power',
                'title' => 'Мощность блока питания',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Корпус',
                'pid' => 'box_inputs',
                'title' => 'Внешние разьемы',
                'type' => 'choice'
            ),
            // Блок питания
            array(
                'prefix' => 'Блок питания',
                'pid' => 'bp_power',
                'title' => 'Мощность',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Блок питания',
                'pid' => 'bp_cooler',
                'title' => 'Установленный вентилятор',
                'type' => 'choice'
            ),
            // Накопители Flash USB
            array(
                'prefix' => 'Накопители Flash USB',
                'pid' => 'fusb_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Накопители Flash USB',
                'pid' => 'fusb_size',
                'title' => 'Объем',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Накопители Flash USB',
                'pid' => 'fusb_size',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Накопители Flash USB',
                'pid' => 'fusb_material',
                'title' => 'Материал корпуса',
                'type' => 'choice'
            ),
            // Клавиатура
            array(
                'prefix' => 'Клавиатура',
                'pid' => 'key_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Клавиатура',
                'pid' => 'key_connection',
                'title' => 'Тип подключения',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Клавиатура',
                'pid' => 'key_connection_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // Мышь
            array(
                'prefix' => 'Мышь',
                'pid' => 'mouse_sensor_type',
                'title' => 'Тип сенсора',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Мышь',
                'pid' => 'mouse_connection_type',
                'title' => 'Тип подключения',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Мышь',
                'pid' => 'mouse_connection_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // Планшет
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_class',
                'title' => 'Класс планшета',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_size',
                'title' => 'Размер экрана',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_proc',
                'title' => 'Процессор',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_memory_ram',
                'title' => 'Объем памяти',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_memory_hdd',
                'title' => 'Объем накопителя',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_os',
                'title' => 'Операционная система',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Планшет',
                'pid' => 'pad_wireless',
                'title' => 'Беспроводные подключения',
                'type' => 'choice'
            ),
            // Принтеры, МФУ
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_functions',
                'title' => 'Функции устройства',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_print_technology',
                'title' => 'Технология печати',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_print_colors',
                'title' => 'Цветность печати',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_print_format',
                'title' => 'Формат печати',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_print_speed_mono',
                'title' => 'Скорость ч/б печати',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_print_speed_color',
                'title' => 'Скорость цв. печати',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Принтеры, МФУ',
                'pid' => 'printer_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            // Сетевое оборудование, Маршрутизаторы
            array(
                'prefix' => 'Сетевое оборудование, Маршрутизаторы',
                'pid' => 'router_speed',
                'title' => 'Скорость передачи данных',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'Сетевое оборудование, Маршрутизаторы',
                'pid' => 'router_wifi',
                'title' => 'Стандарт Wi-Fi',
                'type' => 'choice'
            ),
            // ИБП
            array(
                'prefix' => 'ИБП',
                'pid' => 'ups_power',
                'title' => 'Мощность полная, В*А',
                'type' => 'choice'
            ),
            array(
                'prefix' => 'ИБП',
                'pid' => 'ups_power_active',
                'title' => 'Мощность активная, Вт',
                'type' => 'choice'
            ),
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
        $entity->setPrefix($data['prefix']);

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
