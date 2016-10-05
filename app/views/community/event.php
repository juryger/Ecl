<div class="col-sm-8 blog-main">
    <div class="blog-post">
        <?php if ($data['actionParam'] == 1):?>
            <h2 class="blog-post-title">Lorem ipsum dolor sit amet consectetuer adipiscing elit.</h2>
            <blockquote>
                <p class="blog-post-meta">21.08.2016 - 24.08.2016 at <a href="#">Ut aliquam</a></p>
                <p class="blog-post-meta">Opened</p>
            </blockquote>

            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p>
        <?php elseif ($data['actionParam'] == 2): ?>
            <h2 class="blog-post-title">Aliquam tincidunt mauris eu risus.</h2>
            <blockquote>
                <p class="blog-post-meta">01.01.2015 - 07.01.2015 at <a href="#">Al Tuliquam</a></p>
                <p class="blog-post-meta">Closed</p>
            </blockquote>

            <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
        <?php elseif ($data['actionParam'] == 3): ?>
            <h2 class="blog-post-title">Cras iaculis ultricies nulla.</h2>
            <blockquote>
                <p class="blog-post-meta">03.09.2016 - 07.09.2016 at <a href="#">Mu Chaliquam</a></p>
                <p class="blog-post-meta">Pending</p>
            </blockquote>

            <p>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</p>
        <?php else: ?>
            <span style="color: red">There is no such event: </span>
            <?=$data['actionParam']?>
        <?php endif; ?>
    </div><!-- /.blog-post -->

    <nav>
        <ul class="pager">
            <li><a href="<?php echo BASE_URL; ?>public/article/index/tools/prev">Previous</a></li>
            <li><a href="<?php echo BASE_URL; ?>public/article/index/tools/next">Next</a></li>
        </ul>
    </nav>
    <br/>
</div><!-- /.blog-main -->