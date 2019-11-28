<?php

namespace App\Data;

interface TypeCalculSQL
{
    const RECUPERER_TYPES_CALCUL_SQL = "select * from type_calcul";
    const RECUPERER_TYPES_CALCUL_PAR_ID_SQL = "select * from type_calcul where id = ?";
}
