<?php

\Route::get('/urlauth/{urlauthtoken}', 
    function ($urlauthtoken) 
    {
        $record=\iWedmak\UrlAuth\UrlAuth::where('token', $urlauthtoken)
        ->where('lifetime', '>', \Carbon\Carbon::now())
        ->first();
        if($record)
        {
            $record->increment('visits');
            \Auth::loginUsingId($record['user_id'], true);
            \Event::fire(new \iWedmak\UrlAuth\Events\UrlVisit($record));
            return redirect($record['url']);
        }
        $throw=\Config::get('urlauth.exception');
        pre($throw);
        throw new $throw('no token');
    }
)->name('urlAuth')->middleware('web');
