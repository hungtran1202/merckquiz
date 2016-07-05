<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/28/16
 * Time: 11:25 AM
 */
?>
<div class="home-banner">
    <div class="slider">
        <div class="slider-inner loading-slider">
            <?php
            if (!empty($data['slider'])) {
                foreach ($data['slider'] as $key => $item) {
                    $srcImg = wp_get_attachment_url($item['image']);
                    ?>
                    <div class="slider-item"
                         style="background: url(<?php echo $srcImg ?>) no-repeat center;background-size: cover">
                        <table>
                            <tr>
                                <td>
                                    <div class="container-home">
                                        <div class="box-banner">
                                            <div class="banner-text">
                                                <div class="title"><?php echo $item['title'] ?></div>
                                                <div class="intro"><?php echo $item['intro'] ?></div>
                                            </div>
                                            <div class="button-link">
                                                <a href="<?php echo $item['link'] ?>"><?php echo __('view our services', _NP_TEXT_DOMAIN) ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
            } ?>

        </div>
    </div>
</div>
