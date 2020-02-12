<?php

function user() {
    return \Auth::user();
}

function api() {
		return app(\App\Services\Api\Service::class);
}