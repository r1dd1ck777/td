<?php

namespace App\MainBundle\Services;

abstract class Xls
{
    const PATH = 'uploads/tmp/';
    protected $webPath;
    protected $sheet;
    protected $filepath;

    public function setWebPath($webPath)
    {
        $this->webPath = $webPath;
    }

    public function createFrom($filepath)
    {
        $this->filepath = $filepath;
        $objPHPExcel = \PHPExcel_IOFactory::load($filepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $aSheet = $objPHPExcel->getActiveSheet();

        $this->sheet =$aSheet;
    }

    public function toArray()
    {
        $result = array();
        for ($row = 1; $row<1000; $row++) {
            $rowData = $this->getRow($row);
            if (!$this->isRow($rowData)) {
                break;
            }
            $result[] = $rowData;
        }

        return $result;
    }

    protected function isRow(array $row)
    {
        return isset($row[0]) && ('' != $row[0]);
    }

    protected function getRow($row)
    {
        $result = array();
        $count = $this->getColumnCount();
        for ($column = 0; $column <= $count; $column++) {
            $result[] = $this->sheet->getCellByColumnAndRow($column, $row)->getValue();
        }

        return $result;
    }

    protected function getColumnCount()
    {
        return 5;
    }
}
