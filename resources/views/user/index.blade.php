<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Friends list
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
        <button type="button" class="mt-3 btn btn-primary col-2" data-bs-toggle="modal" data-bs-target="#addContact">
            Add contact
        </button>
            @if($contacts->isEmpty())
                <div class="text-center fs-2 mt-5">You have no friends added yet</div>
            @else
        </div>

        <div class="row">
            <div class="col-6 offset-3">
                <button type="button" class="float-end mt-3 btn btn-primary " ">
                Download
                </button>
    <table class="table mt-3">
        <thead>
            <th class="col-6">Contact name</th>
            <th >Actions</th>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{$contact->name}}</td>
            <td>
                <a class="btn btn-warning" href="{{route('contact.show-more',$contact)}}" >Show more</a>
                <form action="{{ route('contact.destroy', $contact) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach


        </tbody>

    </table>

        @endif
        </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="addContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('contact.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" value="{{\Illuminate\Support\Facades\Auth::id()}}" name="user_id" >
                    Name<input type="text" class="form-control" name="name" required >
                    @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    Surname<input type="text" class="form-control" name="surname" required >
                    @error('surname')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    Email<input type="email" class="form-control" name="email" required>
                    @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    Avatar<input type="file" class="form-control" name="avatar" accept=".jpg, .jpeg, .png">
                    @error('file')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror



                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary"> Add </button>
                </div>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>
