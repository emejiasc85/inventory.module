<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Color;
use EmejiasInventory\Entities\People;
use EmejiasInventory\Entities\Tag;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditPeopleController extends Controller
{
    //except,idColumn


    public function edit(People $people, $slug)
    {
        return view('people.edit',compact('people'));
    }

    public function update(Request $request, People $people)
    {
        if ($request->hasFile('file'))
        {
            $request->request->add(['avatar' => $request->file('file')->store('people/photos')]);
        }
        $people->fill($request->all());
        $people->save();
        Alert::success('Persona editada correctamente');
        return redirect($people->profileUrl);
    }

    public function editColors(People $people)
    {
        $colors = Color::all();
        return view('people.colors', compact('people', 'colors'));
    }

    public function editTags(People $people)
    {
        $tags = Tag::pluck('name', 'id')->toArray();
        return view('people.tags', compact('people', 'tags'));
    }

    public function updateColors(Request $request, People $people)
    {
        $people->colors()->sync($request->color);
        Alert::success('Colores editados');
        return redirect($people->profileUrl);
    }

    public function updateTags(Request $request, People $people)
    {
        $tags = $request->tags;

        Tag::newTags($tags);

        $tags = Tag::whereIn('id', $tags)->orWhereIn('name', $tags)->get();
        $people->tags()->sync($tags);

        Alert::success('Etiquetas editadas');
        return redirect($people->profileUrl);
    }
}
