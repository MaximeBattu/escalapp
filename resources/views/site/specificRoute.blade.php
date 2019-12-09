@include('header')
<section class="text-center">
    @foreach($route as $r)
        <article class="">
            <h1 class="Nom_Salle" >Type de voie : mur</h1>
            <h1>Numéro voie : {{$r->id_route}}</h1>
            <h1>Couleur : {{$r->color_route}}</h1>
            <h1>Difficulté : {{$r->difficulty_route}}</h1>
            <h1>Image : {{$r->url_photo}}</h1>
        </article>
    @endforeach
</section>

@include('footer')
