<div class="teaser-1-big-top-6-small-bottom">

<?php

    $i = 0;

    foreach ($items as $key => $value) {

        $aRendered = false;

        if ($i == 0) { ?>

            <div class="__main flex-container flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">

                <div class="__img">
                    <img
                        class="lazy-img js-lazy-img"
                        src="<?php echo $img_placeholder; ?>"
                        data-src="<?php echo !empty($value['image']) ? $value['image'] : ''; ?>"
                        alt="<?php echo $value['title']; ?>"
                    >
                </div>

                <div class="flex __info">

                    <div class="__headline">
                        <?php
                        if (!empty($value['slug'])) { ?>
                            <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
                        <?php
                        }
                                echo $value['title'];

                        if (!empty($value['slug'])) { ?>
                            </a>
                        <?php
                            $aRendered = true;
                        } ?>

                    </div>

                    <div class="__text">
                        <?php
                        if (!empty($value['slug']) && !$aRendered) { ?>
                            <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
                        <?php
                        }
                                echo $value['text'];

                        if (!empty($value['slug']) && !$aRendered) { ?>
                            </a>
                        <?php
                        } ?>
                    </div>

                    <?php
                    if (!empty($value['slug'])) { ?>
                        <div class="__readmore">Weiterlesen</div>
                    <?php
                    } ?>



                </div>

                <?php
                if (!empty($value['slug']) && !$aRendered) { ?>
                    <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>" class="hidden"></a>
                <?php
                } ?>

            </div>

            <div class="__minis flex-container">

        <?php
        } else {

            if ($i == 1) { ?>

                <div class="flex-container __first flex">

            <?php
            } elseif ($i == 4) { ?>

                </div>

                <div class="flex-container __second flex">

            <?php
            }

            if (!empty($value['slug']) && empty($value['title'])) { ?>
                <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>" class="__mini-item flex">
            <?php
            } else { ?>
                <div class="__mini-item flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
            <?php
            } ?>

                <div class="__img">
                    <img
                        class="lazy-img js-lazy-img"
                        src="<?php echo $img_placeholder; ?>"
                        data-src="<?php echo !empty($value['image']) ? $value['image'] : ''; ?>"
                        alt="<?php echo $value['title']; ?>"
                    >
                </div>
                
                <?php
                if (!empty($value['title'])) { ?>
                    <span class="__title">
                        <?php
                        if (!empty($value['slug'])) { ?>
                            <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
                        <?php
                        }
                                echo $value['title'];

                        if (!empty($value['slug'])) { ?>
                            </a>
                        <?php
                        } ?>
                    </span>
                <?php
                }

                if (!empty($value['slug'])) { ?>
                    <div class="__readmore"></div>
                <?php
                }

            if (!empty($value['slug']) && empty($value['title'])) { ?>
                </a>
            <?php
            } else { ?>
                </div>
            <?php
            }

        }

        $i++;

    }
?>
                </div>

         </div>

</div>