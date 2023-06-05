<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Edit contact
        </h2>
    </x-slot>
    <div class="container col-6">
        <form action="{{route('contact.update',$contact)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 mt-5">
                Name
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $contact->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                Surname
                <input type="text" name="surname" id="surname"
                       class="form-control @error('surname') is-invalid @enderror"
                       value="{{ old('surname', $contact->surname) }}" required>
                @error('surname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                Email
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $contact->email) }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                Avatar
                <input type="file" class="form-control" name="avatar" accept=".jpg, .jpeg, .png">
                @error('file')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-success col-2">Sacuvaj</button>
        </form>
    </div>


</x-app-layout>


