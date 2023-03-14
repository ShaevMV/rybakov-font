<template>
    <div id="ninth_part">
        <div class="container">
            <h2 class="title_landing">{{title}}</h2>
            <div class="carousel_wrap">
                <div id="carousel">
                    <div class="shadow" v-for="(review,index) in params">
                        <img src="images/content/expert1.jpg" id="item-1">
                        <div class="caption carous_item carous_item3">
                            <div class="slider_content">
                                <div class="top_slider_part">
                                    <div class="left_sl"><img :src="review.image"></div>
                                    <div class="right_sl" :inner-html.prop="review.text | truncate(400)">
                                    </div>
                                </div>
                                <div class="bottom_slider_part">
                                    <div class="left_char">
                                        <span class="sl_name">{{review.name}}</span>
                                        <span class="sl_date">{{review.data}}</span>
                                    </div>
                                    <div class="right_link"><a href="#" @click.prevent="show(review)"> Читать полностью</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="nav_button prev_button link pull-left" id="prev" title="prev"></a>
                <a class="nav_button next_button link pull-right" id="next" title="next"></a>
                <div class="dots"></div>
            </div>
        </div>
        <div id="reviewModal" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header modal-review">
                    <div class="uk-flex modal-review__head">
                        <div class="modal-review__image"><img :src="currentReview.image" alt=""></div>
                        <div class="modal-review__info">
                            <div class="modal-review__name">{{currentReview.name}}</div>
                            <div class="modal-review__date">{{currentReview.data}}</div>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-body" uk-overflow-auto v-html="currentReview.text"></div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-primary uk-modal-close" type="button">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import $ from 'jquery';
    import {mixin} from './mixin.js';


    window.jQuery = $;


    export default {
        name: "reviews",
        mixins: [mixin],
        data: () => ({
            currentReview: {
                name: '',
                date: '',
                image: '',
                text: ''
            }
        }),
        mounted() {

            if(typeof $.fn.waterwheelCarousel === 'undefined') {
                require('./plagin/TweenMax.min.js');
                require('./plagin/jquery.touchSwipe.min.js');
                require('./plagin/sliderReviews.js');
            } else {
                var el = jQuery(".carousel_wrap");

                el.find(".dots").html('');
                for (var i = 0; i < el.find(".shadow").length; i++) {
                    if (!i) {
                        el.find(".dots").append('<span class="dots-item dots-item--1 active" data-dots-item="1"></span>');
                    } else {
                        el.find(".dots").append('<span class="dots-item dots-item--' + (i + 1) + '" data-dots-item="' + (i + 1) + '"></span>');
                    }
                }

                jQuery("body").on("click", ".dots-item", function (e) {
                    var el = jQuery(this);
                    if (!el.hasClass("active")) {
                        var numSlide = el.data("dots-item");
                        var activeSlide = jQuery(".dots-item.active");
                        var activeSlideIndex = activeSlide.index() + 1;
                        var elIndex = el.index() + 1;
                        if (elIndex > activeSlideIndex) {
                            var diff = elIndex - activeSlideIndex;
                            var count = 0;
                            for (var i = 0; i < diff; i++) {
                                setTimeout(function () {
                                    carousel.next();
                                }, count);
                                count += 400;
                            }
                        } else {
                            var diff = activeSlideIndex - elIndex;
                            var count = 0;
                            for (var i = 0; i < diff; i++) {
                                setTimeout(function () {
                                    carousel.prev();
                                }, count);
                                count += 400;
                            }
                        }
                    }
                });

                if (jQuery('#carousel').length) {

                    if (jQuery(window).width() > '1000') {

                        var carousel = jQuery("#carousel").waterwheelCarousel({
                            flankingItems: 1,
                            separation: 275,
                            sizeMultiplier: 0.8,
                            separationMultiplier: 0.9,
                            speed: 250,
                            movedToCenter: function ($item) {
                                jQuery(".dots span").removeClass("active");
                                var summ = $item.index() + 1;
                                jQuery(".dots span[data-dots-item=" + summ + "]").addClass("active");
                            }

                        });

                    } else {
                        var carousel = jQuery("#carousel").waterwheelCarousel({
                            flankingItems: 0,
                            separation: 275,
                            sizeMultiplier: 0.8,
                            separationMultiplier: 0.9,
                            speed: 250,
                            movedToCenter: function ($item) {
                                jQuery(".dots span").removeClass("active");
                                var summ = $item.index() + 1;
                                jQuery(".dots span[data-dots-item=" + summ + "]").addClass("active");
                            }

                        });
                    }

                    jQuery("#carousel").swipe({
                        swipeStatus: function (event, phase, direction, distance) {
                            if (phase == "end") {
                                if (direction == "right") {
                                    carousel.prev();
                                } else if (direction == "left") {
                                    carousel.next();
                                } else {
                                    return false;
                                }
                            }
                        },
                        triggerOnTouchEnd: false,
                        threshold: 100
                    });
                    jQuery('#prev').on('click', function () {
                        carousel.prev();
                        return false;
                    });
                    jQuery('#next').on('click', function () {
                        carousel.next();
                        return false;
                    });
                }
            }
        },
        methods: {
            show(review) {
                this.currentReview = review;
                window.UIkit.modal('#reviewModal').show();
            }
        },
        filters: {
            truncate(text, stop, clamp) {
                if (text === null || text === undefined) return '';
                return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '');
            },
        }
    }

</script>

<style scoped>

</style>