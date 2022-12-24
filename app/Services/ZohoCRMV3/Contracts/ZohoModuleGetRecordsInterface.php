<?php

declare(strict_types=1);

namespace App\Services\ZohoCRMV3\Contracts;

interface ZohoModuleGetRecordsInterface
{
    /**
     * Get zoho module records
     * @param integer $page
     * @param integer $perPage
     * @return array<int,com\zoho\crm\api\record\Record>
     */
    public function getRecords(int $page, int $perPage): array;
}
