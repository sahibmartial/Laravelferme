<form action="{{ route('getEmployes') }}" method="POST">
  
<!-- For defining autocomplete -->
    <input type="text" name="name" id='name'>

    <!-- For displaying selected option value from autocomplete suggestion -->
    <input type="text" id='nameeid' readonly>

</form>
{{ Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S') }}
     <!-- Script -->
    <script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     
    $(document).ready(function(){
      //alert('hello');

      $( "#name" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('getEmployes')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           // Set selection
           $('#name').val(ui.item.label); // display the selected text
           $('#nameeid').val(ui.item.value); // save selected id to input
           return false;
        }
      });

    });
    </script>