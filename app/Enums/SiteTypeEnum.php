<?php

namespace App\Enums;

enum SiteTypeEnum : string
{
    case Http = 'http';
    case Redis = 'redis';
    case Mysql = 'mysql';
    case Postgres = 'postgres';
    case Mongo = 'mongo';
    case Elastic = 'elastic';
}
