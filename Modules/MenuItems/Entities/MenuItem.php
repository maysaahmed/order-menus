<?php

namespace Modules\MenuItems\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{

    protected $fillable = ['name', 'description', 'price'];
    protected $table = "menu_items";

    /**
     * options relationship
     * @return HasMany
     */
    public function menuItemOptions(): HasMany
    {
        return $this->hasMany(MenuItemOption::class, 'item_id', 'id');
    }

}
