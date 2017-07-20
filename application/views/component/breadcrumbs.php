<?php

$breadcrumbsLength = count($breadcrumbs);

/* BREADCRUMP LIST FOR GOOGLE */
/* https://developers.google.com/search/docs/data-types/breadcrumbs */
?>
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            <?php
            foreach ($breadcrumbs as $key => $value) { ?>
                {
                    "@type": "ListItem",
                    "position": <?php echo $key+1; ?>,
                    "item": {
                        "@id": "<?php echo $value['url']; ?>",
                        "name": "<?php echo $value['title']; ?>"
                    }
                }<?php
                echo $key < $breadcrumbsLength-1 ? ',' : '';
            }  ?>
        ]
    }
</script>

<?php
/* BREADCRUMP LIST FOR USER */
?>
<div class="breadcrumbs">

    <?php
    foreach ($breadcrumbs as $key => $value) {

        if ($key < $breadcrumbsLength-1) { ?>

            <a href="<?php echo $value['url']; ?>" class="__inner"><?php echo $value['title']; ?></a>
            <div class="__inner __arrow"></div>

        <?php
        } else { ?>

            <div class="__inner __current"><?php echo $value['title']; ?></div>

        <?php
        }

    } ?>

</div>
