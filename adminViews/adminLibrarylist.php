<?php
    require_once '../Models/Database.php';
    require_once '../Models/Song.php';
    require_once 'adminView/header.php';

    //Get database connection
    $db=Database::getDb();
    $sg = new Song();
    //If get page is set or not
    if(isset($_GET['page'])){
        //set GET value in the variable
        $page = $_GET['page'];
    }else{
        //Start value or initial value of the page
        $page = 1;
    }
    //IF the ORDER by is SET
    if(isset($_GET['orderBy'])){
        $order = $_GET['orderBy'];
    }else{
        //initial value for orderby
        $order = null;
    }

    //If search button is click
    if(isset($_POST['submitSearch'])){
        $searchkey = "%".$_POST['search']."%";
    }else{
        $searchkey = null;
    }
    //Get the Data per page or results per page
    $dataperPage = 5;

    $songs =  $sg->listAdminSongs($db, $searchkey,$page,$dataperPage,$order);
    //Get the total count of all the values
    $totalcount = $sg->getcount($db);
    //Acquired the total pages allowed in the List
    $total_pages = $totalcount->count/$dataperPage;


?>

    <h1>List of Songs</h1>

    <!-- MUSIC/ SONG INFORMATION  -->
    <table class="table table-borderless table-hover text-center">
        <thead>
            <tr class="text-uppercase">
                <th class="text-center"><a href="?orderBy=">#</a></th>
                <th class="text-center"><a href="?orderBy=title">Title</a></th>
                <th class="text-center"><a href="?orderBy=artist">Artist</a></th>
                <th class="text-center">Duration</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $i = (($page-1) * $dataperPage)+1;
        //Loop all thru the songs
        foreach ($songs as $m) {
            print '<tr>
                        <!-- THE NUMBER OF TRACK IN THE ALBUM -->
                        <th scope="row">'.$i.'</th>
                        <!-- SONG NAME -->
                        <td class="text-center">'.$m->title.'</td>
                         <!-- ARTIST NAME -->  
                        <td>'.$m->name.'</td>
                        <!-- DURATION OF THE SONG -->
                        <td>'.$m->duration.'</td>
                        <td>
                            <a href="adminLibraryview.php?id='.$m->id.'">View</a> |
                            <a href="adminLibraryupdate.php?id='.$m->id.'">Update</a> |
                            <a href="adminLibrarydelete.php?id='.$m->id.'">Delete</a>
                        </td>
                    </tr>';
        $i++;
        }
        ?>
        </tbody>

    </table>
    <ul class="pagination pull-right">
        <!--       Link is disabled if the $page is less than 1, mean page is 1-->
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="?orderBy=<?=$order?>&page=1">&lt;&lt;</a>
        </li>
        <!--       Link is disabled if the $page is less than 1, mean page is 1-->
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?orderBy=".$order."&page=".($page - 1); } ?>">&lt;</a>
        </li>
        <!--        Link is disabled if its on the last page -->
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?orderBy=".$order."&page=".($page + 1); } ?>">&gt;</a>
        </li>
        <!--        Link is disabled if its on the last page -->
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
            <a href="?orderBy=<?=$order;?>&page=<?php echo ceil($total_pages); ?>">&gt;&gt;</a>
        </li>
    </ul>

    <a class="btn btn-primary" href="adminLibraryadd.php"> Add Song </a>

<?php



