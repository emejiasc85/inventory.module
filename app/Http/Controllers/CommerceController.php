<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Commerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CommerceController extends Controller
{
   function logo(Commerce $commerce)
   {

      $header = [
        'Content-lenght'  => File::size($commerce->logoFile),
        'Content-type'    => File::mimeType($commerce->logoFile)
      ];

      return response()->download(
        $commerce->logoFile,
        null, $header, ResponseHeaderBag::DISPOSITION_INLINE
      );
   }
}
