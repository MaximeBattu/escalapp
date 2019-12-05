@include('header')

<h1 class="text-center">Salles disponibles : {{count($salles)}}</h1>
<div class="container">
  <div class="row">
      @foreach($salles as $salle)
        <div class="col-sm box">
            <p>
                Nom : {{$salle->name_room}}
            </p>
            <p>
                Numéro : {{$salle->tel_room}}
            </p>
            <p>
                Adresse : {{$salle->address_room}}
            </p>
        </div>
      @endforeach
  </div>
</div>

<!-- <div class="container">
  <div class="row" style="height:60vh;text-align:center;">
    <div class="col col-md border border-dark" style="margin-right:10%;">
      <div class="border-bottom border-dark"  style="margin-left:-15px;margin-right:-15px;padding:50px;">
          <h1>Contest 1</h1>
      </div>
    </div>
    <div class="col col-md border border-dark" style="margin-left:10%;">
      <div class="border-bottom border-dark" style="margin-left:-15px;margin-right:-15px;padding:50px;">
          <h1>Contest 2</h1>
      </div>
    </div>
  </div>
</div> -->
@include('footer')
