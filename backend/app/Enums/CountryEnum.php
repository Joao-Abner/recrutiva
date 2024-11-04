<?php

namespace App\Enums;

enum CountryEnum: string
{
    //  apenas paises da america latina, por enquanto
    case BRAZIL = 'Brasil';
    case ARGENTINA = 'Argentina';
    case CHILE = 'Chile';
    case COLOMBIA = 'Colômbia';
    case ECUADOR = 'Equador';
    case GUATEMALA = 'Guatemala';
    case MEXICO = 'México';
    case PARAGUAY = 'Paraguai';
    case PERU = 'Peru';
    case URUGUAY = 'Uruguai';
    case VENEZUELA = 'Venezuela';
    
}