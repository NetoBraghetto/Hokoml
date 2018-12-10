<?php
namespace Hokoml\Tests;

use PHPUnit\Framework\TestCase;
use Braghetto\Hokoml\Hokoml;

abstract class AbstractTest extends TestCase
{
    protected $hokoml;

    public function __construct() {
        parent::__construct();
        $config = require __DIR__ . '/web/config.php';
        $this->hokoml = new Hokoml($config);
    }
}
