<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chatting', function () {
    return true;
});
