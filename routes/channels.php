<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//this is default example

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int)$user->id === (int)$id;
// });

//this is for private channel
//messages is name of the channel in event

Broadcast::channel('messages.{id}', function ($user, $id) {
    // return true;
    return (int)$user->id === (int)$id;
});


Broadcast::channel('messages', function () {
    return true;
});
