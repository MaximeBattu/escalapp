@include('header') 
<div class="menu_Salle">
<section>
    <article class=""> <h1 class="Nom_Salle" >Nom de la salle</h1> </article>
    <article class="">Adresse/Lieu</article>
    <article class="">Horaires</article>
    <article class="">Téléphone</article>
</section>

</div>

<div class="div_Flex_Salle">

    <div class="div_Espace_Cote_Salle"></div>

    <div class="div_Salle">
        <h1><a href="{{route('see_bloc')}}">Bloc</a></h1>
        <p><a id="img_salle_page_block" href="{{route('see_bloc')}}"></a></p>
    </div>

    <div class="div_Espace_Separation_Salle">Nombre de Block</div>
    <div class="div_Espace_Separation_Salle"></div>
    <div class="div_Espace_Separation_Salle">Nombre de Mur</div>

    <div class="div_Salle">
        <h1><a href="salle_mur.php">Mur</a> </h1>
        <p><a id="img_salle_page_salle" href="page_salle_mur.php"></a></p>
    </div>

    <div class="div_Espace_Cote_Salle"></div>

</div>
@include('footer') 