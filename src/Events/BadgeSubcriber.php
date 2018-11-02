<?php

namespace Aecy\Badge\Events;

use Aecy\Badge\Badge;
use Aecy\Badge\Notifications\BadgeNotification;

class BadgeSubcriber
{
    public $badge;

    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
    }

    public function subscribe ($events)
    {
        $events->listen(
            'eloquent.saved: App\Comment', [$this, 'onNewComment']
        );
        $events->listen('App\Events\Premium', [$this, 'onPremium']);
    }

    public function notifyBadge ($user, $badge)
    {
        if ($badge) {
            $user->notify(new BadgeNotification($badge));
        }
    }

    public function onNewComment ($comment)
    {
        $user = $comment->user;
        $count = $user->comments()->count();
        $badge = $this->badge->unlockActionFor($user, 'comments', $count);
        $this->notifyBadge($user, $badge);
    }

    public function onPremium ($event)
    {
        $badge = $this->badge->unlockActionFor($event->user, 'premium');
        $this->notifyBadge($event->user, $badge);
    }
}
