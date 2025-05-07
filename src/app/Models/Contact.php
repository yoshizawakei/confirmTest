<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "name_first",
        "name_last",
        "gender",
        "tel",
        "email",
        "address",
        "building",
        "detail",
        "created_at",
    ];
    protected $casts = [
        "created_at" => "date:Y-m-d",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where("name_first", "like", "%$keyword%")
                    ->orWhere("name_last", "like", "%$keyword%")
                    ->orWhere("tel", "like", "%$keyword%")
                    ->orWhere("email", "like", "%$keyword%")
                    ->orWhere("address", "like", "%$keyword%")
                    ->orWhere("building", "like", "%$keyword%")
                    ->orWhere("created_at", "like", "%$keyword%")
                    ->orWhereHas("category", function ($q) use ($keyword) {
                        $q->where("content", "like", "%$keyword%");
                    })
                    ->orWhere("gender", "like", "%$keyword%")
                    ->orWhere("detail", "like", "%$keyword%");
            });
        }
    }

    public function scopeCategorySearch($query, $inquiry_type)
    {
        if (!empty($inquiry_type)) {
            $query->whereHas("category", function ($q) use ($inquiry_type) {
                $q->where("id", $inquiry_type);
            });
        }
    }
        public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
            $query->where("gender", $gender);
        }
    }

    public function scopeDateSearch($query, $search_date)
    {
        if (!empty($search_date)) {
            $query->where("created_at", "like", "%$search_date%");
        }
    }



}
