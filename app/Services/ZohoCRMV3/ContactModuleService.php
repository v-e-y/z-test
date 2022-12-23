<?php

declare(strict_types=1);

namespace App\Services\ZohoCRMV3;

use Asciisd\Zoho\ZohoManager;
use com\zoho\crm\api\record\SuccessResponse;

final class ContactModuleService
{
    /**
     * @var string Zoho module name 
     */
    public const MODULE_NAME = 'Contacts';

    /**
     * @var \Asciisd\Zoho\ZohoManager Zoho module manager
     */
    private ZohoManager $module;

    public function __construct()
    {
        $this->module = ZohoManager::useModule(self::MODULE_NAME);
    }

    public function create(array $props): SuccessResponse
    {
        return $this->module->create($props);
    }

    public function __invoke(): ZohoManager
    {
        return $this->module;
    }

    public function __toString(): string
    {
        return self::MODULE_NAME;
    }
}