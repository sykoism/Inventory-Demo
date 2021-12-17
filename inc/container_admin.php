</head>
<body class="">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="addInventory.php">Inventory Arrival</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AdminExam.php">Manage Exam</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="staff.php">Manage Staff</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AdminSales.php">Manage Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="LowInventory.php">Threshold of "Low" Inventory</a>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['username']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="action.php?action=logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
	


<div class="container" style="min-height:50px;">
</div>

<div class="container">