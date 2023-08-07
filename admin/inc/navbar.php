<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../pics.png" width="150">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0"
          id="navLinks">
        <li class="nav-item">
          <a class="nav-link" 
             aria-current="page" 
             href="index.php"><h5>Dashboard</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="teacher.php"><h5>Teachers</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student.php"><h5>Students</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Registration.php"><h5>Enrollees </h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Class.php"><h5>Class</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="subjects.php"><h5>Subject</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="message.php"><h5>Message</h5></a>
        </li>
      
      </ul>
        <li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <h5> Admin</h5>
          </a>
        <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="settings.php" data-toggle="modal" data-target="#modalForAddCourse">Settings</a></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
  </div>
    </div>
</nav>