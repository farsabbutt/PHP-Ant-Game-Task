<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>

            jQuery(document).ready(function ($) {
                jQuery(".ant").click(function () {
                    var className = "";
                    var id = "";
                    if (jQuery(this).hasClass('queen')) {
                        className = "queen";
                    } else if (jQuery(this).hasClass('worker')) {
                        className = "worker";
                       
                        id = jQuery(this).next('span').data('workerid');
                        
                    } else if(jQuery(this).hasClass('drone')){
                        id = jQuery(this).next('span').data('workerid');
                        className = "drone";
                    }

                    $.ajax({
                        url: "ajax.php",
                        method: "GET",
                        data: "type=" + className + "&id=" + id,
                        beforeSend: function (xhr) {

                        }
                    })
                            .done(function (data) {
                                console.log(data);
                                location.reload();
                            });
                });

            });

        </script>
    </head>
    <body>
        <h1>The Ant Game</h1>
        <?php
        session_start();
      
        require_once ('ant.class.php');
        require_once ('queenAnt.class.php');
        require_once ('workerAnt.class.php');
        require_once ('droneAnt.class.php');

        if (empty($_SESSION["antQueen"])) {
            $queenAnt = new queenAnt();
            $queenAnt->tookHit();
            $_SESSION["antQueen"] = serialize($queenAnt);

            echo '<img class="ant queen" width="4%" src="' . $queenAnt->getImage() . '" />';
            echo $queenAnt->getHitpoints();
           
            echo '<br /><br />';
        } else {

           
            echo '<img class="ant queen" width="4%" src="' . unserialize($_SESSION["antQueen"])->getImage() . '" />';
            echo unserialize($_SESSION["antQueen"])->getHitpoints();
             
            echo '<br /><br />';
        }

        if (empty($_SESSION["antWorkers"])) {

            for ($i = 1; $i <= 6; $i++) {
                $workerAnt = new workerAnt();
                $ants[] = $workerAnt;
            }

            $_SESSION["antWorkers"] = serialize($ants);

            for ($i = 0; $i < count($ants); $i++) {


                echo '<img class="ant worker" width="4%" src="' . $ants[$i]->getImage() . '" />';
                echo '<span class="worker" data-workerid="' . $i . '">' . $ants[$i]->getHitpoints() . '</span>';
            }
        }else{
            $ants = unserialize($_SESSION["antWorkers"]);
             
             for ($i = 0; $i < count($ants); $i++) {
                    
                 if($ants[$i]->getHitPoints() == 0){
                     unset($ants[$i]);
                     continue;
                 }
                 
                echo '<img class="ant worker" width="4%" src="' . $ants[$i]->getImage() . '" />';
                echo '<span class="worker" data-workerid="' . $i . '">' . $ants[$i]->getHitpoints() . '</span>';
            }
           
        }
        
        echo '<br /><br />';
        
        if (empty($_SESSION["antDrones"])) {

            for ($i = 1; $i <= 9; $i++) {
                $workerAnt = new droneAnt();
                $antsDrone[] = $workerAnt;
            }

            $_SESSION["antDrones"] = serialize($antsDrone);

            for ($i = 0; $i < count($antsDrone); $i++) {


                echo '<img class="ant drone" width="4%" src="' . $antsDrone[$i]->getImage() . '" />';
                echo '<span class="drone" data-workerid="' . $i . '">' . $antsDrone[$i]->getHitpoints() . '</span>';
            }
        }else{
            $antsDrone = unserialize($_SESSION["antDrones"]);
             for ($i = 0; $i < count($antsDrone); $i++) {
                 
                  if($antsDrone[$i]->getHitPoints() == 0){
                     unset($antsDrone[$i]);
                     continue;
                 }


                echo '<img class="ant drone" width="4%" src="' . $antsDrone[$i]->getImage() . '" />';
                echo '<span class="drone" data-workerid="' . $i . '">' . $antsDrone[$i]->getHitpoints() . '</span>';
            }
        }
        
        
        
        
        
        ?>
        <br />
        
        <br />
        <a href="reset.php" />Play Game</a>
    </body>
</html>