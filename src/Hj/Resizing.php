<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use \Exception;

/**
 * This class takes care of resizing the image.
 */
class Resizing
{
    /**
     * @param File $file
     * 
     * @throws Exception
     */
    public function __construct(File $file)
    {
        if (false === $this->isImage($file)) {
            throw new Exception('The file is not a valid image. Supported formats are JPEG and PNG');
        }
    }
    
    public function resize(Image $initial)
    {
        $final = $this->copyTheInitialToFinal($initial);
        
        return $final;
    }

    /**
     * Returns the final image which is a copy of the original image because we do not change the initial
     * 
     * @param Image $initial The initial image
     * 
     * @return Image $final The final image
     */
    private function copyTheInitialToFinal(Image $initial)
    {
        $finalFilename = $this->generateFilenameOfTheCopy($initial);
        // we do a a copy of the original image because we do not change the initial
        copy($initial->getPathname(), $finalFilename);
        
        $final = new Image($finalFilename);
        
        return $final;
    }
    
    /**
     * Return the filename of the copy
     * 
     * @param Image $image The initial image
     * 
     * @return string The filename of the copy
     */
    private function generateFilenameOfTheCopy(Image $image)
    {
        return $image->getPath() . 
                '/' . uniqid() . 
                '_' . 
                $image->getFilename();
    }
    
    /**
     * Check if the given file is a PNG or JPG file.
     * 
     * @param File $image
     * 
     * @return boolean
     */
    private function isImage(File $file)
    {
        $isImage = true;
        
        $extension = $file->getExtension();
        
        $supportedType = array('jpeg', 'jpg', 'png');
        
        if (false === in_array($extension, $supportedType)) {
            $isImage = false;
        }
        
        return $isImage;
    }
}
