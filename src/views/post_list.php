<?php echo $this->getView('default_header', $data) ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php 
                foreach($data->collection as $key => $array) {
                    $url = get_permalink($array->ID);
                    $newUrl = str_replace( home_url(), "", $url ); // strip domain (since it's headless)
                    ?>
                <div class="post-list-item">
                    <h3><a href="<?php echo $newUrl ?>"><?php echo $array->post_title ?></a></h3>
                    <p class="post-teaser">
                        <?php echo $this->getBodyExcerpt($array->post_content) ?>
                    </p>
                    <div class="read-more"><a href="<?php echo $newUrl ?>">Read more...</a></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if (!empty($data->paging['pages']) && $data->paging['pages'] > 1): ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <nav>
                  <ul class="pagination pagination-lg">
                    <?php if($data->paging['previous'] !== null): ?>
                    <li>
                      <a href="<?php echo $data->url."?page=".$data->paging['previous'] ?>" aria-label="Previous Page">
                        <span aria-hidden="true">&#8592;&nbsp; Previous</span>
                      </a>
                    </li>
                    <?php endif ?>
                    <?php 
                    for ($i = 1; $i <= $data->paging['pages']; $i++) {
                      if($i == $data->paging['page']) {
                        echo '<li class="active"><span>'.$i.' <span class="sr-only">(current)</span></span></li>';
                      } else {
                        $url = $data->url."?page=".$i;
                        echo '<li><a href="'.$url.'">'.$i.'</a></li>';
                      } 
                    }
                    ?>
                    <?php if($data->paging['next'] !== null): ?>
                    <li>
                      <a href="<?php echo $data->url."?page=".$data->paging['next'] ?>" aria-label="Next Page">
                        <span aria-hidden="true">Next &nbsp;&#8594;</span>
                      </a>
                    </li>
                    <?php endif ?>
                  </ul>
                </nav>
            </div>
        </div>
    </div>
  <?php endif ?>