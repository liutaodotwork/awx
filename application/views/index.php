<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Airwallex Product Demos</title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="Welcome to Airwallex Product Demos! Here, you will find comprehensive demonstrations showcasing the various products offered by Airwallex. Whether you're interested in the payment solutions, foreign exchange services, or global accounts, these demos will provide you with a firsthand experience of how the products work and the value they can bring to your business.">
        <!-- Mobile Specific Meta Tag-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
        <link rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/vendor.min.css">
        <!-- Main Template Styles-->
        <link id="mainStyles" rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/styles.min.css">
        <!-- Modernizr-->
        <script src="<?= $asset_path ?>/js/modernizr.min.js"></script>
    </head>
    <body>
        <!-- Page Title-->
        <div class="page-title">
            <div class="container">
                <div class="column">
                    <h1>Airwallex Product Demos</h1>
                </div>

                <div class="column">
                    <ul class="breadcrumbs">
                        <li><a href="<?= site_url() ?>">Home</a></li>
                    </ul>
                </div>
            </div>

        </div>

<?php if (false ) { ?>
<div class="container padding-bottom-2x mb-2">
      <div class="row">
        <div class="col-lg-9 col-md-8 order-md-2">
          <div class="row">
            <div class="col-sm-6 margin-bottom-2x pb-2">
              <h6 class="text-muted text-lg text-uppercase">Image on top</h6>
              <hr class="margin-bottom-1x">
              <div class="card"><img class="card-img-top" src="../img/components/img04.jpg" alt="Card image">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a class="btn btn-primary btn-sm" href="#">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 margin-bottom-2x pb-3">
              <h6 class="text-muted text-lg text-uppercase">Image on bottom</h6>
              <hr class="margin-bottom-1x">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a class="btn btn-primary btn-sm" href="#">Go somewhere</a>
                </div><img class="card-img-bottom" src="../img/components/img05.jpg" alt="Card image">
              </div>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase">Header and Footer</h6>
          <hr class="margin-bottom-1x">
          <div class="card text-center">
            <div class="card-header"><span class="text-lg">Featured</span></div>
            <div class="card-body">
              <h3 class="card-title">Special title treatment</h3>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary" href="#">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">3 days ago</div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x mt-2">Content Alignment</h6>
          <hr class="margin-bottom-1x">
          <div class="row">
            <div class="col-lg-4 margin-bottom-1x">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary btn-sm" href="#">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 margin-bottom-1x">
              <div class="card text-center">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary btn-sm" href="#">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 margin-bottom-1x">
              <div class="card text-right">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary btn-sm" href="#">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-1x mt-1">Navigation: Tabs</h6>
          <hr class="margin-bottom-1x">
          <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link active" href="#">Active</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                <li class="nav-item"><a class="nav-link disabled" href="#">Disabled</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h3 class="card-title">Special title treatment</h3>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary" href="#">Go somewhere</a>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x mt-1">Navigation: Pills</h6>
          <hr class="margin-bottom-1x">
          <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-pills card-header-pills">
                <li class="nav-item"><a class="nav-link active" href="#">Active</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                <li class="nav-item"><a class="nav-link disabled" href="#">Disabled</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h3 class="card-title">Special title treatment</h3>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary" href="#">Go somewhere</a>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x mt-1">Background Colors</h6>
          <hr class="margin-bottom-1x">
          <div class="card text-white bg-primary text-center mb-3">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Primary card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card bg-secondary text-center mb-3">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Secondary card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card text-white bg-success text-center mb-3">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Success card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card text-white bg-info text-center mb-3">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Info card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card text-white bg-warning text-center mb-3">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Warning card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card text-white bg-danger text-center mb-3">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Danger card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card text-white bg-dark text-center mb-2">
            <div class="card-header text-lg">Header</div>
            <div class="card-body">
              <h4 class="card-title">Dark card title</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x">Outline Cards</h6>
          <hr class="margin-bottom-1x">
          <div class="card border-primary text-center mb-3">
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card border-success text-center mb-3">
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card border-info text-center mb-3">
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card border-warning text-center mb-3">
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card border-danger text-center mb-3">
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <div class="card border-dark text-center">
            <div class="card-body">
              <h4 class="card-title">Special title treatment</h4>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x">Layout: Cards Group</h6>
          <hr class="margin-bottom-1x">
          <div class="card-group">
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img04.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
              <div class="card-footer text-sm text-muted">Last updated 3 mins ago</div>
            </div>
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img05.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
              </div>
              <div class="card-footer text-sm text-muted">Last updated 3mins ago</div>
            </div>
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img06.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
              </div>
              <div class="card-footer text-sm text-muted">Last updated 3 mins ago</div>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x">Layout: Cards Deck</h6>
          <hr class="margin-bottom-1x">
          <div class="card-deck">
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img04.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
              <div class="card-footer text-sm text-muted">Last updated 3 mins ago</div>
            </div>
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img05.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
              </div>
              <div class="card-footer text-sm text-muted">Last updated 3 mins ago</div>
            </div>
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img06.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
              </div>
              <div class="card-footer text-sm text-muted">Last updated 3 mins ago</div>
            </div>
          </div>
          <h6 class="text-muted text-lg text-uppercase padding-top-2x">Layout: Cards Columns</h6>
          <hr class="margin-bottom-1x">
          <div class="card-columns">
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img04.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title that wraps to a new line</h4>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><span class="text-sm text-muted">Last updated 3 mins ago</span>
              </div>
            </div>
            <div class="card margin-bottom-1x">
              <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><span class="text-sm text-muted">Last updated 3 mins ago</span>
              </div>
            </div>
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img05.jpg" alt="Card image">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p><span class="text-sm text-muted">Last updated 3 mins ago</span>
              </div>
            </div>
            <div class="card text-white bg-primary text-center margin-bottom-1x">
              <div class="card-body">
                <p class="card-text text-medium text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><span class="text-sm opacity-75">Last updated 3 mins ago</span>
              </div>
            </div>
            <div class="card margin-bottom-1x"><img class="card-img-top" src="../img/components/img06.jpg" alt="Card image"></div>
            <div class="card text-center margin-bottom-1x">
              <div class="card-body">
                <h4 class="card-title">Card title</h4>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p><span class="text-sm text-muted">Last updated 3 mins ago</span>
              </div>
            </div>
            <div class="card text-right margin-bottom-1x">
              <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><span class="text-sm text-muted">Last updated 3 mins ago</span>
              </div>
            </div>
          </div>
        </div>
<?=  $this->load->view( '_side_menu', [], TRUE ); ?>
      </div>
    </div>
<?php
}
?>

        <script src="<?= $asset_path ?>/js/vendor.min.js"></script>
        <script src="<?= $asset_path ?>/js/scripts.min.js"></script>
    </body>
</html>
