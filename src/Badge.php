<?php

namespace Aecy\Badge;

use Aecy\Badge\BadgeUnlock;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	public $guarded = [];
	public $timestamps = false;

	public function unlocks ()
	{
		return $this->hasMany(BadgeUnlock::class);
	}

    /**
     * @param User $user
     * @return bool
     */
    public function isUnlockedFor(User $user): bool
	{
		return $this->unlocks()
			->where('user_id', $user->id)
			->exists();
	}

    /**
     * @param User $user
     * @param string $action
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Builder|Model|null|object
     */
    public function unlockActionFor(User $user, string $action, int $count = 0)
	{
		$badge = $this->newQuery()
			->where('action', $action)
            ->where('action_count', $count)
            ->first();
        if ($badge && !$badge->isUnlockedFor($user)) {
        	$user->badges()->attach($badge);
        	return $badge;
        }
        return null;
	}
}
