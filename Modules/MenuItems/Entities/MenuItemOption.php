<?php

namespace Modules\MenuItems\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItemOption extends Model
{

    protected $fillable = ['name', 'maxQty', 'price'];
    protected $table = "menu_item_options";

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'item_id', 'id');
    }
}
