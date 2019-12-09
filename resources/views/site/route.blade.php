@include('header')

<table class="table table- container" style="width: 80vw;">
    <thead>
    <tr>
        <th>Image</th>
        <th scope="col">Couleur</th>
        <th scope="col">Difficulté</th>
        <th scope="col">Type</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>

    @foreach($routes as $route)
        @if($route->type_route == "V")
        <tr>
            <td>{{$route->url_photo}}</td>
            <td>{{$route->color_route}}</td>
            <td>{{$route->difficulty_route}}</td>
            <td>{{$route->type_route}}</td>
            <td><a href="">Voir la voie</a></td>
        </tr>
        @endif

    @endforeach

    </tbody>

</table>

@include('footer')
