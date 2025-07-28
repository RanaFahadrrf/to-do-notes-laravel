<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Show all notes of user logged-in users
        // $notes = Note::where('user_id' , Auth::id())->get();
       

        $notes = Auth::user()->notes;
        return view('users-blades.notes-dashboard' , compact('notes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
         $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',

            ]
        );

        if($validateUser->fails())
        {
            return response()->json([
               'status' => false,
               'message' => 'Validation Error',
               'errors' => $validateUser->errors()->all()
            ],401);
        }

        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path(). '/uploads' , $imageName);
        $note = Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => Auth::id(),
        ]);

          return redirect()->route('notes-dashboard');
        // return response()->json([
        //        'status' => true,
        //        'message' => 'Note Created and Saved Successfully',
        //        'note' => $note
        //     ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show selected single note of selected user
         $note = Note::find($id);
         $uid = $note->user_id;
        Gate::authorize('is-authenticated-user' , $uid);     
        return $note;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateUser = Validator::make(
        $request->all(),
        [
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ]
    );

    if ($validateUser->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $validateUser->errors()->all()
        ], 401);
    }

    $note = Note::find($id);
    $uid = $note->user_id;
    Gate::authorize('is-authenticated-user' , $uid); 
    if (!$note) {
        return response()->json([
            'status' => false,
            'message' => 'Post not found'
        ], 404);
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $path = public_path('/uploads/');
        if ($note->image && file_exists($path . $note->image)) {
            unlink($path . $note->image);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $imageName);
    } 
    else {
        $imageName = $note->image;
    }

    // Update post
    $note->update([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageName
    ]);
       return redirect()->route('notes-dashboard');
    // return response()->json([
    //     'status' => true,
    //     'message' => 'Note updated successfully',
    //     'note' => $note
    // ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::find($id);
        $uid = $note->user_id;
        Gate::authorize('is-authenticated-user' , $uid); 
        
         $imagePath = Note::select('image')->where('id' , $id)->get();      
        $filePath = public_path(). '/uploads/' . $imagePath[0]['image'];
        unlink($filePath);

        $note = Note::where('id' , $id)->delete();

        return redirect()->route('notes-dashboard');
        //  return response()->json([
        //     'status' => true,
        //     'message' => 'Note Deleted Successfully',
        //     'note' => $note
        // ], 200);
    }
}
