<?php
/**
 * excel表格导入类库
 * 本类库用来操作excel表格的导入，可以通过设置import_excel_config_file配置项来动态调整导入规则。
*/
namespace Kezhi\Lib;
class ExcelImport {
    /** @var Array $rules 导入规则 */
    private $rules = array();
    /** @var Array $exts 支持的扩展名 */
    private $exts = array();
    /** @var Object $phpexcel phpexcel实例对象 */
    private $phpexcel = null;
    /** @var int $worksheet_index 工作表索引号*/
    private $worksheet_index = null;
    /** @var Array $area 数据区域*/
    private $area = array();

    /**
     * 构造函数
     * 初始化配置项，如果找不到配置则启用默认配置
     * @param Array $rules 导入规则
     * @param Array $exts 支持的格式（后缀）
    */
    public function __construct(Array $rules = null,Array $exts = null){
        $this->rules = $rules;
        $this->exts = $exts;
    }

    /**
     * 获取PHPExcel实例
     * 根据文件名称，选择对应的PHPExcel进行实例化，如果实例化失败则返回null
     * @param String $file 需要实例化的文件地址
     * @return Object PHPExcel 实例
     * @throws Exception 不支持的扩展名称
    */
    private function getInstance($file){
        $ext_name = substr($file, strrpos($file, '.') + 1);
        if(isset($this->exts[$ext_name]) && $this->exts[$ext_name] === true){
            switch($ext_name){
                case 'xls':
                    return \PHPExcel_IOFactory::createReader('Excel5');
                    break;
                case 'xlsx':
                    return \PHPExcel_IOFactory::createReader('Excel2007');
                    break;
                default:
                    throw new \Exception('暂时不支持 ' . $ext_name . ' 的扩展名称', 406);
            }
        }
        // 默认返回Excel5，按照xls格式操作
        return \PHPExcel_IOFactory::createReader('Excel5');
    }

    /**
     * 导入操作
     * 输入文件，根据规则进行格式分析并处理，返回二维数组
     * @param String $file 需要操作的文件的地址
     * @return Object $this
     * @throws Exeption 当文件不存在的时候抛出错误
    */
    public function import($file){
        try{
            $phpexcel_reader = $this->getInstance($file);
            if(is_null($phpexcel_reader)){
                throw new \Exception('获取reader实例失败', 500);
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 500);
        }
        if(!file_exists($file)){
            throw new \Exception('文件不存在，无法读取', 500);
        }
        $this->phpexcel = $phpexcel_reader->load($file);
        return $this;
    }

    /**
     * 设置worksheet索引
     * 设置worksheet索引，从0开始，默认为null
     * @param int $index 索引号，从0开始
     * @param Object $this
    */
    public function worksheet($index = null){
        if(is_null($index)){
            $this->worksheet_index = 0;
        }
        $this->worksheet_index = intval($index);
        return $this;
    }

    /**
     * 设置数据区域
     * 设置需要读取的数据区域，需要先设置worksheet索引
     * @param int $from_line_no 开始的行号
     * @param int $to_line_no 结束的行号
     * @param Object $this
    */
    public function area($from_line_no, $to_line_no){
        if(is_null($this->worksheet_index)){
            $this->worksheet_index = 0;
        }
        $this->area = [
            'from'  =>  intval($from_line_no),
            'to'    =>  intval($to_line_no)
        ];
        return $this;
    }

    /**
     * 获取值
     * 根据设置获取表格内容
     * @return Array
     * @throws Exception 当没有调用import方法时抛出异常
    */
    public function getValue(){
        $result = array();
        if(is_null($this->phpexcel)){
            throw new \Exception('未检测到成功导入的有效文件', 500);
        }
        if(is_null($this->worksheet_index)){
            foreach($this->phpexcel->getWorksheetIterator() as $key=>$worksheet){
                $result[$key] = $this->getWorksheet($worksheet);
            }
        }else{
            $worksheet = $this->phpexcel->setActiveSheetIndex($this->worksheet_index);
            $result[$this->worksheet_index] = $this->getWorksheet($worksheet);
        }
        return $result;
    }

    /**
     * 获取工作表
     * 根据area获取工作表指定区域内容
     * @param PHPExcel $worksheet worksheet对象
     * @return Array 改工作表区域的数组
    */
    private function getWorksheet(&$worksheet){
        $result = array();
        if(empty($this->area)){
            foreach($worksheet->getRowIterator() as $row){
                $result[$row->getRowIndex()] = $this->getRow($row);
            }
            return $result;
        }
        foreach($worksheet->getRowIterator() as $row){
            if(($row->getRowIndex() < $this->area['from']) || $row->getRowIndex() > $this->area['to']){
                // 不在限定的范围内,doNothing

            }else{
                $result[$row->getRowIndex()] = $this->getRow($row);
            }
        }
        return $result;
    }

    /**
     * 获取行
     * 根据rules获取行内元素，如果未设置rules则返回所有获取到的值
     * @param Object $row PHPExcel的Row对象
     * @return Array 该行元素的数组
    */
    private function getRow(&$row){
        $result = [];
        if(is_null($this->rules)){
            foreach($row->getCellIterator() as $key=>$cell){
                if(!is_null($cell)){
                    $result[$key] = $cell->getValue();
                }
            }
        }else{
            foreach($row->getCellIterator() as $key=>$cell){
                $keyword = array_search($key, $this->rules);
                if($keyword !== false){
                    $result[$keyword] = $cell->getValue();
                }
            }
        }
        return $result;
    }
}

?>
