<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id'
        ];
        
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with(['category'],['user']) -> orderBy('updated_at', 'DESC') -> paginate($limit_count);
    }
    
    // Categoryに対するリレーション
    public function category()
    {
        return $this -> belongsTo('App\Category');
    }
    
    // Userに対するリレーション
    public function user()
    {
        return $this -> belongsTo('App\User');
    }
}
