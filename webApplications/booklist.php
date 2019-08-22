<!DOCTYPE html>
    <head>
        <link class="img-test" rel="shortcut icon" type="image/png" href="../images/firefoxLogo.png">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BookListing</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Book List Section, if causing issues change this to other part of website -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSYyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	  	<link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
	  	<!-- -->
    </head>
    <body>
        <!-- Booklist Section -->
        <script src="https://kit.fontawesome.com/dd01eeee16.js"></script>
        <div class="container mt-4">
            <h1 class="display-4 text-center">
            <i class="fas fa-book-open text-primary"></i> <span class="text-primary">Book</span>Listing</h1>
            <h4 class="display-6 text-center">Create your personal reading list</h4>
            <form id="book-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" class="form-control">
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN#</label>
                    <input type="text" id="isbn" class="form-control">
                </div>
                <input type="submit" value="Add Book" class="btn btn-primary btn-block">
            </form>

            <table class="table table-strpied table-sm mt-5">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN#</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="book-list"></tbody>
            </table>
        </div>

        <script src="booklist.js"></script>

        <br>
        <br>
        <div class="container" style="width: 100%; text-align: center; margin-top:8%">
                <a class="text-center" href="../portfolio.php" style="margin: 0 auto">
                <img class="img-test" src="../images/firefoxLogo.png" alt="HTML5 Icon" style="text-align: center; margin: 5px 15px 5px 5px; width:50px; height:50px;">
                <br>Back To Foxdrop</a>
        </div>
        
    </body>
</html>

