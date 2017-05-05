<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    
    <ul class="nav navbar-nav side-nav" id="no-print">
        
        <li class="active">
            <a href="add_currency.php"><i class="fa fa-fw fa-edit"></i> Add Currency</a>
            </li>
            <li>
            <a href="../currency/currency_search.php"> <i class="fa fa-fw fa-user"></i> Search & Modify </a>
           </li>
            
        <?php
        if ($_SESSION['user_level'] >= 5) {
        
        echo '<li>';
            echo '<a href="../admin/admin_center.php"> <i class="fa fa-fw fa-cogs"></i> Admin Center</a>';
            echo '</li>';    
        }
        ?>
              
    </ul>
   
       
    
    
</div>