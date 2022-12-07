<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <header class="mb-5">
                <div class="p-5 text-center bg-light" style="margin-top: 58px;">
                    <h1 class="mb-3"><?php echo $controller->page_title; ?></h1>
                    <h4 class="mb-3">
                        <?php
                        $visitas = $visitasService->getVisitas();
                        if($visitas==1){
                            echo "Bienvenid@";
                        }
                        else{
                            echo "Ha visitado la página $visitas veces";
                        }
                        ?>
                        
                        
                    </h4>
                    <form method="post">
                        <input type="submit" name="reset" value="Restablecer contador"  class="btn btn-secondary">
                    </form>
                </div>
            </header>

