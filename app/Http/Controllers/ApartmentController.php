<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Owner;
use App\Note;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteDeleteRequest;

use Carbon\Carbon;
use Gate;



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

    public function store(ApartmentStoreRequest $request)
    {
        $owners = [];
        
        $apartment = Apartment::create([
            'number' => $request->number,
            'floor' => $request->floor,
            'entrance' => $request->entrance,
            'kit' => $request->kit,
            'user_id' => Auth::id(),
            'status' => 0
        ]);

        if (strlen($request->note) > 1) {
            Note::create([
                'note' => $request->note,
                'user_id' => Auth::id(),
                'apartment_id' => $apartment->id
            ]);
        }

        foreach ($request->owners as $owner) {
            $owners[] = Owner::create([
                'name' => $owner['name'],
                'number' => $owner['number']
            ])->id;
        }

        $apartment->owners()->attach($owners);
    }

    public function destroy($id)
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
    
    public function updateStatus(Request $request)
    {
        $apartment = Apartment::find($request->apartment_id);
        
        $apartment->status = $request->status;
        
        if ($request->status < 2) {
            $apartment->mount_at = null;
        }
        else if ($request->status == 2) {
            $apartment->mount_at = Carbon::now();
        }
        
        $apartment->save();
    }
}
