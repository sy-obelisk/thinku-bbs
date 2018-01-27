<?php

/*
 * PHP分页类   
 * @package Page   
 * @Created 2015-05-16
 * @Created By Aaron
 * Example:
       $myPage=new Pager(1300,intval($CurrentPage));   
       $pageStr= $myPage->GetPagerContent();   
       echo $pageStr;   
 */
namespace app\libs;

use Yii;

class Pager
{
    private $pageSize = 10;
    private $pageIndex;
    private $totalNum;

    private $totalPagesCount;

    private $pageUrl;
    private static $_instance;

    public function __construct($url, $p_totalNum, $p_pageIndex, $p_pageSize = 10, $p_initNum = 3, $p_initMaxNum = 5)
    {
        if (!isset ($p_totalNum) || !isset($p_pageIndex)) {
            die ("pager initial error");
        }

        $this->totalNum = $p_totalNum;//总条数
        $this->pageIndex = $p_pageIndex;//当前页
        $this->pageSize = $p_pageSize;//每页数量
        $this->initNum = $p_initNum;
        $this->initMaxNum = $p_initMaxNum;
        $this->totalPagesCount = ceil($p_totalNum / $p_pageSize);//总页数
        $this->pageUrl = $url;//地址

        $this->_initPagerLegal();
    }


    /*
     *设置页面参数合法性
     *@return void
    */
    private function _initPagerLegal()
    {
        if ((!is_numeric($this->pageIndex)) || $this->pageIndex < 1) {
            $this->pageIndex = 1;
        } elseif ($this->pageIndex > $this->totalPagesCount) {
            $this->pageIndex = $this->totalPagesCount;
        }


    }
//$this->pageUrl}={$i}    
//{$this->CurrentUrl}={$this->TotalPages}    
    public function GetPagerContent()
    {
        $str = "<div class=\"Pagination\">";
        //首页 上一页
        if ($this->pageIndex == 1) {
            $str .= "<li><a href='javascript:;'>首页</a></li>";
            $str .= '<li><a href="javascript:;">上一页</a></li>';
        } else {
            $str .= "<a href='{$this->pageUrl}=1' class='tips' title='首页'>首页</a> " . "\n";
            $str .= "<a href='{$this->pageUrl}=" . ($this->pageIndex - 1) . "' class='tips' title='上一页'>上一页</a> " . "\n" . "\n";
        }
        /*
        除首末后 页面分页逻辑
        */
        //10页（含）以下
        $currnt = "";
        if ($this->totalPagesCount <= 10) {
            for ($i = 1; $i <= $this->totalPagesCount; $i++) {
                if ($i == $this->pageIndex) {
                    $currnt = " class='current'";
                } else {
                    $currnt = "";
                }
                $str .= "<a href='{$this->pageUrl}={$i}            ' {$currnt}>$i</a>" . "\n";
            }
        } else                                //10页以上
        {
            if ($this->pageIndex < 3)  //当前页小于3
            {
                for ($i = 1; $i <= 3; $i++) {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='current'";
                    } else {
                        $currnt = "";
                    }
                    $str .= "<a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a>" . "\n";
                }

                $str .= "<span class=\"dot\">……</span>" . "\n";
                for ($i = $this->totalPagesCount - 3 + 1; $i <= $this->totalPagesCount; $i++)//功能1
                {
                    $str .= "<a href='{$this->pageUrl}={$i}' >$i</a>" . "\n";

                }

            } elseif ($this->pageIndex <= 5)   //   5 >= 当前页 >= 3
            {
                for ($i = 1; $i <= ($this->pageIndex + 1); $i++) {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='current'";
                    } else {
                        $currnt = "";
                    }
                    $str .= "<a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a>" . "\n";

                }
                $str .= "<span class=\"dot\">……</span>" . "\n";

                for ($i = $this->totalPagesCount - 3 + 1; $i <= $this->totalPagesCount; $i++)//功能1
                {
                    $str .= "<a href='{$this->pageUrl}={$i}' >$i</a>" . "\n";

                }

            } elseif (5 < $this->pageIndex && $this->pageIndex <= $this->totalPagesCount - 5)             //当前页大于5，同时小于总页数-5

            {

                for ($i = 1; $i <= 3; $i++) {
                    $str .= "<a href='{$this->pageUrl}={$i}' >$i</a>" . "\n";
                }
                $str .= "<span class=\"dot\">……</span>";
                for ($i = $this->pageIndex - 1; $i <= $this->pageIndex + 1 && $i <= $this->totalPagesCount - 5 + 1; $i++) {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='current'";
                    } else {
                        $currnt = "";
                    }
                    $str .= "<a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a>" . "\n";
                }
                $str .= "<span class=\"dot\">……</span>";

                for ($i = $this->totalPagesCount - 3 + 1; $i <= $this->totalPagesCount; $i++) {
                    $str .= "<a href='{$this->pageUrl}={$i}' >$i</a>" . "\n";

                }
            } else {
                for ($i = 1; $i <= 3; $i++) {
                    $str .= "<a href='{$this->pageUrl}={$i}' >$i</a>" . "\n";
                }
                $str .= "<span class=\"dot\">……</span>" . "\n";

                for ($i = $this->totalPagesCount - 5; $i <= $this->totalPagesCount; $i++)//功能1
                {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='current'";
                    } else {
                        $currnt = "";
                    }
                    $str .= "<a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a>" . "\n";

                }
            }
        }
        /*
        除首末后 页面分页逻辑结束
        */
        //下一页 末页
        if ($this->pageIndex == $this->totalPagesCount) {
            $str .= "\n" . "<a href='javascript:void(0)' class='tips' title='下一页'>下一页</a>" . "\n";
            $str .= "<a href='javascript:void(0)' class='tips' title='末页'>末页</a>" . "\n";


        } else {
            $str .= "\n" . "<a href='{$this->pageUrl}=" . ($this->pageIndex + 1) . "' class='tips' title='下一页'>下一页</a> " . "\n";
            $str .= "<a href='{$this->pageUrl}={$this->totalPagesCount}' class='tips' title='末页'>末页</a> " . "\n";
        }

        $str .= "</div>";
        return $str;
    }

    public function GetPager()
    {
        $str = '<div class="s-page" aria-label="Page navigation">';
        $str .= '<ul class="pagination">';
        $str .= "<li><a  href='{$this->pageUrl}=1'>&laquo;</a> </li>";
//        if ($this->pageIndex == '1'||$this->pageIndex <1) {
//            $str.="<li><a href='{$this->pageUrl}=1' aria-label='Previous'>";
//        } else {
//            $str .= "<li><a href='{$this->pageUrl}=" . ($this->pageIndex-1) . "' aria-label='Previous'>" ;
//        }
//        $str.=' <span aria-hidden="true">&laquo;</span></a> </li>';
//        $str.=' <span aria-hidden="true">&lt;</span></a> </li>';

//        $str.=' <li>&lt;</li>';
//中间页码
        if ($this->totalPagesCount <= 10) {
            for ($i = 1; $i <= $this->totalPagesCount; $i++) {
//                $page = Yii::$app->request->get('p', 1);
                if ($i == $this->pageIndex) {
                    $str .= "<li class='active'>";
                } else {
                    $str .= "<li>";
                }
                $str .= "<a href='{$this->pageUrl}=" . $i . "'>$i</a>";
                $str .= '</li>';
            }
        } else {
            if ($this->pageIndex - 4 <= 0) {
                for ($i = 1; $i <= 10; $i++) {
                    if ($i == $this->pageIndex) {
                        $str .= "<li class='active'>";
                    } else {
                        $str .= "<li>";
                    }
                    $str .= "<a href='{$this->pageUrl}=" . $i . "'>$i</a>";
                    $str .= '</li>';
                }
            } elseif ($this->pageIndex > 4 && $this->pageIndex < $this->totalPagesCount - 5) {
                for ($i = $this->pageIndex - 4; $i <= $this->pageIndex + 5; $i++) {
                    $page = Yii::$app->request->get('p', 1);
                    if ($i == $page) {
                        $str .= "<li class='active'>";
                    } else {
                        $str .= "<li>";
                    }
                    $str .= "<a href='{$this->pageUrl}=" . $i . "'>$i</a>";
                    $str .= '</li>';
                }
            } elseif ($this->pageIndex >= $this->totalPagesCount - 5) {
                for ($i = $this->totalPagesCount - 9; $i <= $this->totalPagesCount; $i++) {
                    if ($i == $this->pageIndex) {
                        $str .= "<li class='active'>";
                    } else {
                        $str .= "<li>";
                    }
                    $str .= "<a href='{$this->pageUrl}=" . $i . "'>$i</a>";
                    $str .= '</li>';
                }
            }

//            for($i=$this->totalPagesCount-9;$i<= $this->totalPagesCount;$i++){
//                $page = Yii::$app->request->get('p', 1);
//                if($i==$page){
//                    $str.="<li class='active'>";
//                }else{
//                    $str.="<li>";
//                }
//                $str.="<a href='{$this->pageUrl}=" .$i."'>$i</a>";
//                $str.='</li>';
//            }
        }

        //下一页 末页
//        if ($this->pageIndex == $this->totalPagesCount||$this->pageIndex >$this->totalPagesCount) {
//            $str .=  "<li><a href='{$this->pageUrl}=" . ($this->totalPagesCount ) . "' aria-label='Next' >";
//        } else {
//            $str .=  "<li><a href='{$this->pageUrl}=" . ($this->pageIndex+1) . "' aria-label='Next' > ";
////
//        }
////        $str .= "<span>&gt;</span></a></li>";
////
//        $str .= "<span aria-hidden='true'>&gt;</span></a></li>";
        $str .= "<li><a href='{$this->pageUrl}=" . ($this->totalPagesCount) . "'>&raquo;</a></li>";
        $str .= "</div>";
//        var_dump($this->totalPagesCount,$this->pageIndex,$this->totalNum,$this->pageSize);die;
        return $str;
    }
//    /**
//     * 获得实例
//     * @return
//     */
//  static public function getInstance() {
//      if (is_null ( self::$_instance )) {
//          self::$_instance = new pager ();
//      }
//      return self::$_instance;
//  }

//调用实例---------------start
//include "pager.class.php";
//$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
//$myPage=new pager(1300,intval($CurrentPage));
//$pageStr= $myPage->GetPagerContent();
//$myPage=new pager(90,intval($CurrentPage));
//$pageStr= $myPage->GetPagerContent();
//echo $pageStr;
//调用实例---------------end

}

?>