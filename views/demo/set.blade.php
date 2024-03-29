@extends('formx::demo.demo')

@section('title','DataSet')

@section('body')


    <h1>DataSet </h1>

    <br />

    <div class="container">
        <div class="row">


           <div class="col-sm-8">
               <div class="row">

               @foreach ($set->data as $item)
                    <div class="col-sm-4" style="margin-bottom: 5px">
                        <strong>{!! $item->title !!}</strong><br />
                        <em>{!! $item->author->firstname !!} {!! $item->author->lastname !!}</em><br />
                        <small>{!! implode(", ", $item->categories->pluck("name")->all())  !!}</small><br />
                    </div>
                @endforeach

               </div>
               {!! $set->links() !!}
           </div>

            <div class="col-sm-4">
                order by <strong>title <a href="{!! $set->orderbyLink('title', 'asc') !!}">asc</a></strong>,<br />
                order by <strong>title <a href="{!! $set->orderbyLink('title', 'desc') !!}">desc</a></strong><br />

            </div>


        </div>
    </div>

    {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getSet") !!}
    {!! Documenter::showCode("zofe/formx/views/demo/set.blade.php") !!}

@stop
