<?php

namespace Modules\User\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Entities\User;
use Modules\User\Events\UserCreated;
use Modules\User\Events\UserUpdated;

class SaveRecommender
{
    /**
     * Handle the event.
     *
     * @param UserCreated|UserUpdated $event
     * @return void
     */
    public function handle(UserCreated|UserUpdated $event)
    {
        $data = $event->data;
        $user = $event->user;

        if (isset($data['recommender'])) {
            $recommender = User::query()->where('code', $data['recommender'])->first();

            if ($recommender) {
                $user->appendToNode($recommender)->save();

            }

        }
    }
}
