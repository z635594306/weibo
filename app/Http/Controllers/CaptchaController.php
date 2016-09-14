<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gregwar\Captcha\CaptchaBuilder;

use Session;

class CaptchaController extends Controller
{
    public function captcha($tmp)
    {
         //负责输出验证码程序
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
       
        //1.创建画布,准备颜色

        //宽高
        $img = imagecreatetruecolor(90,32);
        $bg =  imagecolorallocate($img,rand(128,255),rand(128,255),rand(128,255));
          
        //2.绘画
        imagefill($img,0,0,$bg);
        $str =  '3456789wertyupasdfghjkxcvbnmQWERTYUPASDFGHJKXCVBNM';
        $str = str_shuffle($str);
        //字符串长度
        $str = substr($str,0,4);

        $clr = imagecolorallocate($img,rand(0,127),rand(0,127),rand(0,127));
        for ($i=0; $i < 4; $i++) { 
            imagettftext($img, 18, rand(-30,30),10+$i*20, 25, $clr,'./fonts/arialbd.ttf',$str[$i]);
        }
        for ($i=0; $i < 500 ; $i++) { 
            $clr = imagecolorallocate($img,rand(0,127),rand(0,127),rand(0,127));
            imagesetpixel($img,rand(0,100),rand(0,30), $clr);
        }
        for ($i=0; $i < 5; $i++) { 
            $clr = imagecolorallocate($img,rand(0,127),rand(0,127),rand(0,127));
            imageline($img,rand(0,100) ,rand(0,30), rand(0,100),rand(0,30), $clr);
        }

        Session::put('code', strtolower($str));//通过静态方法的方式使用flash
        // 3. 输出
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type:image/jpeg');
        imagejpeg($img);
            
        // 4. 释放资源
        imagedestroy($img);
        

        // //生成图片
        // header("Cache-Control: no-cache, must-revalidate");
        // header('Content-Type: image/jpeg');
        // $builder->output();
        
    }
}
