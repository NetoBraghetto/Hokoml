<?php
namespace Braghetto\Hokoml;

/**
* CategoryInterface
*/

interface CategoryInterface
{
    public function list($category_id = null);

    public function predict($title);
}
