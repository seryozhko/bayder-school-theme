      <?php if(is_front_page()) 
        get_template_part( 'template-parts/footer/venues', 'loop' ); 
      ?>

      </div><!-- .col-12 -->
    </div><!-- .row -->
  </main>
  <footer class="container pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md text-center">
        <img class="mb-2" src="<?php bloginfo('template_url'); ?>/assets/logo.png" alt="" width="24" height="24">
        <small class="d-block mb-3 text-muted">2012-<?php echo Date('Y'); ?> © <?php bloginfo('name'); ?></small>
      </div>
    </div>
  </footer>

  <div class="modal fade bs-example-modal-lg" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-full" role="document">
      <div class="modal-content">
        <div class="text-uppercase modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div id="modalCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators"></ol>
            <div class="carousel-inner"></div>

            <a class="carousel-control-prev" href="#modalCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#modalCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        
        </div>
      </div>
    </div>
  </div>

	<?php wp_footer(); ?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/front.js"></script>
</body>
</html>