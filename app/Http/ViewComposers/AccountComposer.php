<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountUser;

class AccountComposer
{
    public function compose(View $view)
    {
        $account = null;
        if (Auth::check()) {
            $account = AccountUser::where('email', Auth::user()->email)->firstOrFail();
        }
        $view->with('account', $account);
    }
}
