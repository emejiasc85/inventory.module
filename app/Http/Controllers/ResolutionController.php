<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Resolution;
use Illuminate\Http\Request;

class ResolutionController extends Controller
{
    public function index()
    {
        $resolutions = Resolution::orderBy('id', 'DESC')->paginate();

        return view('resolutions.index', compact('resolutions'));
    }

    public function report(Resolution $resolution)
    {
        return view('resolutions.report', compact('resolution'));
    }
}
