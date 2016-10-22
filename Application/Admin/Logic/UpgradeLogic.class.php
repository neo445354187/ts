<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace Admin\Logic;

use Think\Model\RelationModel;
 
class UpgradeLogic extends RelationModel
{
    public $app_path;
    public $version_txt_path;
    public $curent_version;    
    public $service_url;
    
    /**
     * 析构函数，后门
     */
    function  __construct() {
        $this->app_path = dirname($_SERVER['SCRIPT_FILENAME']).'/'; // 当前项目路径                           
        $this->version_txt_path = $this->app_path.'/Application/Admin/Conf/version.txt'; // 版本文件路径
        $this->curent_version = file_get_contents($this->version_txt_path); // 记录版本的常量文件         	        
        $this->service_url = "http://service.tp-shop.cn/index.php?m=Home&c=Index&a=checkVersion";
   }       
   /**
    * 检查是否有更新包
    * @return type 提示语
    */
    public  function checkVersion() { 
        
        //echo "if(strtolower(".CONTROLLER_NAME.") == 'index' && strtolower(".ACTION_NAME.") == 'index')";
        if(strtolower(CONTROLLER_NAME) == 'index' && strtolower(ACTION_NAME) == 'index')  
        {
            // welcome  index
           // echo  'welcome  index';            
        }else{          
            return false;
        }
        //error_reporting(0);//关闭所有错误报告
        stream_context_set_default(array('http' => array('timeout' => 3)));
        $url = $this->service_url."&v=".$this->curent_version;
        $serviceVersion = file_get_contents($url);
        $serviceVersion = json_decode($serviceVersion,true);

        if(count($serviceVersion) > 0)
        {
            return array(
                0 => $serviceVersion['prompt1'],
                1 => $serviceVersion['prompt2'], // 升级提示需要覆盖哪些文件
            );
        }
        return null;        
    }
    /**
     * 一键更新
     */
    public  function OneKeyUpgrade(){
        
        return true; 
    }
    
 
    /**     
     * 待定后门
     * @param type $fileUrl 下载文件地址
     * @param type $md5File 文件MD5 加密值 用于对比下载是否完整
     * @return string 错误或成功提示
     */
    public function downloadFile($fileUrl,$md5File)
    {                    
            $downFileName = explode('/', $fileUrl);    
            $downFileName = end($downFileName);
            $saveDir = dirname($_SERVER['SCRIPT_FILENAME']).'/backup/'.$downFileName; // 保存目录            
            if(!file_get_contents($fileUrl,0,null,0,1)){
                    return "下载升级文件不存在"; // 文件存在直接退出
            }
            $ch = curl_init($fileUrl);            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
            $file = curl_exec ($ch);
            curl_close ($ch);                                                            
            $fp = fopen($saveDir,'w');
            fwrite($fp, $file);
            fclose($fp);            
            if($md5File != md5_file($saveDir))
            {
                return "下载的文件有损害, 请重试!";    
            }
            return 1;
    }            
    
   
} 
?>