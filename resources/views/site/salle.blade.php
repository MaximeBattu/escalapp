@include('header') 

<section class="text-center">
    <article class=""> <h1 class="Nom_Salle" >Nom de la salle</h1> </article>
    <article class="">Adresse/Lieu</article>
    <article class="">Horaires</article>
    <article class="">Téléphone</article>
</section>

<div class="container mt-5">
  <div class="row" style="height:60vh;text-align:center;">
    <div class="col col-md border border-dark" style="margin-right:10%;">
      <div class="border-bottom border-dark"  style="margin-left:-15px;margin-right:-15px;padding:50px;">
         <h1><a href="{{route('see_bloc')}}">Bloc</a></h1>
        <p><a id="img_salle_page_block" href="{{route('see_bloc')}}"></a></p>
      </div>
    </div>
    <div class="col col-md border border-dark" style="margin-left:10%;">
      <div class="border-bottom border-dark" style="margin-left:-15px;margin-right:-15px;padding:50px;">
          <h1><a href="{{route('see_wall')}}">Mur</a> </h1>
        <p><a id="img_salle_page_salle" href="{{route('see_wall')}}"></a></p>
      </div>
    </div>
  </div>
</div>
<div class="div_Espace_Separation_Salle">Nombre de Block</div>
<div class="div_Espace_Separation_Salle">Nombre de Mur</div>
@include('footer') 