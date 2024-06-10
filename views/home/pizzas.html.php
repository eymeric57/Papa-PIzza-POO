<div class="admin-container">
  <h1><?= $h1 ?></h1>
  <a class="call-action" href="#">Je crée ma pizza</a>
</div>
<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
    <?php foreach ($pizzas as $pizza) : ?>
      <div class="card m-2" style="width: 18rem;">
        <a href="/pizza/<?= $pizza->id ?>">
          <img src="/assets/images/pizza/<?= $pizza->image_path ?>" alt="<?= $pizza->name ?>" class="card-img-top img-fluid img-pizza">
        </a>
        <div class="card-body">
          <h3 class="card-title sub-title text-center"><?= $pizza->name ?></h3>
        </div>
      </div>
    <?php endforeach ?>
  </div>

</div>