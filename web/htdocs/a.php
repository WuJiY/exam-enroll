<?php
header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<title>中医体质分类判定表	</title>
<meta name="keywords" content="中医体质分类判定表" />
<meta name="description" content="中医体质分类判定表"/>
<style>
.border{margin:10px;  }
em{color:#FC3;  font-weight:bold;}
h6{margin:8px; height:14px; font-size:14px; font-weight:600;}
span{font-size:12px;}
</style>
</head>
<body>
<form action="" name="form1" method="post">
<div class="border">
<em>平和质 (A型)</em>
<h6>1您体力充沛吗？</h6>
<span><input type="radio" name="mrbook1[]" value="1" />没有(根本无)</span>
<span><input type="radio" name="mrbook1[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="mrbook1[]" value="3" checked="checked" />有时(有些)</span>
<span><input type="radio" name="mrbook1[]" value="4" />经常(相当)</span>
<span><input type="radio" name="mrbook1[]" value="5" />总是(非常)</span>

<h6>2您容易疲乏吗？</h6>
<span><input type="radio" name="mrbook2[]" value="5" />没有(根本无)</span>
<span><input type="radio" name="mrbook2[]" value="4" checked="checked" />很少(有一点)</span>
<span><input type="radio" name="mrbook2[]" value="3" />有时(有些)</span>
<span><input type="radio" name="mrbook2[]" value="2" />经常(相当)</span>
<span><input type="radio" name="mrbook2[]" value="1" />总是(非常)</span>

<h6>3您说话声音低弱无力吗？</h6>
<span><input type="radio" name="mrbook3[]" value="5" />没有(根本无)</span>
<span><input type="radio" name="mrbook3[]" value="4" checked="checked" />很少(有一点)</span>
<span><input type="radio" name="mrbook3[]" value="3" />有时(有些)</span>
<span><input type="radio" name="mrbook3[]" value="2" />经常(相当)</span>
<span><input type="radio" name="mrbook3[]" value="1" />总是(非常)</span>

<h6>4您感觉胸闷不乐，情绪低沉吗？</h6>
<span><input type="radio" name="mrbook4[]" value="5" checked="checked" />没有(根本无)</span>
<span><input type="radio" name="mrbook4[]" value="4" />很少(有一点)</span>
<span><input type="radio" name="mrbook4[]" value="3" />有时(有些)</span>
<span><input type="radio" name="mrbook4[]" value="2" />经常(相当)</span>
<span><input type="radio" name="mrbook4[]" value="1" />总是(非常)</span>

<h6>5您比一般人耐受不了寒冷（冬天是寒冷，夏天的冷空调。电扇等）吗？</h6>
<span><input type="radio" name="mrbook5[]" value="5" checked="checked" />没有(根本无)</span>
<span><input type="radio" name="mrbook5[]" value="4" />很少(有一点)</span>
<span><input type="radio" name="mrbook5[]" value="3" />有时(有些)</span>
<span><input type="radio" name="mrbook5[]" value="2" />经常(相当)</span>
<span><input type="radio" name="mrbook5[]" value="1" />总是(非常)</span>


<h6>6您能适应外界自然和社会环境变化吗？</h6>
<span><input type="radio" name="mrbook6[]" value="1" />没有(根本无)</span>
<span><input type="radio" name="mrbook6[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="mrbook6[]" value="3" checked="checked" />有时(有些)</span>
<span><input type="radio" name="mrbook6[]" value="4" />经常(相当)</span>
<span><input type="radio" name="mrbook6[]" value="5" />总是(非常)</span>

<h6>7您容易失眠吗？</h6>
<span><input type="radio" name="mrbook7[]" value="5" />没有(根本无)</span>
<span><input type="radio" name="mrbook7[]" value="4"  />很少(有一点)</span>
<span><input type="radio" name="mrbook7[]" value="3" />有时(有些)</span>
<span><input type="radio" name="mrbook7[]" value="2" checked="checked" />经常(相当)</span>
<span><input type="radio" name="mrbook7[]" value="1" />总是(非常)</span>

<h6>8您容易忘事（健忘）吗?</h6>
<span><input type="radio" name="mrbook8[]" value="5" />没有(根本无)</span>
<span><input type="radio" name="mrbook8[]" value="4" />很少(有一点)</span>
<span><input type="radio" name="mrbook8[]" value="3" />有时(有些)</span>
<span><input type="radio" name="mrbook8[]" value="2"checked="checked" />经常(相当)</span>
<span><input type="radio" name="mrbook8[]" value="1" />总是(非常)</span>
</div>


<div class="border">
<em>气虚质 (B型)</em>
<h6>（1）您容易疲乏吗？</h6>
<span><input type="radio" name="qxz1[]" value="1" />没有(根本无)</span>
<span><input type="radio" name="qxz1[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="qxz1[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz1[]" value="4"checked="checked"  />经常(相当)</span>
<span><input type="radio" name="qxz1[] value="5" />总是(非常)</span>

<h6>（2）您容易气短（呼吸短促，喘不上气）吗？</h6>
<span><input type="radio" name="qxz2[]" value="1" />没有(根本无)</span>
<span><input type="radio" name="qxz2[]" value="2" checked="checked" />很少(有一点)</span>
<span><input type="radio" name="qxz2[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz2[]" value="4" />经常(相当)</span>
<span><input type="radio" name="qxz2[]" value="5" />总是(非常)</span>

<h6>（3）您容易心慌吗？</h6>
<span><input type="radio" name="qxz3[]" value="1" checked="checked" />没有(根本无)</span>
<span><input type="radio" name="qxz3[]" value="2"  />很少(有一点)</span>
<span><input type="radio" name="qxz3[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz3[]" value="4" />经常(相当)</span>
<span><input type="radio" name="qxz3[]" value="5" />总是(非常)</span>

<h6>（4）您容易头晕或站起时眩晕吗？</h6>
<span><input type="radio" name="qxz4[]" value="1"  />没有(根本无)</span>
<span><input type="radio" name="qxz4[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="qxz4[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz4[]" value="4" />经常(相当)</span>
<span><input type="radio" name="qxz4[]" value="5" checked="checked" />总是(非常)</span>

<h6>（5）您比别人容易患感冒吗？</h6>
<span><input type="radio" name="qxz5[]" value="1" checked="checked" />没有(根本无)</span>
<span><input type="radio" name="qxz5[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="qxz5[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz5[]" value="4" />经常(相当)</span>
<span><input type="radio" name="qxz5[]" value="5" />总是(非常)</span>


<h6>（6）您喜欢安静，懒得说话吗？</h6>
<span><input type="radio" name="qxz6[]" value="1" checked="checked" />没有(根本无)</span>
<span><input type="radio" name="qxz6[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="qxz6[]" value="3"  />有时(有些)</span>
<span><input type="radio" name="qxz6[]" value="4" />经常(相当)</span>
<span><input type="radio" name="qxz6[]" value="5" />总是(非常)</span>

<h6>（7）您说话声音低弱无力吗？</h6>
<span><input type="radio" name="qxz7[]" value="1" checked="checked" />没有(根本无)</span>
<span><input type="radio" name="qxz7[]" value="2"  />很少(有一点)</span>
<span><input type="radio" name="qxz7[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz7[]" value="4"  />经常(相当)</span>
<span><input type="radio" name="qxz7[]" value="5" />总是(非常)</span>

<h6>（8）您活动量稍大就容易出虚汗吗?</h6>
<span><input type="radio" name="qxz8[]" value="1" />没有(根本无)</span>
<span><input type="radio" name="qxz8[]" value="2" />很少(有一点)</span>
<span><input type="radio" name="qxz8[]" value="3" />有时(有些)</span>
<span><input type="radio" name="qxz8[]" value="4"checked="checked" />经常(相当)</span>
<span><input type="radio" name="qxz8[]" value="5" />总是(非常)</span>
</div>
<input type="submit" name="submit" value="提交" />

</form>

</body>
</html>
<?php

//平和气质
$a='';
$b='';
$c='';
$d='';
$e='';
$f='';
$g='';
$h='';
function getValue($post_key, &$var){
    if(isset($_POST[$post_key])){
        $var = $_POST[$post_key][0];
    }
}
getValue('mrbook1', $a);
getValue('mrbook2', $b);
getValue('mrbook3', $c);
getValue('mrbook4', $d);
getValue('mrbook5', $e);
getValue('mrbook6', $f);
getValue('mrbook7', $g);
getValue('mrbook8', $h);
      echo "转化分是：";
      //定义一个计算结果原始分
      //原始分=各个条目的分别相加。
      $score= $a+$b+$c+$d+$e+$f+$g+$h;
      //定义一个条目数
      //转化分数=[（原始分-条目数）/（条目数×4）] ×100
      $nums=8;
      //平和质 (A型)转化分
     $phz= round((($score-$nums)/($nums*4))*100);
     echo '<br />' . $phz . '<br />';

     //气虚质 (B型)
     $a_qxz="";
     $b_qxz="";
     $c_qxz="";
     $a_qxz="";
     $e_qxz="";
     $f_qxz="";
     $g_qxz="";
     $h_qxz="";

     if (isset($_POST['qxz1'])){
         for ($i=0;$i<count($_POST['qxz1']);$i++ ){
             $a_qxz=$_POST['qxz1'][$i];
             //echo $a_qxz;
         }
     }
     if (isset($_POST['qxz2'])){
         for ($i=0;$i<count($_POST['qxz2']);$i++ ){
             $b_qxz=$_POST['qxz2'][$i];
             //echo $b_qxz;
         }
     }

     if (isset($_POST['qxz3'])){
         for ($i=0;$i<count($_POST['qxz3']);$i++ ){
             $c_qxz=$_POST['qxz3'][$i];
             echo $c_qxz;
         }
     }
//     if (isset($_POST['submit'])){
//         echo $zhf;
//     }


?>
