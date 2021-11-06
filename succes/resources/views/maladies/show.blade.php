@extends('base')
@section('title')
   <title>CAS-MALADIE</title>
@endsection

@section('content') 
    <div class="container">
              
            <table class="table table-bordered">
                <thead class="table-dark">
                     <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Symptomes</th>
                            <th scope="col">Campagne</th>
                            <th scope="col">Jours</th>
                            <th scope="col">Traitements</th>
                            <th scope="col"></th>
                      </tr>    
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{$maladie->date}}</td>
                        <td>{{$maladie->symptomes}}</td>
                        <td>{{$maladie->campagne}}</td>
                        <td>{{$maladie->jours}}</td>
                        <td>{{$maladie->traitements}}</td>
                        <td><a href="{{route('maladies.edit',$maladie->id)}}" ><i class="fa fa-edit" style="font-size:28px;color:red"></i> </a></td>
                    </tr>

                </tbody>
            </table>  
    </div>

    <p><a href="{{route('maladies.index')}}"> Retour </a></p>
@stop