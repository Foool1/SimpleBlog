<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Main application kernel class.
 *
 * Handles the bootstrapping of the Symfony application.
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
