<?php

namespace Aecy\Badge;

use Illuminate\Database\Eloquent\Model;

class BadgeUnlock extends Model
{
	public $table = 'badge_user';
	public $guarded = [];
}