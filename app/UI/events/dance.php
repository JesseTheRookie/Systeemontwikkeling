<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>

    <div id="section-dance-header">
        <div class="content-dance-header">
            <div>
            <img src="../img/banner-dance.jpg" alt="">
            </div>
            <div class="content-dance-right">
                <h3>
                    Haarlem <br>Dance.
                </h3>
                <a href="">
                    Performers
                </a>
                <a href="">
                    Tickets
                </a>
            </div>
        </div>
    </div>

<div id="section-artists-dance">
    <h2>
        Performers
    </h2>

    <hr>

    <div class="content-artists-dance">
        <div>
            <img src="../img/Tiesto.jpg" alt="">
            <button class="myBtn">Tiesto</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/Nicky.jpg" alt="">
            <button class="myBtn">Nicky Romero</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/hardwell.jpg" alt="">
            <button class="myBtn">Hardwell</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/armin.png" alt="">
            <button class="myBtn">Armin van Buuren</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/martin.jpeg" alt="">
            <button class="myBtn">Martin Garrix</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/afrojack.jpg" alt="">
            <button class="myBtn">Afrojack</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>
    </div>
</div>
<?php
    require APPROOT . '/ui/inc/footer.php';
?>


<style>
.content-dance-header h3
{
    color: #ffffff;
    font-size: 70px;
    padding: 80px 0px 40px 0px;
}
#section-artists-dance h2
{
    font-size: 60px;
    color: #ffffff;
    margin: 0 auto;
    text-align: center;
    padding: 100px 0px 0px 0px;
}
#section-artists-dance > div
{
    display: grid;
    grid-template-columns: 33% 33% 33%;
    position: relative;
    width: 100%;
    text-align: center;
    margin: 0 auto;
    padding: 0px 0px 100px 0px
}
</style>
