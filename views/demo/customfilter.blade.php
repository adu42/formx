@extends('formx::demo.demo')

@section('title','DataFilter')

@section('body')

    @include('formx::demo.menu_filter')

    <h1>DataFilter (custom filter, custom layout)</h1>

    <br />

    <div class="container">
        <div class="row">
            <div class="col-sm-8">

                {!! $filter->open !!}
                    <div class="input-group custom-search-form">

                         {!! $filter->field('src') !!}
                          <span class="input-group-btn">
                              <button class="btn btn-default" type="submit">
                                  <span class="glyphicon glyphicon-search"></span>
                              </button>
                              <a href="/formx-demo/customfilter" class="btn btn-default">
                                 <span class="glyphicon glyphicon-remove"></span>
                              </a>
                         </span>

                    </div>
                {!! $filter->close !!}

                <br />
                <div class="row">

                @foreach ($set->data as $item)
                    <div class="col-sm-4" style="margin-bottom: 5px">
                        <strong>{!! $item->title !!}</strong><br />
                        <em>{!! $item->author->firstname !!} {!! $item->author->lastname !!}</em><br />
                        <small>{!! implode(", ", $item->categories->pluck("name")->all())  !!}</small><br />
                    </div>
                @endforeach

                </div>

                <div>
                    {!! $set->links() !!}
                    <div class="pull-right">
                        <a href="/formx-demo/customfilter">all articles</a> |
                        <a href="/formx-demo/customfilter?src=jhon+doe&search=1">jhon doe articles</a> |
                        <a href="/formx-demo/customfilter?src=jane+doe&search=1">jane doe articles</a>
                    </div>
                </div>


            </div>

            <div class="col-sm-4">
                This is a sample of datafilter + dataset.<br />
                The filter is using a custom <strong>query scope</strong>.<br />
                The filter is passed to a DataSet (to paginate results and enable order by features)<br />
                <br />
                On the layout-side,  we customize filter output by using partial render
                (form open, form close and src field)<br />
                then we do a simple foreach on dataset "data" to display resultset.<br />
                <br />
            </div>
        </div>
    </div>

    {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getCustomfilter") !!}
    {!! Documenter::showMethod("Ado\\Formx\\Demo\\Article", "scopeFreesearch") !!}
    {!! Documenter::showCode("zofe/formx/views/demo/customfilter.blade.php") !!}

@stop
