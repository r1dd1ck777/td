<?php
namespace App\MainBundle\DataFixtures\Production\ORM;

use App\MainBundle\Entity\Category;
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
            // Бытовая техника
            array(
                'key' => 'bt_price',
                'title' => 'Цена',
                'type' => 'text'
            ),
            array(
                'key' => 'bt_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'bt_power',
                'title' => 'Мощность Вт',
                'type' => 'text'
            ),
            array(
                'key' => 'bt_class',
                'title' => 'Класс энергопотребления',
                'type' => 'choice'
            ),
            array(
                'key' => 'bt_diagonal',
                'title' => 'Диагональ',
                'type' => 'text'
            ),
            array(
                'key' => 'bt_color',
                'title' => 'Цвет',
                'type' => 'choice'
            ),
            array(
                'key' => 'bt_material',
                'title' => 'Материал корпуса',
                'type' => 'text'
            ),
            // Системы видеонаблюдения
            array(
                'key' => 'guard_street',
                'title' => 'Уличная',
                'type' => 'text'
            ),
            array(
                'key' => 'guard_kupol',
                'title' => 'Купольная',
                'type' => 'text'
            ),
            array(
                'key' => 'guard_ik',
                'title' => 'с ИК подсветкой',
                'type' => 'text'
            ),
            array(
                'key' => 'guard_dimension',
                'title' => 'Разрешение',
                'type' => 'text'
            ),
            // Климатическая техника
            array(
                'key' => 'climat_price',
                'title' => 'Цена',
                'type' => 'text'
            ),
            array(
                'key' => 'climat_square',
                'title' => 'Площадь охлаждения',
                'type' => 'text'
            ),
            array(
                'key' => 'climat_freon_mark',
                'title' => 'Марка фреона',
                'type' => 'choice'
            ),
            array(
                'key' => 'climat_type',
                'title' => 'Тип',
                'type' => 'choicee'
            ),
            array(
                'key' => 'climat_worktime',
                'title' => 'Режим работы',
                'type' => 'choice'
            ),
            array(
                'key' => 'climat_power',
                'title' => 'Мощность потребления',
                'type' => 'text'
            ),
            // Компьютерная техника
            array(
                'key' => 'pc_price',
                'title' => 'Цена',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'pc_netbook',
                'title' => 'Нетбуки',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_sys_block',
                'title' => 'Готовые сист.блоки',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_mb',
                'title' => 'Материнская плата',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_cpu',
                'title' => 'Процессор',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_ram',
                'title' => 'Опертивная память',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_hdd',
                'title' => 'Жесткий диск',
                'type' => 'text'
            ),
            array(
                'key' => 'pc_video',
                'title' => 'Видеоплата',
                'type' => 'text'
            ),
            // Процессор
            array(
                'key' => 'cpu_socket',
                'title' => 'Разъем процессора',
                'type' => 'choice'
            ),
            array(
                'key' => 'cpu_family',
                'title' => 'Семейство процессора',
                'type' => 'choice'
            ),
            // Оперативная память
            array(
                'key' => 'ram_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'ram_volume',
                'title' => 'Объем',
                'type' => 'text'
            ),
            array(
                'key' => 'ram_ram_type',
                'title' => 'Тип оперативной памяти',
                'type' => 'choice'
            ),
            array(
                'key' => 'ram_frequency',
                'title' => 'Частота памяти',
                'type' => 'choice_'
            ),
            // Видеокарты
            array(
                'key' => 'gpu_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'gpu_chipset',
                'title' => 'Графический чипсет',
                'type' => 'choice'
            ),
            array(
                'key' => 'gpu_ram_size',
                'title' => 'Объем памяти',
                'type' => 'choice'
            ),
            array(
                'key' => 'gpu_ram_type',
                'title' => 'Тип памяти',
                'type' => 'choice'
            ),
            array(
                'key' => 'gpu_bit',
                'title' => 'Битность',
                'type' => 'choice'
            ),
            array(
                'key' => 'gpu_cool',
                'title' => 'Охлаждение',
                'type' => 'choice'
            ),
            array(
                'key' => 'gpu_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // HDD
            array(
                'key' => 'hdd_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand',
            ),
            array(
                'key' => 'hdd_size',
                'title' => 'Объем',
                'type' => 'text'
            ),
            // SDD
            array(
                'key' => 'sdd_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand',
            ),
            array(
                'key' => 'sdd_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            array(
                'key' => 'sdd_speed',
                'title' => 'Скорость чтения',
                'type' => 'choice'
            ),
            array(
                'key' => 'sdd_read',
                'title' => 'Скорость записи',
                'type' => 'choice'
            ),
            // ODD
            array(
                'key' => 'odd_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'odd_class',
                'title' => 'Класс',
                'type' => 'choice'
            ),
            array(
                'key' => 'odd_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            array(
                'key' => 'odd_color',
                'title' => 'Цвет',
                'type' => 'choice'
            ),
            // Материнские платы
            array(
                'key' => 'mb_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'mb_proc',
                'title' => 'Процессорная совместимость',
                'type' => 'choice'
            ),
            array(
                'key' => 'mb_socket',
                'title' => 'Сокет',
                'type' => 'choice'
            ),
            array(
                'key' => 'mb_chipset',
                'title' => 'Чипсет (северный мост)',
                'type' => 'choice'
            ),
            array(
                'key' => 'mb_memory',
                'title' => 'Тип памяти',
                'type' => 'choice'
            ),
            array(
                'key' => 'mb_build_in_video',
                'title' => 'Встроенное видео',
                'type' => 'checkbox'
            ),
            array(
                'key' => 'mb_raid',
                'title' => 'Поддержка RAID',
                'type' => 'checkbox'
            ),
            // Корпус
            array(
                'key' => 'box_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'box_class',
                'title' => 'Класс корпуса',
                'type' => 'choice'
            ),
            array(
                'key' => 'box_form',
                'title' => 'Форм-фактор МП',
                'type' => 'choice'
            ),
            array(
                'key' => 'box_power',
                'title' => 'Мощность блока питания',
                'type' => 'choice'
            ),
            array(
                'key' => 'box_inputs',
                'title' => 'Внешние разьемы',
                'type' => 'checkbox'
            ),
            // Блок питания
            array(
                'key' => 'bp_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'bp_power',
                'title' => 'Мощность',
                'type' => 'choice'
            ),
            array(
                'key' => 'bp_cooler',
                'title' => 'Установленный вентилятор',
                'type' => 'choice'
            ),
            // Накопители Flash USB
            array(
                'key' => 'fusb_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'key' => 'fusb_size',
                'title' => 'Объем',
                'type' => 'choice'
            ),
            array(
                'key' => 'fusb_size',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            array(
                'key' => 'fusb_size',
                'title' => 'Материал корпуса',
                'type' => 'choice'
            ),
            // Клавиатура
            array(
                'key' => 'key_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'key_type',
                'title' => 'Тип',
                'type' => 'choice'
            ),
            array(
                'key' => 'key_connection',
                'title' => 'Тип подключения',
                'type' => 'choice'
            ),
            array(
                'key' => 'key_connection_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // Мышь
            array(
                'key' => 'mouse_sensor_type',
                'title' => 'Тип сенсора',
                'type' => 'choice'
            ),
            array(
                'key' => 'mouse_connection_type',
                'title' => 'Тип подключения',
                'type' => 'choice'
            ),
            array(
                'key' => 'mouse_connection_interface',
                'title' => 'Интерфейс подключения',
                'type' => 'choice'
            ),
            // Планшет
            array(
                'key' => 'pad_class',
                'title' => 'Класс планшета',
                'type' => 'choice'
            ),
            array(
                'key' => 'pad_size',
                'title' => 'Размер экрана',
                'type' => 'choice'
            ),
            array(
                'key' => 'pad_proc',
                'title' => 'Процессор',
                'type' => 'choice'
            ),
            array(
                'key' => 'pad_memory_ddr',
                'title' => 'Объем памяти',
                'type' => 'choice'
            ),
            array(
                'key' => 'pad_memory_hdd',
                'title' => 'Объем накопителя',
                'type' => 'choice'
            ),
            array(
                'key' => 'pad_os',
                'title' => 'Операционная система',
                'type' => 'choice'
            ),
            array(
                'key' => 'pad_wireless',
                'title' => 'Беспроводные подключения',
                'type' => 'choice'
            ),
            // Принтеры, МФУ
            array(
                'key' => 'printer_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'printer_functions',
                'title' => 'Функции устройства',
                'type' => 'choice'
            ),
            array(
                'key' => 'printer_print_technology',
                'title' => 'Технология печати',
                'type' => 'choice'
            ),
            array(
                'key' => 'printer_print_colors',
                'title' => 'Цветность печати',
                'type' => 'choice'
            ),
            array(
                'key' => 'printer_print_format',
                'title' => 'Формат печати',
                'type' => 'choice'
            ),
            array(
                'key' => 'printer_print_speed_mono',
                'title' => 'Скорость ч/б печати',
                'type' => 'choice'
            ),
            array(
                'key' => 'printer_print_speed_color',
                'title' => 'Скорость цв. печати',
                'type' => 'choice'
            ),
            array(
                'key' => 'printer_interface',
                'title' => 'Интерфейс',
                'type' => 'choice'
            ),
            // Сетевое оборудование Маршрутизаторы
            array(
                'key' => 'router_speed',
                'title' => 'Скорость передачи данных',
                'type' => 'choice'
            ),
            array(
                'key' => 'router_wifi',
                'title' => 'Стандарт Wi-Fi',
                'type' => 'choice'
            ),
            // Сетевые адаптеры
            array(
                'key' => 'web_adapter_class',
                'title' => 'Класс',
                'type' => 'choice'
            ),
            array(
                'key' => 'web_adapter_cart',
                'title' => 'Сетевая карта',
                'type' => 'choice'
            ),
            array(
                'key' => 'web_adapter_cart_wifi',
                'title' => 'Сетевая карта Wi-Fi',
                'type' => 'choice'
            ),
            // ИБП
            array(
                'key' => 'ups_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'ups_brand',
                'title' => 'Производитель',
                'type' => 'choice_brand'
            ),
            array(
                'key' => 'router_speed',
                'title' => 'sss',
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
        $entity->setName($data['title']);
        $entity->setType($data['type']);

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
