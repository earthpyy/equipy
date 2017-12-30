@extends('layouts.app')

@section('content')
    @include('layouts.title')

    @include('layouts.info')

    <div class="card">
        <div class="card-header">
            Things
        </div>
        <div class="card-body">
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="barcode" placeholder="Barcode">
                    </div>
                </div>

                <table class="table table-striped table-responsive-sm table-sm">
                    <thead>
                        <tr>
                            @yield('table-header')
                        </tr>
                    </thead>
                    <tbody id="list">
                        @yield('table-body')
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    var scntDiv = $('#list');
    var i = $('#list tr').size() + 1;

    $(document).on('change keydown paste input', '#barcode', function(){
        if ($('#barcode').val().length == 13) {

            var barcode = $('#barcode').val();
            $('#barcode').val('');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                method: "POST",
                url: "{!! url('thing/detail') !!}",
                data: {
                    "barcode" : barcode
                },
                dataType: "json",
                success: function(thing) {
                    if (thing.length != 0) {
                        console.log(thing);
                        scntDiv.append('<tr><td>' + i + '</td><td>' + thing.barcode + '</td><td>' + thing.name + '</td><td>' + thing.type.name + '</td><td><a class="btn btn-sm btn-danger" id="remove" href="#">Remove</a></td></tr>');   
                        i++;
                    }
                }
            })
        }
    });

    //Remove button
    $(document).on('click', '#remove', function() {
        $(this).closest('tr').remove();
        i--;
        return false;
        // TODO: change status
    });
</script>
@endsection