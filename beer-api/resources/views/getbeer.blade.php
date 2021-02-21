@extends('app')
@section('content')
    @if(isset($data))
        <h1>Редактор пива №{{$data->id}}</h1>
            <div class="row">
                <div class="col">
                    <img src="/storage/images/{{$data->photo}}" width="512px"/>
                </div>
                <div class="col">
                    @if(!empty($errors))
                        @if($errors->any())
                            <ul class="alert alert-danger" style="list-style-type: none">
                                @foreach($errors->all() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                    @if(session("success"))
                        <div class="alert alert-success">
                            {{session("success")}}
                        </div>
                    @endif
                    <form action="{{route("update-beer-by-id",$data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        
                        <div class="mb-3">
                            <label for="beer_name" class="form-label">Название</label>
                            <input type="text" class="form-control" value="{{$data->name}}" id="beer_name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="beer_desc" class="form-label">Описание</label>
                            <textarea class="form-control" id="beer_desc" name="desc">{{$data->description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="beer_photo" class="form-label">Фото</label>
                            <input class="form-control" type="file" id="beer_photo" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{route('beer-list')}}" class="btn btn-secondary">Назад</a>
                        <a href="{{route("delete-beer-by-id",$data->id)}}" data-method="delete" class="btn btn-danger deletebeer" style="float:right;">Удалить</a>
                    </form>
                </div>
            </div>
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("input[name=\"_token\"]").val()
                    }
                });
                $(".deletebeer").click(function(e){
                    e.preventDefault();
                    var t = $(this);
                    $.post({
                        type: t.data('method'),
                        url: t.attr('href')
                    }).done(function (data) {
                        window.location.href = data;
                    });
                })
            </script>
    @endif

@endsection
