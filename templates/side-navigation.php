<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    
    <ul class="nav navbar-nav side-nav" id="no-print">
        <li>
            <a href="tsurphu-dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> 
        </li>
        <li class="active">
            <a href="tsurphu-donation.php"><i class="fa fa-fw fa-edit"></i> Add Donation</a>
            </li>
            
          <li>
           <a href="tsurphu-search.php"><i class="fa fa-fw fa-search"></i> Search </a>
           </li>
            <li>
          <a href="tsurphu-only-deceased.php"><i class="fa fa-fw fa-search"></i> Search Only Deceased </a>
          </li>
           <li>
         <a href="tsurphu-adv-search.php"><i class="fa fa-fw fa-search"></i> Advance Search </a>
          </li>
        <?php
        if ($_SESSION['user_level'] >= 5) {

           echo '<li>';
           echo '<a href="tsurphu-adminsearch.php"><i class="fa fa-fw fa-search"></i> Edit Amount </a>';
           echo '</li>';

          echo '<li>';
          echo '<a href="tsurphu-printout.php"><i class="fa fa-fw fa-print"></i> Print Receipt </a>';
          echo '</li>';

        echo '<li>';
            echo '<a href="tsurphu-searchby-user.php"> <i class="fa fa-fw fa-user"></i> Data Entred by Users </a>';
            echo '</li>';
        echo '<li>';
            echo '<a href="../admin/admin_center.php"> <i class="fa fa-fw fa-cogs"></i> Admin Center</a>';
            echo '</li>';    
        }
        ?>
              
    </ul>
   
       
    
    
</div>
