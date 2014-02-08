<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use \Exception;
use \SplFileObject;

/**
 * Contract for image
 */
class Image extends SplFileObject
{
    /**
     * @var string
     */
    private $openMode = 'r';
    
    public function __construct($filename)
    {
        parent::__construct($filename, $this->openMode);
    }

    /**
     * Return an exception when the given file is not an image
     * 
     * @throws Exception
     */
    public function isImage()
    {
        $extension = $this->getExtension();
        
        $supportedType = array('jpeg', 'jpg', 'png');
        
        if (false === in_array($extension, $supportedType)) {
            throw new Exception('The file is not a valid image. Supported formats are JPEG and PNG');
        }
    }
}