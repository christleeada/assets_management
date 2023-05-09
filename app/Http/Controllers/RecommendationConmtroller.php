<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class RecommendationConmtroller extends Controller
{
    public function notifications()
{
    $advices = Item::pluck('advice');
    return view('layouts.notifications', compact('advices'));
}

}
