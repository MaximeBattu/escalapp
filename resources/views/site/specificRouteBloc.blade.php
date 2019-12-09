@include('header')
<section class="text-center">
    @foreach($routeBloc as $rb)
    <article class="">
        <h1 class="Nom_Salle" >Type de voie : bloc</h1>
        <h1>Numéro voie : {{$rb->id_route}}</h1>
        <h1>Couleur : {{$rb->color_route}}</h1>
        <h1>Difficulté : {{$rb->difficulty_route}}</h1>
        <h1>Image : {{$rb->url_photo}}</h1>
    </article>
        @endforeach
</section>

@include('footer')
