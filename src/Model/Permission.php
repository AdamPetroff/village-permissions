<?php

namespace VillageProject\Model;

class Permission
{
    public const ADDRESS_BOOK = 'addressbook';
    public const SEARCH = 'search';

    public const PERMISSIONS = [
        self::ADDRESS_BOOK,
        self::SEARCH
    ];
}