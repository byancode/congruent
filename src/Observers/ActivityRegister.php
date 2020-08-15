<?php
namespace Byancode\Congruent\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityRegister
{
    public function activity(string $type, Model $model)
    {
        $user = Auth::user();
        $model->activities()->create([
            'type_id' => $type,
            'author_id' => $user->id,
            'author_type' => \get_class($user),
        ]);
    }
}
