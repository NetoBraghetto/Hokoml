<?php
namespace Braghetto\Hokoml;

/**
* ProductInterface
*/

interface ProductInterface
{
    public function find($id);

    public function create(array $item);

    public function update($id, array $changes);
}
