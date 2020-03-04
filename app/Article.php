<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**     
     *
     * @var string
     */
    protected $table = 'articles';

    /**     
     *
     * @var array
     */
    protected $fillable = [
    	'title','author','image','youtube_url','posted_at','description','body','order','views','slug','meta_title','meta_description','meta_keyword','status','approval','created_by','updated_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery()
    {
        return $this->hasMany(ArticleGallery::class);
    }

    /**
     * @param null $width
     * @param null $height
     * @return string
     */
    public function getThumbPath($width = null, $height = null)
    {
        if (empty($width) OR empty($height)) {
            return url("uploads/articles/".$this->image);
        }
        return url("uploads/articles/thumbs/{$width}_{$height}_".$this->image);
    }

}
