<?=$render('header', ['loggedUser'=>$loggedUser]);?>
<section class="container main">
        <?=$render('sidebar');?>
        <section class="feed mt-10">
            
            <div class="row">
                <div class="column pr-5">

                    <?=$render('feed-editor',['user'=>$loggedUser]);?>

                    <?php foreach($feed as $feedItem): ?>

                        <?=$render('feed-item' , [
                            'data' => $feedItem
                        ]);?>
                        
                    <?php endforeach; ?>

                </div>
                <div class="column side pl-5">
                    <?=$render('sponsors');?>
                </div>
            </div>

        </section>
    </section>
    <?=$render('footer');?>