@extends('app')
@section('content')
    @if(isset($data))
        <h1>Карточка пива №{{$data->id}}</h1>
            <div class="row">
                <div class="col">
                    <img src="/storage/images/{{$data->photo}}" width="512px"/>
                </div>
                <div class="col">
                    <form>
                        
                        <div class="mb-3">
                            <label for="beer_name" class="form-label">Название</label>
                            <input type="text" class="form-control" value="{{$data->name}}" id="beer_name" name="name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="beer_desc" class="form-label">Описание</label>
                            <textarea class="form-control" id="beer_desc" name="desc" disabled>{{$data->description}}</textarea>
                        </div>

                        <a href="{{route('beer-list-guest')}}" class="btn btn-secondary">Назад</a>
                    </form>
                </div>
            </div>
    @endif

@endsection
