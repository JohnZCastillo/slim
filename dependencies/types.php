<?php

use Doctrine\DBAL\Types\Type;

$customTypes = [
//ADD TYPES HERE
];

foreach ($customTypes as $customTypeClass) {
    if (!Type::hasType($customTypeClass)) {
        Type::addType($customTypeClass, $customTypeClass);
    }
}