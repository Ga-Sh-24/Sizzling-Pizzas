<head>
    <title>Sizzling Pizzas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        .brand{
            background: #c32148 !important;    /*!important is used for overriding any inbuilt class of materialize*/
        }

        .brand-text{
            color: #c32148 !important;
        }

        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 10px;
        }

        .pizza{
            width: 150px;
            height: 150px;
            margin: 60px auto -55px;
            display: block;
            position: relative;
            top: -35px;
        }
    </style>
</head>
<body class="grey lighten-3">
    <nav class="white z-depth-0">    
        <div class="container">    
            <a href="#" class="brand-logo brand-text">Sizzling Pizzas</a> 
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li class="grey-text text-darken-2"><strong>Hello Guest!</strong></li>
                <li><a href="add.php" class="btn brand z-depth-0">Add a Pizza</a></li>
            </ul>
        </div>
    </nav>
