<!DOCTYPE html>
<html>


<head>

    <title>My Search engine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
          crossorigin="anonymous">
          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        html, body {
            height: 100%;
        }

        body {
            background: linear-gradient(to right, #77a1d3, #79cbca, #e684ae);
        }

        .preloader {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            background: #080808;
            width: 100px;
            height: 100px;
            justify-content: center;
            align-items: center;
            color: white;
            border-radius: 50%;
            padding: 10px;
        }

        .preloader i {
            animation: 1s linear infinite spin;
        }

        .row {
            display: grid;
            align-items: center;
            justify-content: center;
            width: 500px;
            border-radius: 4px;
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            box-shadow: 0 0 12px #d8d8d8;
            padding: 15px;
        }

        .row .menu {
            width: 100%;
            margin-top: 10px;
        }

        .row .menu input {
            width: 400px;
        }

        .row .menu span.input-group-text {
            cursor: pointer;
        }

        .row .menu i {
            color: dodgerblue;
        }

        .row .preview {
            width: 100%;
            height: auto;
        }

        .row .preview img {
            width: 100%;
            height: auto;
            box-shadow: 0 0 12px #080808;
            border-radius: 4px;
        }

        @keyframes spin {
            from {
                transform: rotateZ(0deg);
            }
            to {
                transform: rotateZ(360deg);
            }
        }


        .booksContainer{
            top: 20%;
            position: absolute;
            left: 10%;
            background: white;
            width: 1000px;
            position: absolute;
            border-radius: 10px;
            padding: 10;
            


            

        }

    </style>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
</head>
<body>


<div class="preloader"><i class="fas fa-spinner fa-3x"></i></div>


<div class="row">
    <div class="menu">
        <div class="input-group mb-3">
            <input class="form-control form-control-lg" id="query" style="    width: 325px;
    float: left !important;" placeholder="Search Book By Title,Author, Category, Subject"/>
            <input type="button" class="btn btn-info searchMe" style="    float: right;
    width: 15%;" value="Search">
        </div>
    </div>
</div>








<div class="booksContainer" >
<table style="margin: 0px auto;" border="2">
    <thead>
        <th style="width: 12.5%">ID</th>
        <th style="width: 12.5%">Title</th>
        <th style="width: 12.5%">Author</th>
        <th style="width: 12.5%">Note</th>
        <th style="width: 12.5%">Subject</th>
        <th style="width: 12.5%">Category</th>
        <th style="width: 12.5%">Price</th>
        <th style="width: 12.5%">Downloads</th>
        <th style="width: 12.5%">Reviews (Amazon)</th>
        <th style="width: 12.5%">Click Here to Read the Book (Bonus Point)</th>


    </thead>
    <tbody id="tableBody" style="background: white">


    </tbody>

</table>



</div>


<script>
    $('.searchMe').click(function () {
      //  debugger;
        let q = $("#query").val();
        $.ajax({
            url: "api.php?action=search&q=" + q,
            dataType: "JSON",
            success: function (data) {
                debugger;

                let html = '';
                for(i=0; i<data.length; i++){
                    let item = data[i];
                    html+='<tr>';
                    html+='<td>'+item['EBook-No.']+'</td>';
                    html+='<td>'+item['Title']+'</td>';
                    html+='<td>'+item['Author']+'</td>';
                    html+='<td>'+item['Note']+'</td>';
                    html+='<td>'+item['Subject']+'</td>';
                    html+='<td>'+item['Category']+'</td>';
                    html+='<td>'+item['Price']+'</td>';
                    html+='<td>'+item['Downloads']+'</td>';
                    html+='<td><ul>';
                    for(j=0;j<item.reviews.length;j++){
                        html+='<hr><li><b>Username: </b>'+item.reviews[j].reviewerName+'<br> <b>Remarks: </b>'+item.reviews[j].summary+'<br> <b>Full Comment: </b>'+'<input placeholder="Move cursor Here to read full comments" title="'+item.reviews[j].reviewText+'readonly"></input></li>';
                    }
                    html+='</ul></td>';
                    html+='<td>'+'<a href="ebooks/'+'book_'+item['EBook-No.']+'.txt'+'" target="_blank">'+'Click Here to Read the Book'+'</a></td>';

                    html+='</tr>';
                }
                $("#tableBody").html(html);
            }
        })

    });
</script>
<script type="text/javascript">
    $( function() {
    $( document ).tooltip();
  } );


</script>

</body>


</html>
