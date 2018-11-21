<?php

namespace Blog;

/**
 * Class Module
 *
 * @package Blog
 */
class Module
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
