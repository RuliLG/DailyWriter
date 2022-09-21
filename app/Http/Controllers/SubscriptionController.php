<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function render()
    {
        return Inertia::render('Subscribe');
    }
}
