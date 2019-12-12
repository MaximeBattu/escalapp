@include('header')

<h1 class="text-center">Salles disponibles : {{count($salles)}}</h1>
<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        @foreach($salles as $salle)
            <div class="col-md-3 boxRoom">
                <p>
                    <strong>Nom :</strong> {{$salle->name_room}}
                </p>
                <p>
                    <strong>Numéro :</strong> {{$salle->tel_room}}
                </p>
                <p>
                    <strong>Adresse :</strong> {{$salle->address_room}}
                </p>
                <p>
                    <a href="{{route('see_room', ['id'=>$salle->id_room])}}">Voir salle</a>
                </p>
            </div>

        @endforeach
    </div>
</div>
@include('footer')
