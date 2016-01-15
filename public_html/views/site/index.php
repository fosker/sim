<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Simple Image Manager';
?>
<div class="site-index">

    <div class="container-fluid">
        <div class="carousel slide" id="carousel-596116">
            <ol class="carousel-indicators">
                <li data-slide-to="0" data-target="#carousel-596116">
                </li>
                <li data-slide-to="1" data-target="#carousel-596116" class="active">
                </li>
                <li data-slide-to="2" data-target="#carousel-596116">
                </li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img alt="Carousel Bootstrap Firs" class="center-block" src="img/slider/1.jpg" />
                    <div class="carousel-caption">

                    </div>
                </div>
                <div class="item">
                    <img alt="Carousel Bootstrap Second" class="center-block" src="img/slider/2.jpg" />
                    <div class="carousel-caption">

                    </div>
                </div>
                <div class="item">
                    <img alt="Carousel Bootstrap Third" class="center-block" src="img/slider/3.jpg" />
                    <div class="carousel-caption">

                    </div>
                </div>
            </div> <a class="left carousel-control" href="#carousel-596116" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-596116" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
    </div>

    <div class="container">

        <div class="row text-center">
            <h1>Мы предоставляем</h1>
        </div>
        <div class="row text-center">
            <div class="col-md-offset-2 col-md-4">
                <div class="for-clients">
                    <h2>Для клиентов</h2>
                    <ul>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                    </ul>
                    <a href="<?=Url::to(['site/register', 'role' => 'client'])?>"><button type="button" class="btn btn-primary">Регистрация</button></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="for-designers">
                    <h2>Для дизайнеров</h2>
                    <ul>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                        <li>asdjaklsdjaklsjdlkasdasdasd</li>
                    </ul>
                    <a href="<?=Url::to(['site/register', 'role' => 'designer'])?>"><button type="button" class="btn btn-primary">Регистрация</button></a>
                </div>
            </div>
        </div>

    </div>
</div>
