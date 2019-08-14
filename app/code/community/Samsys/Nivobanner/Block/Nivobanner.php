<?php
/**
 * sam-sys
 * @category   samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 Samsys Systems. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Nivobanner extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getBanner() {
        if (!$this->hasData('nivobanner')) {
            $this->setData('nivobanner', Mage::registry('nivobanner'));
        }
        return $this->getData('nivobanner');
    }

    public function getDataByGroupCode($groupCode){
        return Mage::getModel('nivobanner/nivobannergroup')->getDataByGroupCode($groupCode);
    }
	
		
	public function getResizedUrl($imgUrl,$groupName,$x,$y=NULL){

		
        $imgPath=$this->splitImageValue($imgUrl,"path");
        $imgName=$this->splitImageValue($imgUrl,"name");
		
		
 
        /**
         * Path with Directory Seperator
         */
        $imgPath=str_replace("/",DS,$imgPath);
		
 
        /**
         * Absolute full path of Image
         */
        $imgPathFull=Mage::getBaseDir("media").DS.$imgPath.DS.$imgName;
		
 
        /**
         * If Y is not set set it to as X
         */
        $width=$x;
        $y?$height=$y:$height=$x;
		
		
        /**
         * Resize folder is widthXheight
         */
        $resizeFolder= 'Nivo_'.$groupName;
 
        /**
         * Image resized path will then be
         */
        $imageResizedPath=Mage::getBaseDir("media").DS.$imgPath.DS.$resizeFolder.DS.$imgName;
		if(file_exists($imageResizedPath))
		{
			list($width_img, $height_img) = getimagesize($imageResizedPath);
			$pre_width = $width_img;
			$pre_height = $height_img ;
		}
		else
		{ 
		$pre_width ='';
		$pre_height = '';
			}

	
        /**
         * First check in cache i.e image resized path
         * If not in cache then create image of the width=X and height = Y
         */
		 if(($pre_width!=$width)||($pre_height!=$height))
		 { 
		
        	if (file_exists($imageResizedPath)&& file_exists($imgPathFull)) : 
		
            $imageObj = new Varien_Image($imgPathFull);
			//$imageObj->backgroundColor(0xff, 0xf6, 0xc6);
            $imageObj->constrainOnly(TRUE);
			 /*(Note: when keepAspectRatio(TRUE), height would be ignored)*/
            $imageObj->keepAspectRatio(false);
            $imageObj->resize($width,$height);
			/*keepFrame(true) includes background color*/
			$imageObj->keepFrame(false);
			
            $imageObj->save($imageResizedPath);
			
			elseif(!file_exists($imageResizedPath)&& file_exists($imgPathFull)):
			
			 $imageObj = new Varien_Image($imgPathFull);
			//$imageObj->backgroundColor(0xff, 0xf6, 0xc6);
            $imageObj->constrainOnly(TRUE);
			 /*(Note: when keepAspectRatio(TRUE), height would be ignored)*/
            $imageObj->keepAspectRatio(false);
            $imageObj->resize($width,$height);
			/*keepFrame(true) includes background color*/
			$imageObj->keepFrame(false);
			
            $imageObj->save($imageResizedPath);
			
        endif;
		}
 
        /**
         * Else image is in cache replace the Image Path with / for http path.
         */
        $imgUrl=str_replace(DS,"/",$imgPath);
 
        /**
         * Return full http path of the image
         */
        return Mage::getBaseUrl("media").$imgUrl."/".$resizeFolder."/".$imgName;
    }
 
    /**
	 * get original image name and path and
     * Splits images Path and Name
     *
     * Path=custom/module/images/
     * Name=example.jpg
     *
     * @param string $imageValue
     * @param string $attr
     * @return string
     */
    public function splitImageValue($imageValue,$attr="name"){
	
        $imArray=explode("/",$imageValue);
 
        $name=$imArray[count($imArray)-1];
        $path=implode("/",array_diff($imArray,array($name)));
        if($attr=="path"){
            return $path;
        }
        else
            return $name;
 
    }
	
	

    protected function checkDir($directory) {
	
        if (!is_dir($directory)) {
            umask(0);
            mkdir($directory, 0777,true);
            return true;
        }
    }
}