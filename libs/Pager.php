<?php
namespace app\libs;

/**
 * Class Pager
 * order by Obelisk
 */
use yii;

class Pager
{
    private $pageSize = 10;
    private $pageIndex;
    private $totalNum;

    private $totalPagesCount;
    private $pageClass;

    private $pageUrl;
    private static $_instance;

    public function __construct($p_totalNum, $p_pageIndex, $p_pageSize = 10, $pageClass = 'iPage', $p_initNum = 3, $p_initMaxNum = 5)
    {
        if (!isset ($p_totalNum) || !isset($p_pageIndex)) {
            die ("pager initial error");
        }

        $this->totalNum = $p_totalNum;
        $this->pageIndex = $p_pageIndex;
        $this->pageSize = $p_pageSize;
        $this->initNum = $p_initNum;
        $this->initMaxNum = $p_initMaxNum;
        $this->pageClass = $pageClass;
        $this->totalPagesCount = ceil($p_totalNum / $p_pageSize);

        $this->_initPagerLegal();
    }


//    }
    /*
     *设置页面参数合法性
     *@return void
    */
    private function _initPagerLegal()
    {
        if ((!is_numeric($this->pageIndex)) || $this->pageIndex < 1) {
            $this->pageIndex = 0;
        }


    }

    public function GetPagerContent()
    {
        $str = "";

        //首页 上一页
        if ($this->pageIndex > 0 && $this->totalPagesCount > 0) {
            if ($this->pageIndex == 1) {
                $str .= '<li class="' . $this->pageClass . ' on">1</li>';
            } else {
                $str .= '<li class="' . $this->pageClass . '">1</li>';
            }
        }
        /*
        除首末后 页面分页逻辑
        */
        //10页（含）以下
        $currnt = "";
        if ($this->totalPagesCount <= 10) {
            for ($i = 2; $i < $this->totalPagesCount; $i++) {
                if ($i == $this->pageIndex) {
                    $currnt = "class='on'";
                } else {
                    $currnt = "class='$this->pageClass'";
                }
                $str .= "<li {$currnt}>$i</li>";
            }
        } else                                //10页以上
        {
            if ($this->pageIndex < 5)  //当前页小于3
            {
                for ($i = 2; $i <= 10; $i++) {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='on'";
                    } else {
                        $currnt = "class='$this->pageClass'";
                    }
                    $str .= "<li {$currnt}>$i</li>";
                }
                $str .= '<li>...</li>';
            }
            if ($this->pageIndex >= 5 && $this->totalPagesCount < 15)   //   5 >= 当前页 >= 3
            {
                $str .= '<li>...</li>';
                for ($i = 5; $i < $this->totalPagesCount; $i++) {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='on'";
                    } else {
                        $currnt = "class='$this->pageClass'";
                    }
                    $str .= "<li {$currnt}>$i</li>";

                }
            }
            if (5 <= $this->pageIndex && ($this->totalPagesCount - $this->pageIndex) > 9 && $this->totalPagesCount >= 15)             //当前页大于5，同时小于总页数-5

            {
                $str .= '<li>...</li>';
                for ($i = $this->pageIndex; $i <= ($this->pageIndex + 9); $i++) {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='on'";
                    } else {
                        $currnt = "class='$this->pageClass'";
                    }
                    $str .= "<li {$currnt}>$i</li>";
                }
                $str .= '<li>...</li>';
            }
            if (5 <= $this->pageIndex && ($this->totalPagesCount - $this->pageIndex) <= 9 && $this->totalPagesCount >= 15) {
                $str .= '<li>...</li>';
                for ($i = ($this->totalPagesCount - 9); $i < $this->totalPagesCount; $i++)//功能1
                {
                    if ($i == $this->pageIndex) {
                        $currnt = " class='on'";
                    } else {
                        $currnt = "class='$this->pageClass'";
                    }
                    $str .= "<li {$currnt}>$i</li>";

                }
            }
        }
        /*
        除首末后 页面分页逻辑结束
        */
        //下一页 末页
        if ($this->totalPagesCount >= 2) {
            if ($this->pageIndex == $this->totalPagesCount) {
                $str .= '<li class="on">' . $this->totalPagesCount . '</li>';
            } else {
                $str .= '<li class="' . $this->pageClass . '">' . $this->totalPagesCount . '</li>';
            }
        }
        return $str;
    }

    public function GetPager($url)
    {
        $str = '<div class="s-page" aria-label="Page navigation">';
        $str .= '<ul class="pagination">';
        $str .= "<li><a  href='".$url."1.html'>&lt;&lt;</a> </li>";
        if ($this->pageIndex == '1' || $this->pageIndex < 1) {
            $str .= "<li><a href='".$url."1.html' aria-label='Previous'>";
        } else {
            $str .= "<li><a href='$url" . ($this->pageIndex - 1) . ".html' aria-label='Previous'>";
        }
        $str .= ' <span aria-hidden="true">&lt;</span></a> </li>';
//中间页码
        if ($this->totalPagesCount <= 10) {
            for ($i = 1; $i <= $this->totalPagesCount; $i++) {
//                $page = Yii::$app->request->get('p', 1);
                if ($i == $this->pageIndex) {
                    $str .= "<li class='active'>";
                } else {
                    $str .= "<li>";
                }
                $str .= "<a href='$url" . $i . ".html'>$i</a>";
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
                    $str .= "<a href='$url" . $i . ".html'>$i</a>";
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
                    $str .= "<a href='$url" . $i . ".html'>$i</a>";
                    $str .= '</li>';
                }
            } elseif ($this->pageIndex >= $this->totalPagesCount - 5) {
                for ($i = $this->totalPagesCount - 9; $i <= $this->totalPagesCount; $i++) {
                    if ($i == $this->pageIndex) {
                        $str .= "<li class='active'>";
                    } else {
                        $str .= "<li>";
                    }
                    $str .= "<a href='$url" . $i . ".html'>$i</a>";
                    $str .= '</li>';
                }
            }

        }

        //下一页 末页
        if ($this->pageIndex == $this->totalPagesCount || $this->pageIndex > $this->totalPagesCount) {
            $str .= "<li><a href='$url" . ($this->totalPagesCount) . ".html' aria-label='Next' >";
        } else {
            $str .= "<li><a href='$url" . ($this->pageIndex + 1) . ".html' aria-label='Next' > ";
//
        }
        $str .= "<span>&gt;</span></a></li>";
        $str .= "<li><a href='$url" . ($this->totalPagesCount) . ".html'>&gt;&gt;</a></li>";
        $str .= "</div>";
        return $str;
    }

}

?>