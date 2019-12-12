@include('header')

<table class="table table-container" style="width: 80vw;">
    <thead>
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Score</th>
    </tr>
    </thead>
    <tbody>

    @foreach($users as $user)
        <tr>
            <td><a href="">{{$user->name}}</a></td>
            <td>{{$user->score}}</td>
        </tr>
    @endforeach

</table>

@include('footer')
