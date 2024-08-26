<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'cookingTime',
        'availability',
        'price',
        'description',
        'review',
        'image',
        'discount',
        'category_id'
        ,'menu_id'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_item');
    }

    
 /*   public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
      */      public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_item', 'item_id', 'order_id')
                      ->withPivot('quantity', 'custom_description')
                    ->withTimestamps();
    }
/*
    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('availability', true);
    }
*/
    // Accessors
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    // Mutators
    public function setCookingTimeAttribute($value)
    {
        $this->attributes['cookingTime'] = $value ; // convert minutes to seconds
    }
}