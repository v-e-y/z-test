<?php

declare(strict_types=1);

namespace App\Services\ZohoCRMV3\Contracts;

use Asciisd\Zoho\ZohoManager;

interface ZohoModuleEntityInterface
{
    /**
     * Get Zoho module entity
     * @return \Asciisd\Zoho\ZohoManager
     */
    public function zohoModule(): ZohoManager;
}