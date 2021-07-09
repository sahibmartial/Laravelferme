<div class="mt-4">
<h4 class="text-center">Enregister Achat Aliment</h4>
<form action="{{ route('addmorePost') }}" method="POST">

        @csrf
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        @if (Session::has('success'))

            <div class="alert alert-success text-center">

                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                <p>{{ Session::get('success') }}</p>

            </div>

        @endif
 
        <table class="table table-bordered ml-2" id="dynamicTable">  

            <tr>
                <th>Date</th>
                <th>Campagne</th>

                <th>Libelle</th>
                
                <th>Quantite</th>

                <th>PriceUnit</th>

                <th>Fournisseur</th>
                <th>Contact</th>

                <th>Observations</th>

                <th>Action</th>

            </tr>

            <tr>  
                 <td><input type="date" name="addmore[0][date_achat]" placeholder="Date" class="form-control" /></td>  
                <td><input type="text" name="addmore[0][campagne]" placeholder="Name" class="form-control" /></td>  
                <td><input type="text" name="addmore[0][libelle]" placeholder="Libelle" class="form-control" /></td>  
                <td><input type="text" name="addmore[0][quantite]" placeholder=" Qte" class="form-control" /></td>
                <td><input type="text" name="addmore[0][priceUnitaire]" placeholder=" Prix Unit" class="form-control" /></td> 
                <td><input type="text" name="addmore[0][fournisseur]" placeholder="Fournisseur" class="form-control" /></td>
                <td><input type="text" name="addmore[0][contact]" placeholder="07-06-05-04-03" class="form-control" /></td>
                <td>
                    <textarea name="addmore[0][obs]" placeholder="RAS" class="form-control"></textarea>
                </td>

             <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
            </tr>  
        </table> 
        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
        
    </form>
  
<script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
        ++i;
        $("#dynamicTable").append('<tr><td><input type="date" name="addmore['+i+'][date_achat]" placeholder="" class="form-control" /></td><td><input type="text" name="addmore['+i+'][campagne]" placeholder=" Enter Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][libelle]" placeholder="Enter libelle" class="form-control" /></td><td><input type="text" name="addmore['+i+'][quantite]" placeholder="Enter  Qty" class="form-control"/></td><td><input type="text" name="addmore['+i+'][priceUnitaire]" placeholder="Enter Price" class="form-control"/></td> <td><input type="text" name="addmore['+i+'][fournisseur]" placeholder="Enter fournisseur" class="form-control"/></td> <td><input type="text" name="addmore['+i+'][contact]" placeholder="07-06-05-04-03" class="form-control"/></td> <td><textarea  name="addmore['+i+'][obs]" placeholder="Enter Obs" class="form-control"/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

    });   
    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  
</script>

</div>
