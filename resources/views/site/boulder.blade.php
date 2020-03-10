@extends('layouts.route-boulder')
@section('scripts')
    <script>
        const pageUrl = '{{ Request::url() }}'

        function create(tag, text, parent, classs = null, id = null) {
            let o = document.createElement(tag)
            if (text != null) {
                o.appendChild(document.createTextNode(text))
            }
            if (classs != null) {
                o.classList.add(classs)
            }
            if (id != null) {
                o.id = id
            }
            parent.appendChild(o)
            return o
        }
    </script>
    <script src="{{asset('js/route.js')}}"></script>
@endsection
@section('scripts')
    <script>
        const pageUrl = '{{ Request::url() }}'
    </script>
    <script src="{{asset('js/route.js')}}"></script>
@endsection
