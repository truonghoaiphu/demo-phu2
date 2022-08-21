<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * \App\Models\LikeVideo
 *
 * @property int $id
 * @property int $user_id
 * @property int $share_video_id
 * @property string $reaction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo whereReaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo whereShareVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikeVideo whereUserId($value)
 * @mixin \Eloquent
 */
class LikeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'share_video_id',
        'reaction',
    ];
}
