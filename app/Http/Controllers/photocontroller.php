<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Photo;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Http\Request;

class photocontroller extends Controller
{
    public function index(){
        $photos = Photo::orderBy('created_at', 'DESC')->where('status',0)->paginate(10);
        return view('welcome', compact('photos'));
    }
    public function photo_index(){
        $photos = Photo::orderBy('created_at', 'DESC')->where('status',0)->paginate(12);
        return view('photo.photo_index', compact('photos'));
    }

    public function see_photo(){
        $photos = Photo::paginate(10);
        return view('photo.see_photo', compact('photos'));
    }
    public function createpost(){
        return view('photo.createpost');
    }
    public function add_photo(Request $request){
        $rules = [
            'title'=> 'required|min:5|max:100',
            'author'=> 'required|min:3|max:100',
            'location'=> 'required',
            'image'=> 'nullable|max:10000',
        ];

        // if(!empty($request->image)) {
        //     $rules['image'] = 'image';
        // }


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('photo.createpost')->withInput()->witherrors($validator);
        }

        //Save data in database
        $photo = new Photo();

        $photo->title = $request->title;
        $photo->author = $request->author;
        $photo->location = $request->location;
        $photo->description = $request->description;
        $photo->status = $request->status;
        $photo->save();

        if(!empty($request->image)){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/photos'),$imageName);
            $photo->image = $imageName;
            $photo->save();

            // create new image instance
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/photos/'.$imageName));

            $img->cover(250, 250);
            $img->save(public_path('uploads/photos/thumb/'.$imageName));
        }

        return redirect()->route('photo.see_photo')->with('sucess','Photo added successfully!');
    }

    public function editpost($id){
        $photo = Photo::findOrFail($id);
        return view('photo.edit_photo', compact('photo'));
    }

    public function update(Request $request){
        $rules = [
            'title'=> 'required|min:5|max:100',
            'author'=> 'required|min:3|max:100',
            'location'=> 'required',
            'image'=> 'nullable|max:10000',
        ];
        $id = $request->id;


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('photo.editpost')->withInput()->witherrors($validator);
        }

        //Save data in database
        $photo = Photo::findOrFail($id);

        $photo->title = $request->title;
        $photo->author = $request->author;
        $photo->location = $request->location;
        $photo->description = $request->description;
        $photo->status = $request->status;
        $photo->save();

        if(!empty($request->image)){

            File::delete('uploads/photos/'.$photo->image);
            File::delete('uploads/photos/thumb/'.$photo->image);

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/photos'),$imageName);
            $photo->image = $imageName;
            $photo->save();

            // create new image instance
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/photos/'.$imageName));

            $img->cover(250, 250);
            $img->save(public_path('uploads/photos/thumb/'.$imageName));
        }
        return redirect()->route('photo.see_photo')->with('success', 'Post successfully updated!');
    }

    public function destroy(Request $request){
        $photo = Photo::find($request->id);

        if($photo == null){
            session()->flash('Photo not found!');
            return response()->json([
                'status' => false,
                'message' => 'Photo not found!'
            ]);
        }else{
            File::delete('uploads/photos/'.$photo->image);
            File::delete('uploads/photos/thumb'.$photo->image);

            $photo->delete();

            session()->flash('Photo deleted successfully!');
            return response()->json([
                'status' => true,
                'message' => 'Photo deleted successfully!'
            ]);
        }
    }
    public function photo_details($id){
        $photo = Photo::find($id);
        return view('photo.photo_details', compact('photo'));
    }
}
