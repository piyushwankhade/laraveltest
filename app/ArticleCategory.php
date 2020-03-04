<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    /**     
     *
     * @var string
     */
    protected $table = 'article_categories';

    /**     
     *
     * @var array
     */
    protected $fillable = [
    	'category_id','title','image','slug','meta_title','meta_description','meta_keyword','status','approval','order','created_by','updated_by'
    ];

    /**
     * @return Builder
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'category_id')->withDefault();
    }
    
    /**
     * @return Builder
     */
    public function children()
    {
        return $this->hasMany(self::class, 'category_id');        
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
    
}
