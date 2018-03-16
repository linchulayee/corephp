
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script type="text/javascript">
        $(document).ready(function() {
            // $('#example').DataTable( {
            //     select: {
            //         style: 'os',
            //         items: 'cell'
            //     }
            // } );
            var  post = $.ajax({
                type: "GET",
                dataType: 'json',
                url: 'http://localhost/corephp-master/product/read.php',
                success: function(returnData){
                    var output;
                    for(var data in returnData) {
                       output += '<tr><td>'+returnData[data].prodcut_name+'</td><td>'+returnData[data].cat_name+'</td><td><a href="">Delete</a></td></tr>';
                    }
                    console.log(returnData);
                    $("#cat_table").append(output);
                }
            });
            post.done(function(msg) {
              $("#log").html( msg );
            });

            post.fail(function(jqXHR, textStatus) {
              alert( "Request failed: " + textStatus );
            });
        } );

            
            </script>
</head>
<body>
   <table id="example" class="display" style="width:80%">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Catagory</th>
                <th>DELETE</th>
               
            </tr>
        </thead>
        <tbody id="cat_table" style="text-align: center;">
        </tbody>
        
    </table> 
</body>
</html>
    