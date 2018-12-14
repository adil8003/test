<?php
$this->title = Yii::t('app', 'Courses');
?>
<input type="hidden" id="userid"  value="<?php echo yii::$app->session['userid'] ?>"/>
<div class="row" >
    <div class="card" id="" >
        <div class="header">
            <h5 class="title">Course  List  <span>
                    <!--                    <div class="border-input input-md btn btn-info btn-fill btn-xs btn-wd pull-right">
                                            <select onchange="CardBox();" id="box" class=" border-input input-md btn btn-info btn-fill btn-xs btn-wd" style="margin: -4px;">
                                                <option value="Active">Change layout</option>
                                                <option  value="1">Card box</option>
                                                <option value="2">Horizontal card</option>
                                            </select>
                                        </div>-->
                </span> </h5>
        </div>
        <hr>
        <div class="row coursemargin" id="list-course">
            <!--<p id="notAvailable"></p>-->
            <!--            <div class="alert alert-danger" id="notAvailable" >
                            <button type="button" aria-hidden="true" class="close">×</button>
                            <span><b> </b> </span>
                        </div>-->
            <div class="col-xs-12">
                <div class="card coursecard">
                    <div class="card-block">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="card-title courseTitle">card 1<span class=""><a href="index.php?r=course/coursecontent&amp;id=' + v.id + '" title="Add content"><i  class="ti-plus teal-text editCourse pull-right"></i></a>
                                            <span> <a href="index.php?r=course/editcourse&amp;id=' + v.id + '" title="Edit" class="teal-text editCourse"   > <i  class="ti-pencil teal-text pull-right">&nbsp;</i></a></span></span></h5>
                                    <div class="row">
                                        <hr class="hrline">
                                        <div class="col-md-6">
                                            <p class="card-text courselayout"><b>Description:</b> Something that Filip didn't mention in his videos is that you can add comments to your Python scripts. Comments are important to make sure that you and others can understand.</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class=" courselayout"><b>Subject:</b> course subject</p>
                                            <p class="card-text courselayout"><b>Department:</b> csdvfgbfgbgh </p>
                                            <p class="card-text courselayout"><b>Branch:</b> nhjmjhmghngh</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="author pull-right" id="orgImage">
                                        <img src="https://udemy-images.udemy.com/course/240x135/756150_c033_2.jpg" style="height:180px;" id="imagepic" alt="Image" class="img-rounded img-responsive img-raised">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <ul class="card-wrapper">
                    <li>
                        <div  class="search-course-card--card__inner--1tkPf">
                            <div class="search-course-card--card--left-col--3kKip">
                                <img src="https://udemy-images.udemy.com/course/240x135/756150_c033_2.jpg" srcset="https://udemy-images.udemy.com/course/240x135/756150_c033_2.jpg 1x, https://udemy-images.udemy.com/course/480x270/756150_c033_2.jpg 2x" alt="course image" class="search-course-card--card__image--yIhWY"></a>
                            </div>
                            <div class="fx">
                                <div class="search-course-card--card__head--2X4bl">
                                    <a  href="" class="search-course-card--card__title--1moSD"><h1>Card 2 Angular 5 (formerly Angular 2) - The Complete Guide</h1></a><div class="bestseller-info " data-purpose="bestseller-badge">

                                    </div>
                                </div>
                                <div class="search-course-card--card__content--3-BSH">
                                    <div class="search-course-card--card--middle-col--1LrYN">
                                        <p class="search-course-card--card__instructor--jB8_v courselayout" >
                                            <span>Something that Filip didn't mention in his videos is that you can add comments to your Python scripts. Comments are important to make sure that you and others can understand. Something that Filip didn't mention in his videos is that you can add comments to your Python scripts. Comments are important to make sure that you and others can understand. 
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sub">Subject: <span class="subfont">Angular</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="sub">Department: <span class="subfont">IT</span></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sub">Branch: <span class="subfont">Tech</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="courselayout sub"><a href="index.php?r=course/coursecontent&amp;id=' + v.id + '" title="Add content"><i  class="ti-plus teal-text editCourse "></i></a>&nbsp;&nbsp;
                                            <span><a href="index.php?r=course/editcourse&amp;id=' + v.id + '" title="Edit" class="teal-text editCourse"   > <i  class="ti-pencil teal-text "></i></a></span></div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </li>
                </ul>
            </div> 
            <div class="col-xs-12">
                <ul class="card-wrapper" >
                    <li>
                        <div  class="search-course-card--card__inner--1tkPf" style="margin-top: 23px;">
                            <div class="search-course-card--card--left-col--3kKip">
                                <img src="https://udemy-images.udemy.com/course/240x135/1045942_d12f.jpg"  alt="course image" class="search-course-card--card__image--yIhWY">
                            </div>
                            <div class="fx">
                                <div class="search-course-card--card__head--2X4bl">
                                    <a href="" class="search-course-card--card__title--1moSD"><h1>Card 3 Angular 5 (formerly Angular 2) - The Complete Guide</h1></a><div class="bestseller-info " >

                                    </div>
                                </div>
                                <div class="search-course-card--card__content--3-BSH">
                                    <div class="search-course-card--card--middle-col--1LrYN">
                                        <p class="search-course-card--card__instructor--jB8_v courselayout" >
                                            <span> Something that Filip didn't mention in his videos is that you can add comments to your Python scripts. Comments are important to make sure that you and others can understand. 
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sub">Subject: <span class="subfont">Angular</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="sub">Department: <span class="subfont">IT</span></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sub">Branch: <span class="subfont">Tech</span></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="courselayout sub pull-right"><a href="index.php?r=course/coursecontent&amp;id=' + v.id + '" title="Add content"><i  class="ti-plus teal-text editCourse "></i></a>&nbsp;&nbsp;
                                            <span><a href="index.php?r=course/editcourse&amp;id=' + v.id + '" title="Edit" class="teal-text editCourse"   > <i  class="ti-pencil teal-text "></i></a></span></div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12">
                <ul class="card-wrapper" >
                    <li>
                        <div  class="search-course-card--card__inner--1tkPf" style="margin-top: 23px;">

                            <div class="fx">
                                <div class="search-course-card--card__head--2X4bl">
                                    <a href="" class="search-course-card--card__title--1moSD"><h1>Card 4 Angular 5 (formerly Angular 2) - The Complete Guide </h1></a><div class="bestseller-info">

                                    </div>
                                </div>
                                <div class="search-course-card--card__content--3-BSH">
                                    <div class="search-course-card--card--middle-col--1LrYN">
                                        <p class="search-course-card--card__instructor--jB8_v courselayout" >
                                            <span> Something that Filip didn't mention in his videos is that you can add comments to your Python scripts. Comments are important to make sure that you and others can understand. 
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sub">Subject: <span class="subfont">Angular</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="sub">Department: <span class="subfont">IT</span></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sub">Branch: <span class="subfont">Tech</span></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="courselayout sub"><a href="index.php?r=course/coursecontent&amp;id=' + v.id + '" title="Add content"><i  class="ti-plus teal-text editCourse "></i></a>&nbsp;&nbsp;
                                            <span><a href="index.php?r=course/editcourse&amp;id=' + v.id + '" title="Edit" class="teal-text editCourse"   > <i  class="ti-pencil teal-text "></i></a></span></div>
                                    </div>

                                </div>

                            </div>
                            <div class="search-course-card--card--left-col--3kKip">
                                <img src="https://udemy-images.udemy.com/course/240x135/1045942_d12f.jpg"  alt="course image" class="search-course-card--card__image--yIhWY">
                            </div>

                        </div>
                    </li>
                </ul>
            </div>

            
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-outer">
                            <a href="https://hackr.io/tutorials/learn-javascript" class="card js-related-topic topic-grid-item" data-slug="javascript">
                                <img class="topic-thumbnail lazyload" src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" data-src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" alt="JavaScript Tutorials and courses">
                                <p class="js-topic">JavaScript</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-outer">
                            <a href="https://hackr.io/tutorials/learn-javascript" class="card js-related-topic topic-grid-item" data-slug="javascript">
                                <img class="topic-thumbnail lazyload" src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" data-src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" alt="JavaScript Tutorials and courses">
                                <p class="js-topic">JavaScript</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-outer">
                            <a href="https://hackr.io/tutorials/learn-javascript" class="card js-related-topic topic-grid-item" data-slug="javascript">
                                <img class="topic-thumbnail lazyload" src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" data-src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" alt="JavaScript Tutorials and courses">
                                <p class="js-topic">JavaScript</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-outer">
                            <a href="https://hackr.io/tutorials/learn-javascript" class="card js-related-topic topic-grid-item" data-slug="javascript">
                                <img class="topic-thumbnail lazyload" src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" data-src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" alt="JavaScript Tutorials and courses">
                                <p class="js-topic">JavaScript</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-outer" hackr--flex-grid card-outer a>
                            <a href="https://hackr.io/tutorials/learn-javascript" class="card js-related-topic topic-grid-item" data-slug="javascript">
                                <img class="topic-thumbnail lazyload" src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" data-src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" alt="JavaScript Tutorials and courses">
                                <p class="js-topic">JavaScript</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-outer">
                            <a href="https://hackr.io/tutorials/learn-javascript" class="card js-related-topic topic-grid-item" data-slug="javascript">
                                <img class="topic-thumbnail lazyload" src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" data-src="https://d1eq8vvyuam4eq.cloudfront.net/javascript_logo.svg?ver=1520499265" alt="JavaScript Tutorials and courses">
                                <p class="js-topic">JavaScript</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .topic-thumbnail {
    margin-right: 15px;
    height: 40px;
    width: 40px;
    overflow: hidden;
}
    .hackr--flex-grid {
        flex-wrap: wrap;
    }
    .flex-grid, .fx {
        display: flex;
    }
    .tutorial--flex-grid {
        margin: 0 -10px;
    }
    .tutorial--flex-grid .card-outer a {
        color: #383838;
    }
    .hackr--flex-grid .card-outer a {
        word-break: break-all;
        font-size: 14px;
        border-radius: 3px;
        color: #383838;
        border: 1px solid #eee;
    }
    .topic-grid-item, .topic-grid-item:hover {
        background-color: #fff;
        transition: all .1s linear;
    }
    .topic-grid-item {
        padding: 15px;
        display: flex;
        min-height: 20px;
        align-items: center;
        justify-content: flex-start;
        flex-direction: row;
        border: none;
        margin-bottom: 17px;
        border-radius: 6px;
        box-shadow: 0 1px 2px rgba(0,0,0,.1);
    }


    ul{ list-style: none;
        margin: 0;
        padding: 0;
    }
    .subfont{
        font-size: 14px;
        font-weight: 500;
        letter-spacing: .4px;
    }
    .sub{
        font-size: 15px !important;
        font-weight: 700 !important;
        line-height: 18px !important;
    }
    .search-course-card--card__inner--1tkPf {
        border: 1px solid #dedfe0;
        border-radius: 2px 2px 0 0;
        /*position: relative;*/
        padding-right: 30px;
        background-color: #fff;
        /*min-height: 132px;*/
        display: flex;
    }
    .search-course-card--card--left-col--3kKip {
        width: 260px;
        /*margin-right: 30px;*/
    }

    a {
        color: #007791;
        font-weight: 400;
    }
    .fx {
        flex: 1;
        min-width: 1px;
    }
    .search-course-card--card__title--1moSD h1 {
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #29303b !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 18px !important;
    }
    .search-course-card--card__content--3-BSH {
        height: auto;
        flex: 1;
        min-width: 1px;
        align-items: stretch;
        display: flex;
        padding-bottom: 10px;
    }
    .search-course-card--card__subtitle--CBRzq {
        font-size: 13px !important;
        color: #505763;
        margin: 5px 0 0;
    }
    .search-course-card--card__head--2X4bl {
        padding-top: 10px;
    }
</style>
