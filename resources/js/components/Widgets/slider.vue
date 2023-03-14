<template>
    <div id="slides_container">
        <ul id="slides">
            <li v-for="(item,index) in params" class="slide"
                v-bind:class="{showing:index === 0}"
                v-bind:style="'background-image:url('+item.image+')'">
                <h1>{{item.title}}</h1>
                <div class="after_line"></div>
                <router-link
                        class="button_continue button_first_landing"
                        to="/lk">
                    {{item.button}}
                </router-link>
            </li>
        </ul>
        <button class="buttons controls control_left" id="previous_edu"></button>
        <button class="buttons controls control_right" id="next_edu"></button>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    export default {
        name: "slider",
        mixins: [mixin],
        mounted() {
            let slides = document.querySelectorAll('#slides .slide');

            if (slides.length > 0) {
                let controls = document.querySelectorAll('.controls');
                for (let i = 0; i < controls.length; i++) {
                    controls[i].style.display = 'inline-block';
                }
                let currentSlide = 0;
                let slideInterval = setInterval(nextSlide, 5000);

                function nextSlide() {
                    goToSlide(currentSlide + 1);
                }

                function previousSlide() {
                    goToSlide(currentSlide - 1);
                }

                function goToSlide(n) {
                    slides[currentSlide].className = 'slide';
                    currentSlide = (n + slides.length) % slides.length;
                    slides[currentSlide].className = 'slide showing';
                }

                let next = document.getElementById('next_edu');
                let previous = document.getElementById('previous_edu');

                next.onclick = function () {
                    clearInterval(slideInterval);
                    nextSlide();
                    slideInterval = setInterval(nextSlide, 5000);
                };
                previous.onclick = function () {
                    clearInterval(slideInterval);
                    previousSlide();
                    slideInterval = setInterval(nextSlide, 5000);
                };

            }
        }
    }
</script>

<style scoped>

</style>