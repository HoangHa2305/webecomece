<?php 
class Format
{
    public function formatDate($date)   //ngày tháng năm của website
    {                 
        return date('F j, Y,g:i a', strtotime($date));
    }

    public function textShorten($text, $limit = 400)  //text ngắn làm cho tiêu đề chuẩn sale
    {   
        $text = $text." ";
        $text = substr($text,0,$limit);
        $text = substr($text,0,strpos($text,' '));
        $text = $text.".....";
        return $text;
    }

    public function validation($data)      //validate form
    {  
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function title() //kiểm tra tên của Sever
    {        
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path,'.php');
        if($title == 'index'){
            $title = 'home';
        }elseif($title == 'contact'){
            $title = 'contact';
        }
        return $title = ucfirst($title);
    }
    public function format_currency($n=0)
    {
        $n=(string)$n;
        $n= strrev($n);
        $res = '';
        for($i=0;$i<strlen($n);$i++){
            if($i%3==0 && $i!=0){
                $res.='.';
            }
            $res.=$n[$i];
        }
        $res=strrev($res);
        return $res;
    }
}
?>