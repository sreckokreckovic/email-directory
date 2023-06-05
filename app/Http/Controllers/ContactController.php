<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(){
        $avatars=Image::query()->get();
        $contacts= Contact::query()->where('user_id',auth()->id())->get();
        return view('user.index',compact('contacts','avatars'));

    }

    public function store(Request $request){
        $file=$request->file('avatar');

        if($file!=NULL)
        $this->storeFile($file);
        //Contact::query()->create($request->validate());

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name'=> 'required|string|max:255',
            'surname'=>'required|string|max:255',
            'email'=>'required|string|email|max:255'
        ]);
        $user = new Contact();
        $user->user_id = $validatedData['user_id'];
        $user->name = $validatedData['name'];
        $user->surname = $validatedData['surname'];
        $user->email = $validatedData['email'];

        $user->save();
        return redirect()->back();



    }
    private function storeFile($file){
        $path="storage/" . $file->store('avatars');
        $name=$file->getClientOriginalName();

        $lastId = Contact::latest()->value('id');
        $newId = $lastId + 1;

        Image::query()->create([
            'name'=>$name,
            'path'=>$path,
            'imageable_type'=>Contact::class,
            'imageable_id'=>$newId
            ]);
    }
    public function destroy(Contact $contact){

        $contact->delete();

        return redirect()->back();
    }

    public function showMore(Contact $contact){
        $image= Image::query()->where('imageable_id',$contact->id)->where('imageable_type',Contact::class)->first();
        return view('user.show-more',['contact'=>$contact,'image'=>$image]);
    }

    public function edit(Contact $contact){
        return view('user.edit',['contact'=>$contact]);
    }


}
