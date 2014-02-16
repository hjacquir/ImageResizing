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
    
    /**
     * Return an average of RGB component
     * 
     * @param resource $resource A resource of image
     * @param integer  $x        The pixel position on X axis (range values : [1,width-1])
     * @param integer  $y        The pixel position on Y axis (range values : [1,height-1])
     * 
     * @return float $averageRGBComponent An average of RGB component value
     */
    public function getAverageRGBComponentValue($resource, $x, $y)
    {
        $colorIndexOfThePixel = imagecolorat($resource, $x, $y);
        
        // red component value
        $r = ($colorIndexOfThePixel >> 16) & 0xFF;
        // green component value
        $g = ($colorIndexOfThePixel >> 8) & 0xFF;
        // blue component value
        $b = $colorIndexOfThePixel & 0xFF;
        
        $averageRGBComponent = ($r + $g + $b)/3;
        
        return $averageRGBComponent;
    }

    /**
     * Return a resource of image
     * 
     * @return Resource $imageResource
     */
    public function imageToResource()
    {
        $imageResource = imagecreatefromjpeg($this->getPathname());
        
        return $imageResource;
    }
        
    /**
     * Returns the final image which is a copy of the original image because we do not change the initial
     * 
     * @return Image $copy The copy
     */
    public function copy()
    {
        $copyFilename = $this->generateFilenameOfTheCopy();
        // we do a a copy of the original image because we do not change the initial
        copy($this->getPathname(), $copyFilename);
        
        return new Image($copyFilename);
    }
    
    /**
     * Returns a new image convolved with Sobel matrix
     * 
     * @param array  $matrix
     * @param string $axis
     * 
     * @return Image
     * 
     * @todo add validation on x and y
     * @todo add validation on matrix
     */
    public function convolve($matrix, $axis)
    {
        $imageResource = $this->imageToResource();
        
        imageconvolution($imageResource, $matrix, 1, 0);

        $filename = $this->getPath() . '/' . strtoupper($axis) . '_' . $this->getFilename();
        
        imagejpeg($imageResource, $filename);
        
        return new Image($filename);
    }
}