<style>
    .discription-content {
        background-image: none !important;
    }

    .content-img {
        width: 35% !important;
    }

    .imagess {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        width: 100% !important;
    }

    .imagess img {
        width: 150px !important;
        height: 150px !important;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
    }

    .main-reviews {
        gap: 0px !important;
    }

    #tab-content {
        border-bottom: 2px solid #ccc;
    }

    /* Default star appearance */
    .star {
        color: gray; /* Empty star color */
        cursor: pointer;
    }

    /* Filled star (selected) */
    .star.selected {
        color: yellow; /* Star text color when selected */
    }
</style>


<div class="discription-content">
    <div class="content am">
        <div class="tabs">
            <div class="tab active" data-tab="reviews">Reviews (<?= ($reviews['total_reviews']) ? $reviews['total_reviews'] : '0' ?>)</div>
        </div>
        <?php foreach ($reviews['reviews'] as $review) { ?>
        <div id="tab-content">
            <!-- Reviews Section -->
            <div class="content-container" id="reviews">
                <div class="content-img">
                    <div class="imagess">
                        <?php foreach ($review['images'] as $image) { ?>
                            <img src="<?= base_url('uploads/reviews/') . $image ?>" alt="Reviews Image">
                        <?php } ?>
                    </div>
                </div>
                <div class="content-text">
                    <div class="main-reviews">
                        <div class="mains-rating">
                            <p><?= ($review['username']) ? $review['username'] : $review['addressname'] ?></p>
                        </div>
                        <div class="main-ratings">
                            <div class="stars" data-rating="<?= $review['rating'] ?>" data-review-id="<?= $review['id'] ?>">
                                <!-- Create 5 stars, none selected by default -->
                                <span class="star <?= ($review['rating'] >= 1) ? 'selected' : ''; ?>" data-star="1">&#9733;</span>
                                <span class="star <?= ($review['rating'] >= 2) ? 'selected' : ''; ?>" data-star="2">&#9733;</span>
                                <span class="star <?= ($review['rating'] >= 3) ? 'selected' : ''; ?>" data-star="3">&#9733;</span>
                                <span class="star <?= ($review['rating'] >= 4) ? 'selected' : ''; ?>" data-star="4">&#9733;</span>	
                                <span class="star <?= ($review['rating'] == 5) ? 'selected' : ''; ?>" data-star="5">&#9733;</span>
                            </div>
                        </div> 
                    </div>
                    <p class="details-para-n"><?= $review['review'] ?></p>
                </div>
            </div>
        </div> <!-- End of tab-content -->
        <?php } ?>
    </div> <!-- End of content -->
</div> <!-- End of discription-content -->

<script>
// Handle star rating interaction

</script>
