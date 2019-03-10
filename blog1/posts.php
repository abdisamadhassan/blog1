<?php
include('inc/conn.php');
//get all posts
$sql = "SELECT * from posts  ORDER BY id ASC";
$results=mysqli_query($conn,$sql);
$posts=mysqli_fetch_all($results,MYSQLI_ASSOC);
mysqli_free_result($results);

$recent="SELECT * from posts ORDER BY DESC limit 5";
$rec=mysqli_query($conn,$sql);
$recposts=mysqli_fetch_all($rec,MYSQLI_ASSOC);
mysqli_free_result($rec);

$catogory="SELECT catogory from posts";
$catogories=mysqli_query($conn,$catogory);
$cato=mysqli_fetch_all($catogories,MYSQLI_ASSOC);
mysqli_free_result($catogories);

mysqli_close($conn);
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Charm" rel="stylesheet">

        <title>Shout4Anime</title>
        <style type="text/css">
            p {
                font-size: fit-width;
            }
            
            h2 {
                font-family: 'Charm', cursive;
            }
            
            p {
                word-wrap: break-word;
            }
            .scrolling{
                overflow-y:scroll;
                height:2000px;
            }
        </style>
    </head>

    <body>
        <div class='container'>
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <a class="navbar-brand" href="#">Shout4Anime</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addpost.php">addpost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="posts.php">posts<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">logout</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <br>
            <p><a href='index.php'>home</a>/ All Posts</p>
            <hr>
            <div class='row'>
                <div class='col-md-7 col-sm-12'>
                    <h2 class='text-danger'> All Posts</h2>
                    <hr>
                    <div class='scrolling'>
                    <table class="table table-bordered">
                        <tr>
                            <td>Topics</td>
                            <td>created_at</td>
                            <td>Catogory</td>
                            <td>author</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#"></a>
                            </td>
                            <td>6 hours ago</td>
                            <td>110mb</td>
                            <td><a href='#'>Abdisamad</a></tr>
                        <?php foreach ($posts as $post):?>
                            <tr>
                                <td>
                                    <a href="post.php?id=<?php echo $post['id'];?>">
                                        <?php echo $post["title"];?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $post['date_created'];?>
                                </td>
                                <td>
                                    <?php echo $post['catogory'];?>
                                </td>
                                <td>
                                    <a href='#'>
                                        <?php echo $post['author'];?>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                    </table>
                    </div>
                </div>
                <div class='col-md-4 col-sm-12'>
                    <br>
                    <br>
                    <h2 class='text-dark'>Self Introduction</h2>
                    <hr>
                    <img src="genos.png" alt="" style='width:100%;'>
                    <a href="http://en.gravatar.com/nightghoul" class='text-danger'>NightGhoul</a>
                    <br>
                    <p>Before I start losing myself in the excitement let me start off by why I decided to take on blogging. To start with I am not that of great of writer and English is my second language but I have always been inspired by my love for anime and the blogging community.</p>
                    <a href="http://en.gravatar.com/nightghoul" class='text-danger'>view profile page--></a>
                    <br>
                    <br>
                    <ul class='list-group list-unstyled'>
                        <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">Recent Posts</a></li>
                        <?php foreach ($recposts as $recpost):?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href='previewpost.php?id=<?php echo $recpost[' id '];?>'>
                                    <?php echo $recpost['title'];?>
                                </a>
                            </li>
                            <?php endforeach;?>
                    </ul>
                    <hr>
                    <br>
                    <ul class="list-group list-unstyled">
                        <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">catorgories</a></li>

                        <div class="form-group">
                            <select class="form-control" name='cato' onchange="location = this.value;">
                                <option value=''>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">choose a catogory</li>
                                </option>
                                <?php foreach ($cato as $catogory):?>
                                    <option value='dashboard.php?cato=<?php echo $catogory[' catogory '];?>'>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?php echo $catogory['catogory'];?>
                                        </li>
                                    </option>
                                    <?php endforeach;?>
                            </select>
                        </div>

                    </ul>
                    <hr>
                    <br>
                    <ul class="list-group list-unstyled">
                        <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">Archieves</a></li>
                        <div class="form-group">
                            <select class="form-control" name='archieves' onchange="location = this.value;">
                                <option value=''>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">choose an archieve</li>
                                </option>
                                <?php foreach ($cato as $catogory):?>
                                    <option value='dashboard.php?cato=<?php echo $catogory[' catogory '];?>'>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?php echo $catogory['catogory'];?>
                                        </li>
                                    </option>
                                    <?php endforeach;?>
                            </select>
                        </div>
                    </ul>
                    <hr>
                    <br>
                    <!--
      <ul class="list-group list-unstyled">
       <li><a href='#' class="list-group-item list-group-item-success text-danger">Recent comments</a></li>
          <?php// foreach ($recent_comments as $recent_comment):?>
       <li class="list-group-item d-flex justify-content-between align-items-center"><a href='previewpost.php?id=<?php echo $recent_comment['post_id'];?>'>
        <?php// echo $recent_comment['name'];?><br>
        <?php// echo $recent_comment['commented_at'];?>.....
        </a>
  </li>
    <?php// endforeach;?>
</ul><hr><br>  -->
                    <!--
          <ul class="list-group list-unstyled">
       <li><a href='#' class="list-group-item list-group-item-success text-danger">Posts</a></li>
          <?php //foreach ($rows as $row):?>
              <li class="list-group-item d-flex justify-content-between align-items-center"><a href="previewpost.php?id=<?php echo $row['id'];?>">post<?php echo $row['id'];?></a></li>
    <?php //endforeach;?>
  </ul><hr><br> -->
                    <form action='dashboard.php' method='post'>
                        <div class="form-group">
                            <h2 class='text-dark'>suggestion box</h2>
                            <hr>
                            <textarea class="form-control" id="suggestion" name='suggestion' rows='10'>Enter your Suggestion</textarea>
                            <button type="submit" name='suggestion_box' class="btn btn-dark">send!</button>
                        </div>
                    </form>
                    <hr>
                    <br>
                    <h2 class='text-dark'>fallow blog on</h2>
                    <hr>
                    <p>Click to follow this blog and receive notifications of new posts by email.</p>
                    <button type="submit" name='suggestion_box' class="btn btn-success btn-lg button-block">subscribe</button>
                    <br>
                    <br>
                </div>
            </div>
    
        <?php include('inc/footer.php');?>