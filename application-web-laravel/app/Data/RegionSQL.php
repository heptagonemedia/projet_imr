<?php

namespace App\Data;

interface RegionSQL
{
    const RECUPERER_REGIONS_SQL = "select * from region";
    const RECUPERER_REGION_PAR_ID_SQL = "select * from region where id = ?";
}
