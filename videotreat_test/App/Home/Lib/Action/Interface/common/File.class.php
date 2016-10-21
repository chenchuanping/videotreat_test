<?php
class File{
    private $_dir;
    const SEPARATOR=DIRECTORY_SEPARATOR;//目录分隔符
    const EXT='.php';
    public function __construct(){
        /* 拼接成  E:\wamp\www\videotreat\Application\Runtime\Cache*/
        $dir =  dirname(__FILE__);
        $dir_array=explode('\\',$dir);
        array_pop($dir_array);
        array_pop($dir_array);
        array_pop($dir_array);
        array_pop($dir_array);
        array_push($dir_array,'Runtime');
        array_push($dir_array,'Cache');
        $this->_dir=implode(self::SEPARATOR,$dir_array);
        $this->_dir=$this->_dir.self::SEPARATOR;
    }
    public function cacheDate($key,$value='',$cacheTime=0){
        //拼接缓存文件路径，缓存文件名为  $key.txt
        $filename=$this->_dir.$key.'_cache'.self::EXT;
        //将value值写入缓存
        if($value!=''){
            if(is_null($value)){
                return unlink($filename);
            }
            $dir=dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir);
            }
            $cacheTime=sprintf('%011d',$cacheTime);
            return  file_put_contents($filename,$cacheTime.json_encode($value));
        }
        /*
         * 缓存存在，直接读取
         */
        if(!is_file($filename)){
           return false;
        }
        $contents=file_get_contents($filename);
        $cacheTime=(int)substr($contents,0,11);
        $value=substr($contents,11);
        /*超过缓存时间，就删除文件*/
        if($cacheTime!=0 && $cacheTime+filemtime($filename)<time()){
            unlink($filename);
            return false;
        }
        return json_decode($value,true);
    }
}
