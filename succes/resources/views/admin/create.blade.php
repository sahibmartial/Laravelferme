@extends('layout.app')
@section('title')
<title>MASSE</title>
<script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>

@endsection

@section('contenu')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Autocomplete from database</h4>
                <hr>

                <div class="form-group">
                    <label>Campagne</label>
                    <input id="intitule" name="intitule" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Start</label>
                    <input id="start"  type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>OBS</label>
                    <input id="obs"  type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Statut</label>
                    <input id="satus"  type="text" class="form-control">
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function () {
           $('#intitule').autocomplete({
               source:function(request,response){
                
                   $.getJSON('?term='+request.term,function(data){
                        var array = $.map(data,function(row){
                            return {
                                value:row.id,
                                label:row.start,
                                start:row.start,
                                obs:row.obs,
                                satus:row.satus
                            }
                        })

                        response($.ui.autocomplete.filter(array,request.term));
                   })
               },
               minLength:1,
               delay:500,
               select:function(event,ui){
                   $('#start').val(ui.item.start)
                   $('#start').val(ui.item.start)
                   $('#satus').val(ui.item.satus)
               }
           })
        })
    </script>
@endsection