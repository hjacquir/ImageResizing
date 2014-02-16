<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use \SplFileObject;

/**
 * A custom file class
 */
class File extends SplFileObject
{
     /**
     * @var string
     */
    private $openMode = 'r';
    
    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        parent::__construct($filename, $this->openMode);
    }
    
    /**
     * Return a filename of the copy into the same path 
     * 
     * @return string The filename of the copy
     */
    public function generateFilenameOfTheCopy()
    {
        return $this->getPath() . 
                '/' . uniqid() . 
                '_' . 
                $this->getFilename();
    }
    
    /**
     * Check if the given file is a PNG or JPG file.
     * 
     * @param File $image
     * 
     * @return boolean
     */
    public function isImage()
    {
        $isImage = true;
        
        $extension = $this->getExtension();
        
        $supportedType = array('jpeg', 'jpg', 'png');
        
        if (false === in_array($extension, $supportedType)) {
            $isImage = false;
        }
        
        return $isImage;
    }
}
