<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $people = People::name($request->get('name'))->orderBy('id', 'DESC')->paginate();

        return view('people.index', compact('people'));
    }

    public function autoComplete(Request $request)
    {
        $term = $request->get('term');
         return People::select('id', 'name', 'nit', 'address')
            ->where('nit', 'LIKE', "%$term%")
            ->get();
    }

    public function profile(People $people, $slug)
    {
        return view('people.profile', compact('people'));
    }

    public function avatar(People $people)
    {
        $header = [
            'Content-lenght'  => File::size($people->avatarFile),
            'Content-type'    => File::mimeType($people->avatarFile)
          ];
        return response()->download(
            $people->avatarFile,
            null, $header, ResponseHeaderBag::DISPOSITION_INLINE
        );
    }
}
