@php($borders='border: 1px solid black;border-collapse:collapse;')
<table style="{{$borders}}">
    <thead>
    <tr>
        @php($style='border: 1px solid black;border-collapse:collapse; background-color: #ADD8E6; border-style:solid;border-width:5px; text-align: center; font-weight: bold;')

        <td style="{{$style}}">Name</td>
        <td style="{{$style}}">Surname</td>
        <td style="{{$style}}">Email</td>
    </tr>
    </thead>

    <tbody>
    @foreach($contacts as $contact)
        <tr style="{{$borders}}">
            <td style="{{$borders}}">{{$contact->name}}</td>
            <td style="{{$borders}}">{{$contact->surname}}</td>
            <td style="{{$borders}}">{{$contact->email}}</td>
        </tr>
    @endforeach

    </tbody>


</table>
