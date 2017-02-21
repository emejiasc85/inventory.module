<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class MakesController extends Controller
{
    public function index(Request $request)
    {

    	$makes = Make::name($request->get('name'))->orderBy('id', 'DESC')->paginate();
    	return view('makes.index', compact('makes'));
    }
    public function logo(Make $make)
    {

      $header = [
        'Content-lenght'  => File::size($make->logoFile),
        'Content-type'    => File::mimeType($make->logoFile)
      ];

      return response()->download(
        $make->logoFile,
        null, $header, ResponseHeaderBag::DISPOSITION_INLINE
      );
    }


}
