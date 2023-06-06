<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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
    public function index()
    {

        $contacts = Contact::query()->where('user_id', auth()->id())->paginate(7);
        return view('user.index', compact('contacts',));

    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        $file = $request->file('avatar');

        if ($file != NULL)
            $this->storeFile($file);

        Contact::query()->create($request->validated());

        return redirect()->back();

    }

    private function storeFile($file)
    {
        $path = "storage/" . $file->store('avatars');
        $name = $file->getClientOriginalName();

        $lastId = Contact::latest()->value('id');
        $newId = $lastId + 1;

        Image::query()->create([
            'name' => $name,
            'path' => $path,
            'imageable_type' => Contact::class,
            'imageable_id' => $newId
        ]);
    }

    public function destroy(Contact $contact, Request $request): RedirectResponse
    {
        $redirectPage = $this->calculatePage($request->perPage, $request->total, $request->currentPage);
        $contact->delete();

        return redirect()->route('contact.index', ['page' => $redirectPage]);
    }

    public function showMore(Contact $contact)
    {
        $image = Image::query()->where('imageable_id', $contact->id)->where('imageable_type', Contact::class)->first();
        return view('user.show-more', ['contact' => $contact, 'image' => $image]);
    }

    public function edit(Contact $contact)
    {
        return view('user.edit', ['contact' => $contact]);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {

        $file = $request->file('avatar');
        if ($file != NULL) {
            $path = "storage/" . $file->store('avatars');
            $name = $file->getClientOriginalName();

            Image::query()->where('imageable_id', $contact->id)->updateOrCreate([

                'imageable_id' => $contact->id
            ],
                [
                    'name' => $name,
                    'path' => $path,
                    'imageable_type' => Contact::class,
                    'imageable_id' => $contact->id
                ]
            );
        }
        Contact::query()->where('id', $contact->id)->update($request->validated());

        return redirect()->route('contact.show-more', $contact);
    }

    private function calculatePage($perPage, $total, $currentPage)
    {
        if ($total < $perPage)
            return 1;
        $numOfElemCurrentPage = $total - ($currentPage - 1) * $perPage;
        if ($numOfElemCurrentPage == 1)
            return $currentPage - 1;
        return $currentPage;
    }


}
