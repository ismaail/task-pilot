<?php

declare(strict_types=1);

namespace Domain\Card\Actions;

use Carbon\Carbon;
use Domain\Card\Models\Card;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static void run(?Card $value = null)
 */
class UpdateCurrentCardAction
{
    use AsAction;

    public function handle(?Card $card = null): void
    {
        Auth::user()?->update([
            'current_card_id' => $card?->id,
            'current_card_at' => $card ? Carbon::now() : null,
        ]);
    }
}
