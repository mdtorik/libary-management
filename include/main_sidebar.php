<aside class="main-sidebar elevation-4 bg">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="img\lib13.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text txt">MS BOOK SHOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/fb.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block txt"><?php echo $_SESSION["s_username"];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-fill txt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                  </svg>
              <p class="txt">
                BOOK MANAGEMENT
                <i class="right fas fa-angle-left txt"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="home.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="txt">LIBARY SYSTEM</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="book-add" class="nav-link">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">ADD BOOK</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="manage-contact" class="nav-link">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">MANAGE BOOK</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="manage-catagory" class="nav-link">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">MANAGE CATAGORY</p>
                </a>
              </li>
            </ul>
          </li>
        <!--end book mangment system-->
        <!--user mangment system-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class='fas fa-user txt'></i>
              <p class="txt">
                USER MANAGEMENT
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="create-user" class="nav-link active">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">Create User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage-user" class="nav-link">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">Manage User</p>
                </a>
              </li>
             
            </ul>
          </li>
          <!--salse mangment system-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-fill txt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
</svg>
              <p class="txt">
                SELSE MANAGEMENT
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sales-managment" class="nav-link active">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">SELSE TABLE</p>
                </a>
              </li> 
            </ul>
          </li>
          <!--parchases mangment system-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-check txt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                  </svg>
              <p class="txt">
                PARCHASES MANAGE
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="parchase-table" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="txt">PARCHASES TABLE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="parchase-managment" class="nav-link active">
                  <i class="far fa-circle nav-icon txt"></i>
                  <p class="txt">PARCHASES MANAGE</p>
                </a>
              </li> 
            </ul>
          </li>
          
          <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="far fa-circle nav-icon txt"></i>
                  <!-- <i><span class="glyphicon glyphicon-off"></span></i> -->
                  <!-- <span class="glyphicon">&#xe017;</span> -->
                  <p class="txt">Logout</p>
                </a>
           </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>