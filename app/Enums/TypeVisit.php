<?php 


namespace App\Enums;

enum TypeVisit: string
{
    case REUNIAO = 'reunião';
    case ESTATAL = 'estatal';
    case INSPECAO = 'inspeção';
}