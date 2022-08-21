<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * \App\Models\ShareVideo
 *
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property string $video_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereVideoId($value)
 * @mixin \Eloquent
 * @property string $title
 * @property string $description
 * @property string $thumbnail
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShareVideo whereTitle($value)
 */
class ShareVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'url',
        'video_id',
        'title',
        'description',
        'thumbnail',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getTotalReactionsAttribute($value)
    {
        return $this->hasMany(LikeVideo::class)->where('reaction', $value)->count();

    }

    public function reactionVideo($userId, $shareVideoId) {
        $result = LikeVideo::whereUserId($userId)->where('share_video_id', $shareVideoId)->first();
        return $result;
    }
}
