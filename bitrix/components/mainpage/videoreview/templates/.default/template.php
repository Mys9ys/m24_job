<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/videoreview/style.min.css');?>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/videoreview/script.min.js"); ?>

<?if(!empty($arParams['ID'])){?>
<div class="video_review_box">
    <div class="video_items_box">
        <?foreach ($arResult['product'] as $key=>$item){?>
            <div class="video_all_box">
                <div class="video_title"><?=$item['NAME']?></div>
                <div class="panel_video" id="video_all<?=$key?>">
                    <picture>
                        <img class="lazyLoadM24"
                             data-max="<?=$item['pic']['midi_img']?>"
                             data-min="<?=$item['pic']['min_img']?>"
                             data-media="426"
                             src="/images/loader.jpg">
                    </picture>
                    <div class="button_play_video video-button" data-ytID="<?=$item['vidID']?>" data-target="video_all<?=$key?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                </div>
            </div>
        <?}?>
    </div>
</div>
    <? return;?>
<?}?>

<div class="video_review_box">
    <?$countVids = 1;
    if(!empty($arParams['count'])){?>
        <div class="video_items_box">
        <?foreach ($arResult['items'] as $key=>$item){?>
            <div class="video_all_box">
                <div class="video_title"><?=$item['NAME']?></div>
                <div class="panel_video" id="video_all<?=$key?>">
                    <picture>
                        <img class="lazyLoadM24"
                             data-max="<?=$item['pic']['midi_img']?>"
                             data-min="<?=$item['pic']['min_img']?>"
                             data-media="426"
                             src="/images/loader.jpg">
                    </picture>
                    <div class="button_play_video video-button" data-ytID="<?=$item['vidID']?>" data-target="video_all<?=$key?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                </div>
                <?if(count($item['tags'])<=6){?>
                    <div class="video_tags">
                        <span>Теги: </span>
                        <?foreach ($item['tags'] as $tags){?>
                            <a class="tags_item" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                        <?}?>
                    </div>
                <?} else {?>
                    <div class="video_tags">
                        <span>Теги: </span>
                        <?$video_tags_count = 1;?>
                        <?foreach ($item['tags'] as $tags){?>
                            <a class="tags_item <?if($video_tags_count>6){echo 'video_tags_unvis';}?>" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                            <?$video_tags_count++;?>
                        <?}?>
                        <div class="video_tags_btn all_video_tags">еще теги</div>
                    </div>
                <?}?>
                <?if(count($item['products'])<=3){?>
                    <div class="video_products">
                        <span>Продукция: </span>
                        <?foreach ($item['products'] as $product){?>
                            <a href="<?=$product['link']?>">
                                <img class="lazyLoadM24"
                                     data-max="<?=$product['img']?>"
                                     data-min=""
                                     data-media="0"
                                     src="/images/loader.jpg" title="<?=$product['name']?>">
                            </a>
                        <?}?>
                    </div>
                <?} else {?>
                    <div class="video_products">
                        <span>Продукция: </span>
                        <?$video_products_count = 1;?>
                        <?foreach ($item['products'] as $product){?>
                            <a class="<?if($video_products_count>1){echo 'video_products_unvis';}?>" href="<?=$product['link']?>">
                                <img class="lazyLoadM24"
                                     data-max="<?=$product['img']?>"
                                     data-min=""
                                     data-media="0"
                                     src="/images/loader.jpg" title="<?=$product['name']?>">
                            </a>
                            <?$video_products_count++;?>
                        <?}?>
                        <div class="video_products_btn all_video_products">еще +</div>
                    </div>
                <?}?>
            </div>
        <?}?>
        </div>
    <?} else {?>
        <div class="video_search_block">
            <input class="search_vids_input" type="search" placeholder="Поиск..."><div class="video_search_button"><i class="fa fa-search" aria-hidden="true"></i></div>
            <div class="vids_search_result">
                <div class="vids_search_result_close">+</div>
                <div class="vids_search_result_box"></div>
            </div>

        </div>
        <?=tagsContent($arResult['allTags'])?>
        <?if(empty($_REQUEST['tag'])){?>

            <div class="video_popular_box">
                <div class="video_popular_title">
                    Популярные обзоры:
                </div>
                <?foreach ($arResult['popular'] as $key=>$item){?>
                    <div class="video_item_promo">
                        <div class="video_title"><?=$item['NAME']?></div>
                        <div class="panel_video" id="video_popular<?=$key?>">
                            <picture>
                                <img class="lazyLoadM24"
                                     data-max="<?=$item['pic']['max_img']?>"
                                     data-min="<?=$item['pic']['midi_phone_img']?>"
                                     data-media="426"
                                     src="/images/loader.jpg">
                            </picture>
                            <div class="button_play_video video-button" data-ytID="<?=$item['vidID']?>" data-target="video_popular<?=$key?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                        </div>
                        <?if(count($item['tags'])<=6){?>
                            <div class="video_tags">
                                <span>Теги: </span>
                                <?foreach ($item['tags'] as $tags){?>
                                    <a class="tags_item" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                <?}?>
                            </div>
                        <?} else {?>
                            <div class="video_tags">
                                <span>Теги: </span>
                                <?$video_tags_count = 1;?>
                                <?foreach ($item['tags'] as $tags){?>
                                    <a class="tags_item <?if($video_tags_count>6){echo 'video_tags_unvis';}?>" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                    <?$video_tags_count++;?>
                                <?}?>
                                <div class="video_tags_btn all_video_tags">еще теги</div>
                            </div>
                        <?}?>
                        <?if(count($item['products'])<=3){?>
                            <div class="video_products">
                                <span>Продукция: </span>
                                <?foreach ($item['products'] as $product){?>
                                    <a href="<?=$product['link']?>">
                                        <img class="lazyLoadM24"
                                             data-max="<?=$product['img']?>"
                                             data-min=""
                                             data-media="0"
                                             src="/images/loader.jpg" title="<?=$product['name']?>">
                                    </a>
                                <?}?>
                            </div>
                        <?} else {?>
                            <div class="video_products">
                                <span>Продукция: </span>
                                <?$video_products_count = 1;?>
                                <?foreach ($item['products'] as $product){?>
                                    <a class="<?if($video_products_count>1){echo 'video_products_unvis';}?>" href="<?=$product['link']?>">
                                        <img class="lazyLoadM24"
                                             data-max="<?=$product['img']?>"
                                             data-min=""
                                             data-media="0"
                                             src="/images/loader.jpg" title="<?=$product['name']?>">
                                    </a>
                                    <?$video_products_count++;?>
                                <?}?>
                                <div class="video_products_btn all_video_products">еще +</div>
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </div>
            <div class="video_new_box">
                <div class="video_new_title">Новые видео:</div>
                <?foreach ($arResult['new'] as $key=>$item){?>
                    <div class="video_item_promo">
                        <div class="video_title"><?=$item['NAME']?></div>
                        <div class="panel_video" id="video_new<?=$key?>">
                            <picture>
                                <img class="lazyLoadM24"
                                     data-max="<?=$item['pic']['max_img']?>"
                                     data-min="<?=$item['pic']['midi_phone_img']?>"
                                     data-media="426"
                                     src="/images/loader.jpg">
                            </picture>
                            <div class="button_play_video video-button" data-ytID="<?=$item['vidID']?>" data-target="video_new<?=$key?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                        </div>
                        <?if(count($item['tags'])<=6){?>
                            <div class="video_tags">
                                <span>Теги: </span>
                                <?foreach ($item['tags'] as $tags){?>
                                    <a class="tags_item" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                <?}?>
                            </div>
                        <?} else {?>
                            <div class="video_tags">
                                <span>Теги: </span>
                                <?$video_tags_count = 1;?>
                                <?foreach ($item['tags'] as $tags){?>
                                    <a class="tags_item <?if($video_tags_count>6){echo 'video_tags_unvis';}?>" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                    <?$video_tags_count++;?>
                                <?}?>
                                <div class="video_tags_btn all_video_tags">еще теги</div>
                            </div>
                        <?}?>
                        <?if(count($item['products'])<=3){?>
                            <div class="video_products">
                                <span>Продукция: </span>
                                <?foreach ($item['products'] as $product){?>
                                    <a href="<?=$product['link']?>">
                                        <img class="lazyLoadM24"
                                             data-max="<?=$product['img']?>"
                                             data-min=""
                                             data-media="0"
                                             src="/images/loader.jpg" title="<?=$product['name']?>">
                                    </a>
                                <?}?>
                            </div>
                        <?} else {?>
                            <div class="video_products">
                                <span>Продукция: </span>
                                <?$video_products_count = 1;?>
                                <?foreach ($item['products'] as $product){?>
                                    <a class="<?if($video_products_count>1){echo 'video_products_unvis';}?>" href="<?=$product['link']?>">
                                        <img class="lazyLoadM24"
                                             data-max="<?=$product['img']?>"
                                             data-min=""
                                             data-media="0"
                                             src="/images/loader.jpg" title="<?=$product['name']?>">
                                    </a>
                                    <?$video_products_count++;?>
                                <?}?>
                                <div class="video_products_btn all_video_products">еще +</div>
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </div>

        <?}?>
        <div class="video_items_box ajax_get_vids_all_box" >
            <?$video_all_title = 'Все видео:';
            if(!empty($_REQUEST['tag'])){$video_all_title = '<a class="all_tags" href="/content/video_review/">#Все видео</a>';}?>
            <div class="video_all_title"><?=$video_all_title?></div>
            <?foreach ($arResult['items'] as $key=>$item){?>
                <div class="video_all_box">
                    <div class="video_title"><?=$item['NAME']?></div>
                    <div class="panel_video" id="video_all<?=$key?>">
                        <picture>
                            <img class="lazyLoadM24"
                                 data-max="<?=$item['pic']['max_img']?>"
                                 data-min="<?=$item['pic']['midi_phone_img']?>"
                                 data-media="426"
                                 src="/images/loader.jpg">
                        </picture>
                        <div class="button_play_video video-button" data-ytID="<?=$item['vidID']?>" data-target="video_all<?=$key?>" data-vidStart="<?=$item['timeStart']?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                    </div>
                    <?if(count($item['tags'])<=5){?>
                        <div class="video_tags">
                            <span>Теги: </span>
                            <?foreach ($item['tags'] as $tags){?>
                                <a class="tags_item" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                            <?}?>
                        </div>
                    <?} else {?>
                        <div class="video_tags">
                            <span>Теги: </span>
                            <?$video_tags_count = 1;?>
                            <?foreach ($item['tags'] as $tags){?>
                                <a class="tags_item <?if($video_tags_count>5){echo 'video_tags_unvis';}?>" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                <?$video_tags_count++;?>
                            <?}?>
                            <div class="video_tags_btn all_video_tags">еще теги</div>
                        </div>
                    <?}?>
                    <?if(count($item['products'])<=3){?>
                        <div class="video_products">
                            <span>Продукция: </span>
                            <?foreach ($item['products'] as $product){?>
                                <a href="<?=$product['link']?>">
                                    <img class="lazyLoadM24"
                                         data-max="<?=$product['img']?>"
                                         data-min=""
                                         data-media="0"
                                         src="/images/loader.jpg" title="<?=$product['name']?>">
                                </a>
                            <?}?>
                        </div>
                    <?} else {?>
                        <div class="video_products">
                            <span>Продукция: </span>
                            <?$video_products_count = 1;?>
                            <?foreach ($item['products'] as $product){?>
                                <a class="<?if($video_products_count>1){echo 'video_products_unvis';}?>" href="<?=$product['link']?>">
                                    <img class="lazyLoadM24"
                                         data-max="<?=$product['img']?>"
                                         data-min=""
                                         data-media="0"
                                         src="/images/loader.jpg" title="<?=$product['name']?>">
                                </a>
                                <?$video_products_count++;?>
                            <?}?>
                            <div class="video_products_btn all_video_products">еще +</div>
                        </div>
                    <?}?>
                </div>
            <?}?>
        </div>
        <div class="ajax_get_vids_all ajax_get_vids" data-pagen="1" data-pagemax="<?=$arResult['pagenMaxAll']?>"></div>
        <?if(empty($_REQUEST['tag'])){?>
            <div class="video_items_box ajax_get_vids_blogs_box" >
                <?$video_all_title = 'Видео блоггеров и партнеров:';?>
                <div class="video_all_title"><?=$video_all_title?></div>
                <?foreach ($arResult['Vblog'] as $key=>$item){?>
                    <div class="video_all_box">
                        <div class="video_title"><?=$item['NAME']?></div>
                        <div class="panel_video" id="video_blog<?=$key?>">
                            <picture>
                                <img class="lazyLoadM24"
                                     data-max="<?=$item['pic']['max_img']?>"
                                     data-min="<?=$item['pic']['midi_phone_img']?>"
                                     data-media="426"
                                     src="/images/loader.jpg">
                            </picture>
                            <div class="button_play_video video-button" data-ytID="<?=$item['vidID']?>" data-target="video_blog<?=$key?>" data-vidStart="<?=$item['timeStart']?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                        </div>
                        <?if(count($item['tags'])<=5){?>
                            <div class="video_tags">
                                <span>Теги: </span>
                                <?foreach ($item['tags'] as $tags){?>
                                    <a class="tags_item" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                <?}?>
                            </div>
                        <?} else {?>
                            <div class="video_tags">
                                <span>Теги: </span>
                                <?$video_tags_count = 1;?>
                                <?foreach ($item['tags'] as $tags){?>
                                    <a class="tags_item <?if($video_tags_count>5){echo 'video_tags_unvis';}?>" href="/content/video_review/?tag=<?=$tags?>">#<?=$tags?></a>
                                    <?$video_tags_count++;?>
                                <?}?>
                                <div class="video_tags_btn all_video_tags">еще теги</div>
                            </div>
                        <?}?>
                        <?if(count($item['products'])<=3){?>
                            <div class="video_products">
                                <span>Продукция: </span>
                                <?foreach ($item['products'] as $product){?>
                                    <a href="<?=$product['link']?>">
                                        <img class="lazyLoadM24"
                                             data-max="<?=$product['img']?>"
                                             data-min=""
                                             data-media="0"
                                             src="/images/loader.jpg" title="<?=$product['name']?>">
                                    </a>
                                <?}?>
                            </div>
                        <?} else {?>
                            <div class="video_products">
                                <span>Продукция: </span>
                                <?$video_products_count = 1;?>
                                <?foreach ($item['products'] as $product){?>
                                    <a class="<?if($video_products_count>1){echo 'video_products_unvis';}?>" href="<?=$product['link']?>">
                                        <img class="lazyLoadM24"
                                             data-max="<?=$product['img']?>"
                                             data-min=""
                                             data-media="0"
                                             src="/images/loader.jpg" title="<?=$product['name']?>">
                                    </a>
                                    <?$video_products_count++;?>
                                <?}?>
                                <div class="video_products_btn all_video_products">еще +</div>
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </div>
            <div class="ajax_get_vids_blogs ajax_get_vids" data-pagen="1" data-pagemax="<?=$arResult['pagenMaxBlogs']?>"></div>
        <?}?>

    <?}?>
</div>



<?function tagsContent($allTags){
    $content= '<div class="tag_title">Популярные теги:</div>';
    $items = 1;
     foreach ($allTags as $key=>$count){
        $font_size = 10+$count*0.5;
        if($count==1)$font_size=9;
        if($items<15) $content = $content . '<a class="video_tag" href="/content/video_review/?tag='.$key.'" style="font-size:'. $font_size.'px">#'.$key.'</a>';
         $items++;
    }
   return '<div class="tag_cloud">'.$content.'</div>';
}?>



