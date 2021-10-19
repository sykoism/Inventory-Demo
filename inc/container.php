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
          <a class="nav-link" href="NewExam.php">New Exam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="PreviousExam.php">Previous Exam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales.php">Sales Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ManageInventory.php">Manage Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="InventoryExpire.php">Inventory Nearly Expired</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productinfo.php">Product Spec</a>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['username']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="admin.php">AdminPage</a></li>
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