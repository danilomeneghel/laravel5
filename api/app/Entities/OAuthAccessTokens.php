<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OAuthAccessTokens extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = "oauth_access_tokens";

    protected $fillable = [
        "session_id",
        "expire_time",
        "created_at",
        "updated_at"
    ];

}
