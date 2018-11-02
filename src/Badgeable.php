<?php

namespace Aecy\Badge;

use Aecy\Badge\Badge;

trait Badgeable
{
	public function badges ()
	{
		return $this->belongsToMany(Badge::class);
	}
}