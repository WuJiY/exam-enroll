<?php
namespace Kezhi\Lib;

class ExcelExport{
    private $rules = [];
    private $datas = [];
    private $excel = null;

    public function setRules(Array $rules){
        $this->rules = $rules;
    }

    /**
     * 'A'  =>  [
     *  'key'   =>  'student_number',
     *  'name'  =>  '学号'
     * ];
    */
    public function setRule($key, Array $value){
        $this->rules[$key] = $value;
    }

    public function setDatas(Array $datas){
        $this->datas = $datas;
    }

    public function export($title = 'title', $subject = 'subject', $description = 'description', $keywords = 'keywords', $category = 'category'){
        $this->excel = new \PHPExcel();
        $this->excel->getProperties()->setCreator("Kezhi Tech")
        							 ->setLastModifiedBy("Kezhi Tech")
        							 ->setTitle($title)
        							 ->setSubject($subject)
        							 ->setDescription($description)
        							 ->setKeywords($keywords)
        							 ->setCategory($category);
        foreach($this->datas as $kn=>$v){
            foreach($this->rules as $ks=>$vo){
                if($kn == 0){
                    $this->excel->setActiveSheetIndex(0)->setCellValue($ks . ($kn + 1), $vo['name']);
                }
                $this->excel->setActiveSheetIndex(0)->setCellValue($ks . ($kn + 2), $v[$vo['key']]);
            }
        }
    }

    public function save(){
        $outputFileName = 'student.xlsx';
        $objWriter = \PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save(__DOWNLOAD__ . $outputFileName);
        return  $outputFileName;
    }
}
