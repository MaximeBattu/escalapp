@include('header')
<section class="text-center">
    @foreach($user as $u)
        <h1>Nom : {{$u->name}}</h1> <br>
        <h1>Email : {{$u->email}}</h1> <br>
        <h1>Score : {{$u->score}}</h1> <br>
        <h1>Voies faites : 0</h1> <br>
        <h1>Voies réussites : 0</h1>
    @endforeach
</section>
@include('footer')
