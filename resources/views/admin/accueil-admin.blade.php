@include('header')

<div class="content-button d-flex flex-column bd-highlight mb-3">
    <div class="p-2 bd-highlight">
        <a href="{{route('see_room_management')}}">
            <button type="button" class="btn btn-primary button">Gestion des salles</button>
        </a>
    </div>
    <div class="p-2 bd-highlight">
        <a href="">
            <button type="button" class="btn btn-primary button">Gestion des comptes</button>
        </a>
    </div>
</div>

@include('footer')
