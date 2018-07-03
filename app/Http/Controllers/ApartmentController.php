<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Owner;
use App\Note;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\OwnerStoreRequest;



class ApartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('apartment.index');
    }

    public function list()
    {
        $data = [
            'list' => Apartment::with(['owners', 'notes.user', 'user'])->get()->toArray(),
            'user' => Auth::user()
        ];

        return response()->json($data);
    }

    public function show($id)
    {
        return view('apartment.show', ['id' => $id]);
    }

    public function store(ApartmentStoreRequest $request)
    {

        $apartment = new Apartment();

        $owners = [];

        $apartment->number = $request->number;
        $apartment->floor = $request->floor;
        $apartment->entrance = $request->entrance;
        $apartment->kit = $request->kit;
        $apartment->user_id = Auth::id();
        $apartment->status = 0;

        $apartment->save();

        if (strlen($request->note) > 1) {
            $note = new Note();

            $note->note = $request->note;
            $note->apartment_id = $apartment->id;
            $note->user_id = Auth::id();
            $note->save();
        }

        foreach ($request->owners as $owner) {
            $new_owner = new Owner();

            $new_owner->name = $owner['name'];
            $new_owner->number = $owner['number'];

            $new_owner->save();

            $owners[] = $new_owner->id;


        }

        $apartment->owners()->attach($owners);
    }

    public function delete($id)
    {
        $apartment = Apartment::find($id);
        $notes = $apartment->notes;
        $owners = $apartment->owners;

        foreach ($notes as $note) {
            $note->delete();
        }

        foreach ($owners as $owner) {
            $owner->delete();
        }

        $apartment->owners()->detach();
        $apartment->delete();
    }

    public function storeNote(NoteStoreRequest $request)
    {
        $new_note = new Note();

        $new_note->note = $request->note;
        $new_note->user_id = $request->user_id;
        $new_note->apartment_id = $request->apartment_id;

        $new_note->save();
    }

    public function storeOwner(OwnerStoreRequest $request)
    {
        $new_owner = new Owner();

        $new_owner->number = $request->number;
        $new_owner->name = $request->name;

        $new_owner->save();

        $apartment = Apartment::find($request->apartment_id);
        $apartment->owners()->attach($new_owner->id);
    }
}
