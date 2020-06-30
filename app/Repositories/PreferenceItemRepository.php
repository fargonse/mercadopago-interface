<?php

namespace App\Repositories;

use App\Models\PreferenceItem;
use App\Repositories\Interfaces\PreferenceItemRepositoryInterface;

class PreferenceItemRepository implements PreferenceItemRepositoryInterface{
    public function create(array $request)
    {
        $item = PreferenceItem::create( $request );

        return $item;
    }
}
