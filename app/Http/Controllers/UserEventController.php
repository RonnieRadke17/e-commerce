<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\ActivityEvent;
use App\Models\EventUser;
use App\Models\PaymentRequest;
use App\Models\ActivityEventUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Encryption\DecryptException;

class UserEventController extends Controller
{
    public function index()//show all events
    {
            return view('user-products/home');
    }
    
}