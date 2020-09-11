<?php
    require_once 'Models/Database.php';
    require_once 'Models/Faq.php';
    require_once 'view/header.php';

    //Create Database Connection
    $db=Database::getDb();
    $fq = new Faq();

?>
    <h1>Frequently Asked Questions</h1>
    <div class="container">
        <div class="row">
            <div id="custom-search-input">
                <form method="GET" action="">
                    <div class="input-group col-md-12">
                        <label for="searchArea" class="hidden">Ask a Question here...</label>
                        <input type="text" name="searchvalue" class="search-query form-control" placeholder="Ask your Question here.." id="searchArea"/>
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="searchFaq">
                            <img src="images/search.png" />
                        </button>
                    </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--      LIST OF FAQS IN THE DATABASE -->
<!--     GET ALL FAQS-->
  <?php
  //If Search button is Set
      if(isset($_GET['searchFaq'])) {
          //Get the search string
          $searchkey = "%" . $_GET['searchvalue'] . "%";
          //Search in the database
          $faqs = $fq->search($db, $searchkey);
            foreach ($faqs as $faq){
                print '<div class="faqs_info">
                            <!-- QUESTIONS IN THE DATABASE -->
                            <h2 class="text-primary">'.$faq->question.'</h2>
                            <!-- POSSIBLE ANSWERS IN THE DATABASE -->
                            <p>'.$faq->answer.'</p>
                       </div>';
            }
      }
  ?>

<?php include 'view/footer.php'; ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        var questions = []
        $.post("handlers/ajax/getFaqJson.php", function(data) {
            //console.log(data);
            var faqs =  JSON.parse(data);
            for(let i = 0; i<faqs.length; i++){
                questions.push(faqs[i].question);
            }

        });
        //console.log(questions);
        $( "#searchArea" ).autocomplete({
            source: questions

        });
    } );
</script>
