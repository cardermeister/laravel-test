@extends('app')
@section('content')
    <h1>Список пива</h1>
    @if(session("success"))
        <div class="alert alert-success">
            {{session("success")}}
        </div>
    @endif
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
                    <td> <a href="{{route("get-beer-by-id",$item->id)}}">{{ $item->id }}</a> </td>
                    <td> <img src="/storage/images/{{ $item->photo}}" width="64px"/> </td>
                    <td> {{ $item->name }} </td>
                    <td> {{ $item->description }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <ul class="pagination">
        @for($i = 1; $i <= $data->lastPage(); $i++) 
            <li class="page-item{{ $data->currentPage()===$i ? ' active' : ''}}"><a class="page-link" href="{{route('beer-list','page='.$i)}}">{{$i}}</a></li>
        @endfor
    </ul>
    <div class="">
        <h2>Добавить пиво</h2>
        @if(!empty($errors))
            @if($errors->any())
                <ul class="alert alert-danger" style="list-style-type: none">
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            @endif
        @endif

        <form action="{{route("beer-list-add")}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="beer_name" class="form-label">Название</label>
                <input type="text" class="form-control" id="beer_name" name="name">
            </div>
            <div class="mb-3">
                <label for="beer_desc" class="form-label">Описание</label>
                <textarea class="form-control" id="beer_desc" name="desc"></textarea>
            </div>
            <div class="mb-3">
                <label for="beer_photo" class="form-label">Фото</label>
                <input class="form-control" type="file" id="beer_photo" name="photo">
            </div>
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>

@endsection
