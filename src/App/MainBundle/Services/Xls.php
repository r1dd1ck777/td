<?php

namespace App\MainBundle\Services;

class Xls
{
    protected $sheet;
    protected $row;

    public function __construct($filepath)
    {
        $objPHPExcel = \PHPExcel_IOFactory::load($filepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $aSheet = $objPHPExcel->getActiveSheet();

        $this->sheet =$aSheet;
        $this->row = 1;
    }

    public function getItems()
    {
        $this->sheet->getCellByColumnAndRow(1, $this->row)->getValue();
    }
}