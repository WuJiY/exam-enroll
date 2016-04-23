<?php
/**
 * 库
*/
namespace Kezhi\Lib;

/**
 * 分页类
*/
class Page
{
    /**
     * @var integer $current_page 当前页数
    */
    protected $current_page;

    /**
     * @var integer $totle_pages 总共的页数
    */
    protected $totle_pages;

    /**
     * @var integer $per_page_number 每页的数量
    */
    protected $per_page_number;

    /**
     * @var integer $totle_number 总共的数量
    */
    protected $totle_number;

    /**
     * 构造函数
     *
     * @param integer $totle_number 总共的记录数
     * @param integer $per_page_number 每页的记录数，默认为10
    */
    public function __construct($totle_number, $current_page, $per_page_number = 10){
        $this->totle_number = $totle_number;
        $this->per_page_number = $per_page_number;
        $this->totle_pages = $totle_number == 0 ? 1 :
        (($totle_number % $per_page_number == 0) ? floor($totle_number / $per_page_number) : floor($totle_number / $per_page_number) + 1);
        $this->current_page = $current_page > $this->totle_pages ? $this->totle_pages : $current_page <= 0 ? 1 : $current_page;
    }

    /**
     * 获取当前页数
     *
     * @return integer 当前页数
    */
    public function getCurrentPage(){
        return $this->current_page;
    }

    /**
     * 获取总共页数
     *
     * @return integer 总共页数
    */
    public function getTotlePages(){
        return $this->totle_pages;
    }

    /**
     * 获取当前查询应该从何处开始
     *
     * @return integer 当前查询应该开始的地方
    */
    public function getCurrentNum(){
        return ($this->current_page - 1) * $this->per_page_number;
    }

    /**
     * 获取每页数量
     *
     * @return integer 每页数量
    */
    public function getPerPageNum(){
        return $this->per_page_number;
    }

    /**
     * 获取前台显示的页数
     *
     * @param integer $max_show_page_number 最大显示的页数，默认为5
     * @return Array 包含了页数信息的数组
    */
    public function getPages($max_show_page_number = 5){
        if($max_show_page_number > $this->totle_pages){
            return $this->createArray(1, $this->totle_pages);
        }
        $half = floor($max_show_page_number / 2);
        if($this->current_page <= floor($this->totle_pages / 2)){
            if($this->current_page < $half){
                return $this->createArray(1, $max_show_page_number);
            }else{
                return $this->createArray($this->current_page - $half + 1, $this->current_page - $half + $max_show_page_number);
            }
        }else{
            if($this->totle_pages - $this->current_page < $half){
                return $this->createArray($this->totle_pages - $max_show_page_number, $this->totle_pages - 1);
            }else{
                return $this->createArray($this->current_page + $half - $max_show_page_number, $this->current_page + $half - 1);
            }
        }
    }

    /**
     * 创建一个数组，数组的值从$start 到 $end
     *
     * @param integer $start 数值开始的值
     * @param integer $end 数组结束的值
     * @param integer $step 数组的值增长的步长，默认为1
     * @return Array 如果步长为0返回空数组，如果步长大于0，返回从小到大排序的值，反之返回从大到小排序的值
    */
    private function createArray($start, $end, $step = 1){
        if($step == 0){
            return [];
        }
        $result = [];
        for($i = 0; $i <= ($end-$start); $i+= $step){
            $result[$i] = $start + $i;
        }
        return $result;
    }
}
?>
