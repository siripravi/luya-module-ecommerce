
<section class="products-categories pt-6" style="margin-top:83px;">
    <div class="container">
        <h2 class="mb-3 text-center">Our Menu</h2>
        <div class="row">
            <?php foreach ($categories as $category) : ?>
                <?php
                $url = Url::to((count($category->categories)) ? ['category/pod', 'slug' => $category->slug] : ['category/view', 'slug' => $category->slug]);
                ?>
                <div class="col-md-4"> <!-- new code -->
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <?php if ($category->cover_image_id) { ?>
                                <img src="<?= Yii::$app->storage->getImage($category->cover_image_id)->source ?>" alt="<?= $category->name ?>" title="<?= $category->name ?>" class="card-img rounded-0 img-fluid">
                            <?php } else { ?>
                                <img class="img-fluid" src="<?= Yii::$app->params['image']['size']['category']['none'] ?>" alt="">
                            <?php } ?>

                        </div>
                        <div class="card-body">
                            <a href="<?= $url ?>" class="link">
                                <span class="cat"><i class="uil uil-tag-alt"></i> <?= $category->name ?></span>
                            </a>
                            <!--  <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>M/L/X/XL</li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>  -->
                            <!-- <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul>  -->
                            <!--<p class="text-center mb-0">$250.00</p>  -->
                        </div>
                    </div>
                </div> <!-- end new code -->

            <?php endforeach; ?>

        </div>
    </div>
</section>

/************************************ */

SELECT cv.id
FROM catalog_value AS cv
LEFT JOIN catalog_feature AS cf ON cv.feature_id = cf.id
LEFT JOIN catalog_value AS cv2 ON cv.id = cv2.id
LEFT JOIN catalog_article AS ca ON cv.id = ca.id
LEFT JOIN catalog_product AS cp ON ca.product_id = cp.id
LEFT JOIN catalog_product_group_ref AS cpg ON cp.id = cpg.product_id
LEFT JOIN catalog_group AS cg ON cpg.group_id = cg.id
WHERE (cf.id = 8) 
  AND (cg.id = 7) 
  AND (ca.enabled = 1) 
  AND (cp.enabled = 1) 
GROUP BY cv.id 
ORDER BY cg.position;

/******************************************/
