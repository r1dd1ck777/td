<?php

namespace App\MainBundle\Services;

abstract class Xls
{
    const PATH = 'uploads/tmp/';
    protected $webPath;
    /** @var \PHPExcel_Worksheet */
    protected $sheet;
    protected $filepath;

    protected function getMaxRowCount()
    {
        return 500;
    }

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
        $maxRow = $this->sheet->getHighestRow();
        for ($row = 1; $row<$maxRow; $row++) {
            if ($this->getMaxRowCount() > 0 && $row >= $this->getMaxRowCount()) {break;}
            $rowData = $this->getRow($row);
//            if (!$this->isRow($rowData)) {
//                break;
//            }
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
