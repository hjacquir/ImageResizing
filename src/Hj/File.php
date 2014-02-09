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
}
