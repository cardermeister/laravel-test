@extends('app')
@section('content')

    <h1>Список пива</h1>
    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Фото</th>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td> <a href="{{route("get-beer-by-id-guest",$item->id)}}">{{ $item->id }}</a> </td>
                    <td> <img src="/storage/images/{{ $item->photo}}" width="64px"/> </td>
                    <td> {{ $item->name }} </td>
                    <td> {{ $item->description }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <ul class="pagination">
        @for($i = 1; $i <= $data->lastPage(); $i++) 
            <li class="page-item{{ $data->currentPage()===$i ? ' active' : ''}}"><a class="page-link" href="{{route('beer-list-guest','page='.$i)}}">{{$i}}</a></li>
        @endfor
    </ul>

@endsection
