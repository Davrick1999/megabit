<?php 
    include 'include/database.php';
    include 'include/postData.php';
    include 'include/viewData.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>React-PHP</title>
        <style>  
            * {
                box-sizing: border-box;
            }
            .container {
                display: flex;
            }
            .buttons-container {
                flex: 40%;
            }
            .sortedEmails {
                position: relative;
                
            }
            .buttons {
                background-color: #fff; 
                border: 2px solid #4CAF50;
                border-radius: 5px;
                color: black;
                padding: 8px 25px;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
            .buttons:nth-last-child(2) {
                border: 2px solid #000;
                margin: 4px 2rem;
            }
            .buttons:nth-last-child(3) {
                border: 2px solid #008CBA;
                margin: 4px 2rem;
            }
            table {
              font-family: Arial, sans-serif;
              border-collapse: collapse;
              flex: 50%;
              flex-shrink: 0;

            }
            
            td, th {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }
            
            tr:nth-child(even) {
              background-color: #dddddd;
            }
            th:nth-child(odd), td:nth-child(odd) {
                text-align: center;
            }
            
            a {
                display: inline-block;
                border: 2px solid #dc3545;
                border-radius: 5px;
                text-decoration: none;
                color: #dc3545;
                padding: 8px 25px;
                font-size: 16px;
                cursor: pointer;
            }
            #myInput {
              width: 100%;
              font-size: 16px;
              padding: 12px 20px ;
              border: 2px solid #008CBA;
              border-radius: 5px;
              margin: 10px 2px;
            }
        </style>
    </head>
    <body>
        <?php 
            
            $emails = new View();

            if(isset($_GET['delete']) && !empty($_GET['delete'])) {
                $deleteId = $_GET['delete'];
                $emails->deleteEmail($deleteId);
            }
        ?>
        <div class="container">
            <?php 
                $emails->showEmails();
            ?>
            <div class="buttons-container">
            <h4 style="margin: 8px; font-family: Ubuntu;">Email Providers</h3>
            <?php 
                $emails->showProviders();
            ?>
            <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names.." title="Type in a name">
        </div>
    </body>
    <script>
        var tableRow = document.getElementById('email');

        var newTable = "<?php 
          $emails = new View();
          $emails->showSortedData(); 
        ?>";

        function sortEmails() {
            window.location.href="index.php?title=sort";
        }
        tableRow.innerHTML = newTable;

        function displayAllEmails() {
            window.location.href="index.php";
        }
        tableRow.innerHTML = newTable;

        function displaySortedEmails(provider) {
          window.location.href="index.php?title="+provider+"";
        }
        tableRow.innerHTML = newTable;

        // in order to use filters and search for emails, 
        // first you need to apply filter and then search
        function search() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("email");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
    </script>
    
</html>