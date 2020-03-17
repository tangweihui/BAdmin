<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['title', 'image', 'pid', 'sort'];


    public function scopeFilter($query, array $params = NULL){
        if($pid = $params['pid'] ?? NULL)
            $query = $query->where('pid', $pid);

        if($keyword = $params['keyword'] ?? NULL)
            $query = $query->where('title', 'like', "%{$params['keyword']}%");

        return $query;
    }


    public function children()
    {
        return $this->hasMany(self::class, 'pid', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'pid');
    }

}
