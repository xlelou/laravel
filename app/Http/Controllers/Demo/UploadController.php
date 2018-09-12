<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/12
     * Time: 15:43
     */

namespace App\Http\Controllers\Demo;

use Illuminate\Support\Facades\Storage;

class UploadController
{
    public static function isImg($file)
    {
        $arr = ['jpg','png','gif'];
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $arr)) {
            return false;
        }
        return true;
    }

    public static function uploadOne($file)
    {
        //获取文件的扩展名
        $ext = $file->getClientOriginalExtension();

        //获取文件的绝对路径
        $path = $file->getRealPath();

        //定义文件名
        $filename = date('Ymd').'/'.date('Y-m-d-h-i-s').uniqid().'.'.$ext;

        //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
        $ret = Storage::disk('uploads')->put($filename, file_get_contents($path));

        if ($ret) {
            return $filename;
        }
        return false;
    }
}
