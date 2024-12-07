<?php
/**
 * Page that allows admins to verify or delete new (unverified) users
 **/

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-3">
                <div class="card ecni_x" style="width: 18rem;">
                    <a href="viewer.php?t=pdf&dt=training_doc&dn=1584383059">
                        <img class="card-img-top" src="' . ASSETS_URL . 'img/elements/bgs/doc_snap.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Employee Handbook</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ecni_x" style="width: 18rem;">
                    <a href="" data-toggle='modal' data-target='#playa_2931014638'>
                        <img class="card-img-top" src="' . ASSETS_URL . 'img/elements/bgs/doc_snap.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Employee Handbook</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ecni_x" style="width: 18rem;">
                    <a href="viewer.php?t=pdf&dt=training_doc&dn=8970448106">
                        <img class="card-img-top" src="' . ASSETS_URL . 'img/elements/bgs/doc_snap.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Employee Handbook</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ecni_x" style="width: 18rem;">
                    <a href="viewer.php?t=pdf&dt=training_doc&dn=8970448106">
                        <img class="card-img-top" src="' . ASSETS_URL . 'img/elements/bgs/doc_snap.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Employee Handbook</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class='modal fade ecni_x_fullscreen transparent ts__video_mod' id='playa_2931014638' tabindex='-1' role='dialog'
     aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close1 ecni_x' data-dismiss='modal' aria-label='Close'>
                    <span class="close-bar"></span>
                    <span class="close-bar"></span>
                </button>
            </div>
            <div class='modal-body'>

                <div class='video_0__box__0'>

                    <video
                            controls
                            crossorigin
                            playsinline
                            preload='auto'
                            webkit-playsinline
                            data-poster='' . ASSETS_URL . 'img/elements/bgs/doc_snap.jpg'
                            id='player'
                    >
                        <!-- Video files -->
                        <source src='files/test-video/Nature%20-%2030884.mp4'
                                type='video/mp4'
                                size='1080'
                        />
                        <source src='files/test-video/Nature%20-%2030884.mp4'
                                type='video/mp4'
                                size='2160'
                        />
                        <!-- Subtitles files -->
                        <track
                                srclang='en'
                                kind='subtitles'
                                label='English'
                                src='../../../../live_pjs/portal-crestchic/portal-crestchic.com/live/assets/videos/commissioning/commissioning-guide-en.srt'
                        />
                        <!-- Caption files -->
                        <track
                                kind='captions'
                                label='Français'
                                srclang='fr'
                                src='https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt'
                        />

                        <track
                                srclang='en'
                                kind='chapters'
                                src='chapters.vtt'
                        />
                    </video>
                </div>
                <div class='__video__description'>
                    <h5 class='modal-title' id='exampleModalLabel'>Commissioning</h5>
                    <span class='text__description'>
          <p><strong>About: </strong> The following will guide you through the commissioning of your Loadbank. </p>
</span></div>
            </div>
            <div class='modal-footer'>
            </div>
        </div>