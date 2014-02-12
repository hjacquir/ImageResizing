<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

/**
 * Contract for image
 */
class Image extends File
{
    /**
     * @var array
     */
    private $imageSize;
    
    /**
     * @param string $filename The file name
     */
    public function __construct($filename)
    {
        parent::__construct($filename);
        
        $this->imageSize = getimagesize($filename);
    }
    
    /**
     * Return the width of the image
     * 
     * @return integer $width
     */
    public function getWidth()
    {
        return $this->imageSize[0];
    }
    
    /**
     * Return the height of the image
     * 
     * @return integer $height
     */
    public function getHeight()
    {
        return $this->imageSize[1];
    }
}