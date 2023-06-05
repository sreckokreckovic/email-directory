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

        </h2>
    </x-slot>

    <div class="offset-5 mt-5">
        <div class="card" style="width: 18rem;">
            @if($image!=NULL)
                <img src="{{asset($image->path)}}" class="card-img-top" ">
            @else
                <img src="{{asset('storage/avatars/6txkMAN49WHKOeR8MJSchdKsXiuylHYGMFpfKdOi.png')}}"
                     class="card-img-top">
            @endif
            <div class="card-body">
                <h5 class="text-center card-title">{{$contact->name}}</h5>

            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name: {{$contact->name}}</li>
                <li class="list-group-item">Surname: {{$contact->surname}}</li>
                <li class="list-group-item">Email: {{$contact->email}}</li>
            </ul>
            <div class="card-body text-center">
                <a href="{{route('contact.edit',$contact)}}" class="btn btn-warning col-5">Edit</a>

            </div>

        </div>
    </div>


</x-app-layout>
