<?php

namespace App\Data;

interface BoueeSQL
{
    const SQL_LISTER_BOUEE = "select * from bouee";
    const SQL_RECUPERER_BOUEE_PAR_ID = "select * from bouee where id = ?";
}
