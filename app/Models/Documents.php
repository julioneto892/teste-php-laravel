<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'contents',
        'exercise',
    ];


	public function categories()
	{
		return $this->belongsTo(Categories::class, 'id');
	}


}
